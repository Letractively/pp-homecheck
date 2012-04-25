<?php 
include_once('database/dbParticipants.php');
delete_dbParticipants($_POST['partID']);
header("Location: ./viewParticipants.php");
?>