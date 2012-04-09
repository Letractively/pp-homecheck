<?php
/*
* Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/*
* Volunteer class for Homecheck
* @author Max Palmer, Alex Edison
* @version updated February 16, 2012
*/

function connect() {
	$host = "localhost";
	$database = "pphomecheckDB";
	$user = "pphomecheckDB";
	$password = "pphomecheckDB";

	$connected = mysql_connect($host,$user,$password);
	if (!$connected) return mysql_error();
	$selected = mysql_select_db($database, $connected);
	if (!$selected) return mysql_error();
	else return true;
}
?>