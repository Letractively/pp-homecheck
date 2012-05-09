<?PHP
	session_start();
	session_cache_expire(30);
	include_once('database/dbVolunteers.php');
    include_once('domain/Volunteer.php');
	$id = $_GET["id"];
	$volunteer = retrieve_dbVolunteers($id);
?>
<html>
	<head>
		<title>
			Viewing <?PHP echo($volunteer->get_first_name()." ".$volunteer->get_last_name()); ?>
		</title>
		<style>
			body{
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
				<?PHP
				 if(!$volunteer){
						//there is no volunteer
						echo('<p id="error">Error: there\'s no volunteer with this id in the database</p>');
						include('footer.inc');
						echo('</div></div></body></html>');
						die();
				}
				else {
					$nice_phone_1 = substr($volunteer->get_phone1(),0,3)."-".substr($volunteer->get_phone1(),3,3)."-".substr($volunteer->get_phone1(),6,4);
					if($volunteer->get_phone2() !== "")
						$nice_phone_2 = substr($volunteer->get_phone2(),0,3)."-".substr($volunteer->get_phone2(),3,3)."-".substr($volunteer->get_phone2(),6,4);;
					echo("<h3>".$volunteer->get_first_name()." ".$volunteer->get_last_name()."</h3>");						
					echo("<fieldset><legend>Scheduling Information</legend>");
					echo("<b>Status: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>".$volunteer->get_status()."<br />");
					echo("<b>Volunteer Type:  </b>".$volunteer->get_type()."<br />");
					echo("<b>Availability: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>");
					$availability = $volunteer->get_availability();
					$counting = count($availability);
					for($j = 0; $j < $counting; $j++)
					{
						$avail = $availability[$j];
						$avail = explode(':', $avail);
						$days = $avail[0];
						$weeks = $avail[1];
						echo $days.'';
						echo ', week ';
						echo $weeks.';&nbsp';
					}
					echo("<br />");
					
					/*echo("<b>Schedule: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>");
					$schedule = $volunteer->get_schedule();
					$count = count($schedule);
					for($i = 0; $i < $count; $i++)
					{	
						$shift = $schedule[$i];
						$shift = explode(':', $shift);
						$day = $shift[0];
						$week = $shift[1];
						echo $day.'';
						echo ', week ';
						echo $week.';&nbsp';
					} */
					echo("</fieldset><br />");
					
					echo('<fieldset><legend>Contact Information</legend>');
					echo("<b>Address: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b>".$volunteer->get_address()."<br />");
					echo("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$volunteer->get_city().", ".$volunteer->get_state()."  ".$volunteer->get_zip()."<br />");
					echo("<b>Primary Phone: &nbsp; </b>".$nice_phone_1."<br />");
					echo("<b>Alternate Phone: </b>".$nice_phone_2."<br />");
					echo("<b>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </b><a href=\"mailto:".$volunteer->get_email()."\">".$volunteer->get_email()."</a><br />");
					echo("</table></fieldset><br />");

					//echo("<fieldset><legend>Emergency Contacts</legend>");

					//echo("</fieldset><br />");

					echo("<fieldset><legend>Notes:</legend>".$volunteer->get_notes()."</fieldset>");
						}
				?>
			</div>
		</div>
	</body>
</html>
