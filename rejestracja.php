<?php

		$servername = "serwer1699338.home.pl";
		$username = "21777739_jozwiak";
		$password = "zaq1@WSX";
		$dbname = "21777739_jozwiak";

//��czenie si� z serwerem bazy danych
$polaczenie = @mysql_connect($servername, $username, $password )
or die('Brak po��czenia z serwerem MySQL.<br />B��d: '.mysql_error()); 
 
//��czenie si� z konkretn� baz� danych na serwerze
$bazadanych = @mysql_select_db($dbname, $polaczenie) 
or die('Nie mog� po��czy� si� z baz� danych<br />B��d: '.mysql_error());   

function ShowForm($komunikat=""){	//funkcja wy�wietlaj�ca formularz rejestracyjny
	echo "$komunikat<br>";
	echo "<form action='rejestracja.php' method=post>";
	echo "Login: <input type=text name=login><br>";
	echo "Haslo: <input type=password name=haslo><br>";
	echo "<input type=hidden value='1' name=send>";
	echo "<input type=submit value='Zarejestruj mnie'>";
	echo "<br><br><a href='index.php'>Powrot do strony glownej</a>";
	echo "</form>";
}
?>
<!DOCTYPE html 
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<title>Rejestracja uzytkownika</title>
</head>
<body>
<?php

if($_POST["send"]==1){	//sprawdzanie czy formularz zosta� wys�any
	if(!empty($_POST["login"]) && !empty($_POST["haslo"])){	//oraz czy uzupe�niono wszystkie dane
		$user = $_POST["login"];
		if(mysql_num_rows(mysql_query("SELECT * from users where user='".htmlspecialchars($_POST["login"]."'"))))ShowForm("Uzytkownik o podanym loginie juz istnieje!!!"); // sprawdzanie czy u�ytkownik o podanej nazwie ju� istnieje
		else{
			mysql_query("INSERT into users values(NULL, '".htmlspecialchars($_POST["login"])."', '".htmlspecialchars($_POST['haslo'])."')"); // zapisywanie rekordu do bazy
			mkdir ("./$user", 0777);
			echo "Rejestracja przebiegla pomyslnie. Mozesz teraz przejsc do <a href='index.php'>strony glownej</a> i sie zalogowac.";
			}
	}
	else ShowForm("Nie uzupelniono wszystkich pol!!!");
}
else ShowForm();
mysql_close(); //zamykanie po��czenia z baz�
?>
</body>
</html>