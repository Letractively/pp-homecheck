<?php
include_once(dirname(__FILE__).'/../domain/DailyLog.php');
class testDailyLog extends UnitTestCase {
    function testDailyLogModule() {    

    	//Fake entry to test
    	$testLog = new DailyLog("12-02-09","test123,test456","admin.1","Everything was fine");
    	
    	//Test getters
    	$this->assertTrue($testLog->get_id() == "12-02-09");
    	$testArray = $testLog->get_entry_ids();
    	$this->assertTrue($testArray[0] == "test123");
    	$this->assertTrue($testArray[1] == "test456");
    	$this->assertTrue($testLog->get_volunteer_id() == "admin.1");
    	$this->assertTrue($testLog->get_note() == "Everything was fine");
    	
    	echo ("testDailyLog complete.\n");
    }
}

?>
