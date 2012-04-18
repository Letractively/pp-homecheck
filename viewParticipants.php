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
    <TITLE>Participant List</TITLE>   
    <link rel="stylesheet" href="styles.css" type="text/css"/>
    <link type="text/css" rel="stylesheet" href="data:text/css,"/>
    <SCRIPT type="text/javascript">
      function populateInfo(name, phone1, phone2, email, status, notes,contacts){
      writeString="Name:".concat(name,"\nPhone1:",phone1,"\nPhone2:",phone2,"\nEmail:",email,"\nStatus:",status,"\nNotes:",notes,"\n\nContacts:\n",contacts);
      document.getElementById('infoArea').value=writeString;
      document.getElementById('infoArea').readOnly=true;
      } 
    </SCRIPT>
  </HEAD>
  <BODY>
    <DIV id="container">
      <?php include('header.php');?>
      <DIV id="content">
	<?php
	  include_once('database/dbParticipants.php'); ?>
      <DIV>
	<DIV STYLE="float:left;">
	  <h1>Participant List</h1>
	  <ul>
	  <?php
	    $partList=getall_participants();
	    foreach($partList as $participant){
	      echo'<li>';
	      echo '<a href="participantInfo.php?ID='.$participant->get_id().'" ONMOUSEOVER="populateInfo('."'";
	      echo $participant->get_first_name()." ".$participant->get_last_name()."','";
	      echo $participant->get_phone1()."','";
	      echo $participant->get_phone2()."','";
	      echo $participant->get_email()."','";
	      echo $participant->get_status()."','";
	      echo $participant->get_notes()."','";
	      echo implode("\\n",$participant->get_contacts())."'";
	      echo ')">';
	      echo $participant->get_first_name();
	      echo ' ';
	      echo $participant->get_last_name();
	      echo '</a>';
	      echo '</li>';
	    }
	  ?>
	  </ul>
	</DIV>
	<DIV STYLE="float:left;">
	  <h1>Participant Info</h1>
	  <textarea id="infoArea" cols="40" rows="20"></textarea>
	</DIV>
	<div style="clear:both;"></div>
      </DIV>
      <?php
	      if($_SESSION['access_level']==2){
		echo '<FORM METHOD="get" ACTION="participantInfo.php" ONSUBMIT="">';
		echo '<input type="hidden" name="ID" value="new"/>';
		echo '<input type="submit" STYLE="HEIGHT:40; WIDTH:140;" value="Add New Participant" align="center" />';
      echo '</FORM>';?>
      <?php include('footer.inc');?>
      </DIV>
    </DIV>
  </BODY>
</HTML>
