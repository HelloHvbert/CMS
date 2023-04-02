<?php
session_start();
include_once('../includes/connect.php');
include_once('../includes/produkt.php');
$produkt= new Produkt;
$produkty=$produkt->fetch_all();
$error;




if($_SESSION['zalog']){
  if(isset($_GET['id'])){
    $id=$_GET['id'];
    $dane= $produkt->fetch_data($id);


  }else
  header("Location: index.php");
}else
  header("Location: index.php");

  if(isset($_POST['zapisz'])){
    $nazwa= $_POST['nazwa'];
    $opis=$_POST['opis'];
    $cena_netto=$_POST['cena_netto'];
    $cena_brutto=$_POST['cena_brutto'];
    $ilosc=$_POST['ilosc'];
    if($opis=="") $opis=null;
    if(empty($nazwa) or empty($cena_netto) or empty($cena_brutto) or empty($ilosc)) {
      $error="<small style='color:#aa0000;'>"."Wszystkie pola oprócz opisu są wymagane"."</small>";
    }else{
      $query=$pdo->prepare("UPDATE produkty SET nazwa=?,opis=?,cena_netto=?,cena_brutto=?,ilosc=? WHERE id_produkt=?");
          $query->bindValue(1,$nazwa); $query->bindValue(2,$opis); $query->bindValue(3,$cena_netto);
          $query->bindValue(4,$cena_brutto); $query->bindValue(5,$ilosc); $query->bindValue(6,$id);
          $query->execute();
          $error="<small style='color:#00FF00;'>"."Produkt zapisano."."</small>";;
    }
  }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Store name</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <center>
  <div class="container">
    <a href="index.php" id="logo">Store name</a><br>
    <h2>Edytuj produkt</h2>
     <?php if(isset($error)) echo $error ?>
    <form action="edit.php?id=<?php echo $dane['id_produkt']; ?>" method="post" autocomplete="off" ><br><br>
      <label>Nazwa produktu</label><br>
      <input type="text" name="nazwa" placeholder="Nazwa" value="<?php echo $dane['nazwa'] ?>"><br><br>
      <label>Opis</label><br>
      <textarea name="opis" rows="10" cols="40" placeholder="Opis" ><?php echo $dane['opis']; ?></textarea><br><br>
      <label>Cena netto (zł)</label><br>
      <input type="number" step="0.01" name="cena_netto" placeholder="cena_netto" min="0" size="5" value="<?php echo $dane['cena_netto'] ?>"><br><br>
      <label>Cena brutto (zł)</label><br>
      <input type="number" step="0.01" name="cena_brutto" placeholder="cena_brutto" min="0" size="5" value="<?php echo $dane['cena_brutto'] ?>"><br><br>
      <label>Ilość</label><br>
      <input type="number" name="ilosc" placeholder="Ilość" min="0" value="<?php echo $dane['ilosc'] ?>"><br><br><br>
      <input type="submit" name="zapisz" value="Zapisz produkt">
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<center>
</body>
</html>
