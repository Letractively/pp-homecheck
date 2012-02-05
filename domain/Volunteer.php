<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homeplate, which is free software.  It comes 
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
	private $contacts;		// array of emergency contacts: Òname, phone, emailÓ
	private $employment_status;		// ÒemployedÓ, ÒunemployedÓ, ÒretiredÓ
	private $employment_history;	// array of employees (most recent first): 
							// Òtitle, company, address, start date, end dateÓ
	private $convictions;		// prior convictions (ÒnoÓ or ÒyesÓ with explanation)
	private $background_check;	// ÒauthorizedÓ, ÒunauthorizedÓ, ÒcompletedÓ
	private $availability; 	// array of day-week pairs; e.g.,ÒMon1Ó, ÒThu4Ó, ÒFIÓ
	private $schedule;     	// array of scheduled shifts; e.g.,  [ÒMon1Ó, ÒWed2Ó]
	private $history;      	// array of recent shifts worked; e.g., [Ò11-03-12Ó]
	private $start_date;   	// yy-mm-dd
	private $end_date;		// yy-mm-dd
	private $status;       // "active", "away", or "former"
	private $notes;		// Coordinator's notes to/from this person
	private $password;     // password for system access

        /**
         * constructor for a Volunteer
         */
    function __construct($last_name, $first_name, $address, $city, $state, $zip, $phone1, $phone2, $email,
                         $contacts, $employment_status, $employment_history, $convictions, $background_check, 
                         $availability, $schedule, $history, $start_date, $end_date, $status, $notes, $password) {                
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
        $this->contacts = explode(',',$contacts);
        $this->employment_status = $employment_status;
        $this->employment_history = explode(',',$employment_history);       
        $this->convictions = $convictions;
        $this->background_check = $background_check;
                 
        $this->availability = explode(',',$availability);
        $this->schedule = explode(',',$schedule);
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
    // rest of the getters need to be added...
    
    function get_password () {
        return $this->password;
    }
    //setter functions ... can be added later as needed
        
}
?>
