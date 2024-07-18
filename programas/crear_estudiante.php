<?php
include("conexion.php");

$nombre = $_POST['nombre'];
$celular = $_POST['celular'];
$direccion = $_POST['direccion'];
$localidad = $_POST['localidad'];
$contrasena = $_POST['contrasena'];
$acudiente = $_POST['acudiente'];
$curso = $_POST['curso'];
$documento = $_POST['documento'];

// Verificar que todas las variables tienen un valor
if ($nombre && $celular && $direccion && $localidad && $contrasena && $acudiente && $curso && $documento) {
    // Preparar la consulta SQL con parámetros seguros
    $query = "INSERT INTO estudiantes (NOMBRE, CELULAR, DIRECCION, LOCALIDAD, CONTRASENA, ACUDIENTE, CURSO, documento) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    // Preparar la declaración
    $stmt = mysqli_prepare($link, $query);

    // Vincular parámetros a la declaración
    mysqli_stmt_bind_param($stmt, "ssssssss", $nombre, $celular, $direccion, $localidad, $contrasena, $acudiente, $curso, $documento);

    // Ejecutar la declaración
    mysqli_stmt_execute($stmt);

    // Verificar si se insertó correctamente
    $affected_rows = mysqli_stmt_affected_rows($stmt);
    
    if ($affected_rows == 1) {
        setcookie('message', "Usuario registrado correctamente!", time() + 5, '/');
        header("Location: ../observador.php");
    } else {
        setcookie('message', "Error al registrar el usuario. Inténtelo de nuevo más tarde.", time() + 5, '/');
        header("Location: ../index.php");
    }

    // Cerrar la declaración y la conexión
    mysqli_stmt_close($stmt);
    mysqli_close($link);
} else {
    setcookie('message', "Todos los campos son requeridos!", time() + 5, '/');
    header("Location: ../index.php");
}
?>
