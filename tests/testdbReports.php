<?php
include_once(dirname(__FILE__).'/../domain/Report.php');
include_once(dirname(__FILE__).'/../database/dbReports.php');
class testdbReports extends UnitTestCase {
	function testdbReportsModule() {
		//Test table creation
		//$this->assertTrue(create_dbReports());
		
		//Test repots
		$report1 = new Report("01-01-01","02-02-02","Active");
		$report2 = new Report("03-03-03","04-04-04","Archived");
		$report3 = new Report("05-05-05","06-06-06","Published");
		
		//Inserts
		$this->assertTrue(insert_dbReports($report1));
		$this->assertTrue(insert_dbReports($report2));
		$this->assertTrue(insert_dbReports($report3));
		
		//Retrieve
		$testReport = retrieve_dbReports($report1->get_id());
		$this->assertEqual($testReport->get_id(),"01-01-01 to 02-02-02");
		$this->assertEqual($testReport->get_status(),"Active");
		
		//Updates
		$report2 = new Report("03-03-03", "04-04-04", "Inactive");
 		$this->assertTrue(update_dbReports($report2));
		$testReport = retrieve_dbReports($report2->get_id());
		$this->assertEqual($testReport->get_id(),"03-03-03 to 04-04-04");
		$this->assertEqual($testReport->get_status(),"Inactive");
		
		//Deletes
		$this->assertTrue(delete_dbReports($report1->get_id()));
		$this->assertTrue(delete_dbReports($report2->get_id()));
		$this->assertTrue(delete_dbReports($report3->get_id()));
		$this->assertFalse(retrieve_dbReports($report2->get_id()));
		
		
		echo("testdbReport complete \n");
	}
}
?>