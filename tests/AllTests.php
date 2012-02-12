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
        $this->addTestFile(dirname(__FILE__).'/testParticipantEntry.php');
        $this->addTestFile(dirname(__FILE__).'/testReport.php');
		$this->addTestFile(dirname(__FILE__).'/testShift.php');        
        echo ("All tests complete");
 	  }
 }
?>
