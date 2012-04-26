<?php
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/*
* Participant class for Homecheck
* @author Nicole Erkis
* @version February 6, 2012
*/
class Participant {
	private $id; 		// id (unique key) = first_name . phone1
	private $first_name;   		// first name as a string
	private $last_name;    		// last name as a string
	private $address;      		// address - string
	private $city; 	     		// city - string
	private $state; 	   		// state - string
	private $zip; 	     		// zip code - integer
	private $phone1; 	    	// primary phone
	private $phone2; 	    	// alternate phone
    private $email; 	    	// email address
	private $lives_alone;  		// ÒyesÓ or ÒnoÓ with name & relationship of housemate
	private $contacts;			// array of emergency contacts: each one has the form
								// Òname:relationship:phoneÓ
	private $physician;			// primary care physician and phone
	private $lifeline;			// ÒyesÓ, ÒnoÓ, or Òother typeÓ
	private $in_home_services; 	// array of in-home services being used
	private $special_needs;		// array of special needs that Volunteers should know
	private $hidden_key;		// ÒnoÓ or Òyes Ð give locationÓ
	private $other_key; 		// Òname:address:and phoneÓ of other person with a key
	private $has_car;			// ÒnoÓ or Òyes Ð give license plate and descriptionÓ
	private $birthday;    		// format: yy-mm-dd
	private $background_check; 	// ÒauthorizedÓ, ÒunauthorizedÓ, ÒcompletedÓ
	private $start_date;   		// format: yy-mm-dd
	private $end_date;			// format: yy-mm-dd
	private $status;       		// "active", "away", or "former"	
	private $log_entries;  		// array of LogEntrys for this person
	private $notes;				// general notes about this person
	
	/**
	* constructor for a Participant
	*/
	function __construct($last_name, $first_name, $address, $city, $state, $zip, $phone1, $phone2, $email, 
	$lives_alone, $contacts, $physician, $lifeline, $in_home_services, $special_needs, $hidden_key, $other_key, 
	$has_car, $birthday, $background_check, $start_date, $end_date, $status, $log_entries, $notes) {
		$this->id = $first_name . $phone1;
		$this->last_name = $last_name;
		$this->first_name = $first_name;
		$this->address = $address;
		$this->city = $city;
		$this->state = $state;
		$this->zip = $zip;
		$this->phone1 = $phone1;
		$this->phone2 = $phone2;
		$this->email = $email;
		$this->lives_alone = $lives_alone;
		if ($contacts == "")
			$this->contacts = array();
		else
			$this->contacts = explode(',',$contacts);
		$this->physician = $physician;
		$this->lifeline = $lifeline;
		if ($in_home_services == "")
			$this->in_home_services = array();
		else
			$this->in_home_services = explode(',',$in_home_services);
		if ($special_needs == "")
			$this->special_needs = array();
		else
			$this->special_needs = explode(',',$special_needs);
		$this->hidden_key = $hidden_key;
		$this->other_key = $other_key;
		$this->has_car = $has_car;
		$this->birthday = $birthday;
		$this->background_check = $background_check;
		 
		$this->start_date = $start_date;
		$this->end_date = $end_date;
		$this->status = $status;
		if ($log_entries == "")
			$this->log_entries = array();
		else
			$this->log_entries = explode(',', $log_entries);
		$this->notes = $notes;
	}
	
	//getter functions
	function get_id() {
		return $this->id;
	}
	function get_first_name() {
		return $this->first_name;
	}
	function get_last_name() {
		return $this->last_name;
	}
	function get_address() {
		return $this->address;
	}
	function get_city() {
		return $this->city;
	}
	function get_state() {
		return $this->state;
	}
	function get_zip() {
		return $this->zip;
	}
	function get_phone1() {
		return $this->phone1;
	}
	function get_phone2() {
		return $this->phone2;
	}
	function get_email() {
		return $this->email;
	}
	function get_lives_alone() {
		return $this->lives_alone;
	}
	function get_contacts() {
		return $this->contacts;
	}
	function get_physician() {
		return $this->physician;
	}
	function get_lifeline() {
		return $this->lifeline;
	}
	function get_in_home_services() {
		return $this->in_home_services;
	}
	function get_special_needs() {
		return $this->special_needs;
	}
	function get_hidden_key() {
		return $this->hidden_key;
	}
	function get_other_key() {
		return $this->other_key;
	}
	function get_has_car() {
		return $this->has_car;
	}
	function get_birthday() {
		return $this->birthday;
	}
	function get_background_check() {
		return $this->background_check;
	}
	function get_start_date() {
		return $this->start_date;
	}
	function get_end_date() {
		return $this->end_date;
	}
	function get_status() {
		return $this->status;
	}
	function get_log_entries() {
		return $this->log_entries;
	}
	function get_notes() {
		return $this->notes;
	}
	
	//setters
	function set_address($address) {
		$this->address = $address;
	}

	function update_logs($newLog){
	  $log_entries[]=$newLog;
	}
}
?>