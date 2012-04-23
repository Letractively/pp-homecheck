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
	$dt = $_GET["date"]; 
	$submitted = $_GET["submitted"]
?>
<HTML>     
    <HEAD>  
    <TITLE>Daily Log</TITLE>   
    <LINK REL="icon"  TYPE="image/png" HREF="images/DLfavicon.png">
	<LINK REL="stylesheet" HREF="styles.css" TYPE="text/css">
	<LINK TYPE="text/css" REL="stylesheet" HREF="data:text/css,">
	<STYLE TYPE="text/css"> 
		body {
			min-width: 1024px;
		}
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
   			width: 99px;
		}
	    .button_info {
   			background:url(images/button_info.png) no-repeat;
   			border: none;
   			height: 32px;
   			width: 99px;
		}
		.button_save {
   			background:url(images/button_save.png) no-repeat;
   			border: none;
   			height: 32px;
   			width: 99px;
		}
        </STYLE>

        <SCRIPT LANGUAGE="JavaScript">
        function moveOnMax(field,nextFieldID){
        	if(field.value.length >= field.maxLength){
        		document.getElementById(nextFieldID).focus();
        	}
        }
	    function validateTime() {
            // Get the source element.
            var el = event.srcElement;
			// Valid entries
        	var ent = "0123456789";
        	event.returnValue = true;
            /* Loop over contents. If any character is not a number,
            	set the return value to false. */
            for (var intLoop = 0; intLoop < el.value.length; intLoop++)
               	if (-1 == ent.indexOf(el.value.charAt(intLoop))) {
               		event.returnValue=false;
					alert("Invalid Time Entry! \nPlease enter in format 12:00, 08:00, or 9:00");
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
    	<?PHP include('header.php');?>
		<DIV ID="content">
		<FORM ID="FORM1" METHOD="POST" AUTOCOMPLETE="off">
			<DIV STYLE=' TOP: 252; MARGIN-LEFT: 25; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;'>
            	<?php 
					if ($submitted != null){
            	  		$subPart = retrieve_dbParticipants($submitted);
            	    	$name = $subPart->get_first_name()." ".$subPart->get_last_name();
            	    	echo "<BR><BR>";
            	    	echo "<h2 style='color: red'>&#10004; Submitted Log for ";
            	    	echo $name;
            	    	echo "</h2>";
            		}
            	?>
            </DIV>
        	<DIV STYLE=" TOP: 180; MARGIN-LEFT: 15; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            	<IMG SRC="images/DailyLogLogo.png" WIDTH="70" HEIGHT="88"/>
        	</DIV>
        	<!--All images with text use Ariel 14pt font-->
			<DIV STYLE=" TOP: 180; MARGIN-LEFT: 95; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            	<IMG SRC="images/DailyLog.png"/>
        	</DIV>
        	<DIV STYLE=" TOP: 250; MARGIN-LEFT: 105; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            	<?PHP echo date('F d, Y');?>
        	</DIV>     
        	
			<DIV STYLE="TOP:332; MARGIN-LEFT: 15; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    		<IMG SRC="images/time.png"/>
			</DIV>
			<DIV STYLE=" TOP: 344; MARGIN-LEFT: 195; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
        		<INPUT TYPE="hidden" NAME="Date" STYLE="WIDTH:0px; " MAXLENGTH="8" TITLE="Enter Date" Value="<?php echo $dt ?>"/>
                <INPUT TYPE="text" NAME="Time1" ID="Time1" STYLE="WIDTH:30px; " MAXLENGTH="2" ONCHANGE="validateTime();" TITLE="Enter Time, HH" ONKEYUP="moveOnMax(this,'Time2')"/>:<INPUT TYPE="text" NAME="Time2" ID="Time2" STYLE="WIDTH:30px; " MAXLENGTH="2" ONCHANGE="validateTime();" TITLE="Enter Time, MM"/>
				<SELECT NAME = "AP" TITLE="Select AM or PM">
    		    	<OPTION VALUE = A>AM</OPTION>
    		    	<OPTION VALUE = P>PM</OPTION>
                </SELECT><BR><BR>
            </DIV>
            
			<DIV STYLE="TOP:398; MARGIN-LEFT: 15; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
		    	<IMG SRC="images/participant.png"/>
			</DIV>
			<DIV STYLE=" TOP: 410; MARGIN-LEFT: 195; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
        		<SELECT NAME = "Participant" STYLE = "WIDTH: 187" TITLE="Begin typing participant last name for fast searching.">
                	<OPTION SELECTED VALUE = "">Select Participant...</OPTION>
		    		<?PHP
		    			$allParticipants = getall_participants();
		    			foreach($allParticipants as &$value) {
		    				$val = $value->get_id();
		    				$log = retrieve_dbParticipantEntry($dt.$val);
		    				if ($log == null) {
		    					echo "<OPTION VALUE='",$val,"'>";
		    					echo $value->get_last_name(),", ",$value->get_first_name();
		    					echo "</OPTION>";
		    				}
		    			}
               		?>
        		</SELECT>
            </DIV>
            
			<DIV STYLE="TOP:457; MARGIN-LEFT: 15; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    		<IMG SRC="images/result.png"/>
			</DIV>
			<DIV STYLE=" TOP: 470; MARGIN-LEFT: 195; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
                <SELECT NAME = "Result" TITLE="Choose 'H' for 'Had to Call', 'C' for 'Called Contact', 'D' for 'Called Dispatch', else leave blank.">
    			    <OPTION VALUE = OK></OPTION>
    			    <OPTION VALUE = C>C</OPTION>
   			    	<OPTION VALUE = H>H</OPTION>
   			    	<OPTION VALUE = D>D</OPTION>
                </SELECT>
	    	</DIV>
	    	
			<DIV STYLE="TOP:520; MARGIN-LEFT: 15; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    		<IMG SRC="images/note.png"/>
			</DIV>
			<DIV STYLE=' TOP: 532; MARGIN-LEFT: 195; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;'>
				<TEXTAREA NAME="Notes" COLS="28" ROWS="5" STYLE="font-family:arial; resize: none;" TITLE="Enter Notes Here"></TEXTAREA>
				<?php
					$vol = $_SESSON['_id'];
					echo "<INPUT TYPE='hidden' NAME='Volunteer' TITLE='Volunteer' ";
					echo "VALUE='", $vol, "'/>";
				?><BR><BR>				
				<INPUT TYPE="submit" onmouseover="this.style.cursor = 'hand';" CLASS="button_submit" VALUE="" TITLE="Submit Participant" ONCLICK="javascript: FORM1.action='insertDL.php'"/>
            </DIV>
            
            <DIV STYLE="TOP:332; MARGIN-LEFT: 515; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    		<IMG SRC="images/dnotes.png"/>
			</DIV>
			<DIV STYLE=" TOP: 335; MARGIN-LEFT: 725; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
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
									echo "<TD>No notes today.</TD>";
								}
    						?>
						</TR>
					</TABLE>
				</DIV>
 				<BR>
        		<TEXTAREA NAME="dNotes" COLS="28" ROWS="2" STYLE="font-family:arial; resize: none;" TITLE="Enter Daily Notes Here"></TEXTAREA>
        		<BR><BR><INPUT TYPE="submit" ONMOUSEOVER="this.style.cursor = 'hand';" CLASS="button_save" TITLE="Save Note" VALUE="" ONCLICK="javascript: FORM1.action='insertDL.php'"/>
        	</DIV>
        	
			
        </FORM>
        
        <FORM ID="FORM2" METHOD = "get">
        	<DIV STYLE="TOP:520; MARGIN-LEFT: 515; POSITION:ABSOLUTE; Z-INDEX: 1; VISIBILITY: show;">
	    		<IMG SRC="images/participants.png"/>
			</DIV>
	    	<DIV STYLE=" TOP: 532; MARGIN-LEFT: 728; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
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
                <INPUT TYPE="submit" ONMOUSEOVER="this.style.cursor = 'hand';" STYLE="FLOAT: LEFT;" CLASS="button_info" VALUE="" TITLE="Participant Information" ONCLICK="javascript: FORM2.action='participantInfo.php'"/> 
				<?php echo "<A STYLE='FLOAT: RIGHT;' HREF='notepad.php?date=".$dt."' TITLE='See Notepad' ONMOUSEOVER='this.style.cursor = 'hand';'><img src='images/button_notes.png'/></A>"; ?>
            </DIV>
        </FORM>
        <DIV STYLE=" TOP: 295; MARGIN-LEFT: 485; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
	    	<img src="images/vl.png" height="590" width="5"/>
		</DIV>
		
		<BR clear="all">
		<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
		<?PHP include('footer.inc');?>	
		<BR>
        </DIV>     
        </DIV>     
    </BODY>     
</HTML>        