<?php
include "../../apirest/config.php";
include "../../apirest/utils.php";


$dbConn =  connect($db);

/*
  listar todas las lecturas o solo una
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['StrIds']))
    {
      //Mostrar medidores no registrados en app móvil
      $filtro = $_GET['StrIds'];
      $txtSql="
        SELECT
        Id as IdServer,
        Fecha,
        Anterior,
        Actual,
        Consumo,
        Basico,
        Exceso,
        Observacion,
        Estado=1,
        Latitud,
        Longitud,
        Medidor_id,
        User_id,
        Created_at,
        Updated_at
        FROM `lecturas` 
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
      //Mostrar lista de lecturas
      $sql = $dbConn->prepare("SELECT * FROM lecturas");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll());
      exit();
  }
}

// Crear una nueva lectura
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    try
    { 
    $input = $_POST;
    $sql = "INSERT INTO lecturas
          (fecha,anterior,actual,consumo,basico,exceso,observacion,imagen,latitud,longitud,estado,medidor_id,user_id,created_at,updated_at)
          VALUES
          (:Fecha,:Anterior, :Actual,:Consumo,:Basico,:Exceso,:Observacion,:Imagen,:Latitud,:Longitud,:Estado,:Medidor_id,:User_id,:Created_at,:Updated_at)";
    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);
    $statement->execute();
    $lecturaId = $dbConn->lastInsertId();
    if($lecturaId)
    {
      $input['idServer'] = $lecturaId;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
   }
    }
   catch (PDOException $e)
    {
        header("HTTP/1.1 400 Bad Request");
    }
}

//Borrar
if ($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
  $id = $_GET['id'];
  $statement = $dbConn->prepare("DELETE FROM lecturas where id=:id");
  $statement->bindValue(':id', $id);
  $statement->execute();
  header("HTTP/1.1 200 OK");
  exit();
}

//Actualizar
if ($_SERVER['REQUEST_METHOD'] == 'PUT')
{
    $input = $_GET;
    echo $input['id'];
    $lecturaId = $input['id'];
    $fields = getParams($input);

    $sql = "
          UPDATE lecturas
          SET $fields
          WHERE id='$lecturaId'
           ";

    $statement = $dbConn->prepare($sql);
    bindAllValues($statement, $input);

    $statement->execute();
    header("HTTP/1.1 200 OK");
    exit();
}


//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Bad Request");

?>