<?php
try{
$pdo = new PDO('mysql:host=link;dbname=database_name', 'login','password');
//$pdo = new PDO('mysql:host=localhost;dbname=isklep', 'root','');
} catch(PDOException $e) {
  exit('Błąd');
}
?>
