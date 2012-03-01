<?php
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/*
* dbDailyLogs class for Homecheck
* @author Alex Edison
* @version February 16, 2012
*/

include_once(dirname(__FILE__).'/../domain/DailyLog.php');
include_once(dirname(__FILE__).'/dbinfo.php');

function create_dbDailyLogs(){
	connect();
	mysql_query("DROP TABLE IF EXISTS dbDailyLogs");
	$result = mysql_query("CREATE TABLE dbDailyLogs (id TEXT NOT NULL, participants TEXT, volunteer TEXT, notes TEXT)");
	mysql_close();
	if(!$result){
		echo (mysql_error()."Error creating dbDailyLogs. \n");
		return false;
	}
	return true;
	
}

function retrieve_dbDailyLogs($id){
	connect();
	$result=mysql_query("SELECT * FROM dbDailyLogs WHERE id = '".$id."'");
	if(mysql_num_rows($result) !== 1){
		mysql_close();
		return false;
	}
	$result_row = mysql_fetch_assoc($result);
	$outLog = new DailyLog($result_row['id'], $result_row['participants'], $result_row['volunteer'],$result_row['notes']);
	mysql_close();
	return $outLog;
	
	
}

function getall_dbDailyLogs(){
	connect();
	$result=mysql_query("SELECT * FROM dbDailyLogs ORDER BY id");
	$outLogs = array();
	while($result_row = mysql_fetch_assoc($result)){
		$outLog = new DailyLog($result_row['id'], $result_row['participants'], $result_row['volunteer'],$result_row['notes']);
		$outLogs[] = $outLog;
	}
	mysql_close();
	return $outLogs;
}

function insert_dbDailyLogs($dailyLog){
	if(! $dailyLog instanceof DailyLog){
		return false;
	}
	connect();
	$query = "SELECT * FROM dbDailyLogs WHERE id = '" . $dailyLog->get_id() . "'";
	$result = mysql_query($query);
	if (mysql_num_rows($result) != 0) {
		delete_dbDailyLogs ($dailyLog->get_id());
		connect();
	}
	
	$query = "INSERT INTO dbDailyLogs VALUES ('".
			$dailyLog->get_id()."','".
			implode(',',$dailyLog->get_entry_ids())."','".
			$dailyLog->get_volunteer_id()."','".
			$dailyLog->get_note()."');";
	$result = mysql_query($query);
	if (!$result) {
		echo (mysql_error(). " Unable to insert into dbDailyLogs: " . $dailyLog->get_id(). "\n");
		mysql_close();
		return false;
	}
	mysql_close();
	return true;
	
}

function update_dbDailyLogs($dailyLog){
	if (! $dailyLog instanceof DailyLog) {
		echo ("Invalid argument for update_dbDailyLogs function call");
		return false;
	}
	if (delete_dbDailyLogs($dailyLog->get_id()))
		return insert_dbDailyLogs($dailyLog);
	else {
		echo (mysql_error()."unable to update dbDailyLogs table: ".$dailyLog->get_id());
		return false;
	}
}

function delete_dbDailyLogs($id){
	connect();
	$result = mysql_query("DELETE FROM dbDailyLogs WHERE id =\"".$id."\"");
	mysql_close();
	if (!$result) {
		echo (mysql_error()." unable to delete from dbDailyLogs: ".$id."\n");
		return false;
	}
	return true;
}
?>