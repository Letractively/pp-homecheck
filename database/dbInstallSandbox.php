<?php
/*
 * Copyright 2012 by Hartley Brody, Richardo Hopkins, Nicholas Wetzel, and Allen
* Tucker.  This program is part of Homecheck, which is free software.  It comes
* with absolutely no warranty.  You can redistribute and/or modify it under the
* terms of the GNU Public License as published by the Free Software Foundation
* (see <http://www.gnu.org/licenses/).
*/

/**
 * Initializes the database by creating the tables
 * and seeding them with test data for volunteers, clients, and schedules
 * @version April 1, 2012
 * @author Allen Tucker
 */
?>

<html>
<title>
Database Initialization
</title>
<body>
<?php
	echo("Installing Tables...<br />");
	include_once('dbinfo.php');
	include_once('dbDailyLogs.php');
	include_once('dbParticipantEntry.php');
	include_once('dbParticipants.php');include_once('../domain/Volunteer.php');
	include_once('dbReports.php');
	include_once('dbScheduleEntry.php');
	include_once('dbShifts.php');
	include_once('dbVolunteers.php');include_once('../domain/Volunteer.php');
	include_once('dbWeeks.php');
	
	// connect
	$connected=connect();
 	if (!$connected) echo mysql_error();
 	echo("connected...<br />");
    echo("database selected...<br />");

	create_dbDailyLogs(); echo("dbDailyLogs added...<br />");
	create_dbParticipantEntry(); echo("dbParticipantEntry added...<br />");
	create_dbParticipants(); echo("dbParticipants added...<br />");
	create_dbReports(); echo("dbReports added...<br />");
	create_dbScheduleEntry(); echo("dbScheduleEntry added...<br />");
	create_dbShifts(); echo("dbShifts added...<br />");
	create_dbVolunteers(); echo("dbVolunteers added...<br />");
	
	// now add some data to the volunteers and clients tables
	fill_the_sandbox();
	
	echo("Installation of sandbox database complete.");
	echo(" To prevent data loss, run this program only if you want to reinitialize the tables.</p>");

function fill_the_sandbox() {
	// add some volunteer data
	    $vol1 = new Volunteer("Edison", "Alex", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"edison.ace@gmail.com", "volunteer",  "",
        			"Wed:4,Fri:2","","", "","", "active", "", "");insert_dbVolunteers($vol1);
        $vol1 = new Volunteer("Erkis", "Nicole", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"nikwik@gmail.com", "volunteer",  "",
        			"Wed:5,Fri:3","","", "","", "active", "", "");insert_dbVolunteers($vol1);
        $vol1 = new Volunteer("Martinez", "Ruben", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"rmartin@bowdoin.edu", "volunteer",  "",
        			"Wed:1,Thu:4,FI","","", "","", "active", "", "");insert_dbVolunteers($vol1);
        $vol1 = new Volunteer("Ashe", "Madeleine", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"madeleine@ashe.com", "coordinator", "",
        			"Wed:2,Thu:5","","", "","", "active", "", "");insert_dbVolunteers($vol1);
        $vol1 = new Volunteer("Tucker", "Allen", "111 Main Street", "Brunswick", "ME", "04011", "1112345678", "", 
    				"allen@bowdoin.edu", "dispatch", "",
        			"FI","","", "","", "active", "", ""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Ashe","Madeleine","4 Larkspur Lane","Brunswick","ME","04011","2077254242","2072324262","madeleine@ashe.com","coordinator","","Sun:2,Thur:5:FI","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Bailey","Rita","866 Merepoint Rd","Brunswick","ME","04011","2077290966","","rbailey626@gmail.com","volunteer","","Wed:4","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Beeman","Gloria","25 Amos Way","Brunswick","ME","04011","2078093444","","nameeb@comcast.net","volunteer","","Sun:1,Sun:3,Sun:5,FI","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Belt","Barbara","30 Oakwood Terrace","Brunswick","ME","04011","2077257035","","bbdreamtrip@gmail.com","volunteer","","Tue:3,Tue:5","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Deshales","Denise","15 North Point Rd","Harpswell","ME","04079","2077293009","","gerryanddenise@gmail.com","volunteer","","Fri:1,Fri:3","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Frazer","Tulle","271 Harpswell Neck Rd","Harpswell","ME","04079","2077258942","","tullef@myfairpoint.net","volunteer","","Wed:2,Wed:3 ","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Gorby","Judy","2 Westminster","Brunswick","ME","04011","2077255039","","irishlas123@comcast.net","volunteer","","Tues:1,Tue:2,FI","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Hallenbeck","Tom","17 Mountain Ash Ave","Brunswick","ME","04011","2077255264","","hallentj1@myfairpoint.net","volunteer","","Fri:2,Fri:4,Fri:5","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Moody","Patricia","12 Wood Landing Rd","Harpswell","ME","04079","2078335535","","pbmoody@comcast.net","volunteer","","Mon:2,Mon:5,Wed:5,Sat:2,FI","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Phinney","June","21 Otter Brook Rd","Harpswell","ME","04079","2077252438","","harpswell@netscape.com","volunteer","","Wed:1,Thu:1","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Rhode","Jack","13 Mountain Ash","Brunswick","ME","04011","2077252157","","jsrhode@comcast.net","volunteer","","Sat:1,Sat:3,Sat:5","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Rhode","Suzanne","13 Mountain Ash","Brunswick","ME","04011","2077252157","","jsrhode@comcast.net","volunteer","","Mon:4,Tue:4","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Ricker","Leda","24 Allen Pt. Rd","Harpswell","ME","04079","2078336267","","ajricker_1965@yahoo.com","volunteer","","Thu:2,Thu:3,Thu:4,FI","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Wessel","Sarah","24 Hildreth Rd","Harpswell","ME","04079","2077257453","","","volunteer","","Mon:1,Mon:3,Sat:4","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Tucker","Meg","42 Walini Way","Harpswell","ME","04079","2077298111","","mtucker@bowdoin.edu","volunteer","","","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Goan","Terry","","Brunswick","ME","04011","2077256621","","tgoan@brunswickpd.org","dispatch","","","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Moeller","Sonia","","Brunswick","ME","04011","2077256621","","smoeller@brunswickpd.org","dispatch","","","","","","","active","",""); insert_dbVolunteers($vol1);
$vol1=new Volunteer("Smith","Mari","","Brunswick","ME","04011","2077256621","","mmsmith@brunswickpd.org","dispatch","","","","","","","active","",""); insert_dbVolunteers($vol1);
        
	// add some participant data
	    $part1 = new Participant("Smith", "John", "111 Main Street", "Brunswick", "ME", "04011", 2071234567, "", "name@domain1.com",
                         "yes", "Contact:Relationship:555-5555", "Physician 111-1111", "yes", "service1,service2", "need1,need2",
                         "no", "Person with other key", "yes - Blue Sedan, License Plate FFF44", "01-01-01", "completed", 
						 "01-01-01", "", "active", "log entries", "notes"); insert_dbParticipants($part1);
		$part1 = new Participant("Doe", "Jane", "222 Park", "Topsham", "ME", "11111", 2072345678, "", "jane@doe.com",
                         "no - lives with John Doe, husband", "Contact,Relationship,555-5555", "Physician 222-2222", "yes", 
                         "service1,service2", "need1,need2", "yes-under doormat", "Person with other key", "no", "04-04-04", 
						 "authorized", "04-15-06", "", "away", "log entries", "notes");insert_dbParticipants($part1);
		$part1 = new Participant("Blah", "Blah", "33 Center Street", "Bowdoinham", "ME", "04011", 2074567890, "", "blah@blah.com",
                         "yes", "Contact,Relationship,555-5555", "Physician 333-3333", "yes", "service1,service2", "need1,need2",
                         "no", "Person with other key", "no", "05-05-05", "completed", "05-30-99", "", "active", "log entries", "notes"); insert_dbParticipants($part1);
        $vol1 = new Participant("BENGTSSON","MARIE","","Brunswick","ME","","2071234567","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("BLACK","MARJORIE","","Harpswell","ME","","2071234568","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("BRANN","TERESA","","Freeport","ME","","2071234569","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("COOPER","ARTHUR","","Freeport","ME","","2071234570","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("GALEN","ROBERT","","Brunswick","ME","","2071234571","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("GATES","GEORGIA","","Brunswick","ME","","2071234572","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("GATES","JOHN","","Freeport","ME","","2071234573","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("GOULD","CHARLES","","Freeport","ME","","2071234574","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("HASKELL","BARBARA","","Freeport","ME","","2071234575","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("HILDEBRANDT","MARY","","Harpswell","ME","","2071234576","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("JEFFREY","PATRICIA","","Brunswick","ME","","2071234577","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("JORDAN","LUCILLE","","Freeport","ME","","2071234578","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("MASON","ALICE","","Freeport","ME","","2071234579","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("MILLER ","KATHIE","","Brunswick","ME","","2071234580","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("PATPATIAN","MAYRENI","","Freeport","ME","","2071234581","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("PAYSON","NICK","","Brunswick","ME","","2071234582","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("PROVOST","CLARA","","Freeport","ME","","2071234583","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("SARLE ","RODNEY","","Brunswick","ME","","2071234584","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("SHELBY","SHARON","","Brunswick","ME","","2071234585","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("SIMMONS","PEARL","","Brunswick","ME","","2071234586","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("SIMPSON","ELIZABETH","","Freeport","ME","","2071234587","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("WESCOTT","ELIZABETH","","Brunswick","ME","","2071234588","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("WESTERVELT","ANN","","Freeport","ME","","2071234589","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("WHITTIER ","LOUISE","","Brunswick","ME","","2071234590","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("WILSON","ELEANOR","","Harpswell","ME","","2071234591","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("WILSON","NANCY","","Freeport","ME","","2071234592","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("YORK","JAN","","Harpswell","ME","","2071234593","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
$vol1 = new Participant("ZEEGERS","MARIE_CLAIRE","","Freeport","ME","","2071234594","","","","","","","","","","","","","","","","active","",""); insert_dbParticipants($vol1);
        
}

?>
</body>
</html>