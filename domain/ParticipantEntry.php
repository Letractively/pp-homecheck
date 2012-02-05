<?php
class ParticipantEntry {
	private $id;    	// Unique identifier for this entry: yy-mm-dd.participant_id
	private $call_time;	// time of day that the participant called in
	private $result; 	// ��, �H�, �C�, or �D� if normal, Had to call, 
						// called Contact, or called police Dispatcher, resp.
	private $note; 		// note associated with this participant on this day
}
?>
