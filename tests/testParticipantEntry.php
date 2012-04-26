<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/*
 * testParticipantEntry class for Homecheck
 * @author Ruben Martinez
 * @version February 12, 2012
 */
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
                 
                 echo ("testParticipantEntry complete.\n");
    }
}
?>