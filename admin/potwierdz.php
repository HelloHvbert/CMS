<?php
session_start();
include_once('../includes/connect.php');

if(!$_SESSION['zalog']) header('Location: ../index.php');

if(isset($_POST['zatwierdz'])){



  $i=$_POST['orders'];
  if(empty($i) ) header('Location: index.php'); else{
    $qq=$pdo->prepare("UPDATE zamowienia SET czyPotwierdzone='1' WHERE id_zamowienie=?");
    $qq->bindValue(1,$i);
    $qq->execute();
    $qq2=$pdo->prepare("SELECT email from klienci WHERE id_klient=(SELECT id_klient FROM zamowienia WHERE id_zamowienie=?)");
    $qq2->bindValue(1,$i);
    $qq2->execute();
    $e=$qq2->fetch();
    $email=$e['email'];
    $to=$email;
    $subject="Potwierdzenie zamówienia";
    $body='
      Witaj
      Twoje zamówienie o numerze '.$i.' zostało potwierdzone.
      Niebawem zostanie wysłane i bezpiecznie dotrze do ciebie.
      Sklep MASNO' ;
    $headers = 'From:skklep123@gmail.com' . "\r\n";
    mail($to, $subject, $body,$headers);
    $qq3=$pdo->prepare("SELECT * FROM zamowienia_produkty WHERE id_zamowienie=?");
    $qq3->bindValue(1,$i);
    $qq3->execute();
    $zamowione=$qq3->fetchAll();
    foreach($zamowione as $produkt){
      $sql=$pdo->prepare("UPDATE produkty SET ilosc=ilosc-? WHERE id_produkt=?");
      $sql->bindValue(1,$produkt['ilosc']); $sql->bindValue(2,$produkt['id_produkt']);
      $sql->execute();
    }

  header("Location: index.php");
}
}

$query=$pdo->prepare("SELECT id_zamowienie,id_klient,zlozone FROM zamowienia WHERE czyPotwierdzone='0'");
$query->execute();
$zamowienia=$query->fetchAll();

if($query->rowCount()==0){
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
  <div class="container">
    <center><a href="index.php" id="logo"> Store name </a></center><br><br>
    <h1 class="text-center">Brak zamówień do potwierdzenia</h1>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

<?php } else { ?>
<!DOCTYPE html>
<html>
<head>
  <title>Store name</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/style.css" type="text/css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <a href="index.php" id="logo">Store name</a><br><br>
    <h1>Lista niezatwierdzonych zamówień</h1><br>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID zamowienia</th>
      <th scope="col">Klient</th>
      <th scope="col">Data złożenia zamowienia</th>

    </tr>
  </thead>
  <tbody>
    <?php foreach($zamowienia as $zam) {
      $q=$pdo->prepare("SELECT id_klient FROM zamowienia WHERE id_zamowienie=?");
      $q->bindValue(1,$zam['id_zamowienie']);
      $q->execute();
      $klient=$q->fetch();
      $q2=$pdo->prepare("SELECT * FROM klienci WHERE id_klient=?");
      $q2->bindValue(1,$klient['id_klient']);
      $q2->execute();
      $imie=$q2->fetch();
      ?>
    <tr>
      <th scope="row"><?php echo $zam['id_zamowienie'] ?></th>
      <td><?php echo $imie['imie'].' '.$imie['nazwisko'] ?></td>
      <td><?php echo $zam['zlozone'] ?></td>
    </tr>
<?php } ?>
  </tbody>
</table>
    <h2> Zaznacz zamówienie aby je zatwierdzić</h2>
    <form action="potwierdz.php" method="post">
      <div class="form-group">
  <select  class="form-control" name="orders" id="exampleFormControlSelect2">
      <?php
        foreach($zamowienia as $zam){
          echo "<option>".$zam['id_zamowienie']."</option>";
        }
      ?>

  <!--  </select>  -->
</select>
  </div>
  <button  class="btn btn-primary bg-success" name="zatwierdz">POTWIERDŹ</button>
    </form>

  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>
<?php } ?>
