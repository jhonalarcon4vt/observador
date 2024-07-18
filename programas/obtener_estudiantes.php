<?php
    include("conexion.php");

    $query="SELECT * FROM estudiantes";
    $estudiantes=mysqli_query($link,$query) or die("error en la consulta de productos");
        
    return $estudiantes;
?>
