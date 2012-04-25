<?php
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/*
* dbReports class for Homecheck
* @author Alex Edison
* @version February 16, 2012
*/

include_once(dirname(__FILE__).'/../domain/Report.php');
include_once(dirname(__FILE__).'/dbinfo.php');

function create_dbReports(){
	connect();
	mysql_query("DROP TABLE IF EXISTS dbReports");
	$result = mysql_query("CREATE TABLE dbReports (id TEXT NOT NULL, status TEXT)");
	mysql_close();
	if(!$result){
		echo (mysql_error()."Error creating dbReports. \n");
		return false;
	}
	return true;
}

function retrieve_dbReports($id){
	connect();
	$result=mysql_query("SELECT * FROM dbReports WHERE id = '".$id."'");
	if(mysql_num_rows($result) !== 1){
		mysql_close();
		return false;
	}
	$result_row = mysql_fetch_assoc($result);
	$dateInfo = explode(' ',$result_row['id']);
	$outReport = new Report($dateInfo[0], $dateInfo[2],$result_row['status']);
	mysql_close();
	return $outReport;
}

function getall_dbReports(){
	connect();
	$result=mysql_query("SELECT * FROM dbReports ORDER BY id");
	$outReports = array();
	while($result_row = mysql_fetch_assoc($result)){
		$result_row = mysql_fetch_assoc($result);
		$dateInfo = explode(' ',$result_row['id']);
		$outReport = new Report($dateInfo[0], $dateInfo[2],$result_row['status']);
		$outReports[] = $outReport;
	}
	mysql_close();
	return $outLogs;
}

function insert_dbReports($report){
	if(! $report instanceof Report){
		return false;
	}
	connect();
	$query = "SELECT * FROM dbReports WHERE id = '" . $report->get_id() . "'";
	$result = mysql_query($query);
	if (mysql_num_rows($result) != 0) {
		delete_dbReports ($report->get_id());
		connect();
	}
	
	$query = "INSERT INTO dbReports VALUES ('".
	$report->get_id()."','".
	$report->get_status()."');";
	$result = mysql_query($query);
	if (!$result) {
		echo (mysql_error(). " Unable to insert into dbReports: " . $report->get_id(). "\n");
		mysql_close();
		return false;
	}
	mysql_close();
	return true;
}

function update_dbReports($report){
	if (! $report instanceof Report) {
		echo ("Invalid argument for update_dbReports function call");
		return false;
	}
	if (delete_dbReports($report->get_id()))
	return insert_dbReports($report);
	else {
		echo (mysql_error()."unable to update dbReports table: ".$report->get_id());
		return false;
	}
	

}

function delete_dbReports($id){
	connect();
	$result = mysql_query("DELETE FROM dbReports WHERE id =\"".$id."\"");
	mysql_close();
	if (!$result) {
		echo (mysql_error()." unable to delete from dbReports: ".$id."\n");
		return false;
	}
	return true;
}

?>