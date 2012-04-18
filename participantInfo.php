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
      var _counter=0;
      function addContactSlot(){
	  _counter++;
	  var oClone = document.getElementById("emergContact").cloneNode(true);
	  oClone.id += (_counter + "");
	  var children=oClone.getElementsByTagName('input');
	  children[0].name+=(_counter+'');
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
	  if($id != "new" and $_SESSION['access_level']>=1)
	    $participant = retrieve_dbParticipants($id);
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
		echo $participant->get_first_name();
		if($_SESSION['access-level']==1)
		  echo 'readonly';
		echo '"/>';
		echo '  Last Name: <input type="text" name="last_name" value="';
		echo $participant->get_last_name();
		if($_SESSION['access-level']==1)
		  echo 'readonly';
		echo '"/> <br/><br/>';
		echo ' Birthday:<input type="text" name="birthday" value"';
		echo $participant->get_birthday();
		if($_SESSION['access-level']==1)
		  echo 'readonly';
		echo'/>';
	      ?>
	    </fieldset>
	    <fieldset>
	      <legend>Contact Information</legend>
	      Address: <input type="text" name="address"/><br/><br/>
	      City: <input type="text" name="city"/><br/><br/>
	      State:
	      <?php
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
		  ?>		
,  Zip:<input type="text" name="zip"/><br/><br/>
	      Phone1: <input type="text" name="phone1"/> <br/> Phone2: <input type="text" name="phone2"/><br/><br/>
	      Email:    <input type="text" name="email"/>
	    </fieldset>
	    <fieldset>
	      <legend>Emergency Contacts</legend>
	      <DIV id="placeholder">
		<DIV id="emergContact">
		  Contact Name: <input type="text" name="contactName"/><br/>
		  Contact Relation: <input type="text" name="contactRel"/><br/>
		  Contact Phone: <input type="text" name="contactPhone"/><br/>	<br/>	
		</DIV>
	      </DIV>
	      <input type="button" ONCLICK="addContactSlot();" value="Add Slot"/>
	    </fieldset>
	    <fieldset>
	      <legend>System Information</legend>
	      Start Date: <input type="text" name="start_date"/>  End Date: <input type="text" name="end_date"/> <br/>
	      Status: <input type="text" name="status"/> <br/>
	      Notes:<br/><textarea name="notes" cols="50" rows="7"></textarea>
	    </fieldset>
	    <br/>
	    <input type="submit" value="Submit" STYLE="WIDHT:50; HEIGHT:30;"/>
	  </FORM>
	</DIV>
	<?php include('footer.inc');?>
      </DIV>
    </DIV>
  </BODY>
</HTML>