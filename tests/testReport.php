<?php
include_once(dirname(__FILE__).'/../domain/Report.php');
class testReport extends UnitTestCase {
	function testReportModule() {

		$report = new Report("01-01-01", "02-02-02", "archived");
		
		//Test getters
		$this->assertTrue($report->get_id() == "01-01-01 to 02-02-02");
		$this->assertTrue($report->get_status() == "archived");
		
		echo ("testReport complete\n");
	}
}
?>