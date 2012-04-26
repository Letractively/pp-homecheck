<HTML>
  <HEAD>
    <TITLE>Write Monthly Notes Script</TITLE>
    <link rel="stylesheet" href="styles.css" type="text/css"></link>
    <link type="text/css" rel="stylesheet" href="data:text/css,"></link>
    <?php 
       echo('<meta http-equiv="Refresh" content="1;url=http://'.
      $_SERVER['SERVER_NAME'].'/pp-homecheck/viewMonthlySched.php?Month='.$_POST['Month'].'&Year='.$_POST['Year'].'"/>');
    ?>
  </HEAD>
  <BODY>
    <p>Saving Monthly Schedule</p>
    <?php 
      echo('<a href="http://'.$_SERVER['SERVER_NAME'].'/pp-homecheck/viewMonthlySched.php?Month='.$_POST['Month'].'&Year='.$_POST['Year'].'">Click here if you are not redirected back to the monthly schedule.</a>');
      include_once('database/dbShifts.php');
      include_once('domain/Shift.php');
      $shiftID=$_POST['shiftID'];
      $shiftVol=retrieve_dbShifts($shiftID)->get_volunteer_id();
      $tempShift = new Shift($shiftID, $shiftVol,"",$_POST['notes:'.$shiftID]);
      update_dbShifts($tempShift);
    ?>
  </BODY>
</HTML>