<?php
/*
 * Created on Mar 28, 2008
 * @author Oliver Radwan 
 */
?>
<?PHP
	session_start();
	session_cache_expire(30);
?>
<html>
	<head>
		<meta HTTP-EQUIV="REFRESH" content="2; url=index.php">
		<title>
			Logged out of Homecheck
		</title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<?PHP include('header.php');?>
			<div id="content">
				<?PHP
					session_unset();
					session_write_close();
				?>
				<p>You are now logged out of Homecheck.</p>
			</div>
			<?PHP include('footer.inc');?>
		</div>
	</body>
</html>