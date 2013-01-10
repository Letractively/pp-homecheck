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
      </link>
    </link>
  </HEAD>     
  <BODY> 
    <DIV id="container">
      <?php include('header.php');?>
      <DIV id="content">
	<?php
	    include_once('database/dbScheduleEntry.php');
	    include_once('domain/ScheduleEntry.php');
	    include_once('domain/Volunteer.php');
	    include_once('database/dbVolunteers.php');
	    $volList=getall_dbVolunteers();
	    $days = array("Sun"=>"Sunday", "Mon"=>"Monday", "Tue"=>"Tuesday", "Wed"=>"Wednesday", 
	    				"Thu"=>"Thursday", "Fri"=>"Friday", "Sat"=>"Saturday");
	    $weeks = array(1 => "1st", 2 => "2nd", 3 => "3rd", 4 => "4th", 5 => "5th", )
	?>
      <h2 align="center">Master Schedule</h2>
      <FORM ID="MasterSchedule" ACTION = "writeMasterSched.php" METHOD="post" ONSUBMIT="return checkRequired(this);">
	
	  <table border="2" align="left" width=100%>
	    <?php
	    echo '<tr><td align="center">  Week  </td>';
	    foreach ($days as $dayid =>$dayname) 
	    	echo '<td align="center">'.$dayname.'</td>';
	    echo '</tr>';
	    foreach ($weeks as $tablerow => $weekname) { 	
	      echo '<tr STYLE="HEIGHT:50;"><td align="center">'.$weekname.'</td>';
	      foreach ($days as $dayid =>$dayname) {
	    		echo '<td valign="center">';
	    		echo '<SELECT NAME="'.$dayid.':'.$tablerow. '" TITLE="Select a volunteer for this shift.">';
	    		echo '<OPTION  VALUE = "">Select ...</OPTION>';
	    		foreach($volList as $row){
		      		$checkEntry=retrieve_dbScheduleEntry($dayid.':'.$tablerow);
		      		if($checkEntry && $checkEntry->get_volunteer_id() == $row->get_id())
						echo "<OPTION SELECTED VALUE = '",$row->get_id(),"'>";
		      		else
						echo "<OPTION VALUE='",$row->get_id(),"'>";
		      		echo $row->get_first_name()," ",$row->get_last_name();
		      		echo "</OPTION>";
	    		}
	    		echo '</OPTION></SELECT></td>';
	    	}
	      echo '</tr>';
	    }
	    echo '</table></DIV>';
	    ?>
	    <br/>
<DIV ALIGN="center">
  <INPUT STYLE="WIDTH:auto; HEIGHT:auto;" TYPE="submit" VALUE="Save Changes" align="center"/>
  </DIV>
  </FORM>
  <FORM ID="CreateMonthly" ACTION="editMonthlySchedule.php" METHOD="get" ONSUBMIT="return checkRequired(this);">
  <DIV ALIGN="center">
  <br>Create Monthly Schedule for: 
  <SELECT NAME="Month" >
  <?php
  	$todaysmonth = date("m");
  	$todaysyear = date("Y");
    $months = array("January","February","March","April","May","June",
    				"July","August","September","October","November","December");
    for ($i=0; $i<12; $i++) {
        if ($i+1<10)
            echo "<OPTION VALUE = 0".($i+1);
    	else echo "<OPTION VALUE = ".($i+1);
    	if ($i==$todaysmonth-1) echo " SELECTED";
    	echo ">".$months[$i]."</OPTION>";
    }
 
  	echo '</SELECT>&nbsp;&nbsp;<SELECT NAME="Year">'; 
    for ($i=$todaysyear; $i<$todaysyear+8; $i++){
    	echo "<OPTION VALUE = ".$i;
    		if ($i==$todaysyear) echo " SELECTED";
    	echo ">".$i."</OPTION>";
    }
  ?>
  </SELECT>
  <INPUT STYLE="WIDTH:auto;HEIGHT:auto;" TYPE="submit" VALUE="Go!"/>

  </FORM>
</DIV>
<?PHP include('footer.inc');?>
</DIV>
</BODY>
</HTML>