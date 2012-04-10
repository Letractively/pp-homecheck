<HTML>
  <HEAD>
    <TITLE>Write Monthly Script</TITLE>
    <link rel="stylesheet" href="styles.css" type="text/css"></link>
    <link type="text/css" rel="stylesheet" href="data:text/css,"></link>
    <?php 
       echo('<meta http-equiv="Refresh" content="5;url=http://'.
      $_SERVER['SERVER_NAME'].'/pp-homecheck/viewMonthlySched.php?Month='.$_POST['Month'].'&Year='.$_POST['Year'].'"/>');
    ?>
  </HEAD>
  <BODY>
    <p>Saving Monthly Schedule</p>
    <?php 
      echo('<a href="http://'.$_SERVER['SERVER_NAME'].'/pp-homecheck/viewMonthlySched.php?Month='.$_POST['Month'].'&Year='.$_POST['Year'].'">Click here if you are not redirected back to the monthly schedule.</a>');
      include_once('database/dbShifts.php');
      include_once('domain/Shift.php');
      include_once('domain/Month.php');
      include_once('database/dbMonths.php');
      $tempMonth = new Month($_POST['Year'].'-'.$_POST['Month'],$_POST['STATUS'],"");
      $shiftList = $tempMonth->get_shift_ids();
      foreach($shiftList as $shiftID){
	$tempShift = new Shift($shiftID, $_POST[$shiftID],"","");
	if(update_dbShifts($tempShift))
	  continue;
	else
	    insert_dbShifts($tempShift);
      }
      if(update_dbMonths($tempMonth));
      else(insert_dbMonths($tempMonth));
    ?>
  </BODY>
</HTML>