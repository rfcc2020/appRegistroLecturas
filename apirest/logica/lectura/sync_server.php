<?php 
    require_once('../../datos/conexion.php');
    $conn=conectarse();
        $sentencia = $conn->prepare
        ("
        SELECT
		Id,
		Fecha,
		Anterior,
		Actual,
		Consumo,
		Basico,
		Exceso,
		Observacion,
		Imagen,
		Latitud,
		Longitud,
		Estado,
		Medidor_id,
		Created_at,
		Updated_at
		FROM lecturas
		WHERE estado = 'NSYNC'
        ");
    if($sentencia->execute())
    {
        $datos = array();
        if($sentencia->bind_result($id,$fecha,$anterior,$actual,$consumo,$basico,$exceso,$observacion,$imagen,$latitud,$longitud,$estado,$medidor_id,$created_at,$updated_at))
			{
				while($sentencia->fetch())
				{
                array_push($datos,array(
                'Id'=>$id,
				'Fecha'=>$fecha,
                'Anterior'=>$anterior,
				'Actual'=>$actual,
				'Consumo'=>$consumo,
				'Basico'=>$basico,
				'Exceso'=>$exceso,
				'Observacion'=>$observacion,
                'Imagen'=>$imagen,
				'Latitud'=>$latitud,
				'Longitud'=>$longitud,
				'Estado'=>$estado,
				'Medidor_id'=>$medidor_id,
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
 ?>