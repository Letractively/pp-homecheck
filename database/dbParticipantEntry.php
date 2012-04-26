<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/* Participant Entry Database for Homecheck
 * @version February 19, 2012
 * @author Ruben Martinez
*/


include_once(dirname(__FILE__).'/../domain/ParticipantEntry.php');
include_once(dirname(__FILE__).'/dbinfo.php');

function create_dbParticipantEntry() {
		connect();
		mysql_query("DROP TABLE IF EXISTS dbParticipantEntry");
		$result = mysql_query("CREATE TABLE dbParticipantEntry(date TEXT NOT NULL, id TEXT NOT NULL, call_time TEXT NOT NULL, result TEXT NOT NULL, " .
				"    note TEXT)");
		mysql_close();
        if(!$result) {
            echo mysql_error(). "Error creating dbParticipantEntry table. <br>";
            return false;
        }
        else return true;
}
/*
 * add a ParticipantEntry to dbParticipantEntry table: if already there, return false
 */
	function insert_dbParticipantEntry($participantentry){
		if(!$participantentry instanceof ParticipantEntry) {
			return false;
		}
		connect();
		$query = "SELECT * FROM dbParticipantEntry WHERE id = '".$participantentry->get_id()."'";
		$result = mysql_query($query);
		
		//if there's no entry for this id, add it
		if (mysql_num_rows($result) != 0) {
			delete_dbParticipantEntry($participantentry->get_id());
			connect();
		}
   		$query = "INSERT INTO dbParticipantEntry VALUES('".
		         $participantentry->get_date()."','".
   				 $participantentry->get_id()."','".
	             $participantentry->get_call_time()."','".
	             $participantentry->get_result()."','".
	             $participantentry->get_note().
	             "');";
	    $result = mysql_query($query);
		if (!$result) {
			echo (mysql_error(). " Unable to insert into dbParticipantEntry: ".$participantentry->get_id(). "\n");
			mysql_close();
			return false;
		}
            
   		mysql_close();
   		return true;
   	}

/*
 * @return a single row from dbParticipantEntry table matching a particular id.
 * if not in table, return false
 */
	function retrieve_dbParticipantEntry($id){
		connect();
   		$query = 'SELECT * FROM dbParticipantEntry WHERE id = "'.$id.'"';
		$result = mysql_query($query);
		if ($result==null || mysql_num_rows($result) !== 1) {
		   mysql_close();
		   return false;
		}
		$result_row = mysql_fetch_assoc($result);
		$partEntry = new ParticipantEntry($result_row['date'],$result_row['id'],$result_row['call_time'],$result_row['result'], $result_row['note']);
		mysql_close();
   		return $partEntry;
	}
   	
	function update_dbParticipantEntry($participantentry){
		if(!$participantentry instanceof ParticipantEntry) {
			return false;
		}
		if (delete_dbParticipantEntry($participantentry->get_id()))
			return insert_dbParticipantEntry($participantentry);
		else {
			echo (mysql_error()."Unable to update dbParticipantEntry: ".$participantentry->get_id());
			return false;
		}
	}
	
/*
 * remove a participant entry from dbParticipantEntry table.  If already there, return false
 */
	function delete_dbParticipantEntry ($id) {
		connect();
   		$query= 'DELETE FROM dbParticipantEntry WHERE id = "'.$id.'"';
		$result=mysql_query($query);
		mysql_close();
		if (!$result) {
		   echo (mysql_error()." Cannot delete from dbParticipantEntry: ".$id);
		   return false;
		}
		return true;
	}
	
/*	
 * @return all rows from dbParticipantEntry table ordered by id
 * if none there, return false
 */

	function getall_dbParticipantEntry($id){
		connect();
   		$query = "SELECT * FROM dbParticipantEntry ORDER BY id";
		$result = mysql_query($query);
		if ($result==null || mysql_num_rows($result) == 0) {
		   mysql_close();
		   return false;
		}
		mysql_close();
   		return $result;
	}
	
	function getall_names() {
		connect();
		$query = mysql_query("SELECT * FROM dbParticipantEntry ORDER BY result");
		$partEntries = array();
		while ($result_row = mysql_fetch_assoc(query)) {
			$partEntry = new ParticipantEntry($result_row['date'],$result_row['id'],$result_row['call_time'],$result_row['result'], $result_row['note']);
			$partEntries[] = $partEntry;
		}
		return $partEntries;
	}

?>