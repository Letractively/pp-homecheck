<?PHP
	session_start();
	session_cache_expire(30);
?>
<html>
	<head>
		<title>
			About
		</title>
		<link rel="stylesheet" href="styles.css" type="text/css" />
	</head>
	<body>
		<div id="container">
			<?PHP include('header.php');?>
			<div id="content">
				<p>Background<br /><br />
				  
	<i>Homecheck</i> is a web-based volunteer scheduling and call-in support system developed at <a href="http://www.bowdoin.edu/computer-science">
	Bowdoin College</a> for <a href="http://peopleplusmaine.org/"">People Plus in Brunswick, Maine</a>.  
				 It was implemented in 2012 by three Bowdoin students (Alex Edison, Nicole Erkis, and Ruben Martinez) and an instructor (Allen Tucker). 
				<p>
				This project was supported by Bowdoin College as part of its ongoing commitment to serving the common good. It was inspired by the 
				<a href="http://www.hfoss.org/">Humanitarian Free and Open Source (HFOSS) Project</a>, which aims to "build a community of academic computing departments,
				IT corporations, and local and global humanitarian and community organizations dedicated to
				building and using Free and Open Source Software to benefit humanity."
				
 <p>System Access and Reuse<br /><br />
Because <i>Homecheck</i> must protect the privacy of individual volunteers and participants, access to the system by non-volunteers is
limited.  If you are a volunteer and have forgotten your Username or Password, please contact the <a href="mailto:madeleine@ashe.com">Program Coordinator</a>.
                </p>
				<p> <i>Homecheck</i> is free and open source software (see <a href="http://code.google.com/p/pp-homecheck/">http://code.google.com/p/pp-homecheck/</a>).  
				From this site, its source code can be freely downloaded and adapted
				 to fit the scheduling call-in support needs of other community organizations.  For more information about the capabilities or adaptability of <i>Homecheck</i> to other settings, please contact
either <a href="mailto:allen@myopensoftware.org">Allen Tucker</a> or visit the website <a href="http://myopensoftware.org/content/software-projects">http://myopensoftware.org</a>.
				</p>
				
			</div>
		<?PHP include('footer.inc');?>
		</div>
	</body>
</html>
