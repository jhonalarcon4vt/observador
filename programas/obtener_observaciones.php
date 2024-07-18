<?php
    include("conexion.php");
    
    $idE=$_GET['idE'];

    $query="SELECT o.ID, o.FECHA, o.HORA, o.OBSERVACION, p.NOMBRE AS NOMBRE_PROFESOR
            FROM observaciones o
            INNER JOIN estudiantes e ON o.ID_E = e.ID
            INNER JOIN profesores p ON o.ID_P = p.ID
            WHERE o.ID_E = $idE";

    $observaciones=mysqli_query($link,$query) or die("error en la consulta de productos");
        
    return $observaciones;
?>