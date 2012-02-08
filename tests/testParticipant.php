<?php
include_once(dirname(__FILE__).'/../domain/Participant.php');
class testParticipant extends UnitTestCase {
    function testParticipantModule() {     
    	
    	//fake person to test
    	$participant = new Participant("Smith", "John", "14 Way St","Harpswell", "ME", "04079", "(207)111-2345", "",
    	    				"jsmith@aol.com", "no", "", "physician (207) 555-5555", "yes", "", "", "no", 
    	    				"name, address, phone", "yes--description", "30-02-30", "completed", "01-01-01", 
    						"", "active", "", "");
    	 
    	//testing getter functions
    	$this->assertTrue($participant->get_first_name() == "John");
    	$this->assertTrue($participant->get_last_name() == "Smith");
    	$this->assertTrue($participant->get_address() == "14 Way St");
    	$this->assertTrue($participant->get_city() == "Harpswell");
    	$this->assertTrue($participant->get_state() == "ME");
    	$this->assertTrue($participant->get_zip() == "04079");
    	$this->assertTrue($participant->get_phone1() == "(207)111-2345");
    	$this->assertTrue($participant->get_phone2() == "");
    	$this->assertTrue($participant->get_email() == "jsmith@aol.com");
    	
    	$this->assertTrue($participant->get_lives_alone() == "no");
    	//$this->assertTrue($participant->get_contacts() == "");
    	$this->assertTrue($participant->get_physician() == "physician (207) 555-5555");
    	$this->assertTrue($participant->get_lifeline() == "yes");
    	//$this->assertTrue($participant->get_in_home_services() == "");
    	//$this->assertTrue($participant->get_special_needs() == "");
    	$this->assertTrue($participant->get_hidden_key() == "no");
    	$this->assertTrue($participant->get_other_key() == "name, address, phone");
    	$this->assertTrue($participant->get_has_car() == "yes--description");
    	$this->assertTrue($participant->get_birthday() == "30-02-30");
    	$this->assertTrue($participant->get_background_check() == "completed");
    	$this->assertTrue($participant->get_start_date() == "01-01-01");
    	$this->assertTrue($participant->get_end_date() == "");
    	$this->assertTrue($participant->get_status() == "active");
    	//$this->assertTrue($participant->get_log_entries() == "");
    	$this->assertTrue($participant->get_notes() == "");
    	 
    	echo ("testVolunteer complete\n");
    }


}

?>
