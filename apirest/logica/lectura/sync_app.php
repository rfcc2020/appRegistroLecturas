<?php 
    require_once('../../datos/conexion.php');
    $conn=conectarse();
	//Get JSON posted by Android Application
	if(isset($_GET['TxtJSON']))
	{
		$json = $_GET["TxtJSON"];
		//Remove Slashes
		if (!get_magic_quotes_gpc()){
			$json = stripslashes($json);
			//Decode JSON into an Array
			$data = json_decode($json);
			//Util arrays to create response JSON
			$a=array();
			$b=array();
			//Loop through an Array and insert data read from JSON into MySQL DB
			for($i=0; $i<count($data) ; $i++)
			{
			//Store User into MySQL DB
			$sentencia = $conn->prepare
        ("
            INSERT INTO lecturas
			( 
				fecha, 
				anterior, 
				actual, 
				consumo, 
				basico, 
				exceso, 
				observacion, 
				latitud, 
				longitud, 
				estado, 
				medidor_id, 
				created_at, 
				updated_at
			) 
			VALUES 
			(
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?,
				?
			)
        "
        );
        $sentencia->bind_param("sssssssssssss",
								$data[$i]->Fecha,
								$data[$i]->Anterior,
								$data[$i]->Actual,
								$data[$i]->Consumo,
								$data[$i]->Basico,
								$data[$i]->Exceso,
								$data[$i]->Observacion,
								$data[$i]->Latitud,
								$data[$i]->Longitud,
								$data[$i]->Estado,
								$data[$i]->Medidor_id,
								$data[$i]->Created_at,
								$data[$i]->Updated_at
		);
    if($sentencia->execute()){
		
					$b["Id"] = $data[$i]->Id;
					$b["Estado"] = '1';
					array_push($a,$b);
			}else{
					$b["Id"] = $data[$i]->Id;
					$b["Estado"] = '0';
					array_push($a,$b);
			}
//Post JSON response back to Android Application
			}
echo json_encode($a);
		}
		else echo 'nmc';
	}
	else
		echo 'sd';
 ?>