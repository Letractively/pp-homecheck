<?php
include_once(dirname(__FILE__).'/../domain/Vounteer.php');
include_once(dirname(__FILE__).'/../database/dbVounteers.php'); 
class testdbVolunteers extends UnitTestCase {
	function testdbVolunteersModule() {

		//Test table creation
		$this->assertTrue(create_dbVolunteers());
		
		//Test volunteers
		$vol1 = new Volunteer("Smith", "John", "111 Main Street", "Brunswick", "ME", "04011", 2071234567, "", "name@domain1.com",
                         "You", "Employed", "Bowdoin,Bates", "None", "Clear", 
                         "M,W,F", "1,2,3", "", "01-01-01", "02-02-02", "Active", "Test1", "password");
		$vol2 = new Volunteer("Doe", "Jane", "222 Park", "Topsham", "ME", "11111", 2072345678, "", "jane@doe.com",
                         "Me", "Retired", "Mayor", "None", "Clear", 
                         "T,TH", "A,B,C", "", "03-03-03", "04-04-04", "Active", "None", "password1");
		$vol3 = new Volunteer("Bar", "Foo", "33 Center Street", "Bowdoinham", "ME", "04011", 2074567890, "", "3@4.com",
                         "Us", "Employed", "Lobsterman", "None", "Clear", 
                         "Sat,Sun", "2,4,6", "", "05-05-05", "06-06-06", "Active", "None", "password2");
		//Test inserts
		$this->assertTrue(insert_dbVolunteers($vol1));
		$this->assertTrue(insert_dbVolunteers($vol2));
		$this->assertTrue(insert_dbVolunteers($vol3));
		
		//Test Retrieve
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_id (), "John2071234567");
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_first_name (), "John");
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_last_name (), "Smith");
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_address(), "111 Main Street");
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_city (), "Brunswick");
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_state (), "ME");
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_zip(), "04011");
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_phone1 (), 2071234567);
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_phone2 (), null);
		$this->assertEqual(retrieve_dbPersons($person1->get_id())->get_email(), "name@domain1.com");
		
		//Test Update
		$vol2 = new Volunteer("Doe", "Jane", "444 Park", "Topsham", "ME", "11111", 2072345678, "", "jane@doe.com",
                         "Me", "Retired", "Mayor", "None", "Clear", 
                         "T,TH", "A,B,C", "", "03-03-03", "04-04-04", "Active", "None", "password1");
		$this->assertTrue(update_dbPersons($vol2));
		$this->assertEqual(retrieve_dbPersons($vol2->get_id())->get_address(), "444 park");
		
		//Test Delete
		$this->assertTrue(delete_dbVolunteers($vol1->get_id()));
		$this->assertTrue(delete_dbVolunteers($vol2->get_id()));
		$this->assertTrue(delete_dbVolunteers($vol3->get_id()));
		$this->assertFalse(retrieve_dbVolunteers($vol2->get_id()));
		
		echo ("testdbVolunteers complete \n");
	}
}
?>