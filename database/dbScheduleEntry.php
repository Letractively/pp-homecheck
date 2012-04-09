<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/* Participant Entry Database for Homecheck
 * @version February 25, 2012
 * @author Ruben Martinez
*/


include_once(dirname(__FILE__).'/../domain/ScheduleEntry.php');
include_once(dirname(__FILE__).'/dbinfo.php');

function create_dbScheduleEntry() {
		connect();
		mysql_query("DROP TABLE IF EXISTS dbScheduleEntry");
		$result = mysql_query("CREATE TABLE dbScheduleEntry(id TEXT NOT NULL, volunteer_id TEXT NOT NULL, notes TEXT)");
		mysql_close();
        if(!$result) {
            echo mysql_error(). "Error creating dbScheduleEntry table. <br>";
            return false;
        }
        else return true;
}
/*
 * add a ScheduleEntry to dbScheduleEntry table: if already there, return false
 */
	function insert_dbScheduleEntry($schedEntry){
		if(!$schedEntry instanceof ScheduleEntry) {
			return false;
		}
		connect();
		$query = "SELECT * FROM dbScheduleEntry WHERE id = '".$schedEntry->get_id()."'";
		$result = mysql_query($query);
		
		//if there's no entry for this id, add it
		if (mysql_num_rows($result) != 0) {
			delete_dbScheduleEntry($schedEntry->get_id());
			connect();
		}
   		$query = "INSERT INTO dbScheduleEntry VALUES('".
		         $schedEntry->get_id()."','".
   				 $schedEntry->get_volunteer_id()."','".
	             $schedEntry->get_notes().
	             "');";
	    $result = mysql_query($query);
		if (!$result) {
			echo (mysql_error(). " Unable to insert into dbScheduleEntry: ".$schedEntry->get_id(). "\n");
			mysql_close();
			return false;
		}
            
   		mysql_close();
   		return true;
   	}

/*
 * @return a single row from dbScheduleEntry table matching a particular id.
 * if not in table, return false
 */
	function retrieve_dbScheduleEntry($id){
		connect();
   		$query = 'SELECT * FROM dbScheduleEntry WHERE id = "'.$id.'"';
		$result = mysql_query($query);
		if ($result==null || mysql_num_rows($result) !== 1) {
		   mysql_close();
		   return false;
		}
		$result_row = mysql_fetch_assoc($result);
		$sEntry = new ScheduleEntry($result_row['id'],$result_row['volunteer_id'],$result_row['notes']);
		mysql_close();
   		return $sEntry;
	}

	function update_dbScheduleEntry($schedEntry){
		if(!$schedEntry instanceof ScheduleEntry) {
			return false;
		}
		if (delete_dbScheduleEntry($schedEntry->get_id()))
			return insert_dbScheduleEntry($schedEntry);
		else {
			echo (mysql_error()."Unable to update dbScheduleEntry: ".$schedEntry->get_id());
			return false;
		}
	}
	
/*
 * remove a participant entry from dbScheduleEntry table.  If already there, return false
 */
	function delete_dbScheduleEntry ($id) {
		connect();
   		$query= 'DELETE FROM dbScheduleEntry WHERE id = "'.$id.'"';
		$result=mysql_query($query);
		mysql_close();
		if (!$result) {
		   echo (mysql_error()." Cannot delete from dbScheduleEntry: ".$id);
		   return false;
		}
		return true;
	}
	
/*	
 * @return all rows from dbScheduleEntry table ordered by id
 * if none there, return false
 */

	function getall_dbScheduleEntry($id){
		connect();
   		$query = "SELECT * FROM dbScheduleEntry ORDER BY id";
		$result = mysql_query($query);
		if ($result==null || mysql_num_rows($result) == 0) {
		   mysql_close();
		   return false;
		}
		mysql_close();
   		return $result;
	}
?>