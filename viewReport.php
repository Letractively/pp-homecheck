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
	include_once('database/dbVolunteers.php');
	$quarter = $_GET["Quarter"]; 
	$y = $_GET["Year"]; 
?>
<HTML>     
    <HEAD>  
    <TITLE>Quarterly Report</TITLE>   
	<LINK rel="stylesheet" href="styles.css" type="text/css">
	<LINK type="text/css" rel="stylesheet" href="data:text/css,">
	<STYLE TYPE="text/css">
	.button_report {
   			background:url(images/button_report.png) no-repeat;
   			border: none;
   			height: 32px;
   			width: 99px;
		}
	</STYLE>
    </HEAD>     
    <BODY> 
    <DIV ID="container">
    <?PHP include('header.php');?>
    <DIV ID="content">
    <H2>Good Morning Quarterly Activity Report</H2><BR>
    <FORM ID="FORM2" METHOD = "get" ACTION = "http://homecheck.myopensoftware.org/viewReport.php">
    <H2>Select a Quarter:</H2><BR>
    	<SELECT NAME = "Quarter" STYLE = "WIDTH: 150" TITLE="Select Time Period">
    		<?PHP 
    			if($quarter == null) {
    				echo "<OPTION VALUE = '1'>January - March</OPTION>
    				<OPTION VALUE = '2'>April - June</OPTION>
    				<OPTION VALUE = '3'>July - September</OPTION>
    				<OPTION VALUE = '4'>October - December</OPTION>";
    			}
    			if($quarter == 1) {
    				echo "<OPTION SELECTED VALUE = '1'>January - March</OPTION>
    				<OPTION VALUE = '2'>April - June</OPTION>
    				<OPTION VALUE = '3'>July - September</OPTION>
    				<OPTION VALUE = '4'>October - December</OPTION>";
    			}
    			if($quarter == 2) {
    				echo "<OPTION VALUE = '1'>January - March</OPTION>
    				<OPTION SELECTED VALUE = '2'>April - June</OPTION>
    				<OPTION VALUE = '3'>July - September</OPTION>
    				<OPTION VALUE = '4'>October - December</OPTION>";
    			}
    			if($quarter == 3) {
    				echo "<OPTION VALUE = '1'>January - March</OPTION>
    				<OPTION VALUE = '2'>April - June</OPTION>
    				<OPTION SELECTED VALUE = '3'>July - September</OPTION>
    				<OPTION VALUE = '4'>October - December</OPTION>";
    			}
    			if($quarter == 4) {
    				echo "<OPTION VALUE = '1'>January - March</OPTION>
    				<OPTION VALUE = '2'>April - June</OPTION>
    				<OPTION VALUE = '3'>July - September</OPTION>
    				<OPTION SELECTED VALUE = '4'>October - December</OPTION>";
    			}
    		?>
    	</SELECT>
    	<SELECT NAME = "Year" STYLE = "WIDTH: 100" TITLE="Select a Year">
    		<?php 
    		$year = 2012;
    		$currentYear = "20".Date(y);
    		while ($year < (int)$currentYear){
    			echo "<OPTION VALUE = '".$year."'>".$year."</OPTION>";
    			$year++;
    		}
    		if ($year == $currentYear) {
    			echo "<OPTION SELECTED VALUE = '".$year."'>".$year."</OPTION>";
    		}
    		?>
    	</SELECT>
    	<INPUT TYPE="" CLASS="button_report" TITLE="Show Report"/> 
    </FORM>
    <?PHP 
    	if($quarter != null) {
    		if ($quarter == 1) echo "<BR><H2>Quarterly Report for January 1, ".$y." to March 31, ".$y."</H2><BR>";
    		if ($quarter == 2) echo "<BR><H2>Quarterly Report for April 1, ".$y." to June 30, ".$y."</H2><BR>";
    		if ($quarter == 3) echo "<BR><H2>Quarterly Report for July 1, ".$y." to September 30, ".$y."</H2><BR>";
    		if ($quarter == 4) echo "<BR><H2>Quarterly Report for August 1, ".$y." to December 31, ".$y."</H2><BR>";
    		echo "<TABLE>";
    		echo "<TR><TD>";
    		echo "Steps to Resolution";
    		echo "</TD><TD>";
    		if ($quarter == 1) echo "Jan";
    		if ($quarter == 2) echo "Apr";
    		if ($quarter == 3) echo "Jul";
    		if ($quarter == 4) echo "Oct";
    		echo "</TD><TD>";
    		if ($quarter == 1) echo "Feb";
    		if ($quarter == 2) echo "May";
    		if ($quarter == 3) echo "Aug";
    		if ($quarter == 4) echo "Nov";
    		echo "</TD><TD>";
    		if ($quarter == 1) echo "Mar";
    		if ($quarter == 2) echo "Jun";
    		if ($quarter == 3) echo "Sept";
    		if ($quarter == 4) echo "Dec";
    		echo "</TD><TD>";
    		echo "Total";
    		echo "</TD></TR>";

    		$y = substr($y, 2);
    		if ($quarter == 1) {
    			$janOK = $janC = $janD = $janH = $febOK = $febC = $febD = $febH = $marOK = $marC = $marD = $marH = 0;
    			$janBrunswick = $janFreeport = $janHarpswell = $janBowdoinham = $janTopsham = $janOther= 0;
    			$febBrunswick = $febFreeport = $febHarpswell = $febBowdoinham = $febTopsham = $febOther= 0;
    			$marBrunswick = $marFreeport = $marHarpswell = $marBowdoinham = $marTopsham = $marOther= 0;
    			$VjanBrunswick = $VjanFreeport = $VjanHarpswell = $VjanBowdoinham = $VjanTopsham = $VjanOther= 0;
    			$VfebBrunswick = $VfebFreeport = $VfebHarpswell = $VfebBowdoinham = $VfebTopsham = $VfebOther= 0;
    			$VmarBrunswick = $VmarFreeport = $VmarHarpswell = $VmarBowdoinham = $VmarTopsham = $VmarOther= 0;
    			$jan_start = $y."-01-01";
    			$jan_end = $y."-01-31";
    			if ((int)$y%4 == 0) {
    				$feb_start = $y."-02-01";
    				$feb_end = $y."-02-29";
    			}
    			else {
    				$feb_start = $y."-02-01";
    				$feb_end = $y."-02-28";
    			}
    			$mar_start = $y."-03-01";
    			$mar_end = $y."-03-31";
    			$janLogs = retrieve_betweentwodates($jan_start, $jan_end);
    			$febLogs = retrieve_betweentwodates($feb_start, $feb_end);
    			$marLogs = retrieve_betweentwodates($mar_start, $mar_end);
    			
    			foreach($janLogs as &$jl) {
    				$d = $jl->get_id();
    				$partEntries = $jl->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $janOK++;
    						if($status == "C") $janC++;
    						if($status == "D") $janD++; 
    						if($status == "H") $janH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $janBrunswick++;
    						if($location == "Freeport") $janFreeport++;
    						if($location == "Harpswell") $janHarpswell++;
    						if($location == "Bowdoinham") $janBowdoinham++;
    						if($location == "Topsham") $janTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $janOther++;
    					}
    				}
    				$volID = $jl->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VjanBrunswick++;
    				if($location == "Freeport") $VjanFreeport++;
    				if($location == "Harpswell") $VjanHarpswell++;
    				if($location == "Bowdoinham") $VjanBowdoinham++;
    				if($location == "Topsham") $VjanTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VjanOther++;
    			}
    			foreach($febLogs as &$fl) {
    				$d = $fl->get_id();
    				$partEntries = $fl->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $febOK++;
    						if($status == "C") $febC++;
    						if($status == "D") $febD++;
    						if($status == "H") $febH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $febBrunswick++;
    						if($location == "Freeport") $febFreeport++;
    						if($location == "Harpswell") $febHarpswell++;
    						if($location == "Bowdoinham") $febBowdoinham++;
    						if($location == "Topsham") $febTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $febOther++;
    					}
    				}
    				$volID = $fl->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VfebBrunswick++;
    				if($location == "Freeport") $VfebFreeport++;
    				if($location == "Harpswell") $VfebHarpswell++;
    				if($location == "Bowdoinham") $VfebBowdoinham++;
    				if($location == "Topsham") $VfebTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VfebOther++;
    			}
    			foreach($marLogs as &$ml) {
    				$d = $ml->get_id();
    				$partEntries = $ml->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $marOK++;
    						if($status == "C") $marC++;
    						if($status == "D") $marD++;
    						if($status == "H") $marH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $marBrunswick++;
    						if($location == "Freeport") $marFreeport++;
    						if($location == "Harpswell") $marHarpswell++;
    						if($location == "Bowdoinham") $marBowdoinham++;
    						if($location == "Topsham") $marTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $marOther++;
    					}
    				}
    				$volID = $ml->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VmarBrunswick++;
    				if($location == "Freeport") $VmarFreeport++;
    				if($location == "Harpswell") $VmarHarpswell++;
    				if($location == "Bowdoinham") $VmarBowdoinham++;
    				if($location == "Topsham") $VmarTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VmarOther++;
    			}
    			$totalOK = (int)$janOK+$febOK+$marOK;
    			echo "<TR><TD>Called in OK</TD><TD>".$janOK."</TD><TD>".$febOK."</TD><TD>".$marOK."</TD><TD>".$totalOK."</TD></TR>";
    			
    			$totalH = (int)$janH+$febH+$marH;
    			echo "<TR><TD>Had to call participant, was OK</TD><TD>".$janH."</TD><TD>".$febH."</TD><TD>".$marH."</TD><TD>$totalH</TD></TR>";
    		
    			$totalC = (int)$janC+$febC+$marC;
    			echo "<TR><TD>Unable to reach participant, called contact(s)</TD><TD>".$janC."</TD><TD>".$febC."</TD><TD>".$marC."</TD><TD>".$totalC."</TD></TR>";
    		
    			$totalD = (int)$janD+$febD+$marD;
    			echo "<TR><TD>Referred to police dispatch</TD><TD>".$janD."</TD><TD>".$febD."</TD><TD>".$marD."</TD><TD>".$totalD."</TD></TR>";
    			
    			$janTotal = (int)$janBrunswick+$janFreeport+$janHarpswell+$janBowdoinham+$janTopsham+$janOther;
    			$febTotal = (int)$febBrunswick+$febFreeport+$febHarpswell+$febBowdoinham+$febTopsham+$febOther;
    			$marTotal = (int)$marBrunswick+$marFreeport+$marHarpswell+$marBowdoinham+$marTopsham+$marOther;
    			$VjanTotal = (int)$VjanBrunswick+$VjanFreeport+$VjanHarpswell+$VjanBowdoinham+$VjanTopsham+$VjanOther;
    			$VfebTotal = (int)$VfebBrunswick+$VfebFreeport+$VfebHarpswell+$VfebBowdoinham+$VfebTopsham+$VfebOther;
    			$VmarTotal = (int)$VmarBrunswick+$VmarFreeport+$VmarHarpswell+$VmarBowdoinham+$VmarTopsham+$VmarOther;
    		}
    		if ($quarter == 2) {
    			$aprOK = $aprC = $aprD = $aprH = $mayOK = $mayC = $mayD = $mayH = $junOK = $junC = $junD = $junH = 0;
    			$aprBrunswick = $aprFreeport = $aprHarpswell = $aprBowdoinham = $aprTopsham = $aprOther= 0;
    			$mayBrunswick = $mayFreeport = $mayHarpswell = $mayBowdoinham = $mayTopsham = $mayOther= 0;
    			$junBrunswick = $junFreeport = $junHarpswell = $junBowdoinham = $junTopsham = $junOther= 0;
    			$VaprBrunswick = $VaprFreeport = $VaprHarpswell = $VaprBowdoinham = $VaprTopsham = $VaprOther= 0;
    			$VmayBrunswick = $VmayFreeport = $VmayHarpswell = $VmayBowdoinham = $VmayTopsham = $VmayOther= 0;
    			$VjunBrunswick = $VjunFreeport = $VjunHarpswell = $VjunBowdoinham = $VjunTopsham = $VjunOther= 0;
    			$apr_start = $y."-04-01";
    			$apr_end = $y."-04-30";
    			$may_start = $y."-05-01";
    			$may_end = $y."-05-31";
    			$jun_start = $y."-06-01";
    			$jun_end = $y."-06-30";
    			$aprLogs = retrieve_betweentwodates($apr_start, $apr_end);
    			$mayLogs = retrieve_betweentwodates($may_start, $may_end);
    			$junLogs = retrieve_betweentwodates($jun_start, $jun_end);
    			
    			foreach($aprLogs as &$al) {
    				$d = $al->get_id();
    				$partEntries = $al->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $aprOK++;
    						if($status == "C") $aprC++;
    						if($status == "D") $aprD++;
    						if($status == "H") $aprH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $aprBrunswick++;
    						if($location == "Freeport") $aprFreeport++;
    						if($location == "Harpswell") $aprHarpswell++;
    						if($location == "Bowdoinham") $aprBowdoinham++;
    						if($location == "Topsham") $aprTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $aprOther++;
    					}
    				}
    				$volID = $al->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VaprBrunswick++;
    				if($location == "Freeport") $VaprFreeport++;
    				if($location == "Harpswell") $VaprHarpswell++;
    				if($location == "Bowdoinham") $VaprBowdoinham++;
    				if($location == "Topsham") $VaprTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VaprOther++;
    			}
    			foreach($mayLogs as &$ml) {
    				$d = $ml->get_id();
    				$partEntries = $ml->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $mayOK++;
    						if($status == "C") $mayC++;
    						if($status == "D") $mayD++;
    						if($status == "H") $mayH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $mayBrunswick++;
    						if($location == "Freeport") $mayFreeport++;
    						if($location == "Harpswell") $mayHarpswell++;
    						if($location == "Bowdoinham") $mayBowdoinham++;
    						if($location == "Topsham") $mayTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $mayOther++;
    					}
    				}
    				$volID = $ml->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VmayBrunswick++;
    				if($location == "Freeport") $VmayFreeport++;
    				if($location == "Harpswell") $VmayHarpswell++;
    				if($location == "Bowdoinham") $VmayBowdoinham++;
    				if($location == "Topsham") $VmayTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VmayOther++;
    			}
    			foreach($junLogs as &$jl) {
    				$d = $jl->get_id();
    				$partEntries = $jl->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $junOK++;
    						if($status == "C") $junC++;
    						if($status == "D") $junD++;
    						if($status == "H") $junH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $junBrunswick++;
    						if($location == "Freeport") $junFreeport++;
    						if($location == "Harpswell") $junHarpswell++;
    						if($location == "Bowdoinham") $junBowdoinham++;
    						if($location == "Topsham") $junTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $junOther++;
    					}
    				}
    				$volID = $jl->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VjunBrunswick++;
    				if($location == "Freeport") $VjunFreeport++;
    				if($location == "Harpswell") $VjunHarpswell++;
    				if($location == "Bowdoinham") $VjunBowdoinham++;
    				if($location == "Topsham") $VjunTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VjunOther++;
    			}
    			
    			$totalOK = (int)$aprOK+$mayOK+$junOK;
    			echo "<TR><TD>Called in OK</TD><TD>".$aprOK."</TD><TD>".$mayOK."</TD><TD>".$junOK."</TD><TD>".$totalOK."</TD></TR>";
    		
    			$totalH = (int)$aprH+$mayH+$junH;
    			echo "<TR><TD>Had to call participant, was OK</TD><TD>".$aprH."</TD><TD>".$mayH."</TD><TD>".$junH."</TD><TD>$totalH</TD></TR>";
    		
    			$totalC = (int)$aprC+$mayC+$junC;
    			echo "<TR><TD>Unable to reach participant, called contact(s)</TD><TD>".$aprC."</TD><TD>".$mayC."</TD><TD>".$junC."</TD><TD>".$totalC."</TD></TR>";
    		
    			$totalD = (int)$aprD+$mayD+$junD;
    			echo "<TR><TD>Referred to police dispatch</TD><TD>".$aprD."</TD><TD>".$mayD."</TD><TD>".$junD."</TD><TD>".$totalD."</TD></TR>";
    			
    			$aprTotal = (int)$aprBrunswick+$aprFreeport+$aprHarpswell+$aprBowdoinham+$aprTopsham+$aprOther;
    			$mayTotal = (int)$mayBrunswick+$mayFreeport+$mayHarpswell+$mayBowdoinham+$mayTopsham+$mayOther;
    			$junTotal = (int)$junBrunswick+$junFreeport+$junHarpswell+$junBowdoinham+$junTopsham+$junOther;
    			$VaprTotal = (int)$VaprBrunswick+$VaprFreeport+$VaprHarpswell+$VaprBowdoinham+$VaprTopsham+$VaprOther;
    			$VmayTotal = (int)$VmayBrunswick+$VmayFreeport+$VmayHarpswell+$VmayBowdoinham+$VmayTopsham+$VmayOther;
    			$VjunTotal = (int)$VjunBrunswick+$VjunFreeport+$VjunHarpswell+$VjunBowdoinham+$VjunTopsham+$VjunOther;
    		}
    		if ($quarter == 3) {
    			$julOK = $julC = $julD = $julH = $augOK = $augC = $augD = $augH = $sepOK = $sepC = $sepD = $sepH = 0;
    			$julBrunswick = $julFreeport = $julHarpswell = $julBowdoinham = $julTopsham = $julOther= 0;
    			$augBrunswick = $augFreeport = $augHarpswell = $augBowdoinham = $augTopsham = $augOther= 0;
    			$sepBrunswick = $sepFreeport = $sepHarpswell = $sepBowdoinham = $sepTopsham = $sepOther= 0;
    			$VjulBrunswick = $VjulFreeport = $VjulHarpswell = $VjulBowdoinham = $VjulTopsham = $VjulOther= 0;
    			$VaugBrunswick = $VaugFreeport = $VaugHarpswell = $VaugBowdoinham = $VaugTopsham = $VaugOther= 0;
    			$VsepBrunswick = $VsepFreeport = $VsepHarpswell = $VsepBowdoinham = $VsepTopsham = $VsepOther= 0;
    			$jul_start = $y."-07-01";
    			$jul_end = $y."-07-31";
    			$aug_start = $y."-08-01";
    			$aug_end = $y."-08-31";
    			$sep_start = $y."-09-01";
    			$sep_end = $y."-09-30";
    			$julLogs = retrieve_betweentwodates($jul_start, $jul_end);
    			$augLogs = retrieve_betweentwodates($aug_start, $aug_end);
    			$sepLogs = retrieve_betweentwodates($sep_start, $sep_end);
    			
    			foreach($julLogs as &$jl) {
    				$d = $jl->get_id();
    				$partEntries = $jl->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $julOK++;
    						if($status == "C") $julC++;
    						if($status == "D") $julD++;
    						if($status == "H") $julH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $julBrunswick++;
    						if($location == "Freeport") $julFreeport++;
    						if($location == "Harpswell") $julHarpswell++;
    						if($location == "Bowdoinham") $julBowdoinham++;
    						if($location == "Topsham") $julTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $julOther++;
    					}
    				}
    				$volID = $jl->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VjulBrunswick++;
    				if($location == "Freeport") $VjulFreeport++;
    				if($location == "Harpswell") $VjulHarpswell++;
    				if($location == "Bowdoinham") $VjulBowdoinham++;
    				if($location == "Topsham") $VjulTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VjulOther++;
    			}
    			foreach($augLogs as &$al) {
    				$d = $al->get_id();
    				$partEntries = $al->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $augOK++;
    						if($status == "C") $augC++;
    						if($status == "D") $augD++;
    						if($status == "H") $augH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $augBrunswick++;
    						if($location == "Freeport") $augFreeport++;
    						if($location == "Harpswell") $augHarpswell++;
    						if($location == "Bowdoinham") $augBowdoinham++;
    						if($location == "Topsham") $augTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $augOther++;
    					}
    				}
    				$volID = $al->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VaugBrunswick++;
    				if($location == "Freeport") $VaugFreeport++;
    				if($location == "Harpswell") $VaugHarpswell++;
    				if($location == "Bowdoinham") $VaugBowdoinham++;
    				if($location == "Topsham") $VaugTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VaugOther++;
    			}
    			foreach($sepLogs as &$sl) {
    				$d = $sl->get_id();
    				$partEntries = $sl->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $sepOK++;
    						if($status == "C") $sepC++;
    						if($status == "D") $sepD++;
    						if($status == "H") $sepH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $sepBrunswick++;
    						if($location == "Freeport") $sepFreeport++;
    						if($location == "Harpswell") $sepHarpswell++;
    						if($location == "Bowdoinham") $sepBowdoinham++;
    						if($location == "Topsham") $sepTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $sepOther++;
    					}
    				}
    				$volID = $sl->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VsepBrunswick++;
    				if($location == "Freeport") $VsepFreeport++;
    				if($location == "Harpswell") $VsepHarpswell++;
    				if($location == "Bowdoinham") $VsepBowdoinham++;
    				if($location == "Topsham") $VsepTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VsepOther++;
    			}
    			$totalOK = (int)$julOK+$augOK+$sepOK;
    			echo "<TR><TD>Called in OK</TD><TD>".$julOK."</TD><TD>".$augOK."</TD><TD>".$sepOK."</TD><TD>".$totalOK."</TD></TR>";
    		
    			$totalH = (int)$julH+$augH+$sepH;
    			echo "<TR><TD>Had to call participant, was OK</TD><TD>".$julH."</TD><TD>".$augH."</TD><TD>".$sepH."</TD><TD>$totalH</TD></TR>";
    		
    			$totalC = (int)$julC+$augC+$sepC;
    			echo "<TR><TD>Unable to reach participant, called contact(s)</TD><TD>".$julC."</TD><TD>".$augC."</TD><TD>".$sepC."</TD><TD>".$totalC."</TD></TR>";
    		
    			$totalD = (int)$julD+$augD+$sepD;
    			echo "<TR><TD>Referred to police dispatch</TD><TD>".$julD."</TD><TD>".$augD."</TD><TD>".$sepD."</TD><TD>".$totalD."</TD></TR>";
    			
    			$julTotal = (int)$julBrunswick+$julFreeport+$julHarpswell+$julBowdoinham+$julTopsham+$julOther;
    			$augTotal = (int)$augBrunswick+$augFreeport+$augHarpswell+$augBowdoinham+$augTopsham+$augOther;
    			$junTotal = (int)$sepBrunswick+$sepFreeport+$sepHarpswell+$sepBowdoinham+$sepTopsham+$sepOther;
    			$VjulTotal = (int)$VjulBrunswick+$VjulFreeport+$VjulHarpswell+$VjulBowdoinham+$VjulTopsham+$VjulOther;
    			$VaugTotal = (int)$VaugBrunswick+$VaugFreeport+$VaugHarpswell+$VaugBowdoinham+$VaugTopsham+$VaugOther;
    			$VjunTotal = (int)$VsepBrunswick+$VsepFreeport+$VsepHarpswell+$VsepBowdoinham+$VsepTopsham+$VsepOther;
    		}
    		if ($quarter == 4) {
    			$octOK = $octC = $octD = $octH = $novOK = $novC = $novD = $novH = $decOK = $decC = $decD = $decH = 0;
    			$octBrunswick = $octFreeport = $octHarpswell = $octBowdoinham = $octTopsham = $octOther= 0;
    			$novBrunswick = $novFreeport = $novHarpswell = $novBowdoinham = $novTopsham = $novOther= 0;
    			$decBrunswick = $decFreeport = $decHarpswell = $decBowdoinham = $decTopsham = $decOther= 0;
    			$VoctBrunswick = $VoctFreeport = $VoctHarpswell = $VoctBowdoinham = $VoctTopsham = $VoctOther= 0;
    			$VnovBrunswick = $VnovFreeport = $VnovHarpswell = $VnovBowdoinham = $VnovTopsham = $VnovOther= 0;
    			$VdecBrunswick = $VdecFreeport = $VdecHarpswell = $VdecBowdoinham = $VdecTopsham = $VdecOther= 0;
    			$oct_start = $y."-10-01";
    			$oct_end = $y."-10-31";
    			$nov_start = $y."-11-01";
    			$nov_end = $y."-11-30";
    			$dec_start = $y."-12-01";
    			$dec_end = $y."-12-31";
    			$octLogs = retrieve_betweentwodates($oct_start, $oct_end);
    			$novLogs = retrieve_betweentwodates($nov_start, $nov_end);
    			$decLogs = retrieve_betweentwodates($dec_start, $dec_end);
    			
    			foreach($octLogs as &$ol) {
    				$d = $ol->get_id();
    				$partEntries = $ol->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $octOK++;
    						if($status == "C") $octC++;
    						if($status == "D") $octD++;
    						if($status == "H") $octH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $octBrunswick++;
    						if($location == "Freeport") $octFreeport++;
    						if($location == "Harpswell") $octHarpswell++;
    						if($location == "Bowdoinham") $octBowdoinham++;
    						if($location == "Topsham") $octTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $octOther++;
    					}
    				}
    				$volID = $ol->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VoctBrunswick++;
    				if($location == "Freeport") $VoctFreeport++;
    				if($location == "Harpswell") $VoctHarpswell++;
    				if($location == "Bowdoinham") $VoctBowdoinham++;
    				if($location == "Topsham") $VoctTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VoctOther++;
    			}
    			foreach($novLogs as &$nl) {
    				$d = $nl->get_id();
    				$partEntries = $nl->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $novOK++;
    						if($status == "C") $novC++;
    						if($status == "D") $novD++;
    						if($status == "H") $novH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $novBrunswick++;
    						if($location == "Freeport") $novFreeport++;
    						if($location == "Harpswell") $novHarpswell++;
    						if($location == "Bowdoinham") $novBowdoinham++;
    						if($location == "Topsham") $novTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $novOther++;
    					}
    				}
    				$volID = $nl->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VnovBrunswick++;
    				if($location == "Freeport") $VnovFreeport++;
    				if($location == "Harpswell") $VnovHarpswell++;
    				if($location == "Bowdoinham") $VnovBowdoinham++;
    				if($location == "Topsham") $VnovTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VnovOther++;
    			}
    			foreach($decLogs as &$dl) {
    				$d = $dl->get_id();
    				$partEntries = $dl->get_entry_ids();
    				foreach($partEntries as &$p) {
    					if ($p != null){
    						$entry = retrieve_dbParticipantEntry($d.$p);
    						$status = $entry->get_result();
    						if($status == "OK") $decOK++;
    						if($status == "C") $decC++;
    						if($status == "D") $decD++;
    						if($status == "H") $decH++;
    						$part = retrieve_dbParticipants($p);
    						$location = $part->get_city();
    						if($location == "Brunswick") $decBrunswick++;
    						if($location == "Freeport") $decFreeport++;
    						if($location == "Harpswell") $decHarpswell++;
    						if($location == "Bowdoinham") $decBowdoinham++;
    						if($location == "Topsham") $decTopsham++;
    						if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $decOther++;
    					}
    				}
    				$volID = $dl->get_volunteer_id();
    				$vol = retrieve_dbVolunteers($volID);
    				$location = $vol->get_city();
    				if($location == "Brunswick") $VdecBrunswick++;
    				if($location == "Freeport") $VdecFreeport++;
    				if($location == "Harpswell") $VdecHarpswell++;
    				if($location == "Bowdoinham") $VdecBowdoinham++;
    				if($location == "Topsham") $VdecTopsham++;
    				if($location != "Brunswick" && $location != "Freeport" && $location != "Harpswell" && $location != "Bowdoinham" && $location != "Topsham") $VdecOther++;
    			}
    			$totalOK = (int)$octOK+$novOK+$decOK;
    			echo "<TR><TD>Called in OK</TD><TD>".$octOK."</TD><TD>".$novOK."</TD><TD>".$decOK."</TD><TD>".$totalOK."</TD></TR>";
    		
    			$totalH = (int)$octH+$novH+$decH;
    			echo "<TR><TD>Had to call participant, was OK</TD><TD>".$octH."</TD><TD>".$novH."</TD><TD>".$decH."</TD><TD>$totalH</TD></TR>";
    		
    			$totalC = (int)$octC+$novC+$decC;
    			echo "<TR><TD>Unable to reach participant, called contact(s)</TD><TD>".$octC."</TD><TD>".$novC."</TD><TD>".$decC."</TD><TD>".$totalC."</TD></TR>";
    		
    			$totalD = (int)$octD+$novD+$decD;
    			echo "<TR><TD>Referred to police dispatch</TD><TD>".$octD."</TD><TD>".$novD."</TD><TD>".$decD."</TD><TD>".$totalD."</TD></TR>";
    			
    			$octTotal = (int)$octBrunswick+$octFreeport+$octHarpswell+$octBowdoinham+$octTopsham+$octOther;
    			$novTotal = (int)$novBrunswick+$novFreeport+$novHarpswell+$novBowdoinham+$novTopsham+$sepOther;
    			$decTotal = (int)$decBrunswick+$decFreeport+$decHarpswell+$decBowdoinham+$decTopsham+$decOther;
    			$VoctTotal = (int)$VoctBrunswick+$VoctFreeport+$VoctHarpswell+$VoctBowdoinham+$VoctTopsham+$VoctOther;
    			$VjunTotal = (int)$VnovBrunswick+$VnovFreeport+$VnovHarpswell+$VnovBowdoinham+$VnovTopsham+$VnovOther;
    			$VdecTotal = (int)$VdecBrunswick+$VdecFreeport+$VdecHarpswell+$VdecBowdoinham+$VdecTopsham+$VdecOther;
    		}    		
    		echo "</TABLE><BR><BR>";
    		echo "<TABLE>";
    		echo "<TR><TD>Number of Participants/Volunteers</TD>";
    		echo "<TD>";
    		if ($quarter == 1) echo "Jan";
    		if ($quarter == 2) echo "Apr";
    		if ($quarter == 3) echo "Jul";
    		if ($quarter == 4) echo "Oct";
    		echo "</TD><TD>";
    		if ($quarter == 1) echo "Feb";
    		if ($quarter == 2) echo "May";
    		if ($quarter == 3) echo "Aug";
    		if ($quarter == 4) echo "Nov";
    		echo "</TD><TD>";
    		if ($quarter == 1) echo "Mar";
    		if ($quarter == 2) echo "Jun";
    		if ($quarter == 3) echo "Sept";
    		if ($quarter == 4) echo "Dec";
    		echo "</TD></TR>";
    		echo "<TR><TD>Brunswick</TD><TD>";
    		if ($quarter == 1) echo $janBrunswick."/".$VjanBrunswick."</TD><TD>".$febBrunswick."/".$VfebBrunswick."</TD><TD>".$marBrunswick."/".$VmarBrunswick."</TD></TR>";
    		if ($quarter == 2) echo $aprBrunswick."/".$VaprBrunswick."</TD><TD>".$mayBrunswick."/".$VmayBrunswick."</TD><TD>".$junBrunswick."/".$VjunBrunswick."</TD></TR>";
    		if ($quarter == 3) echo $julBrunswick."/".$VjulBrunswick."</TD><TD>".$augBrunswick."/".$VaugBrunswick."</TD><TD>".$sepBrunswick."/".$VsepBrunswick."</TD></TR>";
    		if ($quarter == 4) echo $octBrunswick."/".$VoctBrunswick."</TD><TD>".$novBrunswick."/".$VnovBrunswick."</TD><TD>".$decBrunswick."/".$VdecBrunswick."</TD></TR>";
    		echo "<TR><TD>Freeport</TD><TD>";
    		if ($quarter == 1) echo $janFreeport."/".$VjanFreeport."</TD><TD>".$febFreeport."/".$VfebFreeport."</TD><TD>".$marFreeport."/".$VmarFreeport."</TD></TR>";
    		if ($quarter == 2) echo $aprFreeport."/".$VaprFreeport."</TD><TD>".$mayFreeport."/".$VmayFreeport."</TD><TD>".$junFreeport."/".$VjunFreeport."</TD></TR>";
    		if ($quarter == 3) echo $julFreeport."/".$VjulFreeport."</TD><TD>".$augFreeport."/".$VaugFreeport."</TD><TD>".$sepFreeport."/".$VsepFreeport."</TD></TR>";
    		if ($quarter == 4) echo $octFreeport."/".$VoctFreeport."</TD><TD>".$novFreeport."/".$VnovFreeport."</TD><TD>".$decFreeport."/".$VdecFreeport."</TD></TR>";
    		echo "<TR><TD>Harpswell</TD><TD>";
    		if ($quarter == 1) echo $janHarpswell."/".$VjanHarpswell."</TD><TD>".$febHarpswell."/".$VfebHarpswell."</TD><TD>".$marHarpswell."/".$VmarHarpswell."</TD></TR>";
    		if ($quarter == 2) echo $aprHarpswell."/".$VaprHarpswell."</TD><TD>".$mayHarpswell."/".$VmayHarpswell."</TD><TD>".$junHarpswell."/".$VjunHarpswell."</TD></TR>";
    		if ($quarter == 3) echo $julHarpswell."/".$VjulHarpswell."</TD><TD>".$augHarpswell."/".$VaugHarpswell."</TD><TD>".$sepHarpswell."/".$VsepHarpswell."</TD></TR>";
    		if ($quarter == 4) echo $octHarpswell."/".$VoctHarpswell."</TD><TD>".$novHarpswell."/".$VnovHarpswell."</TD><TD>".$decHarpswell."/".$VdecHarpswell."</TD></TR>";
    		echo "<TR><TD>Bowdoinham</TD><TD>";
    		if ($quarter == 1) echo $janBowdoinham."/".$VjanBowdoinham."</TD><TD>".$febBowdoinham."/".$VfebBowdoinham."</TD><TD>".$marBowdoinham."/".$VmarBowdoinham."</TD></TR>";
    		if ($quarter == 2) echo $aprBowdoinham."/".$VaprBowdoinham."</TD><TD>".$mayBowdoinham."/".$VmayBowdoinham."</TD><TD>".$junBowdoinham."/".$VjunBowdoinham."</TD></TR>";
    		if ($quarter == 3) echo $julBowdoinham."/".$VjulBowdoinham."</TD><TD>".$augBowdoinham."/".$VaugBowdoinham."</TD><TD>".$sepBowdoinham."/".$VsepBowdoinham."</TD></TR>";
    		if ($quarter == 4) echo $octBowdoinham."/".$VoctBowdoinham."</TD><TD>".$novBowdoinham."/".$VnovBowdoinham."</TD><TD>".$decBowdoinham."/".$VdecBowdoinham."</TD></TR>";
    		echo "<TR><TD>Topsham</TD><TD>";
    		if ($quarter == 1) echo $janTopsham."/".$VjanTopsham."</TD><TD>".$febTopsham."/".$VfebTopsham."</TD><TD>".$marTopsham."/".$VmarTopsham."</TD></TR>";
    		if ($quarter == 2) echo $aprTopsham."/".$VaprTopsham."</TD><TD>".$mayTopsham."/".$VmayTopsham."</TD><TD>".$junTopsham."/".$VjunTopsham."</TD></TR>";
    		if ($quarter == 3) echo $julTopsham."/".$VjulTopsham."</TD><TD>".$augTopsham."/".$VaugTopsham."</TD><TD>".$sepTopsham."/".$VsepTopsham."</TD></TR>";
    		if ($quarter == 4) echo $octTopsham."/".$VoctTopsham."</TD><TD>".$novTopsham."/".$VnovTopsham."</TD><TD>".$decTopsham."/".$VdecTopsham."</TD></TR>";
    		echo "<TR><TD>Other</TD><TD>";
    		if ($quarter == 1) echo $janOther."/".$VjanOther."</TD><TD>".$febOther."/".$VfebOther."</TD><TD>".$marOther."/".$VmarOther."</TD></TR>";
    		if ($quarter == 2) echo $aprOther."/".$VaprOther."</TD><TD>".$mayOther."/".$VmayOther."</TD><TD>".$junOther."/".$VjunOther."</TD></TR>";
    		if ($quarter == 3) echo $julOther."/".$VjulOther."</TD><TD>".$augOther."/".$VaugOther."</TD><TD>".$sepOther."/".$VsepOther."</TD></TR>";
    		if ($quarter == 4) echo $octOther."/".$VoctOther."</TD><TD>".$novOther."/".$VnovOther."</TD><TD>".$decOther."/".$VdecOther."</TD></TR>";
    		echo "<TR><TD>Totals</TD><TD>";
    		if ($quarter == 1) echo $janTotal."/".$VjanTotal."</TD><TD>".$febTotal."/".$VfebTotal."</TD><TD>".$marTotal."/".$VmarTotal."</TD></TR>";
    		if ($quarter == 2) echo $aprTotal."/".$VaprTotal."</TD><TD>".$mayTotal."/".$VmayTotal."</TD><TD>".$junTotal."/".$VjunTotal."</TD></TR>";
    		if ($quarter == 3) echo $julTotal."/".$VjulTotal."</TD><TD>".$augTotal."/".$VaugTotal."</TD><TD>".$sepTotal."/".$VsepTotal."</TD></TR>";
    		if ($quarter == 4) echo $octTotal."/".$VoctTotal."</TD><TD>".$novTotal."/".$VnovTotal."</TD><TD>".$decTotal."/".$VdecTotal."</TD></TR>";
    		echo "</TABLE><BR><BR>";
    	}
    	if($quarter != null && $totalD != 0) {
    		echo "<TABLE>";
    		echo "<TR><TD>Participants Referred to Dispatch</TD><TD>Town</TD><TD>Date</TD></TR>";
    		if ($quarter == 1) $dls = retrieve_betweentwodates($jan_start, $mar_end);
    		if ($quarter == 2) $dls = retrieve_betweentwodates($apr_start, $jun_end);
    		if ($quarter == 3) $dls = retrieve_betweentwodates($jul_start, $sep_end);
    		if ($quarter == 4) $dls = retrieve_betweentwodates($oct_start, $dec_end);
    		foreach($dls as &$dl) {
    			$eID = $dl->get_entry_ids();
    			$date = $dl->get_id();
    			foreach($eID as &$ID) {
    				$pEntry = retrieve_dbParticipantEntry($date.$ID);
    				if($ID != null) {
    					$fname = retrieve_dbParticipants($ID)->get_first_name();
    					$lname = retrieve_dbParticipants($ID)->get_last_name();
    					$cit = retrieve_dbParticipants($ID)->get_city();
    					$stat = $pEntry->get_result();
	    				if($stat == "D") echo "<TR><TD>".$fname." ".$lname."</TD><TD>".$cit."</TD><TD>".$date."</TR>";
    				}
    			}
    		}
    		echo "<TABLE>";   
    	} 		
    ?>
    <?PHP include('footer.inc');?>
    </DIV>
    </DIV>
    </BODY>     
</HTML>        