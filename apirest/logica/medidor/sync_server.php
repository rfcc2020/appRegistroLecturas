<?php 
    require_once('../../datos/conexion.php');
    $conn=conectarse();
	if(isset($_GET['StrIds']))
	{
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
		$sentencia = $conn->prepare($txtSql);
		if($sentencia->execute())
		{
			$datos = array();
			if($sentencia->bind_result($id,$codigo,$numero,$sector,$imagen,$estado,$persona_id,$created_at,$updated_at))
				{
					while($sentencia->fetch())
					{
					array_push($datos,array(
					'Id'=>$id,
					'Codigo'=>$codigo,
					'Numero'=>$numero,
					'Sector'=>$sector,
					'Imagen'=>$imagen,
					'Estado'=>$estado,
					'Persona_id'=>$persona_id,
					'Created_at'=>$created_at,
					'Updated_at'=>$updated_at                
					));
					}
				}
			$sentencia->close();
			echo utf8_encode(json_encode($datos));
		}
		else
			echo 'Error';
		}
	else
		echo 'SD';
 ?>