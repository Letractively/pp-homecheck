<?php
include_once(dirname(__FILE__).'/../domain/Participant.php');
class testParticipant extends UnitTestCase {
    function testParticipantModule() {     
    	
    	//fake person to test
    	$participant = new Participant("Smith", "John", "14 Way St","Harpswell", "ME", "04079", "(207)111-2345", 
    						"(207)555-5555", "jsmith@aol.com", "no", "contact1,contact2", "physician (207) 555-5555", 
    						"yes", "service1,service2", "need1,need2", "no", "name:address:phone", "yes--description", 
    	    				"30-02-30", "completed", "01-01-01", "", "active", "log1,log2", "notes");
    	 
    	//testing getter functions
    	$this->assertTrue($participant->get_first_name() == "John");
    	$this->assertTrue($participant->get_last_name() == "Smith");
    	$this->assertTrue($participant->get_address() == "14 Way St");
    	$this->assertTrue($participant->get_city() == "Harpswell");
    	$this->assertTrue($participant->get_state() == "ME");
    	$this->assertTrue($participant->get_zip() == "04079");
    	$this->assertTrue($participant->get_phone1() == "(207)111-2345");
    	$this->assertTrue($participant->get_phone2() == "(207)555-5555");
    	$this->assertTrue($participant->get_email() == "jsmith@aol.com");
    	
    	$this->assertTrue($participant->get_lives_alone() == "no");
    	// testing each individual contact
    	$contacts = $participant->get_contacts();
    	$this->assertEqual($contacts[0], "contact1");
    	$this->assertEqual($contacts[1], "contact2");
    	$this->assertTrue($participant->get_physician() == "physician (207) 555-5555");
    	$this->assertTrue($participant->get_lifeline() == "yes");
    	// testing individual in home services
    	$in_home_services = $participant->get_in_home_services();
    	$this->assertEqual($in_home_services[0], "service1");
    	$this->assertEqual($in_home_services[1], "service2");
		// testing individual special needs
		$special_needs = $participant->get_special_needs();
		$this->assertEqual($special_needs[0], "need1");
		$this->assertEqual($special_needs[1], "need2");
    	$this->assertTrue($participant->get_hidden_key() == "no");
    	$this->assertTrue($participant->get_other_key() == "name:address:phone");
    	$this->assertTrue($participant->get_has_car() == "yes--description");
    	$this->assertTrue($participant->get_birthday() == "30-02-30");
    	$this->assertTrue($participant->get_background_check() == "completed");
    	$this->assertTrue($participant->get_start_date() == "01-01-01");
    	$this->assertTrue($participant->get_end_date() == "");
    	$this->assertTrue($participant->get_status() == "active");
    	// testing individual log entries
    	$log_entries = $participant->get_log_entries();
    	$this->assertEqual($log_entries[0], "log1");
    	$this->assertEqual($log_entries[1], "log2");
      	$this->assertTrue($participant->get_notes() == "notes");
    	 
    	echo ("testParticipant complete\n");
    }


}

?>
