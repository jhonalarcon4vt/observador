


<?php
    include("conexion.php");

if (isset($_GET['id'])) {
    $id_observacion = intval($_GET['id']);

    $sql = "SELECT * FROM observaciones WHERE id_observacion = $id_observacion";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No se encontró la observación";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_observacion = intval($_POST['id_observacion']);
    $observacion = $_POST['observacion'];

    $sql = "UPDATE observaciones SET observacion = '$observacion' WHERE id_observacion = $id_observacion";

    if ($conn->query($sql) === TRUE) {
        echo "Observación actualizada exitosamente";
    } else {
        echo "Error al actualizar la observación: " . $conn->error;
    }

    $conn->close();

    // Redirigir de vuelta a la vista de observaciones
    header("Location: vista_observaciones.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Observación</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Editar Observación</h1>
        <form method="POST" action="">
            <input type="hidden" name="id_observacion" value="<?php echo $row['id_observacion']; ?>">
            <div class="form-group">
                <label for="observacion">Observación:</label>
                <textarea class="form-control" id="observacion" name="observacion" rows="4"><?php echo $row['observacion']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
