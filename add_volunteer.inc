<?PHP
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/
/*
 *	volunteerForm.inc
 *  	a form for a volunteer to be added or edited in the database
 *	@author Allen Tucker
 *	@version 4/1/2012
 */

if($_SESSION['access_level']==1)
	if ($id=='new') {
	  echo('<p><strong>Volunteer Input Form</strong><br />');
	  echo('Here you can add a new volunteer to the database. </p>');
    }
    else{
		echo('<p><strong>Volunteer Information Form</strong><br />');
	    echo('Here you can edit your own information in the database.' .
	    	 '<br>When you are finished, hit <b>Submit</b> at the bottom of this page.');
	}
else if ($_SESSION['access_level']==2)
	if ($id=='new') {
	  echo('<p><strong>Volunteer Input Form</strong><br />');
	  echo('Here you can add a new volunteer to the database. </p>');
    }
    else {
	   echo('<p><strong>Volunteer Information Form</strong><br />');
	   echo('Here you can edit, delete, or change the password for a volunteer in the database.</p><p>');
    }
else {
    echo("<p id=\"error\">You do not have sufficient permissions to add a new person to the database.</p>");
	include('footer.inc');
	echo('</div></div></body></html>');
	die();
}

?>
<form method="POST">
	<input type="hidden" name="old_id" value=<?PHP echo("\"".$id."\"");?>>
	<input type="hidden" name="old_pass" value=<?PHP echo("\"".$person->get_password()."\"");?>>
	<input type="hidden" name="_form_submit" value="1">
<p>(<span style="font-size:x-small;color:FF0000">*</span> indicates required information.)

<fieldset>
<legend>Contact Information</legend>
	<table>		<tr><td>First Name<span style="font-size:x-small;color:FF0000">*</span>:</td><td><input type="text" name="first_name" tabindex=1 value="<?PHP echo($person->get_first_name())?>"></td></tr>
			<tr><td>Last Name<span style="font-size:x-small;color:FF0000">*</span>:</td><td><input type="text" name="last_name" tabindex=2 value="<?PHP echo($person->get_last_name())?>"></td></tr>

		<tr><td>Address<span style="font-size:x-small;color:FF0000">*</span>:</td><td> <input type="text" name="address" tabindex=3 value="<?PHP echo($person->get_address())?>"></td></tr>
		<tr><td>City<span style="font-size:x-small;color:FF0000">*</span>:</td><td> <input type="text" name="city" tabindex=4 value="<?PHP echo($person->get_city())?>"></td></tr>
		<tr><td>State, Zip<span style="font-size:x-small;color:FF0000">*</span>:</td>
		<td><select name="state" tabindex=5>
		<?PHP

			$states = array("AL","AK","AZ","AR","CA","CO","CT","DE","DC","FL","GA","HI","ID","IL","IN","IA",
					        "KS","KY","LA","ME","MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM",
					        "NY","NC","ND","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA",
					        "WV","WI","WY");
			foreach ($states as $st) {
				echo "<option value='" . $st . "' ";
                if($person->get_state() == $st ) echo("SELECTED");
                else if ($id == "new" && $st =="ME") echo("SELECTED");
                echo ">" . $st . "</option>";
			}
		?>
		</select>,
		<input type="text" name="zip" size="5" tabindex=6 value="<?PHP echo($person->get_zip())?>"></td></tr>
		<tr><td>Primary Phone<span style="font-size:x-small;color:FF0000">*</span>:</td><td> <input type="text" name="phone1" MAXLENGTH=12 tabindex=7 value="<?PHP echo($person->get_phone1())?>"></td></tr>
		<tr><td>Alternate Phone:</td><td><input type="text" name="phone2" MAXLENGTH=12 tabindex=8 value="<?PHP echo($person->get_phone2())?>"></td></tr>
		<tr><td>Email:</td><td><input type="text" name="email" tabindex=9 value="<?PHP echo($person->get_email())?>"></td></tr>
	   </table>
</fieldset>
<br>
<fieldset>
	<legend>Emergency Contacts</legend>
	<?PHP
		  echo '<input type="hidden" value="2" name="numContacts" id="numContacts" />';
	
		  if ($id != 'new'){
			  $contacts = $person->get_contacts(); 
			  $contact = $contacts[0];
			  $contact = explode(':', $contact);
			  $name = $contact[0];
			  $phone = $contact[1];
			  $email = $contact[2];
		  
		  echo '<table><tr><td>Contact Name:</td><td><input type="text" name="contactName1" tabindex=1 value="'.$name .'"></td></tr>';
		  echo '<tr><td>Contact Phone:</td><td><input type="text" name="contactPhone1" tabindex=2 value="'.$phone.'"></td></tr>';
		  echo '<tr><td>Contact Email:</td><td><input type="text" name="contactEmail1" tabindex=3 value="'.$email.'"></td></tr></table><br />';

		  $contact = $contacts[1];
		  $contact = explode(':', $contact);
		  $name = $contact[0];
		  $phone = $contact[1];
		  $email = $contact[2];

	  	  echo '<table><tr><td>Contact Name:</td><td><input type="text" name="contactName2" tabindex=1 value="'.$name.'"></td></tr>';
		  echo '<tr><td>Contact Phone:</td><td><input type="text" name="contactPhone2" tabindex=2 value="'.$phone.'"></td></tr>';
		  echo '<tr><td>Contact Email:</td><td><input type="text" name="contactEmail2" tabindex=3 value="'.$email.'"></td></tr></table>';		  		}
		  else {
			  echo '<table><tr><td>Contact Name:</td><td><input type="text" name="contactName1" tabindex=1></td></tr>';
			  echo '<tr><td>Contact Phone:</td><td><input type="text" name="contactPhone1" tabindex=2></td></tr>';
			  echo '<tr><td>Contact Email:</td><td><input type="text" name="contactEmail1" tabindex=3></td></tr></table><br />';

	  		  echo '<table><tr><td>Contact Name:</td><td><input type="text" name="contactName2" tabindex=1></td></tr>';
			  echo '<tr><td>Contact Phone:</td><td><input type="text" name="contactPhone2" tabindex=2></td></tr>';
			  echo '<tr><td>Contact Email:</td><td><input type="text" name="contactEmail2" tabindex=3></td></tr></table>';		
		  }
		 ?>

</fieldset>

<br>
<fieldset id="scheduling">
<legend>Scheduling</strong></legend>
<?PHP	
	echo('<p>Volunteer Type');
	echo('<span style="font-size:x-small;color:FF0000">*</span>: &nbsp;&nbsp;');

	echo('<select name="type">');
   		 $types = array('volunteer'=>'volunteer', 'coordinator'=>'coordinator', 'dispatch'=>'dispatch');
		foreach ($types as $ty) {
				echo "<option value='" . $ty . "' ";
                if($person->get_type() == $ty ) echo("SELECTED");
                else if ($id == "new" && $ty =="volunteer") echo("SELECTED");
                echo ">" . $ty . "</option>";
			}
		
	echo('</select><br><br>');


    echo ('Status: ');
    echo('<select name="status">');
    echo ('<option value="">Status...</option>');
    echo ('<option value="active"');if ($person->get_status()=='active') echo (' SELECTED'); echo('>Active</option>');
	echo ('<option value="on-leave"');if ($person->get_status()=='on-leave') echo (' SELECTED'); echo('>On Leave</option>');
	echo ('<option value="former"');if ($person->get_status()=='former') echo (' SELECTED'); echo('>Former</option>');
	echo('</select>');

	echo('<br><br><tr><td>Start Date: &nbsp</td><td>');
            	$mm = substr($person->get_start_date(),3,2);
            	$dd = substr($person->get_start_date(),6,2);
            	$yy = substr($person->get_start_date(),0,2);
            	select_date($mm,$dd,$yy, "startdate_Month", "startdate_Day", "startdate_Year"); 
        ?>
		</td></tr>
</p>
<fieldset id="availability">
<legend>Monthly Availability:</strong><span style="font-size:x-small;color:FF0000">*</span> </legend>
	<table>
	<tr>
		<td>Week&nbsp;&nbsp;</td><td>Mon&nbsp;&nbsp;</td><td>Tue&nbsp;&nbsp;</td><td>Wed&nbsp;&nbsp;</td>
		<td>Thu&nbsp;&nbsp;</td><td>Fri&nbsp;&nbsp;</td><td>Sat&nbsp;&nbsp;</td><td>Sun</td></tr>
<?PHP
    $weeks = array('1'=>'1st', '2'=>'2nd', '3'=>'3rd', '4'=>'4th', '5'=>'5th');
    $days = array('Mon', 'Tue', 'Wed' , 'Thu', 'Fri', 'Sat', 'Sun');
    $person_availability = implode(',',$person->get_availability());
    foreach ($weeks as $weekno => $weekvalue) {
       echo ('<tr><td>'. $weekvalue .'</td>');
       foreach ($days as $day) {
       	  $realkey = $day . ":". $weekno;
       	  echo ('<td><input type="checkbox" name="availability[]" value=' . $realkey);
    	  if (in_array($day.":".$weekno, $person->get_availability())) echo(' CHECKED');
    	  echo ('></td>');
       }
       echo ('</tr>');
    }
?>
</table>
</fieldset>
</fieldset>
<p>


<?PHP
    //changing password for existing volunteer
    	if ($id != "new" && $_SESSION['_id'] == $id)
   	{
		echo '<fieldset id=password><legend>Change Password</strong></legend>';
		echo '<table><tr><td>New Password:</td><td><input type="text" name="newPassword" tabindex=2></td></tr>';
		echo '<tr><td>New Password (confirm):</td><td><input type="text" name="newPasswordCheck" tabindex=3></td></tr></table></fieldset>';
   	}					
?>

		<?PHP	     	
		  echo('<p>Notes:<br />');
	      echo('<textarea name="notes" rows="2" cols="60">');
	      //echo($_POST['notes']);
    	      echo($person->get_notes());
              echo('</textarea>');

		  echo('<input type="hidden" name="schedule" value="'.implode(',',$person->get_schedule()).'">');
		  echo('<input type="hidden" name="password" value="'.$person->get_password().')">');
		  echo('<input type="hidden" name="_submit_check" value="1"><p>');
		  if ($id=="new")
		     echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to add this new volunteer.<br /><br />');
		  else
		     echo('Hit <input type="submit" value="Submit" name="Submit Edits"> to complete these changes.<br /><br />');
		  if ($id != 'new' && $_SESSION['access_level']>=2) {
			echo ('<input type="checkbox" name="deleteMe" value="DELETE"> Check this box and then hit ' .
				'<input type="submit" value="Delete" name="Delete Entry"> to delete this volunteer from the database. <br />' .
				'<input type="checkbox" name="reset_pass" value="RESET"> Check this box and then hit ' .
				'<input type="submit" value="Reset Password" name="Reset Password"> to reset this volunteer\'s password.</p>');
		}
		?>

<?PHP
function &select_date($month, $day, $year, $month_name, $day_name, $year_name) {
		$months = array('','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
        echo('<select name='.$month_name.'><option value=""></option>');
		echo('');
        for ($i = 1; $i <= 12; $i++) {
            echo '<option value='.(($i<10)?"0".$i:$i);
            if ($month==$i) 
            	echo(' SELECTED');
            echo '>' . $months[$i] . ' </option>';
        }
		echo "</select>";

		echo '<select name='.$day_name.'><option value=""></option>';
		for ($i = 1; $i <= 31; $i++) {
            echo '<option value='.(($i<10)?"0".$i:$i); 
            if($day==$i) 
            	echo(' SELECTED'); 
            echo '>' . $i . ' </option>'; 
		}
		echo "</select>";
        // handles a year range of 90 years, from today+10 to today-80
		echo '<select name='.$year_name.'><option value=""></option>';
		$start_year = date("Y")+10;
        for ($i = $start_year; $i >= ($start_year-90); $i--){
         	echo '<option value='.substr($i,2,2); 
         	if($year==substr($i,2,2)) 
         		echo(' SELECTED'); 
         	echo '>' . $i . ' </option>'; 
        }
		echo "</select>";	
}
?>
</form>

