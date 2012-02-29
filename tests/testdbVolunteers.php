<?php
include_once(dirname(__FILE__).'/../domain/Volunteer.php');
include_once(dirname(__FILE__).'/../database/dbVolunteers.php'); 
class testdbVolunteers extends UnitTestCase {
	function testdbVolunteersModule() {
		//Test table creation
			$this->assertTrue(create_dbVolunteers());
	
		//Test volunteers
		$vol1 = new Volunteer("Smith", "John", "111 Main Street", "Brunswick", "ME", "04011", 2071234567, "", "name@domain1.com",
                    "volunteer", "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com",
        			"retired", "", "","completed", "Wed:1,Fri:5,FI","Wed:1,Fri5","", "08-01-01","", "active", "", "");
		$vol2 = new Volunteer("Doe", "Jane", "222 Park", "Topsham", "ME", "11111", 2072345678, "", "jane@doe.com",
                         "volunteer", "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com",
        			"retired", "", "","completed", "Wed:2,Fri:4,FI","Wed:2,Fri:4","", "08-01-01","", "active", "", "");
		$vol3 = new Volunteer("Bar", "Foo", "33 Center Street", "Bowdoinham", "ME", "04011", 2074567890, "", "3@4.com",
                         "volunteer", "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com",
        			"retired", "", "","completed", "Wed:3,Fri:1","Wed:3,Fri:1","", "08-01-01","", "active", "", "");
		$vol4 = new Volunteer("Edison", "Alex", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"edison.ace@gmail.com", "volunteer",  "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com",
        			"retired", "", "","completed", "Wed:4,Fri:2","Wed:4,Fri:2","", "08-01-01","", "active", "", "");
        $vol5 = new Volunteer("Erkis", "Nicole", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"nikwik@gmail.com", "volunteer",  "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com",
        			"retired", "", "","completed", "Wed:5,Fri:3","Wed:5,Fri:3","", "08-01-01","", "active", "", "");
        $vol6 = new Volunteer("Martinez", "Ruben", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"rmartin@bowdoin.edu", "volunteer",  "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com",
        			"retired", "", "","completed", "Wed:1,Thu:4,FI","Thu:4","", "08-01-01","", "active", "", "");
        $vol7 = new Volunteer("Ashe", "Madeleine", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"madeleine@ashe.com", "coordinator", "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com",
        			"retired", "", "","completed", "Wed:2,Thu:5","Thu:5","", "08-01-01","", "active", "", "");
        $vol8 = new Volunteer("Tucker", "Allen", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"allen@bowdoin.edu", "dispatch", "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com",
        			"retired", "", "","completed", "FI","","", "08-01-01","", "active", "", "");
        //Test inserts
		$this->assertTrue(insert_dbVolunteers($vol1));
		$this->assertTrue(insert_dbVolunteers($vol2));
		$this->assertTrue(insert_dbVolunteers($vol3));
		$this->assertTrue(insert_dbVolunteers($vol4));
		$this->assertTrue(insert_dbVolunteers($vol5));
		$this->assertTrue(insert_dbVolunteers($vol6));
		$this->assertTrue(insert_dbVolunteers($vol7));
		$this->assertTrue(insert_dbVolunteers($vol8));
		
		//Test Retrieve
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_id (), "John2071234567");
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_first_name (), "John");
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_last_name (), "Smith");
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_address(), "111 Main Street");
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_city (), "Brunswick");
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_state (), "ME");
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_zip(), "04011");
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_phone1 (), 2071234567);
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_phone2 (), null);
		$this->assertEqual(retrieve_dbVolunteers($vol1->get_id())->get_email(), "name@domain1.com");
		
		//Test Update
		$vol2 = new Volunteer("Doe", "Jane", "444 Park", "Topsham", "ME", "11111", 2072345678, "", "jane@doe.com",
                         "volunteer", "Me", "Retired", "Mayor", "None", "Clear", 
                         "T,TH", "A,B,C", "", "03-03-03", "04-04-04", "Active", "None", "password1");
		$this->assertTrue(update_dbVolunteers($vol2));
		$this->assertEqual(retrieve_dbVolunteers($vol2->get_id())->get_address(), "444 Park");
		
		//Test Delete
		$this->assertTrue(delete_dbVolunteers($vol1->get_id()));
		$this->assertTrue(delete_dbVolunteers($vol2->get_id()));
		$this->assertTrue(delete_dbVolunteers($vol3->get_id()));
		$this->assertFalse(retrieve_dbVolunteers($vol2->get_id()));
		
		echo ("testdbVolunteers complete \n");
	}
}
?>