<?php
	include_once('database/dbParticipantEntry.php');
	include_once('database/dbDailyLogs.php');
	include_once('domain/DailyLog.php');
	
	if ($_POST[Time1] !== null && $_POST[Time2] !== null && $_POST[Participant])
		insert_dbParticipantEntry(new ParticipantEntry($_POST[Date],$_POST[Participant],$_POST[Time1].":".$_POST[Time2].$_POST[AP],$_POST[Result],$_POST[Notes]));
	
	$dl = retrieve_dbDailyLogs($_POST[Date]);
	if($dl == null){
		if($_POST[Participant] != null || $_POST[dNotes] != null) {
			insert_dbDailyLogs(new DailyLog($_POST[Date],$_POST[Participant],$_POST[Volunteer],$_POST[dNotes]));
		}
	}
	else{
		$eid = $dl->get_entry_ids();
		if($eid != null) {
			if($_POST[Participant] != null) {
				foreach($eid as &$parts) 
					$participants .= $parts.",";
				$participants .= $_POST[Participant];
			}
			else {
				foreach($eid as &$parts) 
					$participants .= $parts.",";
			}
		}
		else {
			$participants = $_POST[Participant];
		}
		if($_POST[dNotes] == null) {
			$dNotes = $dl->get_note();
		}
		else {
			$dNotes = $_POST[dNotes];
		}
		insert_dbDailyLogs(new DailyLog($_POST[Date],$participants,$_POST[Volunteer],$dNotes));
	}
	$today = Date("y-m-d");
	header("Location: dailyLog.php?date=".$today."&submitted=".$_POST[Participant]);
?>