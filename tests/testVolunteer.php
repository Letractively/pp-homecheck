<?php
include_once(dirname(__FILE__).'/../domain/Volunteer.php');
class testVolunteer extends UnitTestCase {
    function testVolunteerModule() {
             
        //fake person to test
        $volunteer = new Volunteer("Smith", "John", "14 Way St","Harpswell", "ME", "04079", "(207)111-2345", "", 
    				"jsmith@aol.com", "contact1:2071112222:c1@email.com,contact2:2072223333:c2@email.com",
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
        $this->assertEqual($contacts[0], "contact1:2071112222:c1@email.com");
        $this->assertEqual($contacts[1], "contact2:2072223333:c2@email.com");
        // testing first contact's name, phone, and email
        $first_contact = explode(':',$contacts[0]);
        $this->assertEqual($first_contact[0], "contact1");
        $this->assertEqual($first_contact[1], "2071112222");
        $this->assertEqual($first_contact[2], "c1@email.com");
                 
        echo ("testVolunteer complete\n");
    }
}

?>
