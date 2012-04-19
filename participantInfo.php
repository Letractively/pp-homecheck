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
$states = array("AL","AK","AZ","AR","CA","CO","CT","DE","DC","FL","GA","HI","ID","IL","IN","IA",
		"KS","KY","LA","ME","MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM",
		"NY","NC","ND","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA",
		"WV","WI","WY");
?>
<HTML>
  <HEAD>
    <TITLE>Participant Info</TITLE>   
    <link rel="stylesheet" href="styles.css" type="text/css"/>
    <link type="text/css" rel="stylesheet" href="data:text/css,"/>
    <SCRIPT type="text/javascript">
      var _counter=1;
      function addContactSlot(){
	  _counter++;
	  document.getElementById("numContacts").value+=1;
	  var oClone = document.getElementById("emergContact").cloneNode(true);
	  oClone.id += (_counter + "");
	  var children=oClone.getElementsByTagName('input');
	  children[0].name=children[0].name.substring(0,children[0].name.length-1)+(_counter+'');
	  children[1].name+=(_counter+'');
	  children[2].name+=(_counter+'');
	  document.getElementById("placeholder").appendChild(oClone);
      }
    </SCRIPT>
  </HEAD>
  <BODY>
    <DIV id="container">
      <?php include('header.php');?>
      <DIV id="content">
	<?php
	  include_once('database/dbParticipants.php');
	  $id=$_GET['ID'];
	  if($id != "new" and $_SESSION['access_level']>=1){
	    $participant = retrieve_dbParticipants($id);}
	  else{
	    if($_SESSION['access_level']==2){
	      $participant = new Participant('', '', '', '', '', '', '', '', '','', '', '','', '','','', '','', '', '', '', '','','','','');
	    }
	    else{
	      echo'<p><s>Incorrect access level</s></p>';
	      echo'</DIV></DIV></BODY></HTML>';
	    }
	  }
	?>
	<DIV>
	  <FORM name="ParticipantInfo" METHOD="post" ACTION="writeParticipant.php" ONSUBMIT="">
	    <fieldset>
	      <legend>Personal Information</legend>
	      <?php
		echo 'First Name: <input type="text" name="first_name" value="';
		echo $participant->get_first_name().'"';
		if($_SESSION['access_level']==1){
		  echo 'readonly';}
		  echo '/>';
		  echo '  Last Name: <input type="text" name="last_name" value="';
		  echo $participant->get_last_name().'"';
		  if($_SESSION['access_level']==1){
		    echo 'readonly';}
		    echo '/> <br/><br/>';
		    echo ' Birthday:<input type="text" name="birthday" value"';
		    echo $participant->get_birthday().'"';
		    if($_SESSION['access_level']==1){
		      echo 'readonly';}
		      echo'/>';
	      ?>
	    </fieldset>
	    <fieldset>
	      <legend>Contact Information</legend>
	      <?php
		echo 'Address: <input type="text" name="address" value="';
		echo $participant->get_address().'"';
		if($_SESSION['access_level']==1)
		  echo 'readonly';
		  echo '/><br/><br/>';
		  echo 'City: <input type="text" name="city" value="';
		  echo $participant->get_city().'"';
		  if($_SESSION['access_level']==1)
		    echo 'readonly';
		    echo '/><br/><br/>';
		    echo 'State:';
		    if($_SESSION['access_level']==2){
		      echo '<select name="state">';
		      foreach ($states as $st) {
			echo "<option value='".$st."' ";
			if ($id=='new' and $st =="ME")
			  echo("SELECTED");
			else if($participant and $participant->get_state() == $st )
			  echo("SELECTED");
			echo ">" . $st . "</option>";
		      }
		      echo '</select>';}
		    else{
		      echo $participant->get_state();
		      echo '<input type="hidden" value="'.$participant->get_state().'">';
		    }		
		    echo ',  Zip:<input type="text" name="zip" value="';
		    echo $participant->get_zip().'"';
		    if($_SESSION['access_level']==1)
		      echo 'readonly';
		      echo '/><br/><br/>';
		      echo 'Phone1: <input type="text" name="phone1" value="';
		      echo $participant->get_phone1().'"';
		      if($_SESSION['access_level']==1)
			echo 'readonly';
			echo'/> <br/>'; 
			echo 'Phone2: <input type="text" name="phone2" value="';
			echo $participant->get_phone2().'"';
			if($_SESSION['access_level']==1)
			  echo 'readonly';
			  echo '/><br/><br/>';
			  echo 'Email:    <input type="text" name="email" value="';
			  echo $participant->get_email().'"';
			  if($_SESSION['access_level']==1)
			    echo 'readonly';
			    echo'/>';
	      ?>
	    </fieldset>
	    <fieldset>
	      <legend>Emergency Contacts</legend>
	      <?php
		if($id=='new'){
		  echo '<input type="hidden" value="1" name="numContacts" id="numContacts" />';
		  echo '<DIV id="placeholder">';
		  echo'<DIV id="emergContact">';
		  echo 'Contact Name: <input type="text" name="contactName1"/><br/>';
		  echo 'Contact Relation: <input type="text" name="contactRel1"/><br/>';
		  echo 'Contact Phone: <input type="text" name="contactPhone1"/><br/><br/>';	
		  echo '</DIV>';
		  echo'</DIV>';
		  if($_SESSION['access_level']==2){
		    echo '<input type="button" ONCLICK="addContactSlot();" value="Add Slot"/>';}
		}
		else{
		  $numContacts=count($participant->get_contacts());
		  echo '<input type="hidden" value="'.$numContacts.'" name="numContacts" id="numContacts" />';
		  $contacts = $participant->get_contacts();
		  for($i=1; $i<=$numContacts;$i++){
		    $contact=$contacts[$i-1];
		    $contact=explode(':',$contact);
		    $name = $contact[0];
		    $relation = $contact[1];
		    $phone = $contact[2];
		    echo'Contact Name: <input type="text" name="contactName'.$i.'" value="';
		    echo $name.'"';
		    if($_SESSION['access_level']==1)
		      echo 'readonly';
		    echo'/><br/>';
		    echo 'Contact Relation: <input type="text" name="contactRel'.$i.'" value="';
		    echo $relation.'"';
		    if($_SESSION['access_level']==1)
		      echo 'readonly';
		    echo'/><br/>';
		    echo 'Contact Phone: <input type="text" name="contactPhone'.$i.'" value="';
		    echo $phone.'"';
		    if($_SESSION['access_level']==1)
		      echo 'readonly';
		    echo '/><br/><br/>';}
		  if($_SESSION['access_level']==2){
		    echo '<DIV id="placeholder">';
		    echo'<DIV id="emergContact">';
		    echo 'Contact Name: <input type="text" name="contactName'.$i.'"/><br/>';
		    echo 'Contact Relation: <input type="text" name="contactRel'.$i.'"/><br/>';
		    echo 'Contact Phone: <input type="text" name="contactPhone'.$i.'"/><br/><br/>';
		    echo '</DIV>';
		    echo'</DIV>';
		    echo '<input type="button" ONCLICK="addContactSlot();" value="Add Slot"/>';
		  }
		}
	      ?>
	    </fieldset>
	    <fieldset>
	      <legend>System Information</legend>
	      <?php
			 echo' Start Date: <input type="text" name="start_date" value="';
			 echo $participant->get_start_date().'"';
			 if($_SESSION['access_level']==1)
			   echo 'readonly';
			 echo'/>';
			 echo' End Date: <input type="text" name="end_date" value="';
			 echo $participant->get_end_date().'"';
			 echo'/><br/><br/>';
			 echo' Status: <input type="text" name="status" value="';
			 echo $participant->get_status().'"';
			 echo'/><br/>';
			 echo 'Notes:<br/><textarea name="notes" cols="50" rows="7">';
			 echo $participant->get_notes();
			 echo'</textarea>';
	      ?>
	    </fieldset>
	    <br/>
	    <input type="submit" value="Submit" STYLE="WIDTH:60; HEIGHT:30;"/>
	  </FORM>
	  <?php 
			   if($_SESSION['access_level']==2 and $id!='new'){
			     $deleteString='\'This will delete the current Participant record.  Are you sure you want to conitune?\'';
			     echo '<FORM name="DeleteCheck" METHOD="post" ACTION="deleteParticipant.php" ONSUBMIT="return confirm('.$deleteString.')">';
			     echo '<input type="hidden" name="partID" value="'.$participant->get_id().'"/>';
			     echo '<input type="submit" value="Delete" STYLE="WIDTH:60; HEIGHT:30;"/>';
			     echo '</FORM>';
			   }

	  ?>
	</DIV>
	<?php include('footer.inc');?>
      </DIV>
    </DIV>
  </BODY>
</HTML>
