<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/*
 * Month class for Homecheck
 * @author Allen Tucker
 * @version February 16, 2012
 */
class Month {
	private $id;		// "yy-mm" unique identifier for this month
	private $status; 	// "unpublished", "published" or "archived"
	private $first_day; // Day of the week (0-6, Sun = 0) for yy-mm-01
	private $no_days; 	// number of days in this month
	private $shift_ids; // array of Shift ids, one for each day of the month
	private $notes;		// notes to/from the coordinator
	
	function __construct($id, $status, $notes) {
		$this->id = $id;
		$this->status = $status;
		$this->first_day = date('w', mktime(0,0,0,substr($id,3,2),'01',substr($id,0,2)));
		$this->no_days = date('t', mktime(0,0,0,substr($id,3,2),'01',substr($id,0,2)));
		$this->shift_ids = array();
		for ($d=1; $d<=$this->no_days; $d++) {
			if ($d<10) 
				$this->shift_ids[] = $this->id . "-0" . $d;
			else
				$this->shift_ids[] = $this->id . "-" . $d;
		}
		$this->notes = $notes;
	}
	function get_id() {
		return $this->id;
	}
	function get_status() {
		return $this->status;
	}
	function get_first_day() {
		return $this->first_day;
	}
	function get_no_days() {
		return $this->no_days;
	}
	function get_shift_ids() {
		return $this->shift_ids;
	}
	function get_notes() {
		return $this->notes;
	}
	
}