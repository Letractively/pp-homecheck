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
	$year = $_GET["Year"]; 
?>
<HTML>     
    <HEAD>  
    <TITLE>Quarterly Report</TITLE>   
	<LINK REL="stylesheet" HREF="styles.css" TYPE="text/css">
	<LINK REL="icon"  TYPE="image/png" HREF="images/VRfavicon.png">
	<LINK HREF="print.css" TYPE="text/css" REL="stylesheet" MEDIA="print">
	<LINK TYPE="text/css" REL="stylesheet" HREF="data:text/css,">
	<STYLE TYPE="text/css">
	body {
		min-width: 1024px;
		overflow:scroll;
	}
	.button_report {
   		background:url(images/button_report.png) no-repeat;
   		border: none;
   		height: 32px;
   		width: 99px;
   		cursor: hand;
	}
	.button_print {
   		background:url(images/button_print.png) no-repeat;
   		border: none;
   		height: 32px;
   		width: 99px;
   		cursor: hand;
   		margin-left: 20px;
	}
	table.gridtable {
		font-family: verdana,arial,sans-serif;
		font-size:12px;
		color:#000000;
		border-width: 1px;
		border-color: #000000;
		border-collapse: collapse;
		margin-left: 20px;
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
		text-align: center;
		border-style: solid;
		border-color: #000000;
		background-color: #ffffff;
	}
	</STYLE>
    </HEAD>     
    <BODY> 
    <DIV ID="container">
    <DIV ID ="head"><?PHP include('header.php');?></DIV>
    <DIV ID="content">
    <H2 STYLE="margin-left:20px;">Good Morning Quarterly Activity Report</H2><BR>
    <DIV ID="form">
    <FORM ID="FORM1" METHOD = "get" ACTION = "viewReport.php">
    	<H3>Select a Quarter:</H3>
    	<DIV STYLE=" TOP: 240; MARGIN-LEFT: 200; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
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
    			$startyear = 2012;
    			$currentYear = Date(Y);
    			while ($startyear < (int)$currentYear){
    				echo "<OPTION VALUE = '".$startyear."'>".$startyear."</OPTION>";
    				$startyear++;
    			}
    			if ($startyear == $currentYear) echo "<OPTION SELECTED VALUE = '".$startyear."'>".$startyear."</OPTION>";
    		?>
    	</SELECT>
    	<INPUT TYPE="submit" VALUE ="" ONMOUSEOVER="this.style.cursor = 'hand';" CLASS="button_report" TITLE="Show Report"/> 
    	</DIV>
    </FORM>
    </DIV>
    <?PHP 
    	if($quarter != null) {
    		$aOK = $aC = $aD = $aH = $bOK = $bC = $bD = $bH = $cOK = $cC = $cD = $cH = 0;
    		$aBrunswick = $aFreeport = $aHarpswell = $aTopsham = $aBowdoinham = $aOther = 0;
    		$bBrunswick = $bFreeport = $bHarpswell = $bTopsham = $bBowdoinham = $bOther = 0;
    		$cBrunswick = $cFreeport = $cHarpswell = $cTopsham = $cBowdoinham = $cOther = 0;
    		$VaBrunswick = $VaFreeport = $VaHarpswell = $VaTopsham = $VaBowdoinham = $VaOther = 0;
    		$VbBrunswick = $VbFreeport = $VbHarpswell = $VbTopsham = $VbBowdoinham = $VbOther = 0;
    		$VcBrunswick = $VcFreeport = $VcHarpswell = $VcTopsham = $VcBowdoinham = $VcOther = 0;
    		$y = substr($year, 2);
    		if ($quarter == 1) {
    			echo "<BR><H3>Quarterly Report for January 1, ".$startyear." to March 31, ".$startyear."</H3><BR>";
    			$a_start = $y."-01-01";
    			$a_end = $y."-01-31";
    			if ((int)$y%4 == 0) {
    				$b_start = $y."-02-01";
    				$b_end = $y."-02-29";
    			}
    			else {
    				$b_start = $y."-02-01";
    				$b_end = $y."-02-28";
    			}
    			$c_start = $y."-03-01";
    			$c_end = $y."-03-31";
    		}
    		if ($quarter == 2) {
    			echo "<BR><H3>Quarterly Report for April 1, ".$startyear." to June 30, ".$startyear."</H3><BR>";
    			$a_start = $y."-04-01";
    			$a_end = $y."-04-30";
    			$b_start = $y."-05-01";
    			$b_end = $y."-05-31";
    			$c_start = $y."-06-01";
    			$c_end = $y."-06-30";
    		}
    		if ($quarter == 3) {
    			echo "<BR><H3>Quarterly Report for July 1, ".$startyear." to September 30, ".$startyear."</H3><BR>";
    			$a_start = $y."-07-01";
    			$a_end = $y."-07-31";
    			$b_start = $y."-08-01";
    			$b_end = $y."-08-31";
    			$c_start = $y."-09-01";
    			$c_end = $y."-09-30";
    		}
    		if ($quarter == 4) {
    			echo "<BR><H3>Quarterly Report for August 1, ".$startyear." to December 31, ".$startyear."</H3><BR>";
    			$a_start = $y."-10-01";
    			$a_end = $y."-10-31";
    			$b_start = $y."-11-01";
    			$b_end = $y."-11-30";
    			$c_start = $y."-12-01";
    			$c_end = $y."-12-31";
    		}

    		$aLogs = retrieve_betweentwodates($a_start, $a_end);
    		$bLogs = retrieve_betweentwodates($b_start, $b_end);
    		$cLogs = retrieve_betweentwodates($c_start, $c_end);
    		
   		 	foreach($aLogs as &$al) {
   				$d = $al->get_id();
   				$partEntries = $al->get_entry_ids();
   				foreach($partEntries as &$p) {
   					if ($p != null){
   						$entry = retrieve_dbParticipantEntry($d.$p);
   						if ($entry != null) {
   							$status = $entry->get_result();
	   						if(strcasecmp($status , "OK") == 0) $aOK++;
   							if(strcasecmp($status , "C") == 0) $aC++;
   							if(strcasecmp($status , "D") == 0) $aD++;
   							if(strcasecmp($status , "H") == 0) $aH++;
   							$part = retrieve_dbParticipants($p);
   							$location = $part->get_city();
   							if(strcasecmp($location , "Brunswick") == 0) $aBrunswick++;
	   						if(strcasecmp($location , "Freeport") == 0) $aFreeport++;
   							if(strcasecmp($location , "Harpswell") == 0) $aHarpswell++;
   							if(strcasecmp($location , "Bowdoinham") == 0) $aBowdoinham++;
   							if(strcasecmp($location , "Topsham") == 0) $aTopsham++;
   							if(strcasecmp($location , "Brunswick") != 0 && strcasecmp($location , "Freeport") != 0 && strcasecmp($location , "Harpswell") != 0 && strcasecmp($location , "Bowdoinham") != 0 && strcasecmp($location , "Topsham") != 0) $aOther++;
   						}
   					}
   				}
   				$volID = $al->get_volunteer_id();
   				$vol = retrieve_dbVolunteers($volID);
   				if ($vol != null) {
   					$location = $vol->get_city();
   					if(strcasecmp($location , "Brunswick") == 0) $VaBrunswick++;
   					if(strcasecmp($location , "Freeport") == 0) $VaFreeport++;
   					if(strcasecmp($location , "Harpswell") == 0) $VaHarpswell++;
   					if(strcasecmp($location , "Bowdoinham") == 0) $VaBowdoinham++;
    				if(strcasecmp($location , "Topsham") == 0) $VaTopsham++;
    				if(strcasecmp($location , "Brunswick") != 0 && strcasecmp($location , "Freeport") != 0 && strcasecmp($location , "Harpswell") != 0 && strcasecmp($location , "Bowdoinham") != 0 && strcasecmp($location , "Topsham") != 0) $VaOther++;
   				}
   			}
   			foreach($bLogs as &$bl) {
   				$d = $bl->get_id();
   				$partEntries = $bl->get_entry_ids();
   				foreach($partEntries as &$p) {
   					if ($p != null){
   						$entry = retrieve_dbParticipantEntry($d.$p);
   						$status = $entry->get_result();
   						if(strcasecmp($status , "OK") == 0) $bOK++;
   						if(strcasecmp($status , "C") == 0) $bC++;
   						if(strcasecmp($status , "D") == 0) $bD++;
   						if(strcasecmp($status , "H") == 0) $bH++;
   						$part = retrieve_dbParticipants($p);
   						$location = $part->get_city();
   						if(strcasecmp($location , "Brunswick") == 0) $bBrunswick++;
   						if(strcasecmp($location , "Freeport") == 0) $bFreeport++;
   						if(strcasecmp($location , "Harpswell") == 0) $bHarpswell++;
   						if(strcasecmp($location , "Bowdoinham") == 0) $bBowdoinham++;
   						if(strcasecmp($location , "Topsham") == 0) $bTopsham++;
   						if(strcasecmp($location , "Brunswick") != 0 && strcasecmp($location , "Freeport") != 0 && strcasecmp($location , "Harpswell") != 0 && strcasecmp($location , "Bowdoinham") != 0 && strcasecmp($location , "Topsham") != 0) $bOther++;
   					}
   				}
   				$volID = $bl->get_volunteer_id();
   				$vol = retrieve_dbVolunteers($volID);
   				if ($vol != null) {
   					$location = $vol->get_city();
   					if(strcasecmp($location , "Brunswick") == 0) $VbBrunswick++;
   					if(strcasecmp($location , "Freeport") == 0) $VbFreeport++;
   					if(strcasecmp($location , "Harpswell") == 0) $VbHarpswell++;
   					if(strcasecmp($location , "Bowdoinham") == 0) $VbBowdoinham++;
    				if(strcasecmp($location , "Topsham") == 0) $VbTopsham++;
    				if(strcasecmp($location , "Brunswick") != 0 && strcasecmp($location , "Freeport") != 0 && strcasecmp($location , "Harpswell") != 0 && strcasecmp($location , "Bowdoinham") != 0 && strcasecmp($location , "Topsham") != 0) $VbOther++;
	   			}
   			}
   			foreach($cLogs as &$cl) {
   				$d = $cl->get_id();
   				$partEntries = $cl->get_entry_ids();
   				foreach($partEntries as &$p) {
   					if ($p != null){
   						$entry = retrieve_dbParticipantEntry($d.$p);
   						$status = $entry->get_result();
   						if(strcasecmp($status , "OK") == 0) $cOK++;
   						if(strcasecmp($status , "C") == 0) $cC++;
   						if(strcasecmp($status , "D") == 0) $cD++;
   						if(strcasecmp($status , "H") == 0) $cH++;
   						$part = retrieve_dbParticipants($p);
   						$location = $part->get_city();
   						if(strcasecmp($location , "Brunswick") == 0) $cBrunswick++;
   						if(strcasecmp($location , "Freeport") == 0) $cFreeport++;
   						if(strcasecmp($location , "Harpswell") == 0) $cHarpswell++;
   						if(strcasecmp($location , "Bowdoinham") == 0) $cBowdoinham++;
   						if(strcasecmp($location , "Topsham") == 0) $cTopsham++;
   						if(strcasecmp($location , "Brunswick") != 0 && strcasecmp($location , "Freeport") != 0 && strcasecmp($location , "Harpswell") != 0 && strcasecmp($location , "Bowdoinham") != 0 && strcasecmp($location , "Topsham") != 0) $cOther++;
   					}
   				}
   				$volID = $cl->get_volunteer_id();
   				$vol = retrieve_dbVolunteers($volID);
   				if ($vol != null) {
   					$location = $vol->get_city();
   					if(strcasecmp($location , "Brunswick") == 0) $VcBrunswick++;
   					if(strcasecmp($location , "Freeport") == 0) $VcFreeport++;
   					if(strcasecmp($location , "Harpswell") == 0) $VcHarpswell++;
   					if(strcasecmp($location , "Bowdoinham") == 0) $VcBowdoinham++;
    				if(strcasecmp($location , "Topsham") == 0) $VcTopsham++;
    				if(strcasecmp($location , "Brunswick") != 0 && strcasecmp($location , "Freeport") != 0 && strcasecmp($location , "Harpswell") != 0 && strcasecmp($location , "Bowdoinham") != 0 && strcasecmp($location , "Topsham") != 0) $VcOther++;
   				}
    		}
    		
    		$totalOK = (int)$aOK+$bOK+$cOK;
    		$totalH = (int)$aH+$bH+$cH;    		
    		$totalC = (int)$aC+$bC+$cC;    		
    		$totalD = (int)$aD+$bD+$cD;  
    		echo "<TABLE CLASS='gridtable'><TR><TH><B> Steps to Resolution </TH><TH><B>";
    		if ($quarter == 1) echo "Jan</B></TH><TH><B>Feb</B></TH><TH><B>Mar</B></TH><TH><B>Total</B></TH></TR>";
    		if ($quarter == 2) echo "Apr</B></TH><TH><B>May</B></TH><TH><B>Jun</B></TH><TH><B>Total</B></TH></TR>";
    		if ($quarter == 3) echo "Jul</B></TH><TH><B>Aug</B></TH><TH><B>Sep</B></TH><TH><B>Total</B></TH></TR>";
    		if ($quarter == 4) echo "Oct</B></TH><TH><B>Nov</B></TH><TH><B>Dec</B></TH><TH><B>Total</B></TH></TR>";
    		echo "<TR><TH><B>Called in OK</B></TH><TD>".$aOK."</TD><TD>".$bOK."</TD><TD>".$cOK."</TD><TD>".$totalOK."</TD></TR>";
    		echo "<TR><TH><B>Had to call participant, was OK</B></TH><TD>".$aH."</TD><TD>".$bH."</TD><TD>".$cH."</TD><TD>$totalH</TD></TR>";
    		echo "<TR><TH><B>Unable to reach participant, called contact(s)</B></TH><TD>".$aC."</TD><TD>".$bC."</TD><TD>".$cC."</TD><TD>".$totalC."</TD></TR>";
    		echo "<TR><TH><B>Referred to police dispatch</B></TH><TD>".$aD."</TD><TD>".$bD."</TD><TD>".$cD."</TD><TD>".$totalD."</TD></TR>";
    		echo "</TABLE><BR><BR>";
    		
    		$aTotal = (int)$aBrunswick+$aFreeport+$aHarpswell+$aBowdoinham+$aTopsham+$aOther;
    		$bTotal = (int)$bBrunswick+$bFreeport+$bHarpswell+$bBowdoinham+$bTopsham+$bOther;
    		$cTotal = (int)$cBrunswick+$cFreeport+$cHarpswell+$cBowdoinham+$cTopsham+$cOther;
    		$VaTotal = (int)$VaBrunswick+$VaFreeport+$VaHarpswell+$VaBowdoinham+$VaTopsham+$VaOther;
   			$VbTotal = (int)$VbBrunswick+$VbFreeport+$VbHarpswell+$VbBowdoinham+$VbTopsham+$VbOther;
 			$VcTotal = (int)$VcBrunswick+$VcFreeport+$VcHarpswell+$VcBowdoinham+$VcTopsham+$VcOther;
    		echo "<TABLE CLASS='gridtable'><TR><TH><B>Number of Participants/Volunteers</B></TH><TH><B>";
    		if ($quarter == 1) echo "Jan</B></TH><TH><B>Feb</B></TH><TH><B>Mar</B></TH></TR>";
    		if ($quarter == 2) echo "Apr</B></TH><TH><B>May</B></TH><TH><B>Jun</B></TH></TR>";
    		if ($quarter == 3) echo "Jul</B></TH><TH><B>Aug</B></TH><TH><B>Sep</B></TH></TR>";
    		if ($quarter == 4) echo "Oct</B></TH><TH><B>Nov</B></TH><TH><B>Dec</B></TH></TR>";
    		echo "<TR><TH><B>Brunswick</B></TH><TD>";
    		echo $aBrunswick."/".$VaBrunswick."</TD><TD>".$bBrunswick."/".$VbBrunswick."</TD><TD>".$cBrunswick."/".$VcBrunswick."</TD></TR>";
    		echo "<TR><TH><B>Freeport</B></TH><TD>";
    		echo $aFreeport."/".$VaFreeport."</TD><TD>".$bFreeport."/".$VbFreeport."</TD><TD>".$cFreeport."/".$VcFreeport."</TD></TR>";
    		echo "<TR><TH><B>Harpswell</B></TH><TD>";
    		echo $aHarpswell."/".$VaHarpswell."</TD><TD>".$bHarpswell."/".$VbHarpswell."</TD><TD>".$cHarpswell."/".$VcHarpswell."</TD></TR>";
    		echo "<TR><TH><B>Bowdoinham</B></TH><TD>";
    		echo $aBowdoinham."/".$VaBowdoinham."</TD><TD>".$bBowdoinham."/".$VbBowdoinham."</TD><TD>".$cBowdoinham."/".$VcBowdoinham."</TD></TR>";
    		echo "<TR><TH><B>Topsham</B></TH><TD>";
    		echo $aTopsham."/".$VaTopsham."</TD><TD>".$bTopsham."/".$VbTopsham."</TD><TD>".$cTopsham."/".$VcTopsham."</TD></TR>";
    		echo "<TR><TH><B>Other</B></TH><TD>";
    		echo $aOther."/".$VaOther."</TD><TD>".$bOther."/".$VbOther."</TD><TD>".$cOther."/".$VcOther."</TD></TR>";
    		echo "<TR><TH><B>Totals</B></TH><TD>";
    		echo $aTotal."/".$VaTotal."</TD><TD>".$bTotal."/".$VbTotal."</TD><TD>".$cTotal."/".$VcTotal."</TD></TR>";
    		echo "</TABLE><BR><BR>";
    	
    		if($totalD != 0) {
	    		echo "<TABLE CLASS='gridtable'>";
    			echo "<TR><TH><B>Participants Referred to Dispatch</B></TH><TH><B>Town</B></TH><TH><B>Date</B></TH></TR>";
    			$dls = retrieve_betweentwodates($a_start, $c_end);
    			foreach($dls as &$dl) {
    				$eID = $dl->get_entry_ids();
    				$date = $dl->get_id();
    				foreach($eID as &$ID) {
    					$pEntry = retrieve_dbParticipantEntry($date.$ID);
    					if($ID != null && $pEntry != null) {
    						$fname = retrieve_dbParticipants($ID)->get_first_name();
    						$lname = retrieve_dbParticipants($ID)->get_last_name();
    						$cit = retrieve_dbParticipants($ID)->get_city();
    						$stat = $pEntry->get_result();
    						$day = substr($date, -2); 
							$month = substr($date, -5, 2); 
							$year = substr($date, 0, -6); 
	    					if($stat == "D") echo "<TR><TD>".$fname." ".$lname."</TD><TD>".$cit."</TD><TD>".$month."/".$day."/".$year."</TR>";
    					}
    				}
    			}
    			echo "<TABLE><BR><BR>"; 
    		}
    		echo "<DIV ID='printbttn'><INPUT TYPE='submit' CLASS='button_print' VALUE='' TITLE='Print Page' ONCLICK='javascript: window.print();'/></DIV><BR><BR>";
    	} 		
    	
    ?>
    <DIV ID="footer"><?PHP include('footer.inc');?></DIV>
    </DIV>
    </DIV>
    </BODY>     
</HTML>        