<?php
    include("conexion.php");

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    
    if ($nombre && $celular && $direccion && $localidad) {
        $query="UPDATE estudiantes SET NOMBRE='$nombre', CELULAR=$celular, DIRECCION='$direccion', LOCALIDAD='$localidad' WHERE ID = $id";
        echo $query;
        $result=mysqli_query($link,$query) or die("error en la consulta de productos");

        setcookie('message', "Usuario editado correctamente!", time() + 5, '/');
        header("Location: ../observador.php");
    } else {
        setcookie('message', "La informacion nombre, celular, direccion, localidad son requeridas!", time() + 5, '/');
        header("Location: ../index.php");
    }

?>