

<?php
include 'configuracion_base_de_datos.php';

// Consulta para obtener todas las observaciones
$sql = "SELECT o.id_observacion, e.nombre, e.apellido, o.observacion, o.fecha 
        FROM observaciones o 
        JOIN estudiantes e ON o.id_estudiante = e.id_estudiante";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vista de Observaciones</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Observaciones</h1>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID Observación</th>
                    <th>Nombre Estudiante</th>
                    <th>Observación</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id_observacion']; ?></td>
                            <td><?php echo $row['nombre'] . ' ' . $row['apellido']; ?></td>
                            <td><?php echo $row['observacion']; ?></td>
                            <td><?php echo $row['fecha']; ?></td>
                            <td>
                                <a href="editar_observacion.php?id=<?php echo $row['id_observacion']; ?>" class="btn btn-primary">Editar</a>
                                <a href="eliminar_observacion.php?id=<?php echo $row['id_observacion']; ?>" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta observación?');">Eliminar</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay observaciones</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
