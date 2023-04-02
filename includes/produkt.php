<?php
class Produkt{
  public function fetch_all(){
      global $pdo;
      $query =$pdo->prepare('SELECT * FROM produkty');
      $query->execute();

      return $query->fetchAll();
  }

  public function fetch_data($id_produktu){
    global $pdo;

    $query =$pdo->prepare("SELECT * FROM produkty where id_produkt=?");
    $query->bindValue(1,$id_produktu);
    $query->execute();

    return $query->fetch();
  }
}
?>
