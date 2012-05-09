<?PHP
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
 * Tucker.  This program is part of Homecheck, which is free software.  It comes
 * with absolutely no warranty.  You can redistribute and/or modify it under the
 * terms of the GNU Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/).
*/
	session_start();
	session_cache_expire(30);
	include_once('database/dbinfo.php');
	include_once('database/dbParticipants.php');
	include_once('database/dbParticipantEntry.php');
	include_once('database/dbDailyLogs.php');
	$dt = $_GET["date"]; 
?>
<HTML>     
    <HEAD>  
    <TITLE>Notepad</TITLE>   
	<LINK REL="stylesheet" HREF="styles.css" TYPE="text/css">
	<LINK REL="icon"  TYPE="image/png" HREF="images/NPfavicon.png">
	<LINK TYPE="text/css" REL="stylesheet" HREF="data:text/css,">
	<STYLE TYPE="text/css"> 
	body {
		min-width: 1024px;
		overflow:scroll;
	}
	table.gridtable {
		font-family: verdana,arial,sans-serif;
		font-size:12px;
		color:#000000;
		border-width: 1px;
		border-color: #000000;
		border-collapse: collapse;
	}
	table.gridtable th {
		border-width: 1px;
		font-size:12px;
		text-align: left;
		padding: 8px;
		border-style: solid;
		border-color: #000000;
		background-color: #dedede;
	}
	table.gridtable td {
		border-width: 1px;
		padding: 8px;
		text-align: left;
		border-style: solid;
		border-color: #000000;
		background-color: #ffffff;
	}
    </STYLE>
	</HEAD>     
    <BODY> 
    	<DIV ID="container">
    	<?PHP include('header.php');?>
		<DIV ID="content">
		<?php 
		$now = date('y-m-d');
		if($dt == null) 
			$dt = $now;
		$prevDay = date('y-m-d', strtotime($dt."-1 day"));
		$nextDay = date('y-m-d', strtotime($dt."+1 day"));
		$day = substr($dt, -2); 
		$month = substr($dt, -5, 2); 
		$year = substr($dt, 0, -6); 
		if(strcmp($month, "01") == 0) $m = "January";
		if(strcmp($month, "02") == 0) $m = "February";
		if(strcmp($month, "03") == 0) $m = "March";
		if(strcmp($month, "04") == 0) $m = "April";
		if(strcmp($month, "05") == 0) $m = "May";
		if(strcmp($month, "06") == 0) $m = "June";
		if(strcmp($month, "07") == 0) $m = "July";
		if(strcmp($month, "08") == 0) $m = "August";
		if(strcmp($month, "09") == 0) $m = "September";
		if(strcmp($month, "10") == 0) $m = "October";
		if(strcmp($month, "11") == 0) $m = "November";
		if(strcmp($month, "12") == 0) $m = "December";
		echo "<h2></h2>";
		echo "<DIV STYLE='POSITION: relative; Z-INDEX: 1; VISIBILITY: show;'>";
		echo "<TABLE><TR>
		<TH><A ONMOUSEOVER='this.style.cursor = 'hand';' TITLE='See Previous Day' HREF='notepad.php?date=".$prevDay."'><img border=0 src='images/button_back.png'/></A></TH>
		<TH>Daily Notepad for ".$m." ".$day.", 20".$year."</TH>
		<TH><A ONMOUSEOVER='this.style.cursor = 'hand';' TITLE='See Next Day' HREF='notepad.php?date=".$nextDay."'><img border=0 src='images/button_forward.png'/></A></TH>
		</TR></TABLE><BR></DIV>";
		if ($dt <= $now) {
			$DLs = retrieve_dbDailyLogs($dt);
			if ($DLs != null) {
				$count = 0;
				$parts = $DLs->get_entry_ids();
				foreach($parts as $part) {
					if($part != null){
						$PE = retrieve_dbParticipantEntry($dt.$part);
						if ($PE != null) {
							$res = $PE->get_result();
							if($PE->get_note() != null) $nts = $PE->get_note();
							else $nts = "";
							if (strcmp($res, "OK") != 0 || $nts != null) $count++;
						}
					}
				}
				if ($count > 0){
					echo "<TABLE CLASS='gridtable'><TR><TH>Participant</TH><TH STYLE='min-width: 280px;'>Notes</TH></TR>";
					foreach($parts as $part) {
						if($part != null) {
							$PE = retrieve_dbParticipantEntry($dt.$part);
							$p = retrieve_dbParticipants($part);
							if ($PE != null) {
								$res = $PE->get_result();
								if($PE->get_note() != null)
									$nts = " - ".$PE->get_note();
								else $nts = "";
								if (strcmp($res, "OK") != 0 || $nts != null) 
									echo "<TR><TD>".$p->get_first_name()." ".$p->get_last_name()."</TD><TD>".$res.$nts."</TD></TR>";
							}
						}
					}
					echo "</TABLE><BR><BR>";
					if ($DLs->get_note() != null) {
						echo "<TABLE CLASS='gridtable'>";
						echo "<TR><TH>Daily Notes</TH></TR>";
						echo "<TR><TD>".$DLs->get_note()."</TD></TR>";
						echo "</TABLE><BR><BR>";
					}
					else echo "<h3>No Additional Notes were entered for this day.</h3>";
				}
				else echo "<h3>No Additional Notes were entered for this day.</h3>";
				
			}
			else echo "<h3>No information is available for this day.</h3>";
		}
		else echo "<h3>No information is available for this day....yet!</h3>";
		?>
		<?PHP include('footer.inc');?>
   		</DIV>
    	</DIV>
    </BODY>     
</HTML> 