<?php
include_once(dirname(__FILE__).'/../domain/ParticipantEntry.php');
class testParticipantEntry extends UnitTestCase {
    function testParticipantEntryModule() {     
    			 //fake participant entry to test
                 $participantA = new ParticipantEntry("12-02-29", "John1112345678", "9:57", "", "Good worker!");
                 
                 //testing getter functions
                 $this->assertTrue($participantA->get_id() == "12-02-29John1112345678");
                 $this->assertTrue($participantA->get_call_time() == "9:57");
                 $this->assertTrue($participantA->get_result() == "");
                 $this->assertTrue($participantA->get_note() == "Good worker!");
    }
}

?>