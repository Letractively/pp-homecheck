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
			/* background:#001460; */
			background:#FFFFFF;
			font-family:verdana, arial, sans-serif;
			font-size:12px;
			color: 	#000000;
			}
			p {padding-left: 15px; padding-right:15px;}
			p.notes {padding-left:20px;}
			h3 {padding-left: 20px}
			h1 {padding-left: 20px; padding-right: 20px;}

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
					echo("<table class=\"searchResults\"><tr><td colspan=\"2\" class=\"searchResults\"><h3>".$volunteer->get_first_name()." ".$volunteer->get_last_name()."</h3></td></tr>");						
			      		//echo("<p><h3>" . $volunteer->get_first_name() . " " . $volunteer->get_last_name()."</h3>");
					//echo("</p><p>");
					//echo("<table class=\"searchResults\"><tr><td colspan=\"2\" class=\"searchResults\"></td></tr>");
					echo("<tr><td class=\"searchResults\"><b>Status: </b></td><td class=\"searchResults\">".$volunteer->get_status()."</td></tr>");
					echo("<tr><td class=\"searchResults\"><b>Volunteer Type: </b></td><td class=\"searchResults\">".$volunteer->get_type()."</td></tr>");
					echo("<tr><td class=\"searchResults\"><b>Availability: </b></td><td class=\"searchResults\">");
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
					echo("</td></tr>");
					
					echo("<tr><td class=\"searchResults\"><b>Schedule: </b></td><td class=\"searchResults\">");
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
					}
					echo("</td></tr>");
					
						
					echo("</p><p>");	
					echo("<table class=\"searchResults\"><tr><td colspan=\"2\" class=\"searchResults\"><h3>Contact Information</h3></td></tr>");
					echo("<tr><td class=\"searchResults\"><b>Address: </b></td><td class=\"searchResults\">".$volunteer->get_address()."</td></tr>");
					echo("<tr><td class=\"searchResults\"></td><td class=\"searchResults\"> ".$volunteer->get_city().", ".$volunteer->get_state()."  ".$volunteer->get_zip()."</td></tr>");
					echo("<tr><td class=\"searchResults\"><b>Primary Phone: </b></td><td class=\"searchResults\">".$nice_phone_1."</td></tr>");
					echo("<tr><td class=\"searchResults\"><b>Alternate Phone: </b></td><td class=\"searchResults\">".$nice_phone_2."</td></tr>");
					echo("<tr><td class=\"searchResults\"><b>Email: </b></td><td class=\"searchResults\"><a href=\"mailto:".$volunteer->get_email()."\">".$volunteer->get_email()."</a></td></tr>");
					echo("</p><p>");
					echo("<tr><td class=\"searchResults\"><b>Notes:</b></td><td class=\"searchResults\">".$volunteer->get_notes()."</td></tr>");
						
					echo("</table></p>");
				}
				?>
			</div>
		</div>
	</body>
</html>
