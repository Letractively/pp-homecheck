<?php
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/*
* dbVolunteers class for Homecheck
* @author Alex Edison
* @version February 16, 2012
*/

include_once(dirname(__FILE__).'/../domain/Volunteer.php');
include_once(dirname(__FILE__).'/dbinfo.php');

function create_dbVolunteers(){
	connect();
	mysql_query("DROP TABLE IF EXISTS dbVolunteers");
	$result = mysql_query("CREATE TABLE dbVolunteers (id TEXT NOT NULL, last_name TEXT, first_name TEXT, address TEXT, city TEXT, state TEXT, zip TEXT, 
							phone1 VARCHAR(12) NOT NULL, phone2 VARCHAR(12), email TEXT, type TEXT, contacts TEXT, availability TEXT, schedule TEXT, 
							history TEXT, start_date TEXT, end_date TEXT, status TEXT, notes TEXT, password TEXT)");
	mysql_close();
	if(!$result){
			echo (mysql_error()."Error creating database dbVolunteers. \n");
			return false;
	}
	return true;
}

function retrieve_dbVolunteers($id){
	connect();
	$result=mysql_query("SELECT * FROM dbVolunteers WHERE id  = '".$id."'");
	if(mysql_num_rows($result) !== 1){
			mysql_close();
			return false;
	}
	$result_row = mysql_fetch_assoc($result);
	$theVol = new Volunteer($result_row['last_name'], $result_row['first_name'], $result_row['address'], $result_row['city'], $result_row['state'],
							$result_row['zip'], $result_row['phone1'], $result_row['phone2'], $result_row['email'], $result_row['type'], $result_row['contacts'],
							$result_row['availability'], $result_row['schedule'], $result_row['history'], $result_row['start_date'], $result_row['end_date'], 
							$result_row['status'], $result_row['notes'], $result_row['password']);
	mysql_close();
	return $theVol;
}

function getall_dbVolunteers(){
	connect();
	$result = mysql_query("SELECT * FROM dbVolunteers ORDER BY last_name");
	$theVols = array();
	while($result_row = mysql_fetch_assoc($result)){
		$theVol = new Volunteer($result_row['last_name'], $result_row['first_name'], $result_row['address'], $result_row['city'], $result_row['state'],
							$result_row['zip'], $result_row['phone1'], $result_row['phone2'], $result_row['email'], $result_row['type'], $result_row['contacts'],
							$result_row['availability'], $result_row['schedule'], $result_row['history'], $result_row['start_date'], $result_row['end_date'], 
							$result_row['status'], $result_row['notes'], $result_row['password']);
		$theVols[] = $theVol;
	}
	mysql_close();
	return $theVols;
}

function insert_dbVolunteers($volunteer){
	if(! $volunteer instanceof Volunteer){
		return false;
	}
	connect();
	$query = "SELECT * FROM dbVolunteers WHERE id = '" . $volunteer->get_id() . "'";
	$result = mysql_query($query);
	if (mysql_num_rows($result) != 0) {
		delete_dbVolunteers ($volunteer->get_id());
		connect();
	}
	
	$query = "INSERT INTO dbVolunteers VALUES ('".
				$volunteer->get_id()."','" .
				$volunteer->get_last_name()."','".
				$volunteer->get_first_name()."','".
				$volunteer->get_address()."','".
				$volunteer->get_city()."','".
				$volunteer->get_state()."','".
				$volunteer->get_zip()."','".
				$volunteer->get_phone1()."','".
				$volunteer->get_phone2()."','".
				$volunteer->get_email()."','".
				$volunteer->get_type()."','".
				implode(',',$volunteer->get_contacts())."','".
				implode(',',$volunteer->get_availability())."','".
				implode(',',$volunteer->get_schedule())."','".
				implode(',',$volunteer->get_history())."','".
				$volunteer->get_start_date()."','".
				$volunteer->get_end_date()."','".
				$volunteer->get_status()."','".
				$volunteer->get_notes()."','".
				$volunteer->get_password().
	            "');";
	$result = mysql_query($query);
	if (!$result) {
		echo (mysql_error(). " Unable to insert into dbVolunteers: " . $volunteer->get_id(). "\n");
		mysql_close();
		return false;
	}
	mysql_close();
	return true;
	
}

function update_dbVolunteers($volunteer){
	if (! $volunteer instanceof Volunteer) {
		echo ("Invalid argument for update_dbVolunteer function call");
		return false;
	}
	if (delete_dbVolunteers($volunteer->get_id()))
	return insert_dbVolunteers($volunteer);
	else {
		echo (mysql_error()."unable to update dbVolunteers table: ".$volunteer->get_id());
		return false;
	}
}

function delete_dbVolunteers($id){
	connect();
	$result = mysql_query("DELETE FROM dbVolunteers WHERE id =\"".$id."\"");
	mysql_close();
	if (!$result) {
		echo (mysql_error()." unable to delete from dbVolunteers: ".$id);
		return false;
	}
	return true;
}
?>