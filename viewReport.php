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
	$quarter = $_GET["Quarter"]; 
	$y = $_GET["Year"]; 
?>
<HTML>     
    <HEAD>  
    <TITLE>Quarterly Report</TITLE>   
	<LINK rel="stylesheet" href="styles.css" type="text/css">
	<LINK type="text/css" rel="stylesheet" href="data:text/css,">

    </HEAD>     
    <BODY> 
    <DIV ID="container">
    <?PHP //include('header.php');?>
    <DIV ID="content">
    <H2>Good Morning Quarterly Activity Report</H2><BR>
    <FORM ID="FORM2" METHOD = "get" ACTION = "http://127.0.0.1/pp-homecheck/viewReport.php">
    <p>Select a Quarter:</p>
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
    		$year = 2011;
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
    	<INPUT TYPE="submit" VALUE="Show Report"/> 
    </FORM>
    <?PHP 
    	if($quarter != null) {
    		echo "<TABLE>";
    		echo "<TR><TD>";
    		echo "Steps to Resolution";
    		echo "</TD><TD>";
    		if ($quarter == 1)
    			echo "Jan";
    		if ($quarter == 2)
    			echo "Apr";
    		if ($quarter == 3)
    			echo "Jul";
    		if ($quarter == 4)
    			echo "Oct";
    		echo "</TD><TD>";
    		if ($quarter == 1)
    			echo "Feb";
    		if ($quarter == 2)
    			echo "May";
    		if ($quarter == 3)
    			echo "Aug";
    		if ($quarter == 4)
    			echo "Nov";
    		echo "</TD><TD>";
    		if ($quarter == 1)
    			echo "Mar";
    		if ($quarter == 2)
    			echo "Jun";
    		if ($quarter == 3)
    			echo "Sept";
    		if ($quarter == 4)
    			echo "Dec";
    		echo "</TD><TD>";
    		echo "Total";
    		echo "</TD></TR>";
    		
    		$y = substr($y, -2, 2);
    		if ($quarter == 1) {
    			$date_start = $y."-01-01";
    			$date_end = $y."-03-31";
    		}
    		if ($quarter == 2) {
    			$date_start = $y."-04-01";
    			$date_end = $y."-06-30";
    		}
    		if ($quarter == 3) {
    			$date_start = $y."-07-01";
    			$date_end = $y."-09-30";
    		}
    		if ($quarter == 4) {
    			$date_start = $y."-10-01";
    			$date_end = $y."-12-31";
    		}
    		echo "<TR><TD>";
    		echo "Called in OK";
    		echo "</TD><TD>";
    		
    		retrieve_betweentwodates($date_start, $date_end);
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD></TR>";
    		
    		
    		echo "<TR><TD>";
    		echo "Had to call participant, was OK";
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD></TR>";
    		
    		
    		echo "<TR><TD>";
    		echo "Unable to reach participant, called contact(s)";
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD></TR>";
    		
    		
    		echo "<TR><TD>";
    		echo "Referred to police dispatch";
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD><TD>";
    		
    		echo "</TD></TR>";
    		
    		echo "</TABLE>";
    	}
    ?>
    </DIV>
    <?PHP include('footer.inc');?>
    </DIV>
    </BODY>     
</HTML>        