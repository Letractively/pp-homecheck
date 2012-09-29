 <?php
session_start();
session_cache_expire(30);
include_once('database/dbParticipants.php');
$id = $_GET["ID"];
$participant = retrieve_dbParticipants($id);
?>
<HTML>
  <head>
    <title>
      Viewing <?php echo($participant->get_first_name()." ".$participant->get_last_name()); ?>
    </title>
    <style>
      body{
      font-family:verdana, arial, sans-serif;
      font-size:12px;
      color: 	#000000;
      }
      table{
      border:0px;
      font-family:verdana, arial, sans-serif;
      font-size:12px;
      color: 	#000000;
      }
      
      /* LINK STYLES */
      A			{ color: #001460; text-decoration: none; img-decoration: none; font-weight:bold;}
      A:link		{ color: #018AFEE; text-decoration: none; img-decoration: none; }
      A:visited	{ color: #001460; text-decoration: none; img-decoration: none; }
      A:active	{ color: #BE0000;  }
      A:hover		{ color: #BE0000;  }
      
    </style>
  </head>
  <body>
    <div id="container">
      <div id="content">
	<?php
		if(!$participant){
		  //there is no participant
		  echo('<p id="error">Error: there\'s no participant with this id in the database</p>');
		  include('footer.inc');
		  echo('</div></div></body></html>');
		  die();
		}
		else {
		  $nice_phone_1 = substr($participant->get_phone1(),0,3)."-".substr($participant->get_phone1(),3,3)."-".substr($participant->get_phone1(),6,4);
		  if($participant->get_phone2() !== "")
		    $nice_phone_2 = substr($participant->get_phone2(),0,3)."-".substr($participant->get_phone2(),3,3)."-".substr($participant->get_phone2(),6,4);;
		  echo("<h3>".$participant->get_first_name()." ".$participant->get_last_name()."</h3>");			

		  echo('<fieldset><legend>Contact Information</legend>');
		  echo'<table>';
		  echo "\n";
		  echo '<tr><td><b>Address:</b></td><td>'.$participant->get_address().'</td></tr>';
		  echo '<tr><td></td><td>'.$participant->get_city().", ".$participant->get_state()."  ".$participant->get_zip().'</td></tr>';
		  echo'<tr><td><b>Primary Phone:</b></td><td>'.$nice_phone_1.'</td></tr>';
		  echo("<tr><td><b>Alt. Phone: </b></td><td>".$nice_phone_2."</td></tr>");
		  echo("<tr><td><b>Email:</b></td><td><a href=\"mailto:".$participant->get_email()."\">".$participant->get_email()."</a></td></tr>");
		  echo("</table></fieldset><br />");

		  echo("<fieldset><legend>Emergency Contacts</legend>");
		  $contacts = $participant->get_contacts();
		  $numContacts=count($contacts);
		  for($i=0; $i<$numContacts;$i++){
		    $contact=$contacts[$i];
		    $contact=explode(':',$contact);
		    $name = $contact[0];
		    $relation = $contact[1];
		    $phone = $contact[2];
		    echo"<table>\n<tr><td>",'Contact Name:</td><td>';
		    echo $name.'</td></tr><tr><td>';
		    echo 'Contact Relation:</td><td>';
		    echo $relation.'</td></tr><tr><td>';
		    echo 'Contact Phone: </td><td>';
		    echo $phone.'</td></tr></table><br/>';
		  }
		  

		  echo("</fieldset><br />");
		  echo("<fieldset><legend>Status:</legend>".ucwords($participant->get_status())."</fieldset>");
		  echo("<fieldset><legend>Notes:</legend>".$participant->get_notes()."</fieldset>");
		}
	?>
      </div>
      <?PHP include('footer.inc');?>
    </div>
  </body>
</HTML>