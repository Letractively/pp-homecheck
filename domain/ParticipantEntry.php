<?php
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
