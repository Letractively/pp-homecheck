<?php
include_once(dirname(__FILE__).'/../domain/DailyLog.php');
include_once(dirname(__FILE__).'/../database/dbDailyLogs.php'); 
class testdbDailyLogs extends UnitTestCase {
	function testdbDailyLogsModule() {
		//Test table creation
		// $this->assertTrue(create_dbDailyLogs());
	
		//Test logs
		$log1 = new DailyLog("01-01-01","test123,test456,test789", "vol123456", "No Notes");
		$log2 = new DailyLog("02-02-02","testABC,testDEF,testGHI", "vol9876", "All the notes");
		$log3 = new DailyLog("03-03-03","testQQQ,testWWWW", "volABC", "Nothing happened");
		$log4 = new DailyLog("04-04-04","testEEE,testRRR", "volQWERTY", "All good here");
		$log5 = new DailyLog("05-05-05","testFOO,testBAR", "volME", "Something Happened");
		
		//Test inserts
		$this->assertTrue(insert_dbDailyLogs($log1));
		$this->assertTrue(insert_dbDailyLogs($log2));
		$this->assertTrue(insert_dbDailyLogs($log3));
		$this->assertTrue(insert_dbDailyLogs($log4));
		$this->assertTrue(insert_dbDailyLogs($log5));
		
		//Test retrieve
		$testLog = retrieve_dbDailyLogs($log1->get_id());
 		$this->assertEqual($testLog->get_id(),"01-01-01");
  		$testArray = $testLog->get_entry_ids();
		$this->assertEqual($testArray[0],"test123");
		$this->assertEqual($testArray[1],"test456");
		$this->assertEqual($testArray[2],"test789");
		$this->assertEqual($testLog->get_volunteer_id(),"vol123456");
		$this->assertEqual($testLog->get_note(),"No Notes");

		//Test update
		$log2 = new DailyLog("02-02-02","test111,test222,test333", "vol9876", "All the notes");
		$this->assertTrue(update_dbDailyLogs($log2));
		$testArray = retrieve_dbDailyLogs($log2->get_id())->get_entry_ids();
		$this->assertEqual($testArray[0],"test111");
		$this->assertEqual($testArray[1],"test222");
		$this->assertEqual($testArray[2],"test333");
		
		//Test delete
		$this->assertTrue(delete_dbDailyLogs($log1->get_id()));
		$this->assertTrue(delete_dbDailyLogs($log2->get_id()));
		$this->assertTrue(delete_dbDailyLogs($log3->get_id()));
		$this->assertTrue(delete_dbDailyLogs($log4->get_id()));
		$this->assertTrue(delete_dbDailyLogs($log5->get_id()));
		$this->assertFalse(retrieve_dbDailyLogs($log3->get_id()));
		
		echo("testdbDailyLogs compelte. \n");
	}
}
		
?>