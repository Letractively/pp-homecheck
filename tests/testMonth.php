<?php
include_once(dirname(__FILE__).'/../domain/Month.php');
class testMonth extends UnitTestCase {
    function testMonthModule() {    

    	//Fake entry to test
    	$feb2012 = "12-02";
    	$a_month = new Month($feb2012,"unpublished","Everything is fine");
    	
    	//Test getters
    	$this->assertTrue($a_month->get_id() == "12-02");
    	$this->assertTrue($a_month->get_status() == "unpublished");
    	$this->assertTrue($a_month->get_first_day() == 3);
    	$this->assertEqual($a_month->get_no_days(), 29);
    	$testArray = $a_month->get_shift_ids();
    	$this->assertEqual($testArray[0], "12-02-01");
    	$this->assertEqual($testArray[1], "12-02-02");
    	$this->assertTrue($a_month->get_notes() == "Everything is fine");
    	
    	echo ("testMonth complete.\n");
    }
}

?>
