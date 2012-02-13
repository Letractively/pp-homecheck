<?php
include_once(dirname(__FILE__).'/../domain/Shift.php');
class testShift extends UnitTestCase {
    function testShiftModule() {     
    	
    	//fake shift to test
    	$shift = new Shift("12-02-12", "malcom1234567890", "Monday", "notes");
    	 
    	//testing getter functions
    	$this->assertTrue($participant->get_yy_mm_dd() == "12-02-12");
    	$this->assertTrue($participant->get_volunteer_id() == "malcom1234567890");
    	$this->assertTrue($participant->get_day() == "Monday");
    	$this->assertTrue($participant->get_notes() == "notes");
    	
    	echo ("testShift complete\n");
    }
}

?>
