<?php
    include("conexion.php");

    $contrasena = $_POST['contrasena'];
    $nombre = $_POST['nombre'];
    $celular = $_POST['celular'];
    $direccion = $_POST['direccion'];
    $localidad = $_POST['localidad'];
    
    if ($nombre && $celular && $direccion && $localidad) {
        $query="INSERT INTO profesores (CONTRASENA, NOMBRE, CELULAR, DIRECCION, LOCALIDAD) VALUES ('$contrasena', '$nombre', $celular, '$direccion', '$localidad')";
        $result=mysqli_query($link,$query) or die("error en la consulta de productos");

        setcookie('message', "Usuario editado correctamente!", time() + 5, '/');
        header("Location: ../index.php");
    } else {

        setcookie('message', "La informacion nombre, celular, direccion, localidad son requeridas!", time() + 5, '/');
        header("Location: ../index.php");
    }

?>