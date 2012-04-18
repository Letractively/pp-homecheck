<HTML>
  <HEAD>
    <TITLE>Write Participant</TITLE>
    <link rel="stylesheet" href="styles.css" type="text/css"></link>
    <link type="text/css" rel="stylesheet" href="data:text/css,"></link>
    <?php 
       echo('<meta http-equiv="Refresh" content="1;url=http://'.
      $_SERVER['SERVER_NAME'].'/pp-homecheck/viewParticipants.php"/>');
    ?>
  </HEAD>
  <BODY>
    <p>Saving Monthly Schedule</p>
    <?php 
      echo('<a href="http://'.$_SERVER['SERVER_NAME'].'/pp-homecheck/viewParticipants.php">Click here if you are not redirected back to the participant list.</a>');
      include_once('database/dbParticipants.php');
    ?>
  </BODY>
</HTML>