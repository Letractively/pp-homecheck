<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/*
 * Volunteer class for Homecheck
 * @author Allen Tucker
 * @version February 4, 2012
 */

class Volunteer {
	private $id; 	     	// id (unique key) = first_name . phone1
	private $first_name;   	// first name as a string
	private $last_name;    	// last name as a string
	private $address;      	// address - string
	private $city; 	     	// city - string
	private $state;			// state - string
	private $zip; 	     	// zip code - integer
	private $phone1; 		// primary phone
	private $phone2; 		// alternate phone
    private $email; 		// e-mail address
    private $type;			// type of volunteer: "volunteer", "coordinator", or "dispatch"
	private $contacts;		// array of emergency contacts: �name:phone:email�

	private $availability; 	// array of day:week pairs; e.g., [�Mon:1�, �Thu:4�, �FI�]
	private $schedule;     	// array of scheduled shifts; e.g.,  [�Mon:1�, �Wed:2�]
	private $history;      	// array of recent shifts worked; e.g., [�11-03-12�,"11-05-12"]
	private $start_date;   	// yy-mm-dd
	private $end_date;		// yy-mm-dd
	private $status;       // "active", "away", or "former"
	private $notes;		   // Coordinator's notes to/from this person
	private $password;     // password for system access

        /**
         * constructor for a Volunteer
         */
    function __construct($last_name, $first_name, $address, $city, $state, $zip, $phone1, $phone2, $email, $type,
                         $contacts, $availability, $schedule, $history, $start_date, $end_date, $status, $notes, $password) {                
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
        $this->type = $type;
        if ($contacts == "") 
        	$this->contacts = array();
        else 
        	$this->contacts = explode(',',$contacts);
        
        if ($availability == "") 
        	$this->availability = array();
        else 
        	$this->availability = explode(',',$availability);
        if ($schedule == "") 
        	$this->schedule = array();
        else 
        	$this->schedule = explode(',',$schedule);
        if ($history == "") 
        	$this->history = array();
        else 
        	$this->history = explode(',',$history);
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->status = $status;
        $this->notes = $notes;      
        if ($password=="")
            $this->password = md5($this->id);
        else $this->password = $password;       
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
    function get_email(){
        return $this->email;
    }
    function get_type(){
        return $this->type;
    }
    function get_contacts() {
        return $this->contacts;
    }
    function get_availability() {
        return $this->availability;
    }
    function get_schedule() {
        return $this->schedule;
    }
    function get_history() {
        return $this->history;
    }
    function get_start_date() {
        return $this->start_date;
    }
    function get_end_date(){
        return $this->end_date;
    }
	function get_status(){
        return $this->status;
    }
	function get_notes(){
        return $this->notes;
    }
    function get_password () {
        return $this->password;
    }
    function set_password ($p) {
        $this->password = $p;
    }
        
}
?>
