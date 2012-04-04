<?php
	$con = mysql_connect("127.0.0.1","root","");
	if (!$con) {
  		die('Could not connect: ' . mysql_error());
  	}

	mysql_select_db("pphomecheckdb");
	
	$sql="INSERT INTO dbParticipantEntry(date, id, call_time, result, note) 
		  VALUES('$_POST[Date]','$_POST[Participant]','$_POST[Time]','$_POST[Result]','$_POST[Notes]')";
	if (!mysql_query($sql,$con)) {
  		die('Error: ' . mysql_error());
  	}

	header("Location: http://127.0.0.1/pp-homecheck/viewDailyLog.php");
	mysql_close($con)
?>