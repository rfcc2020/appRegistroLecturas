<?php 
    require_once('../../datos/conexion.php');
    $conn=conectarse();
	if(isset($_GET['StrIds']))
	{
			$filtro = $_GET['StrIds'];
		    $txtSql="
			SELECT 
			Id,
			Cedula,
			Nombre,
			Apellido,
			Telefono,
			Email,
			Estado,
			Created_at,
			Updated_at
			FROM `personas` 
			WHERE 
			id not in  
			"."(".$filtro.")";
			$sentencia = $conn->prepare($txtSql);		
			if($sentencia->execute())
			{
				$datos = array();
				if($sentencia->bind_result($id,$cedula,$nombre,$apellido,$telefono,$email,$estado,$created_at,$updated_at))
					{
						while($sentencia->fetch())
						{
						array_push($datos,array(
						'Id'=>$id,
						'Cedula'=>$cedula,
						'Nombre'=>$nombre,
						'Apellido'=>$apellido,
						'Telefono'=>$telefono,
						'Email'=>$email,
						'Estado'=>$estado,
						'Created_at'=>$created_at,
						'Updated_at'=>$updated_at                
						));
						}
					}
				$sentencia->close();
				echo utf8_encode(json_encode($datos));
			}
			else
				echo 'ex';
	}
			else
				echo 'sd';
 ?>