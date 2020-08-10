<?php
	include_once('../connection.php');

	$output = array('error' => false);

	$database = new Connection();
	$db = $database->open();
	try{
		// hacer uso de una declaraci�n preparada para evitar la inyecci�n de sql
		$stmt = $db->prepare("INSERT INTO clientes (nombre, apellido, precio) VALUES (:nombre, :apellido, :precio)");
		// declaraci�n if-else en la ejecuci�n de nuestra declaraci�n preparada
		if ($stmt->execute(array(':nombre' => $_POST['nombre'] , ':apellido' => $_POST['apellido'] , ':precio' => $_POST['precio'])) ){
			$output['message'] = 'Miembro agregado correctamente';
		}
		else{
			$output['error'] = true;
			$output['message'] = 'Ocurri� un error al agregar. No se pudo agregar';
		} 
		   
	}
	catch(PDOException $e){
		$output['error'] = true;
 		$output['message'] = $e->getMessage();
	}

	//cerrar conexi�n
	$database->close();

	echo json_encode($output);

?>