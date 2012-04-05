<?PHP
/*
 * Copyright 2012 by Alex Edison, Nicole Erkis, Ruben Martinez, and Allen
 * Tucker.  This program is part of Homecheck, which is free software.  It comes
 * with absolutely no warranty.  You can redistribute and/or modify it under the
 * terms of the GNU Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/).
*/
	session_start();
	session_cache_expire(30);
	include_once('database/dbParticipants.php');
	$date = $_GET["date"]; 
?>
<HTML>     
    <HEAD>  
    <TITLE>Daily Log</TITLE>   
	<LINK rel="stylesheet" href="styles.css" type="text/css">
	<LINK type="text/css" rel="stylesheet" href="data:text/css,">
	<STYLE TYPE="text/css"> 
	    select {
 			font-family: Arial, sans-serif;
 			font-size: 1em;
 	    }
	    textarea {
			max-width: 280px;
			max-height: 250px;
 	    }
	    .badValue {
			border:4px solid red;
	    }

        </STYLE>

        <SCRIPT LANGUAGE="JavaScript">
	    function validateTime() {
            // Get the source element.
            var el = event.srcElement;
			// Valid entries
        	var ent = "0123456789:";
        	event.returnValue = true;
            /* Loop over contents. If any character is not a number,
            	set the return value to false. */
            for (var intLoop = 0; intLoop < el.value.length; intLoop++)
               	if (-1 == ent.indexOf(el.value.charAt(intLoop)) || el.value.length < 4) {
               		event.returnValue=false;
					alert("Invalid Time! Please enter in HH:MM format,\nExamples: 12:00, 08:25, 9:00");
		    	}
            	if (!event.returnValue) {       // Bad value
               		el.className = "badValue"; // Change class
		    	}
            	else
               		el.className="";       
            }

	    function isEmpty(str) {
            // Check whether string is empty.
            for (var intLoop = 0; intLoop < str.length; intLoop++)
                if (" " != str.charAt(intLoop))
                    return false;
            return true;
        }

        function checkRequired(f) {
            var strError = "";
            for (var intLoop = 0; intLoop<f.elements.length; intLoop++)
                if (null!=f.elements[intLoop].getAttribute("required")) 
                    if (isEmpty(f.elements[intLoop].value))
                        strError += "  " + f.elements[intLoop].name + "\n";
            		if ("" != strError) {
               		    alert("Required data is missing:\n" + strError);
                        return false;
                    }
					if (f.value.length <=1) {
               		    alert("Required data is missing:\n" + strError);
                    	return false;
                    }
       	}
	</SCRIPT>
    </HEAD>     
    <BODY> 
    	<DIV ID="container">
    	<?PHP //include('header.php');?>
		<DIV ID="content">
		<?PHP
			//Substitute appropriate server credentials
		//	$connect = mysql_connect("127.0.0.1", "root", "") or die ("Check server connection.");
		//	mysql_select_db("pphomecheckdb");
    	?>
        <DIV STYLE=" TOP: 75; LEFT: 100; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            <IMG SRC="images/DailyLogLogo.png" WIDTH="70" HEIGHT="88"/>
        </DIV>
        <!--All images with text use Ariel 14pt font-->
		<DIV STYLE=" TOP: 65; LEFT: 180; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            <IMG SRC="images/DailyLog.png"/>
        </DIV>
		<DIV STYLE="TOP:197; LEFT: 100; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    	<IMG SRC="images/time.png"/>
		</DIV>
		<DIV STYLE="TOP:263; LEFT: 97; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
		    <IMG SRC="images/participant.png"/>
		</DIV>
		<DIV STYLE="TOP:322; LEFT: 100; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    	<IMG SRC="images/result.png"/>
		</DIV>
		<DIV STYLE="TOP:385; LEFT: 100; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    	<IMG SRC="images/note.png"/>
		</DIV>
		<DIV STYLE="TOP:197; LEFT: 600; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    	<IMG SRC="images/participants.png"/>
		</DIV>
        <DIV STYLE=" TOP: 145; LEFT: 188; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            <?PHP echo date('d, F, Y'); ?>
        </DIV>
        <FORM ID="FORM1" ACTION="writeToDL.php" METHOD="POST" ONSUBMIT="return checkRequired(this);">
        	<DIV STYLE=" TOP: 209; LEFT: 280; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
        		<INPUT TYPE="hidden" NAME="Date" STYLE="WIDTH:0px; " MAXLENGTH="8" TITLE="Enter Date" Value="<?php $dt = date('dmY'); echo $dt ?>"/>
                <INPUT TYPE="text" NAME="Time" STYLE="WIDTH:70px; " MAXLENGTH="7" ONCHANGE="validateTime();" TITLE="Enter Time in HH:MM" required/>
				<SELECT NAME = "AP" TITLE="Select AM or PM">
    		    	<OPTION VALUE = A>AM</OPTION>
    		    	<OPTION VALUE = P>PM</OPTION>
                </SELECT><BR><BR>
            </DIV>
            <DIV STYLE=" TOP: 272; LEFT: 280; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
        		<SELECT NAME = "Participant" STYLE = "WIDTH: 187" title="Begin typing participant name for fast searching." required>
                	<OPTION SELECTED VALUE = "">Select Participant...</OPTION>
		    		<?PHP
		    			$allParticipants = getall_participants();
		    			foreach($allParticipants as &$value) {
							echo "<OPTION VALUE='",$value->get_id(),"'>";
		    				echo $value->get_first_name()," ",$value->get_last_name();
		    				echo "</OPTION>";
		    			}
               		?>
        		</SELECT> 
            </DIV>
            <DIV STYLE=" TOP: 335; LEFT: 280; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
                <SELECT NAME = "Result" TITLE="Choose 'H' for 'Had to Call', 'C' for 'Called Contact', 'D' for 'Called Dispatch', else leave blank." required>
    			    <OPTION VALUE = OK></OPTION>
    			    <OPTION VALUE = C>C</OPTION>
   			    	<OPTION VALUE = H>H</OPTION>
   			    	<OPTION VALUE = D>D</OPTION>
                </SELECT>
	    	</DIV>
	    	<DIV STYLE=" TOP: 397; LEFT: 280; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
				<TEXTAREA NAME="Notes" COLS="28" ROWS="5" STYLE="FONT-family:arial" TITLE="Enter Notes Here"></TEXTAREA>
				<BR><BR>
				<INPUT TYPE="submit" VALUE="Submit" />
            </DIV>
        </FORM>
        <FORM ID="FORM2" METHOD = "get">
	    	<DIV STYLE=" TOP: 210; LEFT: 810; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
      		    <SELECT NAME = id STYLE = "WIDTH: 180" SIZE = 18>
					<?PHP
		    			$allParticipants = getall_participants();
		    			foreach($allParticipants as &$value) {
							echo "<OPTION VALUE='",$value->get_id(),"'>";
		    				echo $value->get_first_name()," ",$value->get_last_name();
		    				echo "</OPTION>";
		    			}
               		?>
       		    </SELECT> <BR><BR>
                <INPUT TYPE="submit" VALUE="Participant Info" ONCLICK="javascript: FORM2.action='http://homecheck.myopensoftware.org/participantInfo.php'"/> 
				<INPUT TYPE="submit" VALUE="Notepad" ONCLICK="javascript: FORM2.action='http://homecheck.myopensoftware.org/participantLog.php'"/> 
            </DIV>
        </FORM>
        <DIV STYLE=" TOP: 180; LEFT: 570; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
	    	<img src="images/vl.png" height="440" width="5"/>
		</DIV>
		<br clear="all">
		<?PHP //include('footer.inc');?>	
        </DIV>     
        </DIV>     
    </BODY>     
</HTML>        