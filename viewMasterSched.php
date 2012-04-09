<!--
    /*
    * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
    * Tucker.  This program is part of Homecheck, which is free software.  It comes
    * with absolutely no warranty.  You can redistribute and/or modify it under the
    * terms of the GNU Public License as published by the Free Software Foundation
    * (see <http://www.gnu.org/licenses/).
    */
-->
<HTML>     
  <HEAD>  
    <TITLE>Master Schedule</TITLE>   
    <link rel="stylesheet" href="styles.css" type="text/css">
      <link type="text/css" rel="stylesheet" href="data:text/css,">
	<STYLE TYPE="text/css"> 
	  select {
	      font-family: Arial, sans-serif;
	      font-size: 1em;
	  }
	  textarea {
	      max-width: 280px;
	      max-height: 250px;
	  }
	  .badValue {
	      border:4px solid red;
	  }

	</STYLE>

	<SCRIPT LANGUAGE="JavaScript">
	  function validateTime() {
	  // Get the source element.
	  var el = event.srcElement;
	  // Valid entries
	  var ent = "0123456789:";
	  event.returnValue = true;
	  /* Loop over contents. If any character is not a number,
	  set the return value to false. */
	  for (var intLoop = 0; intLoop '&lt;' el.value.length; intLoop++)
	  if (-1 == ent.indexOf(el.value.charAt(intLoop)) || el.value.length '&lt;' 4) {
	  event.returnValue=false;
	  alert("Invalid Time! Please enter in HH:MM format,\nExamples: 12:00, 08:25, 9:00");
	  }
	  if (!event.returnValue) {       // Bad value
	  el.className = "badValue"; // Change class
	  }
	  else
	  el.className="";       
	  }

	  function isEmpty(str) {
	  // Check whether string is empty.
	  for (var intLoop = 0; intLoop '&lt;' str.length; intLoop++)
	  if (" " != str.charAt(intLoop))
	  return false;
	  return true;
	  }

	  function checkRequired(f) {
	  var strError = "";
	  for (var intLoop = 0; intLoop'&lt;'f.elements.length; intLoop++)
	  if (null!=f.elements[intLoop].getAttribute("required")) 
	  if (isEmpty(f.elements[intLoop].value))
	  strError += "  " + f.elements[intLoop].name + "\n";
	  if ("" != strError) {
	  alert("Required data is missing:\n" + strError);
	  return false;
	  }
	  if (f.value.length '&lt;'=1) {
	  alert("Required data is missing:\n" + strError);
	  return false;
	  }
	  }
	</SCRIPT>
      </link>
    </link>
  </HEAD>     
  <BODY> 
    <DIV id="container">
      <?php //include('header.php');?>
      <DIV id="content">
	<?php
	    include_once('database/dbScheduleEntry.php');
	    include_once('domain/ScheduleEntry.php');
	    include_once('domain/Volunteer.php');
	    include_once('database/dbVolunteers.php');
	    //For testing purposes only
	    $vol1 = new Volunteer("Smith", "John", "111 Main Street", "Brunswick", "ME","04011", 2071234567, "", "name@domain1.com","volunteer", "Mary:2071112222:Mary@email.com,Sue:2072223333:Sue@email.com","retired", "", "","completed", "Wed:1,Fri:5,FI","Wed:1,Fri5","", "08-01-01","", "active", "", "");
	    insert_dbVolunteers($vol1);
	    $volList=getall_dbVolunteers();
	?>
      </DIV>
      <h1 align="center">Master Schedule</h1>
      <FORM ID="MasterSchedule" ACTION = "writeMasterSched.php" METHOD="post" ONSUBMIT="return checkRequired(this);">
	<DIV STYLE="TOP:75 ;LEFT:75 Position:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	  <table border="2" align="center">
	    <tr>
	      <th width="100" align="center">  Sunday  </th>
	      <th width="100" align="center">  Monday  </th>
	      <th width="100" align="center">  Tuesday  </th>
	      <th width="100" align="center">  Wednesday  </th>
	      <th width="100" align="center">  Thursday  </th>
	      <th width="100" align="center">  Friday  </th>
	      <th width="100" align="center">  Saturday  </th>
	    </tr>
	    <tr STYLE="HEIGHT:100;">
	      <td valign="top">
		<SELECT NAME="Sun:1" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sun:1");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Mon:1" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Mon:1");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Tue:1" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Tue:1");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Wed:1" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Wed:1");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Thu:1" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Thu:1");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Fri:1" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Fri:1");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Sat:1" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sat:1");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	    </tr>
	    <tr STYLE="HEIGHT:100;">
	      <td valign="top">
		<SELECT NAME="Sun:2" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sun:2");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Mon:2" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Mon:2");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Tue:2" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Tue:2");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Wed:2" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Wed:2");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Thu:2" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Thu:2");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Fri:2" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Fri:2");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Sat:2" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sat:2");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	    </tr>
	    <tr STYLE="HEIGHT:100;">
	      <td valign="top">
		<SELECT NAME="Sun:3" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sun:3");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Mon:3" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Mon:3");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Tue:3" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Tue:3");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Wed:3" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Wed:3");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Thu:3" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Thu:3");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Fri:3" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Fri:3");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Sat:3" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sat:3");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	    </tr>
	    <tr STYLE="HEIGHT:100;">
	      <td valign="top">
		<SELECT NAME="Sun:4" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sun:4");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Mon:4" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Mon:4");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Tue:4" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Tue:4");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Wed:4" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Wed:4");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Thu:4" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Thu:4");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Fri:4" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Fri:4");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Sat:4" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sat:4");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	    </tr>
	    <tr STYLE="HEIGHT:100;">
	      <td valign="top">
		<SELECT NAME="Sun:5" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sun:5");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Mon:5" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Mon:5");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Tue:5" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Tue:5");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Wed:5" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Wed:5");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Thu:5" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Thu:5");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Fri:5" TITLE="Select a volunteer for this shift.">
		  <OPTION  VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Fri:5");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
			echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      else
			echo "<OPTION VALUE='",$row->get_id(),"'>";
		      echo $row->get_first_name()," ",$row->get_last_name();
		      echo "</OPTION>";}
		  ?>
		</SELECT>
	      </td>
	      <td valign="top">
		<SELECT NAME="Sat:5" TITLE="Select a volunteer for this shift.">
		  <OPTION VALUE = "">Select Volunteer...</OPTION>
		  <?php
		    foreach($volList as $row){
		      $checkEntry=retrieve_dbScheduleEntry("Sat:5");
		      if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id()){
			echo('<OPTION SELECTED VALUE ="');
			echo($row->get_id());
			echo('">');}
		      else
			echo('Test');
		      echo($row->get_first_name()." ".$row->get_last_name());
		      echo("</OPTION>");}
		  ?>
		</SELECT>
	      </td>
	    </tr>
</table>
</DIV>
<br/>
<DIV ALIGN="center">
  <INPUT STYLE="WIDTH:50; HEIGHT:30;" TYPE="submit" VALUE="Save" align="center"/>
  </DIV>
  </FORM>
  <FORM ID="CreateMonthly" ACTION = "viewMonthlySched.php" METHOD="get" ONSUBMIT="return checkRequired(this);">
  <DIV ALIGN="center">
  Create Schedule for: 
  <SELECT NAME="Month" > 
  <OPTION VALUE = "01">January</OPTION>
  <OPTION VALUE = "02">February</OPTION>
  <OPTION VALUE = "03">March</OPTION>
  <OPTION VALUE = "04">April</OPTION>
  <OPTION VALUE = "05">May</OPTION>
  <OPTION VALUE = "06">June</OPTION>
  <OPTION VALUE = "07">July</OPTION>
  <OPTION VALUE = "08">August</OPTION>
  <OPTION VALUE = "09">September</OPTION>
  <OPTION VALUE = "10">October</OPTION>
  <OPTION VALUE = "11">November</OPTION>
  <OPTION VALUE = "12">December</OPTION>
  </SELECT>
  <SELECT NAME="Year">
  <OPTION VALUE = "12">2012</OPTION>
  <OPTION VALUE = "13">2013</OPTION>
  <OPTION VALUE = "14">2014</OPTION>
  <OPTION VALUE = "15">2015</OPTION>
  </SELECT>
  <INPUT STYLE="WIDTH:50; HEIGHT:20;" TYPE="submit" VALUE="Go!"/>
  </DIV>
  </FORM>
  <?php include('footer.inc');?>	
</DIV>
</BODY>
</HTML>