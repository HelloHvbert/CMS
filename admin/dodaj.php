<?php
session_start();

include_once('../includes/connect.php');


if(isset($_SESSION['zalog'])){
    if(isset($_POST['nazwa'],$_POST['cena_netto'],$_POST['ilosc'])){
      $nazwa = $_POST['nazwa']; $cena_netto = $_POST['cena_netto']; $ilosc = $_POST['ilosc'];
      $opis=nl2br($_POST['opis']);

      $file=$_FILES['file'];
      $filename=$_FILES['file']['name'];
      $filetmpname=$_FILES['file']['tmp_name'];
      $filesize=$_FILES['file']['size'];
      $fileerror=$_FILES['file']['error'];
      $filetype=$_FILES['file']['type'];

      $allowed=array('jpg','jpeg', 'png');
      $fileExt=explode('.',$filename);
      $fileActualExt=strtolower(end($fileExt));

      if(empty($nazwa) or empty($cena_netto) or empty($ilosc) or empty($file)  ){
        $error = "<small style='color:#aa0000;'>"."Wszystkie pola oprócz opisu są wymagane"."</small>";
      }else{

        $sent=false;


      	if(in_array($fileActualExt, $allowed)){
      		if($fileerror===0){
      			if($filesize <500000){
      				$filenamenew= uniqid('',true).'.'.$fileActualExt;

      				$filedestination = '../zdjecia/'.$filenamenew;
      				move_uploaded_file($filetmpname,$filedestination);
              $sent=true;
      			}else{
      				echo "Ten plik jest za duży";
      			}

      		}else{
      			echo "Wystąpił błąd podczas przesyłania";
      		}
      	}else
      		echo "Nie możesz przesyłać plików tego typu";

          if($sent){
        $query= $pdo->prepare("INSERT INTO produkty (id_kategoria,id_producent,nazwa,opis,zdjecie,cena_netto,cena_brutto,ilosc,data_dod) VALUES
        (1,1,?,?,?,?,?,?,?)");
        $query->bindValue(1,$nazwa); $query->bindValue(2,$opis); $query->bindValue(3,"zdjecia/".$filenamenew);$query->bindValue(4,$cena_netto); $query->bindValue(5,$cena_netto*1.23); $query->bindValue(6,$ilosc);$query->bindValue(7,date('Y-m-d H:i'));
        $query->execute();
      }
      }
    }

  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <title>Store name</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/style.css" type="text/css" />
  </head>
  <body>
    <div class="container">
      <a href="index.php" id="logo">Store name</a><br>
      <h2>Dodaj produkt</h2>
       <?php if(isset($error)) echo $error ?>
      <form action="dodaj.php" method="post" autocomplete="off" enctype="multipart/form-data"><br><br>
        <label>Nazwa produktu</label><br>
        <input type="text" name="nazwa" placeholder="Nazwa"><br><br>
        <label>Zdjęcie</label><br>
        <input type="file" name="file"><br><br>
        <label>Opis</label><br>
        <textarea name="opis" rows="10" cols="40" placeholder="Opis"></textarea><br><br>
        <label>Cena netto</label><br>
        <input type="number" step="0.01" name="cena_netto" placeholder="cena_netto" min="0" size="5" ><br><br>
        <label>Ilość</label><br>
        <input type="number" name="ilosc" placeholder="Ilość" min="0"><br><br><br>
        <input type="submit" value="Dodaj produkt">
      </form>
      <a href="index.php" > Wróc</a>
    </div>
  </body>
  </html>
<?php
}else header("Location: index.php");
?>
