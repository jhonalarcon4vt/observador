<?php
    $id = isset($_COOKIE['id']) ? $_COOKIE['id'] : null;
    $type = isset($_COOKIE['type']) ? $_COOKIE['type'] : null;

    if ($id) {
        setcookie('id', '', time() - 3600, '/');
    }
    if ($type) {
        setcookie('type', '', time() - 3600, '/');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/general.css">
</head>
<body>
    <main class="main">
        <div class="login">
            <h1>Comportamiento <br>Academico</h1>
            <div class="buttons">
                <button class="btn" onclick="seleccionarEstudiante()" >Alumno</button>
                <button class="btn" onclick="seleccionarProfesor()" >Profesor</button>
            </div>
            <form action="programas/ingresar.php" method="get" id="formulario_estudiante" onsubmit="return validar(this)">
                <div class="form-field">
                    <input type="text" name="id_estudiente" id="id_estudiente" placeholder="Ingresa ID">
                    <input type="password" name="password_estudiante" id="password_estudiante" placeholder="Contraseña">
                </div>
                <button class="btn">Ingresar</button>
            </form>
            <form action="programas/ingresar.php" method="get" id="formulario_profesor" onsubmit="return validar(this)">
                <div class="form-field">
                    <input type="text" name="id_profesor" id="id_profesor" placeholder="Ingresa ID">
                    <input type="password" name="password_profesor" id="password_profesor" placeholder="Contraseña">
                </div>
                <button class="btn" type="submit">Ingresar</button>
                <button class="btn btn--add" type="button" onclick="openPopup('add_profesor')">Nuevo</button>
            </form>
        </div>
    </main>

    <div class="overlay" id="add_profesor">
        <div class="popup">
            <div class="popup__head">
                <h2>Agregar Profesor</h2>
                <span class="popup__head-close"><img src="assets/icons/reject.png" alt="exit" width="32px" height="32px" onclick="closePopup('add_profesor')"></span>
            </div>
            <div class="popup__body">
                <form action="programas/crear_profesor.php" method="POST" class="form">
                    <div class="form__field">
                        <label for="contrasena">Contraseña:</label>
                        <input type="password" name="contrasena" id="contrasena" placeholder="Ingrese contraseña del profesor...">
                    </div>
                    <div class="form__field">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del profesor...">
                    </div>
                    <div class="form__field">
                        <label for="celular">Celular:</label>
                        <input type="text" name="celular" id="celular" placeholder="Ingrese celular del profesor...">
                    </div>
                    <div class="form__field">
                        <label for="direccion">Direccion:</label>
                        <input type="text" name="direccion" id="direccion" placeholder="Ingrese direccion del profesor...">
                    </div>
                    <div class="form__field">
                        <label for="localidad">Localidad:</label>
                        <input type="text" name="localidad" id="localidad" placeholder="Ingrese localidad del profesor...">
                    </div>
                </form>
            </div>
            <div class="popup__footer">
                <button class="btn btn--add" onclick="submitForm('#add_profesor .form')">Aceptar</button>
                <button class="btn btn--del" onclick="closePopup('add_profesor')">Cancelar</button>
            </div>
        </div>
    </div>


    <script>
        const message = "<?php 
            $message = isset($_COOKIE['message']) ? $_COOKIE['message'] : '';
            echo $message;
        ?>";

        if (message) {
            setTimeout(() => {
                alert(message);
            }, 100);
        }

        function seleccionarEstudiante() {
            document.getElementById("formulario_estudiante").style.display = "flex";
            document.getElementById("formulario_profesor").style.display = "none";
        }

        function seleccionarProfesor() {
            document.getElementById("formulario_estudiante").style.display = "none";
            document.getElementById("formulario_profesor").style.display = "flex";    
        }

        function closePopup(id) {
            document.getElementById(id).style.display = 'none';
        }

        function openPopup(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function submitForm(formSelector) {
            document.querySelector(formSelector).submit();
        }

        function validar(formulario) {
            if(formulario.id_estudiente.value == '' || formulario.id_profesor.value == '') {
                alert('Sr Usuario debe ingresar el codigo del Estudiante o profesor para continuar');
                formulario.id_estudiente.focus();
                return false;
            } else if (formulario.password_profesor.value == '') {
                alert('Sr Usuario debe ingresar la contraseña para continuar');
                formulario.password_profesor.focus();
                return false;
            }

            return true;
        }
    </script>
</body>
</html>