<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<title>konrad_jozwiak_z7</title>
</head>
<BODY>
<?php
ini_set( 'display_errors', 'Off' ); 
session_start();
$log2 = $_SESSION['login'];
	echo "Witaj uzytkowniku $log2"; 
?>
<h3>Aby przeslac plik przejdz do <a href="http://jozwiak.teleinfg2.bydgoszcz.pl/z7/wyslij.html"> uploadu</a></h3>

<h3>Aby pobrac plik przejdz do <a href="http://jozwiak.teleinfg2.bydgoszcz.pl/z7/odbierz.php"> downloadu</a></h3>

</BODY>
</HTML>