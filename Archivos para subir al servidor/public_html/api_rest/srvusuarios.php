<?php
include "../../apirest/config.php";
include "../../apirest/utils.php";


$dbConn =  connect($db);

/*
  listar los usuarios que no esten registrados en la app móvil
 */
if ($_SERVER['REQUEST_METHOD'] == 'GET')
{
    if (isset($_GET['StrIds']))
    {
      //Mostrar medidores no registrados en app móvil
      $filtro = $_GET['StrIds'];
    $txtSql="
        select
        u.Id,
        u.Email,
    u.Sector,
        u.Password,
        r.Name as Role,
        u.Created_at,
        u.Updated_at,
        u.Name
        from users u, roles r, role_user ru
        where 
        u.id=ru.user_id
        AND
        r.id=ru.role_id
        AND
        u.id not in
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
      $sql = $dbConn->prepare("SELECT * FROM users");
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