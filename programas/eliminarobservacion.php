

<?php
    include("conexion.php");

if (isset($_GET['id'])) {
    $id_observacion = intval($_GET['id']);

    $sql = "DELETE FROM observaciones WHERE id = $id_observacion";

    if ($conn->query($sql) === TRUE) {
        echo "Observación eliminada exitosamente";
    } else {
        echo "Error al eliminar la observación: " . $conn->error;
    }
}

$conn->close();

// Redirigir de vuelta a la vista de observaciones
header("Location: vista_observaciones.php");
exit;
?>
