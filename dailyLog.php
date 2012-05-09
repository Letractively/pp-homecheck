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
    <TITLE>Daily Log - <?PHP echo date('m/d/y');?></TITLE>   
    <LINK REL="icon"  TYPE="image/png" HREF="images/DLfavicon.png">
	<LINK REL="stylesheet" HREF="styles.css" TYPE="text/css">
	<LINK TYPE="text/css" REL="stylesheet" HREF="data:text/css,">
	<STYLE TYPE="text/css"> 
		body {
			min-width: 1024px;
			overflow:scroll;
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
	     table.tbl {
			font-family: verdana,arial,sans-serif;
			font-size:12px;
			color:#000000;
			align: left;
			border-width: 0px;
			border-color: #000000;
			border-collapse: collapse;
		}
		table.tbl th {
			border-width: 0px;
			padding: 8px;
			text-align: center;
			border-style: solid;
			border-color: #000000;
			background-color: transparent;
		}
		table.tbl td {
			border-width: 0px;
			padding: 8px;
			text-align: left;
			border-style: solid;
			border-color: #000000;
			background-color: transparent;
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
               	if (-1 == ent.indexOf(el.value.charAt(intLoop))) event.returnValue=false;
            	if (!event.returnValue) {       // Bad value
            		alert("Invalid Time Entry! \nPlease enter in format 12:00, 08:00, or 9:00");
               		el.className = "badValue"; // Change class
		    	}
            	else el.className="";       
            }
	</SCRIPT>
    </HEAD>     
    <BODY> 
    	<DIV ID="container">
    	<?PHP include('header.php');?>
		<DIV ID="content" align="left">
		<FORM ID="FORM1" METHOD="POST" ACTION="insertDL.php" AUTOCOMPLETE="off">
			<DIV STYLE=" TOP: 175px; MARGIN-LEFT: 15px; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            	<TABLE CLASS="tbl"><TR STYLE="vertical-align: top"><TD>
            		<IMG SRC="images/DailyLogLogo.png" WIDTH="59" HEIGHT="73"/>
            		</TD><TD>
	        		<IMG SRC="images/DailyLog.png"/>
	        		</TD>
	        		<?php 
						if ($submitted != null){
							echo "<TH STYLE=\"min-width: 500px;\">";
            	  			$subPart = retrieve_dbParticipants($submitted);
            	    		$name = $subPart->get_first_name()." ".$subPart->get_last_name();
            	    		echo "<BR><BR>";
            	    		echo "<H2 style='color: red'>&#10004; Submitted Log for ";
            	    		echo $name;
            	    		echo "</H2></TH>";
            			}
            		?>
            		</TR>
	        	</TABLE> 
        	</DIV>
        	<!--All images with text use Ariel 14pt font-->
        	<DIV STYLE="TOP: 242px; MARGIN-LEFT: 105px; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
            	<?PHP echo date('F d, Y');?>
        	</DIV><BR><BR><BR><BR><BR><BR><BR>
        	
        	<TABLE CLASS="tbl"><TR STYLE="vertical-align: top"><TD>
        	<TABLE><TR><TD>
			<IMG SRC="images/time.png" TITLE="Enter a valid time entry, such as 09:00 or 12:00"/>
			</TD><TD>
			<INPUT TYPE="hidden" NAME="Date" STYLE="WIDTH:0px; " MAXLENGTH="8" TITLE="Enter Date" Value="<?php echo $dt ?>"/>
            <INPUT REQUIRED="" TYPE="text" NAME="Time1" ID="Time1" STYLE="WIDTH:30px; " MAXLENGTH="2" ONCHANGE="validateTime();" TITLE="Enter Time, HH" ONKEYUP="moveOnMax(this,'Time2')"/>:<INPUT REQUIRED="" TYPE="text" NAME="Time2" ID="Time2" STYLE="WIDTH:30px; " MAXLENGTH="2" ONCHANGE="validateTime();" TITLE="Enter Time, MM"/>
			<SELECT NAME = "AP" TITLE="Select AM or PM">
    		    <OPTION VALUE = A>AM</OPTION>
    		    <OPTION VALUE = P>PM</OPTION>
            </SELECT><I><FONT COLOR="333333"> e.g. 09:15</FONT></I><BR>
            </TD></TR><TR><TD>
            <IMG SRC="images/participant.png" TITLE="Begin typing participant last name for fast searching"/>
            </TD><TD>
			<SELECT REQUIRED="" NAME = "Participant" STYLE = "WIDTH: 187" TITLE="Begin typing participant last name for fast searching">
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
        	</TD></TR><TR><TD>
            <IMG SRC="images/result.png" TITLE="Choose 'H' for 'Had to Call', 'C' for 'Called Contact', 'D' for 'Called Dispatch', else leave blank"/>
            </TD><TD>
			<SELECT NAME = "Result" TITLE="Choose 'H' for 'Had to Call', 'C' for 'Called Contact', 'D' for 'Called Dispatch', else leave blank">
    			<OPTION VALUE = OK></OPTION>
    			<OPTION VALUE = C>C</OPTION>
   			   	<OPTION VALUE = H>H</OPTION>
   			    <OPTION VALUE = D>D</OPTION>
            </SELECT>
            </TD></TR><TR><TD STYLE="vertical-align: top">
            <IMG SRC="images/note.png" TITLE="Enter Notes in textbox."/>
            </TD><TD>
			<TEXTAREA NAME="Notes" COLS="28" ROWS="5" STYLE="font-family:arial; resize: none;" TITLE="Enter Notes Here"></TEXTAREA><BR><BR>
			<INPUT TYPE="submit" onmouseover="this.style.cursor = 'hand';" CLASS="button_submit" VALUE="" TITLE="Submit this Participant Entry"/>
			</TD></TR>
			<?php
				$vol = $_SESSON['_id'];
				echo "<INPUT TYPE='hidden' NAME='Volunteer' TITLE='Volunteer' ";
				echo "VALUE='", $vol, "'/>";
			?>	
			</TD></TR></TABLE>
        </FORM>
        </TD><TD>
        <TABLE><TR><TD style = "vertical-align: top">
        <FORM ID="FORM3" METHOD="POST" ACTION="insertDL.php">
	        <INPUT TYPE="hidden" NAME="Date" STYLE="WIDTH:0px; " MAXLENGTH="8" TITLE="Enter Date" Value="<?php echo $dt ?>"/>
        	<IMG SRC="images/dnotes.png" TITLE="Enter Daily Notes in the textbox"/>
			</TD><TD STYLE="table-layout:fixed; width: 200px;"><BR>
			<?php 
				$dl = retrieve_dbDailyLogs($dt);
				if ($dl != null) {
					$nts = $dl->get_note();
					if($dl == null || $nts == null) echo "No notes today.";
					else echo "\"".$nts."\"";
				}
				else echo "No notes today.";
    		?><BR><BR>
    		<TEXTAREA NAME="dNotes" COLS="28" ROWS="3" MAXLENGTH="180" STYLE="font-family:arial; resize: none;" TITLE="Enter Daily Notes Here"></TEXTAREA><BR><BR>
			<INPUT TYPE="submit" ONMOUSEOVER="this.style.cursor = 'hand';" CLASS="button_save" TITLE="Save this note" VALUE=""/>
			</TD></TR>
		</FORM>
		<TR><TD style = "vertical-align: top">
		<FORM ID="FORM2" METHOD = "get" ACTION="participantNotes.php">
        	<IMG SRC="images/participants.png" TITLE="Select a Participant from the list"/>
        	</TD><TD><BR>
        	<INPUT TYPE="hidden" NAME="date" STYLE="WIDTH:0px; " MAXLENGTH="8" TITLE="Enter Date" Value="<?php echo $dt ?>"/>
			<SELECT NAME = "id" TITLE="Select a Participant" STYLE = "WIDTH: 190" required>
				<OPTION SELECTED VALUE = "">Select Participant...</OPTION>
				<?PHP
		    		$allParticipants = getall_participants();
		    		foreach($allParticipants as &$value) {
						echo "<OPTION VALUE='",$value->get_id(),"'>";
		    			echo $value->get_first_name()," ",$value->get_last_name();
		    			echo "</OPTION>";
		    		}
               	?>
       		</SELECT><BR><BR>
       		<?php echo "<INPUT TYPE=\"submit\" ONMOUSEOVER=\"this.style.cursor = 'hand';\" STYLE=\"FLOAT: LEFT;\" CLASS=\"button_info\" VALUE=\"\" TITLE=\"See Selected Participant's Log\"/>"; ?> 
		</FORM>
        <?php echo "<A STYLE='FLOAT: RIGHT;' HREF='notepad.php?date=".$dt."' TITLE='See Daily Notepad' ONMOUSEOVER='this.style.cursor = 'hand';'><img border=0 src='images/button_notes.png'/></A>"; ?>
        </TD></TR></TABLE>
        </TD></TR></TABLE>
        <DIV STYLE=" TOP: 275; MARGIN-LEFT: 390; POSITION: absolute; Z-INDEX: 1; VISIBILITY: show;">
	    	<img src="images/vl.png" height="320" width="3"/>
		</DIV>
		<BR clear="all">
		<?PHP include('footer.inc');?>	
		<BR>
        </DIV>     
        </DIV>     
    </BODY>     
</HTML>