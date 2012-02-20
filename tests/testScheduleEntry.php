<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/*
 * testScheduleEntry class for Homecheck
 * @author Ruben Martinez
 * @version February 12, 2012
 */
include_once(dirname(__FILE__).'/../domain/ScheduleEntry.php');
class testScheduleEntry extends UnitTestCase {
    function testScheduleEntryModule() {     
    	//fake participant entry to test
        $scheduleA = new ScheduleEntry("Mon:1", "John1112345678", "Good worker!");
                 
        //testing getter functions
        $this->assertEqual($scheduleA->get_id(), "Mon:1");
        $this->assertEqual($scheduleA->get_volunteer_id(), "John1112345678");
        $this->assertEqual($scheduleA->get_notes(), "Good worker!");
    }
}
?>