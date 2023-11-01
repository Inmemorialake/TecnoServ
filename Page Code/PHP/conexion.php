<?php
$servername = "localhost";
$username = "root"; // Nombre de usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$database = "TecnoServ"; // Nombre de la base de datos

// Crear la conexión a la base de datos
$conexion = mysql_connect($servername, $username, $password, $database);

// Verificar la conexión
if (!$conexion) {
    echo "Conexion Fallida";
    die ("conexion fallida".mysql_connect_error);
}
else {
    echo "Conexion Exitosa";
}

?>
