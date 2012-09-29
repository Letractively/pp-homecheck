<!--
    /*
    * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
    * Tucker.  This program is part of Homecheck, which is free software.  It comes
    * with absolutely no warranty.  You can redistribute and/or modify it under the
    * terms of the GNU Public License as published by the Free Software Foundation
    * (see <http://www.gnu.org/licenses/).
    */
-->
<?php 
session_start();
session_cache_expire(30);
?>
<HTML>     
  <HEAD>  
    <TITLE>Edit Monthly Schedule</TITLE>   
    <link rel="stylesheet" href="styles.css" type="text/css"/>
    <link type="text/css" rel="stylesheet" href="data:text/css,"/>
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
    <SCRIPT type="text/javascript">
      function confirm_discard(){
	  var conf = confirm("This will discard all unsaved changes.  Do you want to continue?");
	  if(conf == true){
	      window.location="./viewMasterSched.php";
	  }
      }
    </SCRIPT>
  </HEAD>     
  <BODY> 
    <DIV id="container">
      <?php include('header.php');?>
      <DIV id="content">
	<?php
	  include_once('database/dbShifts.php');
	  include_once('domain/Shift.php');
	  include_once('database/dbScheduleEntry.php');
	  include_once('domain/ScheduleEntry.php');
	  include_once('domain/Month.php');
	  include_once('database/dbMonths.php');
	  include_once('domain/Volunteer.php');
	  include_once('database/dbVolunteers.php');
	  $volList=getall_dbVolunteers();
	  if(retrieve_dbMonths($_GET['Year'].'-'.$_GET['Month']))
	    $thisMonth=retrieve_dbMonths($_GET['Year'].'-'.$_GET['Month']);
	  else
	    $thisMonth = new Month($_GET['Year'].'-'.$_GET['Month'],"working","");
	    $dayCount = 1;
	?>
	<DIV>
	  <DIV STYLE="float:left;">
	    <FORM ID="MonthBack" ACTION="editMonthlySched.php" METHOD="get" ONSUBMIT="return confirm('This will discard all unsaved changes.  Do you want to continue?')">
	      <?php
		if($_GET['Month'] == 1){
		  $newMonth = 12;
		  $newYear = $_GET['Year']-1;}
		  elseif(intval($_GET['Month'])<=10){
		    $newMonth = "0".($_GET['Month']-1);
		    $newYear = $_GET['Year'];}
		  else{
		    $newMonth = $_GET['Month']-1;
		    $newYear = $_GET['Year'];}
		    echo('<INPUT TYPE="hidden" NAME="Month" VALUE="'.$newMonth.'"/>');
		    echo('<INPUT TYPE="hidden" NAME="Year" VALUE="'.$newYear.'"/>');
	      ?>
	      <INPUT TYPE="submit" VALUE="Previous Month" STYLE="HEIGHT:40;WIDTH:150;"/>
	    </FORM>
	  </DIV>
	  <DIV STYLE="float:right;">
	    <FORM ID="MonthForward" ACTION="editMonthlySched.php" METHOD="get" ONSUBMIT="return confirm('This will discard all unsaved changes.  Do you want to continue?')">
	      <?php
		      if($_GET['Month'] == 12){
			$newMonth = "01";
			$newYear = $_GET['Year']+1;}
			elseif(intval($_GET['Month'])<9){
			  $newMonth = "0".($_GET['Month']+1);
			  $newYear = $_GET['Year'];}
			else{
			  $newMonth = $_GET['Month']+1;
			  $newYear = $_GET['Year'];}
			  echo('<INPUT TYPE="hidden" NAME="Month" VALUE="'.$newMonth.'"/>');
			  echo('<INPUT TYPE="hidden" NAME="Year" VALUE="'.$newYear.'"/>');
	      ?>
	      <INPUT TYPE="submit" VALUE="Next Month" STYLE="HEIGHT:40;WIDTH:150;"/>
	    </FORM>
	  </DIV>
	  <h1 align="center">Monthly Schedule</h1>
	  <?php 
			    echo('<h2 align="center">'.date("F Y",mktime(1,1,1,$_GET['Month'],1,$_GET['Year'])).'</h2>');
			    echo('<h3 align="center">'.ucfirst($thisMonth->get_status()).'</h3>');
	  ?>
	  <div style="clear:both; font-size:1px;"></div>
	</DIV>
	<FORM ID="MonthlySchedule" ACTION="writeMonthlySched.php" METHOD="post" ONSUBMIT="">
	  <?php
			      echo('<INPUT TYPE="hidden" NAME="Month" VALUE="'.$_GET['Month'].'"/>');
			      echo('<INPUT TYPE="hidden" NAME="Year" VALUE="'.$_GET['Year'].'"/>');
	  ?>
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
	      <?php
				$weekCount=1;
				while($dayCount<=$thisMonth->get_no_days()){
				  echo('<tr STYLE="HEIGHT:100;">');
				  for($i=0;$i<=6;++$i){
				    echo('<td valign="top">');
				    if($dayCount>$thisMonth->get_no_days())
				      continue;
				    else if($weekCount==1 and $thisMonth->get_first_day()>$i)
				      continue;
				    else{
				      echo('<h4>'.$dayCount.'</h4>');
				      $shiftID=$_GET['Year'].'-'.$_GET['Month'].'-'.date("d",mktime(0,0,0,$_GET['Month'],$dayCount,$_GET['Year']));
				      echo('<SELECT NAME="'.$shiftID.'" TITLE="Select a volunteer for this shift.">');
				      echo('<OPTION VALUE = "">Select Volunteer...</OPTION>');
				      $checkMaster=retrieve_dbScheduleEntry(date("D",mktime(0,0,0,$_GET['Month'],$dayCount,$_GET['Year'])).":".$weekCount);
				      $checkMonth=retrieve_dbShifts($shiftID);
				      foreach($volList as $row){
					if($checkMonth and $checkMonth->get_volunteer_id() == $row->get_id()){
					  echo('<OPTION SELECTED VALUE ="');
					  echo($row->get_id());
					  echo('">');}
					else if($checkMaster and $checkMaster->get_volunteer_id() == $row->get_id()){
					  echo('<OPTION SELECTED VALUE ="');
					  echo($row->get_id());
					  echo('">');}
					else
					  echo "<OPTION VALUE='",$row->get_id(),"'>";
					echo($row->get_first_name()." ".$row->get_last_name());
					echo("</OPTION>");}
				      echo'</SELECT><br/>';
				      if($checkMonth){
					echo 'Notes:';
					echo '<textarea name="notes:'.$shiftID.'">'.$checkMonth->get_notes().'</textarea>';}
				      else{
					echo 'Notes:';
					echo '<textarea name="notes:'.$shiftID.'"></textarea>';
				      }
				    }
				    echo'</td>';
				    ++$dayCount;}
				  echo('</tr>');
	      $weekCount+=1;}?>
	    </table>
	  </DIV>
	  <br/>
	  <DIV ALIGN="center">
	    Change Status:
	    <SELECT NAME="STATUS">
	      <?php
				  if($thisMonth->get_status() == "working"){
				    echo('<OPTION SELECTED VALUE="working">Working</OPTION>');
				    echo('<OPTION VALUE="published">Published</OPTION>');
				  }
				  else{
				    echo('<OPTION  VALUE="working">Working</OPTION>');
				    echo('<OPTION SELECTED VALUE="published">Published</OPTION>');
				  }
	      ?>

	    </SELECT>
	    <INPUT STYLE="WIDTH:auto; HEIGHT:auto;" TYPE="submit" VALUE="Save" align="center"/>
	  </DIV>
	</FORM>
	<br/>
	<DIV ALIGN="center">
	  <INPUT STYLE="height:30px; WIDTH:auto;" TYPE="button" VALUE="Discard changes" ONCLICK="confirm_discard()"/>
	</DIV>
	</DIV>
	<?PHP include('footer.inc');?>
</DIV>
</BODY>
</HTML>