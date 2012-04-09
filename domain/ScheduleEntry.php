<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/*
 * ScheduleEntry class for Homecheck
 * @author Ruben Martinez
 * @version February 12, 2012
 */
class ScheduleEntry {
	private $id;		// "ddd:w" identifies a day on the master schedule
					// e.g., “Mon:1” means Monday on week 1 of the month
	private $volunteer_id; // id of the volunteer scheduled for this 
					// shift, e.g. "malcom1234567890", or “vacancy”
	private $notes;		// notes to/from the coordinator about this schedule
	
	//constructor function
	function __construct($id, $volunteer_id, $notes) {
		$this->id = $id;
		$this->volunteer_id = $volunteer_id;
		$this->notes = $notes;
	}
	
	
	//getter functions
	function get_id() {
		return $this->id;
	}
	function get_volunteer_id() {
		return $this->volunteer_id;
	}
	function get_notes() {
		return $this->notes;
	}
}
?>