<?php
include_once('database/dbScheduleEntry.php');
include_once('domain/ScheduleEntry.php');
foreach($_POST as $schedID => $volID){
  $tempEntry = new ScheduleEntry($schedID, $volID,"");
  if(update_dbScheduleEntry($tempEntry))
    continue;
  else
    insert_dbScheduleEntry($tempEntry);
}
header("Location: ./viewMasterSched.php");?>