<?PHP
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/
/*
 * viewVolunteers.php 
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
		<style>
			.floatLeft { width: 25%; float: left; }
			.floatRight {width: 75%; float: right; }
			.container { overflow: hidden; }
		</style>

		<script type = "text/javascript">
			function updateID(selector) {
				var currentID = selector.options[selector.selectedIndex].value;
				var info_url = "volunteer_info.php?id=";
				info_url = info_url.concat(currentID);
				document.getElementById('info').src = info_url;

				var currentID2 = selector.options[selector.selectedIndex].value;
				var edit_url = "volunteerEdit.php?id=";
				edit_url = edit_url.concat(currentID2);
				document.getElementById('edit').href = edit_url;
			}
		</script>
		
	</head>
	<body>
		<div id="container">
			<?PHP include('header.php');?>
			<div id="content">
			<div class="floatLeft">
				<br><b>Volunteer List</b><br>

				<?PHP
				include_once('database/dbVolunteers.php');
				include_once('domain/Volunteer.php');
				
				$allVolunteers = getall_dbVolunteers();
				
				if(sizeof($allVolunteers)==0) {
					echo "There are no volunteers in the database.";
				}
				else {
					echo "<br><select id=volunteer_list size=15 style='width:120px' onchange='updateID(this);'></option>";
					foreach ($allVolunteers as $vol) {
						echo ('<option value="'.$vol->get_id().'">');
						echo(''.$vol->get_first_name()." ".$vol->get_last_name().'');
						echo "</option>";
						$onePerson = $vol;
					}
					echo "</select>";  
				}
	
				echo('<br><br><td class="searchResults"><a href="volunteerEdit.php?id=new"> &nbsp; &nbsp; Add New Volunteer</a</td>');
				echo "</div>";

				echo "<div class='floatRight'>";
				echo('<br><Iframe id="info" src="" width="450" height="300"></Iframe>');
				if($_SESSION['access_level']==1){
					echo('<td class="searchResults"><a href="volunteerEdit.php?id='.$_SESSION['_id'].'"><br><br>&nbsp; &nbsp; Edit Your Information</a></td>');
				}
				else if ($_SESSION['access_level']==2){
					echo('<td class="searchResults"><a href="volunteerEdit.php?id='.$onePerson->get_id().'" id="edit"><br><br>&nbsp; &nbsp;  Edit Volunteer</a></td>');
  				}
				echo "</div>";	
?>
			</div>
			<?PHP include('footer.inc');?>
		</div>
	</body>
</html>
