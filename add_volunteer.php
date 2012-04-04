<?PHP
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen 
 * Tucker.  This program is part of Homecheck, which is free software.  It comes 
 * with absolutely no warranty.  You can redistribute and/or modify it under the 
 * terms of the GNU Public License as published by the Free Software Foundation 
 * (see <http://www.gnu.org/licenses/).
*/
/*
 * add_volunteer.php
 * @author Nicole Erkis
 * @version April 3, 2012
 */
		session_start(); 
		session_cache_expire(30);
?>
<html> 
	<head>
		<title> 
			Add New Volunteer
		</title> 
			<style>
			.column {width:450px; float:left; display:block;}
			label, input {display:block;}
		</style>
	</head>
	<body> 
			<div id="content">
				<?php 
				include_once('database/dbVolunteers.php');
				include_once('domain/Volunteer.php');
				?>
				
				<label>Field1:<input></label>
<label>Field2:<input></label>
				

<form>
<div class="column">
<h3>Contact Information</h3>
<span style="display:inline-block">
    <label for=first style="display:block">First name</label>
    <input type=text size=30 name=first />
</span>
<span style="display:inline-block">
    <label for=last  style="display:block">Last name</label>
    <input type=text size=30 name=last />
</span><br><br>
<label for=address style="display:block">Address</label>
<input type=text size=67 name=address />
<label for=city style="display:block">City</label>
<input type=text size=30 name=city /><select id="state" name="state">
<option value="AK">Alaska</option>
<option value="AL">Alabama</option>
<option value="AR">Arkansas</option>
<option value="AZ">Arizona</option>
<option value="CA">California</option>
<option value="CO">Colorado</option>
<option value="CT">Connecticut</option>
<option value="DC">District of Columbia</option>
<option value="DE">Delaware</option>
<option value="FL">Florida</option>
<option value="GA">Georgia</option>
<option value="HI">Hawaii</option>
<option value="IA">Iowa</option>
<option value="ID">Idaho</option>
<option value="IL">Illinois</option>
<option value="IN">Indiana</option>
<option value="KS">Kansas</option>
<option value="KY">Kentucky</option>
<option value="LA">Louisiana</option>
<option value="MA">Massachusetts</option>
<option value="MD">Maryland</option>
<option value="ME" selected="selected">Maine</option>
<option value="MI">Michigan</option>
<option value="MN">Minnesota</option>
<option value="MO">Missouri</option>
<option value="MS">Mississippi</option>
<option value="MT">Montana</option>
<option value="NC">North Carolina</option>
<option value="ND">North Dakota</option>
<option value="NE">Nebraska</option>
<option value="NH">New Hampshire</option>
<option value="NJ">New Jersey</option>
<option value="NM">New Mexico</option>
<option value="NV">Nevada</option>
<option value="NY">New York</option>
<option value="OH">Ohio</option>
<option value="OK">Oklahoma</option>
<option value="OR">Oregon</option>
<option value="PA">Pennsylvania</option>
<option value="PR">Puerto Rico</option>
<option value="RI">Rhode Island</option>
<option value="SC">South Carolina</option>
<option value="SD">South Dakota</option>
<option value="TN">Tennessee</option>
<option value="TX">Texas</option>
<option value="UT">Utah</option>
<option value="VA">Virginia</option>
<option value="VT">Vermont</option>
<option value="WA">Washington</option>
<option value="WI">Wisconsin</option>
<option value="WV">West Virginia</option>
<option value="WY">Wyoming</option>
</select>

<label for=zip style="display:block">Zip Code</label>
<input type=text size=30 name=zip /><br /><br>
<span style="display:inline-block">
    <label for=first style="display:block">Phone</label>
    <input type=text value="207" size=30 name=first />
</span>

<span style="display:inline-block">
    <label for=last  style="display:block">Secondary Phone</label>
    <input type=text size=30 name=last />
</span>

<label for=zip style="display:block">Email</label>
<input type=text size=30 name=zip /><br />

<h3>Emergency Contacts</h3>
<span style="display:inline-block">
    <label for=first style="display:block">First name</label>
    <input type=text size=30 name=first />
</span>
<span style="display:inline-block">
    <label for=last  style="display:block">Last name</label>
    <input type=text size=30 name=last />
</span><br>
<span style="display:inline-block">
    <label for=first style="display:block">Phone</label>
    <input type=text size=30 name=first />
</span>
<span style="display:inline-block">
    <label for=last  style="display:block">Email</label>
    <input type=text size=30 name=last />
</span><br><br>

<span style="display:inline-block">
    <label for=first style="display:block">First name</label>
    <input type=text size=30 name=first />
</span>
<span style="display:inline-block">
    <label for=last  style="display:block">Last name</label>
    <input type=text size=30 name=last />
</span><br>

<span style="display:inline-block">
    <label for=first style="display:block">Phone</label>
    <input type=text size=30 name=first />
</span>
<span style="display:inline-block">
    <label for=last  style="display:block">Email</label>
    <input type=text size=30 name=last />
</span>
</div>

<div class="column">
<h3>Scheduling</h3>
<label for=start_date style="display:block">Start Date</label>
<input type=text size=30 name=start_date /><br><br>
<select name="type">
<option value="">Volunteer Type...</option>
<option value="volunteer">Volunteer</option>
<option value="coordinator">Coordinator</option>
<option value="dispatch">Dispatch</option>
</select>
<select name="status">
<option value="">Status...</option>
<option value="active">Active</option>
<option value="away">Away</option>
<option value="former">Former</option>
</select><br><br>

<label for=availability style="display:block">Availability</label>
<input type=text size=67 name=availability /><br>

<label for=schedule style="display:block">Schedule</label>
<input type=text size=67 name=schedule /><br><br>

<label for=notes style="display:block">Notes</label>
<input type=text size=67 style="height: 200px" name=notes /><br>

<br><input type="submit" name="formSubmit" value="Save" /><input type="submit" name="formSubmit" value="Cancel" />

</div>
</form>
			<?php include('footer.inc');?>
</div>
	</body> 
</html>