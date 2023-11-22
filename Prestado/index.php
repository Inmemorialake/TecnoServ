<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "tecnoserv";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);



//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"DELETE FROM serviciosolicitado WHERE id=".$_GET["borrar"]);
    if($sqlEmpleaados){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $ID=$data->id;
    $cliente_ID=$data->cliente_ID;
    $empleado_ID=$data->empleado_ID;
    $servicio_ID=$data->servicio_ID;
    $fecha_servicio=$data->fecha_servicio;
    $descripcion_servicio=$data->descripcion_servicio;
    $hoja_registro=$data->hoja_registro;
        if(($cliente_ID!="")&&($empleado_ID!="")) {
            
    $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO servicioprestado(cliente_id,empleado_id,servicio_id,fecha_servicio,descripcion_servicio,hoja_registro) VALUES('$cliente_ID','$empleado_ID,'$servicio_ID','$fecha_servicio','$descripcion_servicio','$hoja_registro') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    $nombre=$data->nombre;
    $correo=$data->correo;
    
    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE serviciosolitado SET nombre='$nombre',correo='$correo' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM servicioprestado ");
if(mysqli_num_rows($sqlEmpleaados) > 0){
    $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
    echo json_encode($empleaados);
}
else{ echo json_encode([["success"=>0]]); }


?>
