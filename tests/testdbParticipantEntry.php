<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/*
 * testdbParticipantEntry class for Homecheck
 * @author Ruben Martinez
 * @version February 22, 2012
 */

include_once(dirname(__FILE__).'/../domain/ParticipantEntry.php');
include_once(dirname(__FILE__).'/../database/dbParticipantEntry.php'); 

class testdbParticipantEntry extends UnitTestCase {
	function testdbParticipantEntryModule() {
		//Test Create
		$this->assertTrue(create_dbParticipantEntry());
		
		//Pseudo-Participants
		$part1 = new ParticipantEntry("12-02-29", "John1112345678", "9:57", "H", "Wont be here for a week.");
		$part2 = new ParticipantEntry("12-02-30", "Jane1112345678", "8:57", "C", "Had to call contact.");
		$part3 = new ParticipantEntry("12-02-31", "Jenn1112345678", "7:57", "", "Called on time.");
		
		//Test Insert
		$this->assertTrue(insert_dbParticipantEntry($part1));
		$this->assertTrue(insert_dbParticipantEntry($part2));
		$this->assertTrue(insert_dbParticipantEntry($part3));
		
		//Test Retrieve
		$this->assertEqual(retrieve_dbParticipantEntry($part2->get_id())->get_date(), "12-02-30");
		$this->assertEqual(retrieve_dbParticipantEntry($part2->get_id())->get_call_time(), "8:57");
		$this->assertEqual(retrieve_dbParticipantEntry($part2->get_id())->get_result(), "C");
		$this->assertEqual(retrieve_dbParticipantEntry($part2->get_id())->get_note(), "Had to call contact.");
		
		//Test Update
		$part2 = new ParticipantEntry("12-02-30", "Jane1112345678", "8:57", "D", "Had to call police!");
		$this->assertTrue(update_dbParticipantEntry($part2));
		$this->assertEqual(retrieve_dbParticipantEntry($part2->get_id())->get_result(), "D");
		
		//Test Delete
		$this->assertTrue(delete_dbParticipantEntry($part1->get_id()));
		$this->assertTrue(delete_dbParticipantEntry($part2->get_id()));
		$this->assertTrue(delete_dbParticipantEntry($part3->get_id()));
	    $this->assertFalse(retrieve_dbParticipantEntry($part2->get_id()));
	    
	    echo ("testdbParticipantEntry complete.\n");
	}
}
?>