<?php
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/*
* dbParticipants class for Homecheck
* @author Nicole Erkis
* @version February 24, 2012
*/

include_once(dirname(__FILE__).'/../domain/Participant.php');
include_once(dirname(__FILE__).'/dbinfo.php');

function create_dbParticipants() {
	connect();
	mysql_query("DROP TABLE IF EXISTS dbParticipants");
	$result = mysql_query("CREATE TABLE dbParticipants (id TEXT NOT NULL, first_name TEXT, last_name TEXT, address TEXT,
    					  city TEXT, state TEXT, zip TEXT, phone1 VARCHAR(12) NOT NULL, phone2 VARCHAR(12), email TEXT,
    					  lives_alone TEXT, contacts TEXT, physician TEXT, lifeline TEXT, in_home_services TEXT,
    					  special_needs TEXT, hidden_key TEXT, other_key TEXT, has_car TEXT, birthday TEXT, background_check TEXT,
    					  start_date TEXT, end_date TEXT, status TEXT, log_entries TEXT, notes TEXT)");
	mysql_close();
	if (!$result) {
		echo mysql_error() . "Error creating dbParticipants table. <br>";
		return false;
	}
	return true;
}

function insert_dbParticipants ($participant){
	if (! $participant instanceof Participant) {
		return false;
	}
	connect();

	$query = "SELECT * FROM dbParticipants WHERE id = '" . $participant->get_id() . "'";
	$result = mysql_query($query);
	if (mysql_num_rows($result) != 0) {
		delete_dbParticipants ($participant->get_id());
		connect();
	}

	$query = "INSERT INTO dbParticipants VALUES ('".
	$participant->get_id()."','".
	$participant->get_first_name()."','".
	$participant->get_last_name()."','".
	$participant->get_address()."','".
	$participant->get_city()."','".
	$participant->get_state()."','".
	$participant->get_zip()."','".
	$participant->get_phone1()."','".
	$participant->get_phone2()."','".
	$participant->get_email()."','".
	$participant->get_lives_alone()."','".
	implode(',',$participant->get_contacts())."','".
		
	$participant->get_physician()."','".
	$participant->get_lifeline()."','".
	implode(',',$participant->get_in_home_services())."','".
	implode(',',$participant->get_special_needs())."','".
	$participant->get_hidden_key()."','".
	$participant->get_other_key()."','".
	$participant->get_has_car()."','".
	$participant->get_birthday()."','".
	$participant->get_background_check()."','".
	$participant->get_start_date()."','".
	$participant->get_end_date()."','".
	$participant->get_status()."','".
	implode(',',$participant->get_log_entries())."','".
	$participant->get_notes().
	"');";

	$result = mysql_query($query);
	if (!$result) {
		echo (mysql_error(). " unable to insert into dbParticipants: " . $participant->get_id(). "\n");
		mysql_close();
		return false;
	}
	mysql_close();
	return true;
}

function retrieve_dbParticipants ($id) {
	connect();
	$query = "SELECT * FROM dbParticipants WHERE id = '".$id."'";
	$result = mysql_query ($query);
	if (mysql_num_rows($result) !== 1){
		mysql_close();
		return false;
	}
	$result_row = mysql_fetch_assoc($result);
	$theParticipant = new Participant($result_row['last_name'], $result_row['first_name'], $result_row['address'],
	$result_row['city'],$result_row['state'], $result_row['zip'],
	$result_row['phone1'], $result_row['phone2'], $result_row['email'],
	$result_row['lives_alone'], $result_row['contacts'], 
	$result_row['physician'], $result_row['lifeline'], $result_row['in_home_services'], $result_row['special_needs'], 
	$result_row['hidden_key'], $result_row['other_key'], $result_row['has_car'],
	$result_row['birthday'], $result_row['background_check'], $result_row['start_date'], $result_row['end_date'],
	$result_row['status'], $result_row['log_entries'], $result_row['notes']);
	mysql_close();
	return $theParticipant;
}

function getall_participants () {
	connect();
	$query = "SELECT * FROM dbParticipants ORDER BY last_name";
	$result = mysql_query ($query);
	$theParticipant = array();
	while ($result_row = mysql_fetch_assoc($result)) {
		$theParticipant = new Participant($result_row['last_name'], $result_row['first_name'], $result_row['address'],
		$result_row['city'],$result_row['state'], $result_row['zip'],
		$result_row['phone1'], $result_row['phone2'], $result_row['email'],
		$result_row['lives_alone'], $result_row['contacts'], 
		$result_row['physician'], $result_row['lifeline'], $result_row['in_home_services'], $result_row['special_needs'], 
		$result_row['hidden_key'], $result_row['other_key'], $result_row['has_car'],
		$result_row['birthday'], $result_row['background_check'], $result_row['start_date'], $result_row['end_date'],
		$result_row['status'], $result_row['log_entries'], $result_row['notes']);
		$theParticipants[] = $theParticipant;
	}
	mysql_close();
	return $theParticipants;
}

function update_dbParticipants ($participant) {
	if (! $participant instanceof Participant) {
		echo ("Invalid argument for update_dbParticipants function call");
		return false;
	}
	if (delete_dbParticipants($participant->get_id()))
	return insert_dbParticipants($participant);
	else {
		echo (mysql_error()."unable to update dbParticipants table: ".$participant->get_id());
		return false;
	}
}

function delete_dbParticipants($id) {
	connect();
	$query="DELETE FROM dbParticipants WHERE id=\"".$id."\"";
	$result=mysql_query($query);
	mysql_close();
	if (!$result) {
		echo (mysql_error()." unable to delete from dbParticipants: ".$id);
		return false;
	}
	return true;
}
?>