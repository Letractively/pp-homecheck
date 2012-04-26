<?php
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/*
* Shift class for Homecheck
* @author Nicole Erkis
* @version February 12, 2012
*/
class Shift {
	private $yy_mm_dd;     		// String: "yy-mm-dd" serves as a unique id for a day
	private $volunteer_id;		// id of the volunteer scheduled for this
								// shift: "malcom1234567890", "vacancy", or "police"
	private $day;				// string name of this day "Monday" ...
	private $notes;				// notes written by the volunteer or the coordinator

	/**
	 * Constructor for Shift
	 */
	function __construct($yy_mm_dd, $volunteer_id, $day, $notes){
		$this->yy_mm_dd = $yy_mm_dd;
		$this->volunteer_id = $volunteer_id;
		$this->day = $day;
		$this->notes = $notes;
	}

	//getter functions
	function get_yy_mm_dd(){
		return $this->yy_mm_dd;
	}
	function get_volunteer_id(){
		return $this->volunteer_id;
	}
	function get_day(){
		return $this->day;
	}
	function get_notes(){
		return $this->notes;
	}
	
}
?>