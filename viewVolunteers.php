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
			.floatLeft { width: 50%; float: left; }
			.floatRight {width: 50%; float: right; }
			.container { overflow: hidden; }
		</style>

		<script type = "text/javascript">
			function updateID(selector) {
			//	var id_list = document.getElementById("volunteer_list").options;
			//	var index = document.getElementById("volunteer_list").selectedIndex;
			//	var currentID = id_list.item(index);
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
				<p><strong>Volunteer List</strong><br />

				<?PHP
				include_once('database/dbVolunteers.php');
				include_once('domain/Volunteer.php');
				
				$allVolunteers = getall_dbVolunteers();
				
				if(sizeof($allVolunteers)==0) {
					echo "There are no volunteers in the database.";
				}
				else {
					echo "<select id=volunteer_list size=15 width='350' style='width: 350px' onchange='updateID(this);'></option>";
					foreach ($allVolunteers as $vol) {
						echo ('<option value="'.$vol->get_id().'">');
						echo(''.$vol->get_first_name()." ".$vol->get_last_name().'');
						echo "</option>";
						$onePerson = $vol;
					}
					echo "</select>";  
				}
	
				echo('<br><td class="searchResults"><a href="volunteerEdit.php?id=new"> &nbsp; &nbsp; &nbsp; &nbsp; Add New Volunteer</a</td>');


				if($_SESSION['access_level']==1){
					echo('<td class="searchResults"><a href="volunteerEdit.php?id='.$_SESSION['_id'].'">&nbsp; &nbsp; Edit Your Information</a></td>');
				}
				else if ($_SESSION['access_level']==2){
					echo('<td class="searchResults"><a href="volunteerEdit.php?id='.$onePerson->get_id().'" id="edit">&nbsp; &nbsp; &nbsp; &nbsp; Edit Volunteer</a></td>');
  				}
		
				echo "</div>";

				echo "<div class='floatRight'>";
				echo('<Iframe id="info" src="" width="450" height="350"></Iframe>');
				echo "</div>";	
?>
			</div>
				
			<?PHP include('footer.inc');?>
			</p>
		</div>
	</body>
</html>
