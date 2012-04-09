<?PHP
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/
/*
 * volunteer_list.php 
 * @author Nicole Erkis
 * @version April 3, 2012
 */

	session_start();
	session_cache_expire(30);
?>

<html>
	<head>
		<title>Volunteers</title>
		<link rel="stylesheet" href="styles.css" type="text/css"/>
	</head>
	<body>
		<div id="container">
			<?PHP include('header.php');?>
			<div id="content">
				<p><strong>Volunteer List</strong><br />

				<?PHP
				include_once('database/dbVolunteers.php');
				include_once('domain/Volunteer.php');
				
				$allVolunteers = getall_dbVolunteers();
				
				if(sizeof($allVolunteers)==0) {
					echo "There are no volunteers in the database.";
				}
				else {
					echo "<select name=volunteer_list size=15 width='350' style='width: 350px' value=' '></option>";
					foreach ($allVolunteers as $vol) {
						echo "<option>";
						echo(''.$vol->get_first_name()." ".$vol->get_last_name().'');
						echo "</option>";
					}
					echo "</select>";  
				}
				?>
			<?PHP include('footer.inc');?>
			</p>
			</div>
		</div>
	</body>
</html>