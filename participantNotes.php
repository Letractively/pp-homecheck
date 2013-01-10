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
include_once('database/dbParticipants.php');
include_once('database/dbParticipantEntry.php');
$partID = $_GET['id'];
$participant = retrieve_dbParticipants($partID);
$lastDay=mktime(0,0,0,substr($_GET['date'],3,2),substr($_GET['date'],-2),substr($_GET['date'],0,2));
$weekInc = 604800;
$dayInc =86400;
?>
<HTML>
  <HEAD>
    <TITLE>Participant Notes</TITLE>
    <link rel="stylesheet" href="styles.css" type="text/css"/>
    <link type="text/css" rel="stylesheet" href="data:text/css,"/>
  </HEAD>
  <BODY>
    <DIV id="container">
      <?php include('header.php');?>
      <DIV id="content">
	<DIV>
	  <DIV STYLE="float:left;">
	    <FORM ID="WeekBack" ACTION="participantNotes.php" METHOD="get" ONSUBMIT="">
	      <?php
		$newWeek = date('y-m-d',$lastDay-$weekInc);
		echo('<INPUT TYPE="hidden" NAME="date" VALUE="'.$newWeek.'"/>');
		echo('<INPUT TYPE="hidden" NAME="id" VALUE="'.$partID.'"/>');
	      ?>
	      <INPUT TYPE="submit" VALUE="Previous Week" STYLE="HEIGHT:40;WIDTH:150;"/>
	    </FORM>
	  </DIV>
	  <DIV STYLE="float:right;">
	    <FORM ID="WeekForward" ACTION="participantNotes.php" METHOD="get" ONSUBMIT="">
	      <?php
		  if($lastDay >= time()){
		    echo('<INPUT TYPE="hidden" NAME="date" VALUE="'.date('y-m-d',$lastDay).'"/>');
		  }
		  else{
		    $newWeek=date('y-m-d',($lastDay+$weekInc));
		    echo('<INPUT TYPE="hidden" NAME="date" VALUE="'.$newWeek.'"/>');
		  }
		  echo('<INPUT TYPE="hidden" NAME="id" VALUE="'.$partID.'"/>');
	      ?>
		    <INPUT TYPE="submit" VALUE="Next Week" STYLE="HEIGHT:40;WIDTH:150;"/>
	    </FORM>
	  </DIV>
	  <h1 align="center">Participant Notes</h1>
	  <?php 
		  echo('<h2 align="center">For '.$participant->get_first_name().' '.$participant->get_last_name().'</h2>');
		  echo('<h2 align="center">Phone: '.$participant->get_phone1().'</h2>');
		  echo('<h2 align="center">Week ending on '.date('l jS F Y',$lastDay).'</h2>');
	  ?>
	  <div style="clear:both; font-size:1px;"></div>
	</DIV>
	<DIV>
	  <table border="2" align="center">
	    <tr>
	      <th width="100" align="center"> Date </th>
	      <th width="60" align="center"> Status </th>
	      <th width="600" align="center">Notes </th>
	    </tr>
	    <?php
		  for($i=0;$i<7;$i++){
		    $entryID=date('y-m-d',($lastDay-$i*$dayInc)).$partID;
		    echo '<tr>';
		    echo '<td>';
		    echo date('D m/d/y', $lastDay-$i*$dayInc);
		    echo '</td>';
		    $entry=retrieve_dbParticipantEntry($entryID);
		    if($entry){
		      echo '<td>';
		      echo $entry->get_result();
		      echo '</td>';
		      echo '<td>';
		      echo $entry->get_note();
		      echo '</td>';
		      echo'</tr>';
		    }
		    else{
		      echo '<td>';
		      echo '</td>';
		      echo '<td>';
		      echo '</td>';
		      echo'</tr>';
		    }	      
		  }

	  ?>
	  </table>
	</DIV>
	</DIV>
	<?PHP include('footer.inc');?>
    </DIV>
  </BODY>
</HTML>
