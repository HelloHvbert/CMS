<?php
session_start();
include_once('../includes/connect.php');

if($_SESSION['zalogowany']){
$query=$pdo->prepare("SELECT * FROM klienci WHERE id_klient=?");
$query->bindValue(1, $_SESSION['uzytkownik']);
$query->execute();
$adres=$query->fetch();

if(isset($_POST['address'])){
  $miasto=$_POST['miasto'];
  $ulica=$_POST['ulica'];
  $nr_dom=$_POST['nr_dom'];
  $poczta=$_POST['poczta'];
  $tel=$_POST['tel'];
  if(empty($miasto) or empty($ulica) or empty($nr_dom) or empty($poczta) or empty($tel)){
    echo "<script>alert('Uzupełnij wszystkie dane')</script";
  }else{
    $query1=$pdo->prepare("INSERT INTO adres VALUES(null,?,?,?,?,?)");
    $query1->bindValue(1,$miasto); $query1->bindValue(2,$ulica); $query1->bindValue(3,$nr_dom); $query1->bindValue(4,$poczta);$query1->bindValue(5,$tel);
    $query1->execute();
    $query2=$pdo->prepare("SELECT * FROM adres WHERE id_adres=(SELECT id_adres from adres order by id_adres desc limit 1)");
    $query2->execute();
    $id_adres=$query2->fetch();
    $query3=$pdo->prepare("UPDATE klienci SET id_adres =? WHERE id_klient=?");
    $query3->bindValue(1,$id_adres['id_adres']); $query3->bindValue(2,$_SESSION['uzytkownik']);
    $query3->execute();
    header("Location: zakup.php");
  }

}


if($adres['id_adres']==0){ ?>

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
      <h2>Dane do dostawy</h2>
      <form action="adres.php" method="post">
<div class="form-group col-md-6">
  <label for="miasto">Miasto</label>
  <input type="text" name="miasto" class="form-control" size="5" id="miasto" ><br>
</div>
<div class="form-group col-md-6">
  <label for="ulica" >Ulica</label>
  <input type="text" name="ulica" class="form-control" id="ulica" ><br>
</div>
<div class="form-group col-md-6">
  <label for="nr_dom">Numer domu</label>
  <input type="text" name="nr_dom" class="form-control" id="nr_dom" ><br>
</div>
<div class="form-group col-md-6">
  <label for="poczta">Kod pocztowy</label>
  <input type="text" name="poczta" class="form-control" id="poczta" pattern="^[0-9]{2}-[0-9]{3}$"><br>
</div>
<div class="form-group col-md-6">
  <label for="tel">Numer telefonu</label>
  <input type="text" name="tel" class="form-control" id="tel" pattern="[0-9]{9}"><br>
</div>
<button type="submit" name="address" class="btn btn-primary">Przejdź dalej</button>
</form><br>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <center>
  </body>
  </html>




<?php
}else{
header("Location: zakup.php");
}
?>



<?php
}else
header('Location: ../index.php');
?>
