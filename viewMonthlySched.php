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
    <TITLE>Monthly Schedule</TITLE>   
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
	  include_once('database/dbMonths.php');
	  include_once('database/dbVolunteers.php');
	  $thisMonth=retrieve_dbMonths($_GET['Year'].'-'.$_GET['Month']);
	  $dayCount = 1;
	?>
	<?php
	  echo '<h1 STYLE="text-align:center;">Monthly Schedule for '.date("F Y",mktime(1,1,1,$_GET['Month'],1,$_GET['Year'])).'</h1>';
	  ?>
	<DIV>
	  <table border="2" STYLE="margin-left:auto; margin-right:auto;">
	    <tr>
	      <th width="175" align="center">  Sunday  </th>
	      <th width="175" align="center">  Monday  </th>
	      <th width="175" align="center">  Tuesday  </th>
	      <th width="175" align="center">Wednesday</th>
	      <th width="175" align="center">  Thursday  </th>
	      <th width="175" align="center">  Friday  </th>
	      <th width="175" align="center">  Saturday  </th>
	    </tr>
	    <?php
	      $weekCount=1;
	      while($dayCount<=$thisMonth->get_no_days()){
	  	echo('<tr STYLE="HEIGHT:200;">');
	   	for($i=0;$i<=6;++$i){
	   	  echo('<td valign="top">');
	  	  if($dayCount>$thisMonth->get_no_days())
	  	    continue;
	  	  else if($weekCount==1 and $thisMonth->get_first_day()>$i)
	  	    continue;
	  	  else{
	  	    echo('<h4>'.$dayCount.'</h4>');
		    $shiftID=$_GET['Year'].'-'.$_GET['Month'].'-'.date("d",mktime(0,0,0,$_GET['Month'],$dayCount,$_GET['Year']));
		    $checkMonth=retrieve_dbShifts($shiftID);
		    echo 'Volunteer:';
		    if($checkMonth){
		      $shiftVol = retrieve_dbVolunteers($checkMonth->get_volunteer_id());
		      if ($shiftVol){
			if($shiftVol->get_id() == $_SESSION['_id'])
			  echo('<font STYLE="background-color:red; color:white;"> '.$shiftVol->get_first_name()." ".$shiftVol->get_last_name().' </font><br/>');
			else
			  echo($shiftVol->get_first_name()." ".$shiftVol->get_last_name().'<br/>');
		      }
		      else
			echo '<br/>';
		      echo '<FORM NAME="notes" ACTION="writeSchedNotes.php" METHOD="post">';
		      echo 'Notes:';
		      echo '<textarea name="notes:'.$shiftID.'">'.$checkMonth->get_notes().'</textarea>';
		      echo('<INPUT TYPE="hidden" NAME="Month" VALUE="'.$_GET['Month'].'"/>');
		      echo('<INPUT TYPE="hidden" NAME="Year" VALUE="'.$_GET['Year'].'"/>');
		      echo('<INPUT TYPE="hidden" NAME="shiftID" VALUE="'.$shiftID.'"/>');
		      echo '<input type="submit" value="Update" />';
		      echo '</FORM>';
		    }
		    else{
		      echo '<br/>';
		      echo '<FORM NAME="notes" ACTION="writeSchedNotes.php" METHOD="post">';
		      echo 'Notes:';
		      echo '<textarea name="notes:'.$shiftID.'"></textarea>';
		      echo('<INPUT TYPE="hidden" NAME="Month" VALUE="'.$_GET['Month'].'"/>');
		      echo('<INPUT TYPE="hidden" NAME="Year" VALUE="'.$_GET['Year'].'"/>');
		      echo('<INPUT TYPE="hidden" NAME="shiftID" VALUE="'.$shiftID.'"/>');
		      echo '<input type="submit" value="Update" />';
		      echo '</FORM>';}
		  }
		  echo'</td>';
		  ++$dayCount;}
	   	echo('</tr>'); 
	    $weekCount+=1; }?>
	  </table>
	</DIV>
	</DIV>
	<?PHP include('footer.inc');?>
    </DIV>
  </BODY>
</HTML>