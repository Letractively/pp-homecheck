<?php 
include_once('database/dbShifts.php');
include_once('domain/Shift.php');
include_once('domain/Month.php');
include_once('database/dbMonths.php');
$tempMonth = new Month($_POST['Year'].'-'.$_POST['Month'],$_POST['STATUS'],"");
$shiftList = $tempMonth->get_shift_ids();
foreach($shiftList as $shiftID){
  $tempShift = new Shift($shiftID, $_POST[$shiftID],"",$_POST['notes:'.$shiftID]);
  if(update_dbShifts($tempShift))
    continue;
  else
    insert_dbShifts($tempShift);
}
if(update_dbMonths($tempMonth));
else(insert_dbMonths($tempMonth));
header("Location: ./editMonthlySchedule.php?Month=".$_POST['Month']."&Year=".$_POST['Year']);
?>