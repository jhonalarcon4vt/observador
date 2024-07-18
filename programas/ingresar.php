<?php
    include("conexion.php");

    $id_estudiente = isset($_GET['id_estudiente']) ? $_GET['id_estudiente'] : null;
    $id_profesor = isset($_GET['id_profesor']) ? $_GET['id_profesor'] : null;
    $password_profesor = isset($_GET['password_profesor']) ? $_GET['password_profesor'] : null;
    $password_estudiante = isset($_GET['password_estudiante']) ? $_GET['password_estudiante'] : null;


    if ($id_estudiente) {
        $query="SELECT * FROM estudiantes WHERE ID=$id_estudiente";
        $result=mysqli_query($link,$query) or die("error en la consulta de productos");

        if(mysqli_num_rows($result)>0) {
            $usuario = mysqli_fetch_array($result);

            if ($usuario['CONTRASENA'] != $password_estudiante) {
                setcookie('message', "Contraseña incorrecta!", time() + 5, '/');                
                header("Location: ../index.php");
            } else {
                $idE = $usuario['ID'];
                setcookie('idE', $idE, time() + 3600, '/'); // 'id' es el nombre de la cookie, $id es el valor, y el tiempo de expiración es 1 hora (3600 segundos)
    
                header("Location: ../estudiante.php?idE=$idE");
            }
        } else {
            setcookie('message', "Usuario no encontrado!", time() + 5, '/');
            header("Location: ../index.php");
        }

    } else if ($id_profesor) {
        $query="SELECT * FROM profesores WHERE ID=$id_profesor";
        $result=mysqli_query($link,$query) or die("error en la consulta de productos");

        if(mysqli_num_rows($result)>0) {
            $usuario = mysqli_fetch_array($result);

            if ($usuario['CONTRASENA'] != $password_profesor) {
                setcookie('message', "Contraseña incorrecta!", time() + 5, '/');                
                header("Location: ../index.php");
            } else {
                $idP = $usuario['ID'];
                setcookie('idP', $idP, time() + 3600, '/'); // 'id' es el nombre de la cookie, $id es el valor, y el tiempo de expiración es 1 hora (3600 segundos)
    
                header("Location: ../observador.php");
            }
        } else {
            setcookie('message', "Usuario no encontrado!", time() + 5, '/');
            header("Location: ../index.php");
        }
    }

?>
