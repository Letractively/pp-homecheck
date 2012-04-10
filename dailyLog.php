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
	include_once('database/dbinfo.php');
	include_once('database/dbParticipants.php');
	include_once('database/dbParticipantEntry.php');
	include_once('database/dbDailyLogs.php');
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
	    .badValue {
			border:4px solid red;
	    }
	    #ta {
	     	width: 200px; 
	     	height: 70px;
	     } 
	    .button_submit {
   			background:url(images/button_submit.png) no-repeat;
   			border: none;
   			height: 32px;
   			width: 96px;
		}
	    .button_info {
   			background:url(images/button_info.png) no-repeat;
   			border: none;
   			height: 32px;
   			width: 96px;
		}
		.button_notes {
   			background:url(images/button_notes.png) no-repeat;
   			border: none;
   			height: 32px;
   			width: 96px;
		}
		.button_save {
   			background:url(images/button_save.png) no-repeat;
   			border: none;
   			height: 32px;
   			width: 96px;
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
	</SCRIPT>
    </HEAD>     
    <BODY> 
    	<DIV ID="container">
    	<?PHP //include('header.php');?>
		<DIV ID="content">
        <DIV STYLE=" TOP: 160; LEFT: 100; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            <IMG SRC="images/DailyLogLogo.png" WIDTH="70" HEIGHT="88"/>
        </DIV>
        <!--All images with text use Ariel 14pt font-->
		<DIV STYLE=" TOP: 160; LEFT: 180; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            <IMG SRC="images/DailyLog.png"/>
        </DIV>
		<DIV STYLE="TOP:282; LEFT: 100; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    	<IMG SRC="images/time.png"/>
		</DIV>
		<DIV STYLE="TOP:348; LEFT: 97; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
		    <IMG SRC="images/participant.png"/>
		</DIV>
		<DIV STYLE="TOP:407; LEFT: 100; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    	<IMG SRC="images/result.png"/>
		</DIV>
		<DIV STYLE="TOP:470; LEFT: 100; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    	<IMG SRC="images/note.png"/>
		</DIV>
		<DIV STYLE="TOP:470; LEFT: 600; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    	<IMG SRC="images/participants.png"/>
		</DIV>
		<DIV STYLE="TOP:282; LEFT: 600; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    	<IMG SRC="images/dnotes.png"/>
		</DIV>
        <DIV STYLE=" TOP: 230; LEFT: 188; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            <?PHP echo date('F d, Y'); ?>
        </DIV>        
        <FORM ID="FORM1" METHOD="POST" AUTOCOMPLETE="off">
        	<DIV STYLE=" TOP: 294; LEFT: 280; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
        		<INPUT TYPE="hidden" NAME="Date" STYLE="WIDTH:0px; " MAXLENGTH="8" TITLE="Enter Date" Value="<?php $dt = date('y-m-d'); echo $dt ?>"/>
                <INPUT TYPE="text" NAME="Time" STYLE="WIDTH:70px; " MAXLENGTH="7" ONCHANGE="validateTime();" TITLE="Enter Time in HH:MM"/>
				<SELECT NAME = "AP" TITLE="Select AM or PM">
    		    	<OPTION VALUE = A>AM</OPTION>
    		    	<OPTION VALUE = P>PM</OPTION>
                </SELECT><BR><BR>
            </DIV>
            
            <DIV STYLE=" TOP: 420; LEFT: 280; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
                <SELECT NAME = "Result" TITLE="Choose 'H' for 'Had to Call', 'C' for 'Called Contact', 'D' for 'Called Dispatch', else leave blank.">
    			    <OPTION VALUE = OK></OPTION>
    			    <OPTION VALUE = C>C</OPTION>
   			    	<OPTION VALUE = H>H</OPTION>
   			    	<OPTION VALUE = D>D</OPTION>
                </SELECT>
	    	</DIV>
	    	<DIV STYLE=" TOP: 295; LEFT: 810; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
 				<DIV ID="ta">
					<TABLE>
						<TR STYLE="float:left;">
							<?php 
								$dl = retrieve_dbDailyLogs($dt);
								if ($dl != null) {
									$nts = $dl->get_note();
									echo "<TD>";
    								if($dl == null || $nts == null)
										echo "No notes today.";
									else
										echo "\"".$nts."\"";
    								echo "</TD>";
								}
								else {
									echo "<TD>";
									echo "No notes today.";
									echo "</TD>";
								}
    						?>
						</TR>
					</TABLE>
				</DIV>
 				<BR>
        		<TEXTAREA NAME="dNotes" COLS="28" ROWS="2" STYLE="font-family:arial; resize: none;" TITLE="Enter Daily Notes Here"></TEXTAREA>
        		<BR><BR><INPUT TYPE="submit" CLASS="button_save" TITLE="Save" VALUE="" ONCLICK="javascript: FORM1.action='insertDL.php'"/>
        	</DIV>
        	<DIV STYLE=" TOP: 360; LEFT: 280; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
        		<SELECT NAME = "Participant" STYLE = "WIDTH: 187" TITLE="Begin typing participant last name for fast searching.">
                	<OPTION SELECTED VALUE = "">Select Participant...</OPTION>
		    		<?PHP
		    			$allParticipants = getall_participants ();
		    			foreach($allParticipants as &$value) {
		    				$val = $value->get_id();
		    				echo "<OPTION VALUE='",$val,"'>";
		    				echo $value->get_last_name(),", ",$value->get_first_name();
		    				echo "</OPTION>";
		    			}
               		?>
        		</SELECT>
            </DIV>
	    	<DIV STYLE=' TOP: 482; LEFT: 280; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;'>
				<TEXTAREA NAME="Notes" COLS="28" ROWS="5" STYLE="font-family:arial; resize: none;" TITLE="Enter Notes Here"></TEXTAREA>
				<?php
					$vol = $_SESSON['_id'];
					echo "<INPUT TYPE='hidden' NAME='Volunteer' TITLE='Volunteer' ";
					echo "VALUE='", $vol, "'/>";
				?><BR><BR>				
				<INPUT TYPE="submit" CLASS="button_submit" VALUE="" TITLE="Submit Participant" ONCLICK="javascript: FORM1.action='insertDL.php'"/>
            </DIV>
        </FORM>
        
        <FORM ID="FORM2" METHOD = "get">
	    	<DIV STYLE=" TOP: 482; LEFT: 812; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
      		    <SELECT NAME = id STYLE = "WIDTH: 185" SIZE = 18>
					<?PHP
		    			$allParticipants = getall_participants();
		    			foreach($allParticipants as &$value) {
							echo "<OPTION VALUE='",$value->get_id(),"'>";
		    				echo $value->get_first_name()," ",$value->get_last_name();
		    				echo "</OPTION>";
		    			}
               		?>
       		    </SELECT> <BR><BR>
                <INPUT TYPE="submit" CLASS="button_info" VALUE="" TITLE="Participant Information" ONCLICK="javascript: FORM2.action='http://homecheck.myopensoftware.org/participantInfo.php'"/> 
				<INPUT TYPE="submit" CLASS="button_notes" VALUE="" TITLE="Notespad"ONCLICK="javascript: FORM2.action='http://homecheck.myopensoftware.org/participantLog.php'"/> 
            </DIV>
        </FORM>
        <DIV STYLE=" TOP: 265; LEFT: 570; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
	    	<img src="images/vl.png" height="540" width="5"/>
		</DIV>
		<br clear="all">
		<?PHP include('footer.inc');?>	
        </DIV>     
        </DIV>     
    </BODY>     
</HTML>        