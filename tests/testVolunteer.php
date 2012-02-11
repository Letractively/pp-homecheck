<?php
include_once(dirname(__FILE__).'/../domain/Volunteer.php');
class testVolunteer extends UnitTestCase {
    function testVolunteerModule() {
             
        //fake person to test
        $volunteer = new Volunteer("Smith", "John", "14 Way St","Harpswell", "ME", "04079", "(207)111-2345", "", 
    				"jsmith@aol.com", "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com",
        			"retired", "", "","completed", "Wed:3,Fri:4,FI","Wed:3","",
    				"08-01-01","", "active", "", "");
                 
        //testing getter functions
        $this->assertTrue($volunteer->get_first_name() == "John");
        $this->assertTrue($volunteer->get_last_name() == "Smith");
        $this->assertTrue($volunteer->get_address() == "14 Way St");
        $this->assertTrue($volunteer->get_city() == "Harpswell");
        $this->assertTrue($volunteer->get_state() == "ME");
        $this->assertTrue($volunteer->get_zip() == "04079");
        $this->assertTrue($volunteer->get_phone1() == "(207)111-2345");
        $this->assertTrue($volunteer->get_phone2() == "");
        $this->assertTrue($volunteer->get_email() == "jsmith@aol.com");
        // testing each individual contact
        $contacts = $volunteer->get_contacts();
        $this->assertEqual($contacts[0], "Mary:2071112222:Mary@email.com");
        $this->assertEqual($contacts[1], "Sue:2072223333:Sue@email.com");
        // testing first contact's name, phone, and email
        $first_contact = explode(':',$contacts[0]);
        $this->assertEqual($first_contact[0], "Mary");
        $this->assertEqual($first_contact[1], "2071112222");
        $this->assertEqual($first_contact[2], "Mary@email.com");
                 
        echo ("testVolunteer complete\n");
    }
}

?>
