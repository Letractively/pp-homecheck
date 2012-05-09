<?php 
include_once('database/dbShifts.php');
$shiftID=$_POST['shiftID'];
$shiftVol=retrieve_dbShifts($shiftID)->get_volunteer_id();
$tempShift = new Shift($shiftID, $shiftVol,"",$_POST['notes:'.$shiftID]);
update_dbShifts($tempShift);
header("Location: ./viewMonthlySched.php?Month=".$_POST['Month']."&Year=".$_POST['Year']);
?>