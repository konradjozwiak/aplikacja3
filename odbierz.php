<?php
$target_file = 'jozwiak.teleinfg2.bydgoszcz.pl/z7/Adam';
$max_rozmiar = 10000;
if (is_uploaded_file($_FILES['plik']['tmp_name'])) {
	if ($_FILES['plik']['size'] > $max_rozmiar) {
		echo "Przekroczenie rozmiaru $max_rozmiar"; 
	}
	else {
		echo 'Odebrano plik: '.$_FILES['plik']['name'].'<br/>';
		if (isset($_FILES['plik']['type'])) {
			echo 'Typ: '.$_FILES['plik']['type'].'<br/>'; 
		}
		move_uploaded_file($_FILES['plik']['tmp_name'],$_SERVER['DOCUMENT_ROOT'].$_FILES['plik']['name']);
		if (move_uploaded_file($_FILES["plik"]["tmp_name"], $target_file)) {
      			echo "<P>FILE UPLOADED TO: $target_file</P>";
   		} 
		else {
      			echo "<P>MOVE UPLOADED FILE FAILED!</P>";
      			print_r(error_get_last());
   		}
	}
}
else {
echo 'Błąd przy przesyłaniu danych!';
}
?>