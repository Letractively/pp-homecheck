<?php
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/* Shift Database for Homecheck
* @version February 29, 2012
* @author Nicole Erkis
*/

include_once(dirname(__FILE__).'/../domain/Shift.php');
include_once(dirname(__FILE__).'/dbinfo.php');

function create_dbShifts() {
		connect();
		mysql_query("DROP TABLE IF EXISTS dbShifts");
		$result = mysql_query("CREATE TABLE dbShifts(yy_mm_dd TEXT NOT NULL, volunteer_id TEXT NOT NULL, day TEXT, notes TEXT)");
		mysql_close();
		if(!$result) {
			echo mysql_error(). "Error creating dbShifts table. <br>";
            return false;
		}
		else return true;
}

function insert_dbShifts($shift){
		if(!$shift instanceof Shift) {
			return false;
		}
		connect();
		$query = "SELECT * FROM dbShifts WHERE yy_mm_dd = '".$shift->get_yy_mm_dd()."'";
		$result = mysql_query($query);

		if (mysql_num_rows($result) != 0) {
			delete_dbShifts($shift->get_yy_mm_dd());
			connect();
		}
		$query = "INSERT INTO dbShifts VALUES('".
		         $shift->get_yy_mm_dd()."','".
		         $shift->get_volunteer_id()."','".
		         $shift->get_day()."','".
				 $shift->get_notes().
				 "');";
		$result = mysql_query($query);
		if (!$result) {
			echo (mysql_error(). " Unable to insert into dbShifts: ".$shift->get_yy_mm_dd(). "\n");
			mysql_close();
			return false;
		}
            
   		mysql_close();
		return true;
}

function retrieve_dbShifts($yy_mm_dd){
		connect();
		$query = 'SELECT * FROM dbShifts WHERE yy_mm_dd = "'.$yy_mm_dd.'"';
		$result = mysql_query($query);
		if ($result==null || mysql_num_rows($result) !== 1) {
			mysql_close();
			return false;
		}
		$result_row = mysql_fetch_assoc($result);
		$theShift = new Shift($result_row['yy_mm_dd'],$result_row['volunteer_id'],$result_row['day'],$result_row['notes']);
		mysql_close();
		return $theShift;
}

function update_dbShifts($shift){
		if(!$shift instanceof Shift) {
			return false;
		}
		if (delete_dbShifts($shift->get_yy_mm_dd()))
			return insert_dbShifts($shift);
		else {
			echo (mysql_error()."Unable to update dbShifts: ".$shift->get_yy_mm_dd());
			return false;
		}
}

function delete_dbShifts ($yy_mm_dd) {
		connect();
		$query= 'DELETE FROM dbShifts WHERE yy_mm_dd = "'.$yy_mm_dd.'"';
		$result=mysql_query($query);
		mysql_close();
		if (!$result) {
			echo (mysql_error()." Cannot delete from dbShifts: ".$yy_mm_dd);
			return false;
		}
		return true;
	}

function getall_dbShifts($yy_mm_dd){
		connect();
		$query = "SELECT * FROM dbShifts ORDER BY yy_mm_dd";
		$result = mysql_query($query);
		if ($result==null || mysql_num_rows($result) == 0) {
			mysql_close();
			return false;
		}
		mysql_close();
   		return $result;
}

function getall_shifts($result) {
		connect();
		$status = mysql_query("SELECT * FROM dbShifts ORDER BY result");
		mysql_close();
		return status;
}

?>