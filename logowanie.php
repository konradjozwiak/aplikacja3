<?php
ini_set( 'display_errors', 'Off' ); 
session_start();
$_SESSION["zalogowany"]; 
if(empty($_SESSION["zalogowany"])){
	$_SESSION["zalogowany"]=0; 
}
		$servername = "serwer1699338.home.pl";
		$username = "21777739_jozwiak";
		$password = "zaq1@WSX";
		$dbname = "21777739_jozwiak";

$polaczenie = @mysql_connect($servername, $username, $password )
or die('Brak po³¹czenia z serwerem MySQL.<br />B³¹d: '.mysql_error()); 
 
$bazadanych = @mysql_select_db($dbname, $polaczenie) 
or die('Nie mogê po³¹czyæ siê z baz¹ danych<br />B³¹d: '.mysql_error()); 

function PokazLogin($komunikat=""){
	echo "$komunikat<br>";
	echo "<form method=post>";
	echo "Login: <input type=text name=login><br>";
	echo "Haslo: <input type=password name=haslo><br>";
	echo "<input type=submit value='Zaloguj!'>";
	echo "</form>";
	}
?>

<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
</head>
<body>
<?php
if($_GET["wyloguj"]=="tak"){
	$_SESSION["zalogowany"]=0;
	echo "Zostales wylogowany z serwisu";
}
	$log = $_POST["login"];
	$data = new DateTime();
	$data = date('Y-m-d');
	$godzina = new DateTime();
	$godzina = date('H:i:s');

if($_SESSION["zalogowany"]!=1){
	if(!empty($_POST["login"]) && !empty($_POST["haslo"])){
		if(mysql_num_rows(mysql_query("SELECT * from users where user = '".htmlspecialchars($_POST["login"])."' AND pass = '".htmlspecialchars($_POST['haslo'])."'"))){

			$query1 = mysql_query("INSERT INTO logi (idLogowania,user,data,godzina,liczba_logowan) VALUES ('','$log','$data','$godzina','0')") or die('Blad zapytania');
			echo "Zalogowano poprawnie. Przejdz do
			<a href='apka.php'> strony glownej</a>";
			$_SESSION["zalogowany"]=1;
			$_SESSION['login']=$_POST['login'];
			}
		else {
			echo PokazLogin("Podaj poprawne dane!");

			$attempt_count = intval(@$_COOKIE["login_count"]); 
			if($attempt_count > 3){
   				die("Too many attempts");
			}
			$query2 = mysql_query("SELECT liczba_logowan From logi WHERE user = '$log'") or die('Blad zapytania2');
			if(mysql_num_rows($query2) > 0) { 
    				while($row = mysql_fetch_array($query2)) {
					$liczba = array();
					$liczba = $row["liczba_logowan"];
					$liczba=$liczba+1;
					$query3 = mysql_query("UPDATE logi SET data='$data', godzina='$godzina', liczba_logowan='$liczba' WHERE user = '$log'") or die('Blad zapytania3');
					if ($liczba > 3) {
						setcookie("login_count", $login_count+1, time()+600);
						//echo $liczba;
					}
				}
			} 
		}
		
		
		}
	else PokazLogin();
}
else{

echo "<h2>Witaj uzytkowniku   $log </h2>"; 
echo "$log";
echo "<a href='index.php?wyloguj=tak'>wyloguj sie</a>";
}

mysql_close($polaczenie);
?>
</body>
</html>
