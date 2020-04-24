<?php 
    require_once('../../datos/conexion.php');
    $conn=conectarse();
	if(isset($_GET['StrIds']))
	{
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
		$sentencia = $conn->prepare($txtSql);
		if($sentencia->execute())
		{
			$datos = array();
			if($sentencia->bind_result($id,$email,$sector,$password,$role,$created_at,$updated_at,$name))
				{
					while($sentencia->fetch())
					{
					array_push($datos,array(
					'Id'=>$id,
					'Email'=>$email,
					'Sector'=>$sector,
					'Password'=>$password,
					'Role'=>$role,
					'Created_at'=>$created_at,
					'Updated_at'=>$updated_at,
					'Name'=>$name
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