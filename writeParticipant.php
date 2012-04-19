<?php 
include_once('database/dbParticipants.php');
$numContacts=$_POST['numContacts'];
$contacts=array();
for($i=1;$i<=$numContacts+1;$i++){
  if($_POST['contactName'.$i] != '' or $_POST['contactRel'.$i]!='' or $_POST['contactPhone'.$i] !=''){
    $contacts[]=$_POST['contactName'.$i].':'.$_POST['contactRel'.$i].':'.$_POST['contactPhone'.$i];}
}
$contacts=implode(',',$contacts);
$checkPart=retrieve_dbParticipants($_POST['first_name'].$_POST['phone1']);
if($checkPart){
  $entries=$checkPart->get_log_entries();}
else{
  $entires='';}
$newParticipant = new Participant($_POST['last_name'], $_POST['first_name'], $_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['phone1'], $_POST['phone2'], $_POST['email'], '', $contacts, '', '', '','', '', '','', $_POST['birthday'],'', $_POST['start_date'], $_POST['end_date'], $_POST['status'], $entries, $_POST['notes']);
if(update_dbParticipants($newParticipant));
else insert_dbParticipants($newParticipant);
header("Location: ./viewParticipants.php");
?>