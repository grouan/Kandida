<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

	
<body bgcolor="#FFFFFF">
<h1>Atom 2.0 Demo Direct</h1>
<hr>
<div id="zone" > Loads directly an Atom file and displays the list of recent articles. 
</div>

<br>
<p>
<?php
	require_once("atomlib.php");
	$url = "http://www.xul.fr/atom.xml";
	echo Atom_Display($url, 25);
?>

</p>
</body>
</html>
