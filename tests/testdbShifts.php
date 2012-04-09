<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/*
 * testdbShifts class for Homecheck
 * @author Nicole Erkis
 * @version February 29, 2012
 */

include_once(dirname(__FILE__).'/../domain/Shift.php');
include_once(dirname(__FILE__).'/../database/dbShifts.php'); 

class testdbShifts extends UnitTestCase {
	function testdbShiftsModule() {

		// $this->assertTrue(create_dbShifts());
		
		$shift1 = new Shift("12-02-29", "Malcom1234567890", "Monday", "Notes1");
		$shift2 = new Shift("12-02-28", "vacancy", "Wednesday", "Notes2");
		$shift3 = new Shift("12-02-27", "police", "Friday", "Notes3");
		
		$this->assertTrue(insert_dbShifts($shift1));
		$this->assertTrue(insert_dbShifts($shift2));
		$this->assertTrue(insert_dbShifts($shift3));
		
		$this->assertEqual(retrieve_dbShifts($shift2->get_yy_mm_dd())->get_volunteer_id(), "vacancy");
		$this->assertEqual(retrieve_dbShifts($shift2->get_yy_mm_dd())->get_day(), "Wednesday");
		$this->assertEqual(retrieve_dbShifts($shift2->get_yy_mm_dd())->get_notes(), "Notes2");
		
		$shift2 = new Shift("12-02-29", "John1234567890", "Thursday", "Notes4");
		$this->assertTrue(update_dbShifts($shift2));
		$this->assertEqual(retrieve_dbShifts($shift2->get_yy_mm_dd())->get_day(), "Thursday");
		
		$this->assertTrue(delete_dbShifts($shift1->get_yy_mm_dd()));
		$this->assertTrue(delete_dbShifts($shift2->get_yy_mm_dd()));
		$this->assertTrue(delete_dbShifts($shift3->get_yy_mm_dd()));
	    $this->assertFalse(retrieve_dbShifts($shift2->get_yy_mm_dd()));
	    
	    echo ("testdbShifts complete.\n");
	}
}
?>