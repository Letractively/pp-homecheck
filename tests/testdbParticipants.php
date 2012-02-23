<?php
include_once(dirname(__FILE__).'/../domain/Participant.php');
include_once(dirname(__FILE__).'/../database/dbParticipants.php'); 
class testdbParticipants extends UnitTestCase {
	function testdbParticipantsModule() {
		
		//create an empty dbParticipants table
		$this->assertTrue(create_dbParticipants());
		
		//create participants to add to the database
		$part1 = new Participant("Smith", "John", "111 Main Street", "Brunswick", "ME", "04011", 2071234567, "", "name@domain1.com",
                         "yes", "Contact,Relationship,555-5555", "Physician 111-1111", "yes", "In,Home,Services", "Special,Needs",
                         "no", "Person with other key", "yes - Blue Sedan, License Plate FFF44", "01-01-01", "completed", 
						 "01-01-01", "", "active", "log entries", "notes");
		$part2 = new Participant("Doe", "Jane", "222 Park", "Topsham", "ME", "11111", 2072345678, "", "jane@doe.com",
                         "no - lives with John Doe, husband", "Contact,Relationship,555-5555", "Physician 222-2222", "yes", 
                         "In,Home,Services", "Special,Needs", "yes-under doormat", "Person with other key", "no", "04-04-04", 
						 "authorized", "04-15-06", "", "away", "log entries", "notes");
		$part3 = new Participant("Blah", "Blah", "33 Center Street", "Bowdoinham", "ME", "04011", 2074567890, "", "blah@blah.com",
                         "yes", "Contact,Relationship,555-5555", "Physician 333-3333", "yes", "In,Home,Services", "Special,Needs",
                         "no", "Person with other key", "no", "05-05-05", "completed", "05-30-99", "", "active", "log entries", "notes");
		
		//test the insert function
		$this->assertTrue(insert_dbParticipants($part1));
		$this->assertTrue(insert_dbParticipants($part2));
		$this->assertTrue(insert_dbParticipants($part3));
		
		//test the retrieve function
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_id (), "John2071234567");
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_first_name (), "John");
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_last_name (), "Smith");
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_address(), "111 Main Street");
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_city (), "Brunswick");
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_state (), "ME");
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_zip(), "04011");
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_phone1 (), 2071234567);
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_phone2 (), null);
		$this->assertEqual(retrieve_dbParticipants($part1->get_id())->get_email(), "name@domain1.com");
		
		//test the update function
        $part2->set_address("6 Pleasant Street");
        $this->assertTrue(update_dbParticipants($part2));
        $this->assertEqual(retrieve_dbParticipants($part2->get_id())->get_address (), "6 Pleasant Street");   
		
		//test the delete function
        $this->assertTrue(delete_dbParticipants($part1->get_id()));
		$this->assertTrue(delete_dbParticipants($part2->get_id()));
		$this->assertTrue(delete_dbParticipants($part3->get_id()));
		$this->assertFalse(retrieve_dbParticipants($part1->get_id()));
		
		echo ("testdbParticipants complete \n");
	}
}
?>