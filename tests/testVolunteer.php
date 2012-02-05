<?php
include_once(dirname(__FILE__).'/../domain/Volunteer.php');
class testVolunteer extends UnitTestCase {
    function testVolunteerModule() {
             
        //fake person to test
        $volunteer = new Volunteer("Smith", "John", "14 Way St","Harpswell", "ME", "04079", "(207)111-2345", "", 
    				"jsmith@aol.com", "", "retired", "", "","completed", "Wed3,Fri4,FI","Wed3","",
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
                 
        echo ("testVolunteer complete\n");
    }
}

?>
