<HTML>
  <HEAD>
    <TITLE>Write Master Script</TITLE>
    <link rel="stylesheet" href="styles.css" type="text/css"></link>
      <link type="text/css" rel="stylesheet" href="data:text/css,"></link>
    <?php 
      echo('<meta http-equiv="Refresh" content="1;url=http://'.$_SERVER['SERVER_NAME'].'/pp-homecheck/viewMasterSched.php" />');
    ?>
  </HEAD>
  <BODY>
    <p>Saving Master Schedule</p>
    <?php echo('<a href="http://'.$_SERVER['SERVER_NAME'].'/pp-homecheck/viewMasterSched.php">Click here if you are not redirected back to the master schedule.</a>');
      include_once('database/dbScheduleEntry.php');
      include_once('domain/ScheduleEntry.php');
      foreach($_POST as $schedID => $volID){
	$tempEntry = new ScheduleEntry($schedID, $volID,"");
	if(update_dbScheduleEntry($tempEntry))
	  continue;
	else
	  insert_dbScheduleEntry($tempEntry);
   }?>
  </BODY>
</HTML>