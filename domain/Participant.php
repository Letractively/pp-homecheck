<?php
class Participant {
	private $person_id; 	// id (unique key) = first_name . phone1
	private $first_name;   // first name as a string
	private $last_name;    // last name as a string
	private $address;      // address - string
	private $city; 	     // city - string
	private $state; 	     // state - string
	private $zip; 	     // zip code - integer
	private $phone1; 	     // primary phone
	private $phone2; 	     // alternate phone
      private $email; 	     // email address
	private $lives_alone;  // ÒyesÓ or ÒnoÓ with name & relationship of housemate
	private $contacts;	// array of emergency contacts: 
					// Òname, relationship, phoneÓ
	private $physician;	// primary care physician and phone
	private $lifeline;	// ÒyesÓ, ÒnoÓ, or Òother typeÓ
	private $in_home_services; // array of in-home services being used
	private $special_needs;	// array of special needs that Volunteers should know
	private $hidden_key;	// ÒnoÓ or Òyes Ð give locationÓ
	private $other_key; // Òname, address, and phoneÓ of other person with a key
	private $has_car;		// ÒnoÓ or Òyes Ð give license plate and descriptionÓ
	private $birthday;     // format: yy-mm-dd
	private $background_check; // ÒauthorizedÓ, ÒunauthorizedÓ, ÒcompletedÓ
	private $start_date;   // format: yy-mm-dd
	private $end_date;	// format: yy-mm-dd
	private $status;       // "active", "away", or "former"	
	private $log_entries;  // array of LogEntry's for this person
	private $notes;		// general notes about this person
}
?>