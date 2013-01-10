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
	  $thisMonth = $_GET['Month'];
	  $thisMonth=retrieve_dbMonths($_GET['Year'].'-'.$thisMonth);
	  if ($_SESSION['access_level']==2) {
	    if(!$thisMonth) {  // create a new month with empty shifts
	      $thisMonth = new Month($_GET['Year'].'-'.$thisMonth,"working","");
	      insert_dbMonths($thisMonth);
	      $shiftList = $thisMonth->get_shift_ids();
          foreach($shiftList as $shiftID){
            $tempShift = new Shift($shiftID, $_POST[$shiftID],"",$_POST['notes:'.$shiftID]);
            if(update_dbShifts($tempShift))
              continue;
            else
              insert_dbShifts($tempShift);
          }
	    }
	  }
	  else if (!$thisMonth || $thisMonth->get_status()!="published") {
	    echo "<br>This month is not available for viewiing."; 
	    die();
	  }
	  $dayCount = 1;
	?>
	<DIV>
	  <DIV STYLE="float:left;">
	    <FORM ID="MonthBack" ACTION="editMonthlySchedule.php" METHOD="get">
	      <?php
		if($_GET['Month'] == '01' ){
		  $newMonth = '12';
		  $newYear = $_GET['Year']-1;}
		else{
		    if($_GET['Month']<11)
		        $newMonth = '0'.($_GET['Month']-1);
		    else $newMonth = $_GET['Month']-1;
		    $newYear = $_GET['Year'];}
		echo('<INPUT TYPE="hidden" NAME="Month" VALUE="'.$newMonth.'"/>');
		echo('<INPUT TYPE="hidden" NAME="Year" VALUE="'.$newYear.'"/>');
	      ?>
	      <INPUT TYPE="submit" VALUE="Previous Month"/>
	    </FORM>
	  </DIV>
	  <DIV STYLE="float:right;">
	    <FORM ID="MonthForward" ACTION="editMonthlySchedule.php" METHOD="get">
	      <?php
		  if($_GET['Month'] == '12'){
			$newMonth = '01';
			$newYear = $_GET['Year']+1;}
			else{
			  if($_GET['Month']<9)
		        $newMonth = '0'.($_GET['Month']+1);
		      else $newMonth = $_GET['Month']+1;
			  $newYear = $_GET['Year'];}
			echo('<INPUT TYPE="hidden" NAME="Month" VALUE="'.$newMonth.'"/>');
			echo('<INPUT TYPE="hidden" NAME="Year" VALUE="'.$newYear.'"/>');
	      ?>
	      <INPUT TYPE="submit" VALUE="Next Month"/>
	    </FORM>
	  </DIV>
	  <?php 
			    echo('<h2 align="center">'.date("F Y",mktime(1,1,1,$_GET['Month'],1,$_GET['Year'])).' Monthly Schedule</h2>');
	  ?>
	  <div style="clear:both; font-size:1px;"></div>
	</DIV>
	    <FORM ID="MonthlySchedule" ACTION="writeMonthlySched.php" METHOD="post" ONSUBMIT="">
	<?php if ($_SESSION['access_level']==2) {
	    echo '<DIV ALIGN="center">Change Status: <SELECT NAME="STATUS">';
	    if($thisMonth->get_status() == "working"){
				    echo('<OPTION SELECTED VALUE="working">Working</OPTION>');
				    echo('<OPTION VALUE="published">Published</OPTION>');
	    }
		else{
				    echo('<OPTION  VALUE="working">Working</OPTION>');
				    echo('<OPTION SELECTED VALUE="published">Published</OPTION>');
		}
	    echo '</SELECT>&nbsp;&nbsp;
	        <INPUT STYLE="WIDTH:auto; HEIGHT:auto;" TYPE="submit" VALUE="Save All Changes" align="center"/>
	        </DIV><br/>';
	}	  
	    echo('<INPUT TYPE="hidden" NAME="Month" VALUE="'.$_GET['Month'].'"/>');
		echo('<INPUT TYPE="hidden" NAME="Year" VALUE="'.$_GET['Year'].'"/>');
	  ?>
	  <table border="2" align="center">
	      <tr>
		<td align="center">  Sunday  </td>
		<td align="center">  Monday  </td>
		<td align="center">  Tuesday  </td>
		<td align="center">  Wednesday  </td>
		<td align="center">  Thursday  </td>
		<td align="center">  Friday  </td>
		<td align="center">  Saturday  </td>
	      </tr>
	      <?php
				$dayCount=1;
				$weekCount=1;
				while($dayCount<=$thisMonth->get_no_days()){
				  echo('<tr STYLE="HEIGHT:100;">');
				  for($i=0;$i<=6;++$i){
				    echo('<td valign="top">');
				    if($dayCount>$thisMonth->get_no_days())
				      continue;
				    else if($weekCount==1 && $thisMonth->get_first_day()>$i)
				      continue;
				    else{
				      echo('<h4>'.$dayCount.'</h4>');
				      $shiftID=$_GET['Year'].'-'.$_GET['Month'].'-'.date("d",mktime(0,0,0,$_GET['Month'],$dayCount,$_GET['Year']));
				      $checkMaster=retrieve_dbScheduleEntry(date("D",mktime(0,0,0,$_GET['Month'],$dayCount,$_GET['Year'])).":".$weekCount);
				      $checkMonth=retrieve_dbShifts($shiftID);
				    if ($_SESSION['access_level']==2) {
				      echo('<SELECT NAME="'.$shiftID.'" TITLE="Select a volunteer for this shift.">');
				      echo('<OPTION VALUE = "">VACANT</OPTION>');
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
				    }
				    else { 
				        $person = retrieve_dbVolunteers($checkMonth->get_volunteer_id());
				        if ($person)
				            echo $person->get_first_name().' '.$person->get_last_name().'<br>'; 
				        else echo 'VACANT<br>';
				    }
					echo '';
					if ($_SESSION['access_level']==2) 
					    echo 'Notes:<br><textarea cols="14" name="notes:'.$shiftID.'">'.$checkMonth->get_notes().'</textarea>';
				    else if ($checkMonth->get_notes()!="") 
				        echo 'Notes:<br>'.$checkMonth->get_notes();
				    }
				    echo'</td>';
				    ++$dayCount;}
				  echo('</tr>');
	      $weekCount+=1;}?>
	    </table>
	  <br/>
	  
	</FORM>
	
	</DIV>
	<?PHP include('footer.inc');?>
</DIV>
</BODY>
</HTML>