<?php 
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/*
* DailyLog class for Homecheck
* @author Alex Edison
* @version February 8, 2012
*/
class DailyLog {
	private $id;     		// Unique identifier for this log: yy-mm-dd
	private $entry_ids;	// array of participant entry ids for this date
	private $volunteer_id;	// id of the volunteer making these entries
	private $note;		// general note for this day 
	
	/**
	 * Constructor for DailyLog
	 */
	
	function __construct($entry_date, $participant_entry_ids, $volunteer, $notes){
		$this->id = $entry_date;
		$this->entry_ids = explode(',',$participant_entry_ids);
		$this->volunteer_id = $volunteer;
		$this->note = $notes;
		
	}
	
	function get_id(){
		return $this->id;
	}
	function get_entry_ids(){
		return $this->entry_ids;
	}
	function get_volunteer_id(){
		return $this->volunteer_id;
	}
	function get_note(){
		return $this->note;
	}
	
}
?>