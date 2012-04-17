<?php 
session_start();
session_cache_expire(30);
?>
<HTML>
  <HEAD>
    <TITLE>Monthly Schedule List</TITLE>   
    <link rel="stylesheet" href="styles.css" type="text/css"/>
    <link type="text/css" rel="stylesheet" href="data:text/css,"/>
  </HEAD>
  <BODY>
    <DIV id="container">
      <?php include('header.php');?>
      <DIV id="content">
	<?php include_once('database/dbMonths.php');?>
      </DIV>
      <h1> Monthly Schedule List </h1>
      <DIV>
	<?php
	    $monthList = getall_Months();
	    foreach($monthList as $month){
	      $status=$month->get_status();
	      if($status =='published'){
		$monthNo = substr($month->get_id(),-2);
		$year=substr($month->get_id(),0,2);
		$monthTime=mktime(0,0,0,$monthNo,1,$year);
		echo '<a href =viewMonthlySched.php?Month='.$monthNo.'&Year='.$year.'>';
		echo date("F",$monthTime)." ".date("Y", $monthTime);
		echo '</a><br/>';
	      }
	    }
	?>
      </DIV>
      <?php include('footer.inc');?>
    </DIV>
  </BODY>
</HTML>