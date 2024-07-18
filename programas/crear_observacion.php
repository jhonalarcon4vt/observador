<?php
    include("conexion.php");

    $idP = $_POST['id_profesor'];
    $idE = $_POST['id_estudiante'];
    $observacion = $_POST['observacion'];

    echo $idP;
    echo $idE;
    echo $observacion;
    
    if ($idP && $idE && $observacion) {
        $query="INSERT INTO observaciones (ID_P, ID_E, OBSERVACION) VALUES ($idP, $idE, '$observacion')";
        $result=mysqli_query($link,$query) or die("error en la consulta de productos");

        setcookie('message', "Observacion creada correctamente!", time() + 5, '/');
        header("Location: ../observador.php");
    } else {
        setcookie('message', "La informacion de observacion son requeridas!", time() + 5, '/');
        header("Location: ../observador.php");
    }

?>