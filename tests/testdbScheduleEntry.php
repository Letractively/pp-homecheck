<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is sched of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/*
 * testdbScheduleEntry class for Homecheck
 * @author Ruben Martinez
 * @version February 25, 2012
 */

include_once(dirname(__FILE__).'/../domain/ScheduleEntry.php');
include_once(dirname(__FILE__).'/../database/dbScheduleEntry.php'); 

class testdbScheduleEntry extends UnitTestCase {
	function testdbScheduleEntryModule() {
		//Test Create
		//$this->assertTrue(create_dbScheduleEntry());
		
		//Pseudo-Participants
		$sched1 = new ScheduleEntry("Sun:1", "John1112345678", "No notes");
		$sched2 = new ScheduleEntry("Mon:2", "Jane1112345678", "No notes");
		$sched3 = new ScheduleEntry("Tue:3", "Vacant", "No notes");
		
		//Test Insert
		$this->assertTrue(insert_dbScheduleEntry($sched1));
		$this->assertTrue(insert_dbScheduleEntry($sched2));
		$this->assertTrue(insert_dbScheduleEntry($sched3));
		
		//Test Retrieve
		$this->assertEqual(retrieve_dbScheduleEntry($sched2->get_id())->get_volunteer_id(), "Jane1112345678");
		$this->assertEqual(retrieve_dbScheduleEntry($sched2->get_id())->get_notes(), "No notes");
		
		//Test Update
		$sched2 = new ScheduleEntry("Mon:2", "Vacant", "No notes");
		$this->assertTrue(update_dbScheduleEntry($sched2));
		$this->assertEqual(retrieve_dbScheduleEntry($sched2->get_id())->get_volunteer_id(), "Vacant");
		
		//Test Delete
		$this->assertTrue(delete_dbScheduleEntry($sched1->get_id()));
		$this->assertTrue(delete_dbScheduleEntry($sched2->get_id()));
		$this->assertTrue(delete_dbScheduleEntry($sched3->get_id()));
	    $this->assertFalse(retrieve_dbScheduleEntry($sched2->get_id()));
	    
	    echo ("testdbScheduleEntry complete.\n");
	}
}
?>