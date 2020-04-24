<?php
function conectarse()//función para conectar a la base de datos
{
$conn = new mysqli("localhost", "root", "", "baselecturas");//datos de conexíon
if ($conn->connect_errno) {//funcíon que controla si hay un error
    echo "Fallo al conectar a MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}
return ($conn);//retorna la variable con la conexión válida
}
?>