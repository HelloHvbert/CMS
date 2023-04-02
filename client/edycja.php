<?php
include_once('../includes/connect.php');
include_once('../includes/produkt.php');
$produkt= new Produkt;
$produkty=$produkt->fetch_all();

?>
