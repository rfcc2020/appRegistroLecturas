<?php
include "config.php";
include "utils.php";


$dbConn =  connect($db);

/*
  listar todas las lecturas o solo una
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    
    if (isset($_GET['StrIds']))
    {
      //Mostrar abonados no registrados en app móvil
      $filtro = $_GET['StrIds'];
        $txtSql="
      SELECT 
      Id,
      Cedula,
      Nombre,
      Apellido,
      Telefono,
      Email,
      Created_at,
      Updated_at
      FROM personas 
      WHERE 
      id not in  
      "."(".$filtro.")";
      try
    {
      $sql = $dbConn->prepare($txtSql);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetchAll() );
      exit();
    }
    catch (PDOException $e)
    {
        header("HTTP/1.1 400 Bad Request");
    }
    }
    
    else {
      //Mostrar lista de abonados
      $sql = $dbConn->prepare("SELECT * FROM personas");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
      exit();
  }
    
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>