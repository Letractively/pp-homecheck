<?php
/*
 * Run all the RMH Homeroom unit tests
 */
// require_once(dirname(__FILE__).'/simpletest/autorun.php');
class AllTests extends GroupTest {
 	  function AllTests() {
 	  	
        $this->addTestFile(dirname(__FILE__).'/testVolunteer.php');
        $this->addTestFile(dirname(__FILE__).'/testParticipant.php');
        $this->addTestFile(dirname(__FILE__).'/testDailyLog.php');
        $this->addTestFile(dirname(__FILE__).'/testMonth.php');
        $this->addTestFile(dirname(__FILE__).'/testParticipantEntry.php');
        $this->addTestFile(dirname(__FILE__).'/testReport.php');
		$this->addTestFile(dirname(__FILE__).'/testShift.php');
		$this->addTestFile(dirname(__FILE__).'/testScheduleEntry.php');
		$this->addTestFile(dirname(__FILE__).'/testdbScheduleEntry.php');
		$this->addTestFile(dirname(__FILE__).'/testdbVolunteers.php');
		$this->addTestFile(dirname(__FILE__).'/testdbParticipantEntry.php');
		$this->addTestFile(dirname(__FILE__).'/testdbParticipants.php');
		$this->addTestFile(dirname(__FILE__).'/testdbDailyLogs.php');
		$this->addTestFile(dirname(__FILE__).'/testdbReports.php');
		$this->addTestFile(dirname(__FILE__).'/testdbShifts.php');


        echo ("\n All tests complete \n");
 	  }
 }
?>
