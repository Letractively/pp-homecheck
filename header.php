<!--
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
 * Tucker.  This program is part of Homecheck, which is free software.  It comes
 * with absolutely no warranty.  You can redistribute and/or modify it under the
 * terms of the GNU Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/).
*/
-->

<style type="text/css">
h1 {padding-left: 0px; padding-right:165px;}
</style>
<div id="header">
<!--<br><br><img src="images/Header.gif" align="center"><br>
<h1><br><br>RMH Homebase <br></h1>-->

</div>

<div align="left" id="navigationLinks">

<?php
	//Log-in security
	//If they aren't logged in, display our log-in form.
	if(!isset($_SESSION['logged_in'])){
		include('login_form.php');
		die();
	}
	else if($_SESSION['logged_in']){

		/**
		 * Set our permission array for guests, volunteers, coordinator, and dispatcher.
		 * If a page is not specified in the permission array, anyone logged into the system
		 * can view it. If someone logged into the system attempts to access a page above their
		 * permission level, they will be sent back to the home page.
		 */
		//pages guests can view
		$permission_array['index.php']=0;
		$permission_array['about.php']=0;
		//pages volunteers and dispatcher can view
		$permission_array['dailyLog.php']=1;
		$permission_array['viewParticipants.php']=1;
		$permission_array['editMonthlySchedule.php']=1;
		$permission_array['participantInfo.php']=1;
		$permission_array['participantBrief.php']=1;
		//additional pages the coordinator can view
		$permission_array['volunteerEdit.php']=2;
		$permission_array['viewMasterSched.php']=2;
		$permission_array['viewVolunteers.php']=2;
		$permission_array['viewReport.php']=2;
		

		//Check if they're at a valid page for their access level.
		$current_page = substr($_SERVER['PHP_SELF'],1);
		if($permission_array[$current_page]>$_SESSION['access_level']){
			//in this case, the user doesn't have permission to view this page.
			//we redirect them to the index page.
			echo "<script type=\"text/javascript\">window.location = \"index.php\";</script>";
			//note: if javascript is disabled for a user's browser, it would still show the page.
			//so we die().
			die();
		}

		//This line gives us the path to the html pages in question, useful if the server isn't installed @ root.
		$path = strrev(substr(strrev($_SERVER['SCRIPT_NAME']),strpos(strrev($_SERVER['SCRIPT_NAME']),'/')));
		$today = date("y-m-d");
		$todaysmonth = date("m");
  	    $todaysyear = date("Y");
		//they're logged in and session variables are set.
		echo('<a href="'.$path.'index.php">home</a>');
		if ($_SESSION['access_level']==0) // guests
		  echo('<a href="volunteerEdit.php?id=new'.'"> | apply </a>');
		
		if($_SESSION['access_level']>=1) // volunteers, coordinator, dispatcher 
		  {
		    echo('<a href="'.$path.'dailyLog.php?date='.$today.'"> | daily log</a>');
		    echo('<a href="'.$path.'viewParticipants.php"> | participants</a>');
		    echo('<a href="'.$path.'editMonthlySchedule.php?Month='.$todaysmonth.'&Year='.$todaysyear.'"> | monthly schedule</a>');
		  }
		echo('<a href="'.$path.'about.php"> | about</a>');
		echo('<a href="'.$path.'logout.php"> | logout</a>');
		if($_SESSION['access_level']==2) { // coordinator only
		  echo '<a href="'.$path.'viewMasterSched.php"> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;master schedule</a>';
		  echo('<a href="'.$path.'viewVolunteers.php"> | volunteers</a>');
		  echo '<a href="'.$path.'viewReport.php"> | reports</a>';	    
		}
		
		
	}
?>
</div>
<!-- End Header -->