<?php
include "config.php";
include "utils.php";


$dbConn =  connect($db);

/*
  listar todas las lecturas o solo una
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['id']))
    {
      //Mostrar un post
      $sql = $dbConn->prepare("SELECT * FROM lecturas where id=:id");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode(  $sql->fetch(PDO::FETCH_ASSOC)  );
      exit();
    }
    else {
      //Mostrar lista de post
      $sql = $dbConn->prepare("SELECT * FROM lecturas");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll()  );
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