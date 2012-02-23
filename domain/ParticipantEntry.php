<?php
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/

/*
 * ParticipantEntry class for Homecheck
 * @author Ruben Martinez
 * @version February 12, 2012
 */
class ParticipantEntry {
	private $id;    	// Unique identifier for this entry: yy-mm-dd . participant_id
	private $call_time;	// time of day that the participant called in
	private $result; 	// рс, рHс, рCс, or рDс if normal, Had to call, 
						// called Contact, or called police Dispatcher, resp.
	private $note; 		// note associated with this participant on this day
	
	//Constructor Function
	function __construct($date, $participant_id, $call_time, $result, $note) {
		$this->id = $date . $participant_id;
		$this->call_time = $call_time;
		$this->result = $result;
		$this->note = $note;
	}
	//Getter Functions
	function get_id() {
		return $this->id;
	}
	function get_call_time() {
		return $this->call_time;
	}
	function get_result() {
		return $this->result;
	}
	function get_note() {
		return $this->note;
	}
	
}
?>
