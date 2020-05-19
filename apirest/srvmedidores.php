<?php
include "config.php";
include "utils.php";


$dbConn =  connect($db);

/*
  listar los medidores que no esten registrados en la app móvil
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['StrIds']))
    {
      //Mostrar medidores no registrados en app móvil
      $filtro = $_GET['StrIds'];
      $txtSql="
        SELECT
        Id,
        Codigo,
        Numero,
        Sector,
        Imagen,
        Estado,
        Persona_id,
        Created_at,
        Updated_at
        FROM `medidors` 
        WHERE 
        id not in
        "."(".$filtro.")";
        $sql = $dbConn->prepare($txtSql);
        $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetchAll());
      exit();
    }
    else {
      //Mostrar lista de abonados
      $sql = $dbConn->prepare("SELECT * FROM medidores");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll());
      exit();
  }
}
//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>