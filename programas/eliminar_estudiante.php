<?php
include("conexion.php");

$id_estudiante = $_GET['id'];

if (!$id_estudiante) {
    http_response_code(400);
    die("ID de estudiante no proporcionado");
}

$query = "DELETE FROM estudiantes WHERE ID = $id_estudiante";

$result = mysqli_query($link, $query);

if ($result) {
    // Éxito
    http_response_code(200);
    echo "Estudiante eliminado correctamente";
} else {
    // Error
    http_response_code(500);
    echo "Error al eliminar el estudiante: " . mysqli_error($link);
}

mysqli_close($link);
?>
