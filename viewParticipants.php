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
      function updateID(selector){
	  var currentID = selector.options[selector.selectedIndex].value;
      	  var info_url = "participantBrief.php?ID=";
	  info_url = info_url.concat(currentID);
	  document.getElementById('info').src = info_url;
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
	<form METHOD="get" ACTION="participantInfo.php" ONSUBMIT="">
	<DIV STYLE="float:left;">
	  <h1>Participant List</h1>
	  <select size="32" id="partList" required="" name="ID" style="WIDTH:400px;" onchange="updateID(this);">
	  <?php
	    $partList=getall_participants();
	    foreach($partList as $participant){
	      echo '<option value="'.$participant->get_id().'">';
	      echo $participant->get_first_name();
	      echo ' ';
	      echo $participant->get_last_name();
	      echo '</option>';
	    }
	  ?>
	  </select>
	</DIV>
	<DIV STYLE="float:left; padding-left:15px;">
	  <h1>Participant Info 	  <input type="submit" value="View and Update Details" STYLE="HEIGHT:25; WIDTH:160;"/></h1>
	  <Iframe id="info" src="" width="450" height="445"></Iframe>
	</DIV>
	<div style="clear:both;"></div>
	</form>
      </DIV>
	  <?php
	    if($_SESSION['access_level']==2){
	      echo '<FORM METHOD="get" ACTION="participantInfo.php" ONSUBMIT="">';
	      echo '<input type="hidden" name="ID" value="new"/>';
	      echo '<input type="submit" STYLE="HEIGHT:40; WIDTH:140;" value="Add New Participant" align="center" />';
	      echo '</FORM>';
	  }?>
      <?php include('footer.inc');?>
      </DIV>
    </DIV>
  </BODY>
</HTML>
