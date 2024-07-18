<?php
    include("programas/obtener_profesor.php");
    include("programas/obtener_estudiantes.php");

    $id = $usuario['ID'];
    $nombre = $usuario['NOMBRE'];
    $celular = $usuario['CELULAR'];
    $direccion = $usuario['DIRECCION'];
    $localidad = $usuario['LOCALIDAD'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Observador</title>
    <link rel="stylesheet" href="css/observador.css">
    <link rel="stylesheet" href="css/general.css">
</head>
<body>
    <main class="main">
        <header class="header">
            <h1>Comportamiento Academico</h1>
            <ul class="header__options">
                <li class="header__option">
                    <h2><?php echo $nombre; ?></h2>
                    <img src="assets/icons/user.png" alt="user" width="48px" height="48px">
                </li>
                <a class="btn header__option header__option--exit" href="/proyecto">
                    <h3>Salir</h3>
                    <img src="assets/icons/exit.png" alt="exit" width="32px" height="32px">
                </a>
            </ul>
        </header>
        <aside class="aside">
            <ul class="aside__options">
                <li class="aside__option">
                    <button class="btn btn--add" onclick="openPopup('add_estudiante')" id="plus_estudiante">Agregar Estudiante</button>
                </li>
            </ul>
        </aside>
        <div class="estudiantes">
            <div class="observador__table">
                <table>
                    <thead>
                        <tr>
                            <th>CODIGO</th>
                            <th>NOMBRES</th>
                            <th>CELULAR</th>
                            <th>DIRECCIÓN</th>
                            <th>LOCALIDAD</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($estudiantes) > 0) {
                            while($row = mysqli_fetch_array($estudiantes)) {
                                echo "
                                <tr>
                                    <td>$row[ID]</td>
                                    <td>$row[NOMBRE]</td>
                                    <td>$row[CELULAR]</td>
                                    <td>$row[DIRECCION]</td>
                                    <td>$row[LOCALIDAD]</td>
                                    <td class='observador__table-acciones'>
                                        <a class='btn' href='./estudiante.php?idE=$row[ID]' target='_blank'><img src='assets/icons/view.png' alt='add' width='16px'></a>
                                        <button class='btn btn--add' onclick='addObservacion({id: $row[ID], nombre: `$row[NOMBRE]`})'><img src='assets/icons/add.png' alt='add' width='16px'></button>
                                        <button class='btn btn--edit' onclick='editEstudiante({id: $row[ID], nombre: `$row[NOMBRE]`, celular: `$row[CELULAR]`, direccion: `$row[DIRECCION]`, localidad: `$row[LOCALIDAD]`})'><img src='assets/icons/edit.png' alt='edit' width='16px'></button>
                                        <button class='btn btn--delete' onclick='deleteEstudiante($row[ID])'><img src='assets/icons/delete.png' alt='Eliminar' width='16px'></button>
                                    </td>
                                </tr>
                                ";
                            };
                        } else {
                            echo "<tr>NO SE ENCONTRARON REGISTROS</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <div class="overlay" id="add_estudiante">
        <div class="popup">
            <div class="popup__head">
                <h2>Agregar Alumno</h2>
                <span class="popup__head-close"><img src="assets/icons/reject.png" alt="exit" width="32px" height="32px" onclick="closePopup('add_estudiante')"></span>
            </div>
            <div class="popup__body">
                <form action="programas/crear_estudiante.php" method="POST" class="form">
                    <div class="form__field">
                    <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del estudiante..." required>
    </div>
    <div class="form__field">
        <label for="documento">Documento:</label>
        <input type="text" name="documento" id="documento" placeholder="Ingrese documento del estudiante..." required>
    </div>
    <div class="form__field">
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" placeholder="Ingrese dirección del estudiante..." required>
    </div>
    <div class="form__field">
        <label for="localidad">Localidad:</label>
        <input type="text" name="localidad" id="localidad" placeholder="Ingrese localidad del estudiante..." required>
    </div>
    <div class="form__field">
        <label for="celular">Celular:</label>
        <input type="text" name="celular" id="celular" placeholder="Ingrese celular del estudiante..." required>
    </div>
    <div class="form__field">
        <label for="acudiente">Acudiente:</label>
        <input type="text" name="acudiente" id="acudiente" placeholder="Ingrese acudiente del estudiante..." required>
    </div>
    <div class="form__field">
        <label for="curso">Curso:</label>
        <input type="text" name="curso" id="curso" placeholder="Ingrese curso del estudiante..." required>
    </div>
    <div class="form__field">
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena" id="contrasena" placeholder="Ingrese contraseña del estudiante..." required>
    </div>
                </form>
            </div>
            <div class="popup__footer">
                <button class="btn btn--add" onclick="submitForm('#add_estudiante form')">Aceptar</button>
                <button class="btn btn--del" onclick="closePopup('add_estudiante')">Cancelar</button>
            </div>
        </div>
    </div>

    
    <div class="overlay" id="edit_estudiante">
        <div class="popup">
            <div class="popup__head">
                <h2>Editar Alumno</h2>
                <span class="popup__head-close"><img src="assets/icons/reject.png" alt="exit" width="32px" height="32px" onclick="closePopup('edit_estudiante')"></span>
            </div>
            <div class="popup__body">
                <form action="programas/editar_estudiante.php" method="POST" class="form">
                    <div class="form__field">
                        <label for="id">ID:</label>
                        <input type="text" name="id" id="id" readonly>
                    </div>
                    <div class="form__field">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del estudiante...">
                    </div>
                    <div class="form__field">
                        <label for="celular">Celular:</label>
                        <input type="text" name="celular" id="celular" placeholder="Ingrese celular del estudiante...">
                    </div>
                    <div class="form__field">
                        <label for="direccion">Direccion:</label>
                        <input type="text" name="direccion" id="direccion" placeholder="Ingrese direccion del estudiante...">
                    </div>
                    <div class="form__field">
                        <label for="localidad">Localidad:</label>
                        <input type="text" name="localidad" id="localidad" placeholder="Ingrese localidad del estudiante...">
                    </div>
                </form>
            </div>
            <div class="popup__footer">
                <button class="btn btn--add" onclick="submitForm('#edit_estudiante form')">Aceptar</button>
                <button class="btn btn--del" onclick="closePopup('edit_estudiante')">Cancelar</button>
            </div>
        </div>
    </div>

    <div class="overlay" id="add_observador">
        <div class="popup">
            <div class="popup__head">
                <h2>Añadir Observacion Al Estudiante</h2>
                <span class="popup__head-close"><img src="assets/icons/reject.png" alt="exit" width="32px" height="32px" onclick="closePopup('add_observador')"></span>
            </div>
            <div class="popup__body">
                <form action="programas/crear_observacion.php" method="POST" class="form">
                    <input type="hidden" name="id_profesor" id="id_profesor" readonly>
                    <div class="form__field">
                        <label for="id_estudiante">ID:</label>
                        <input type="text" name="id_estudiante" id="id_estudiante" readonly>
                    </div>
                    <div class="form__field">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" readonly>
                    </div>
                    <div class="form__field">
                        <label for="observacion">Observacion:</label>
                        <textarea name="observacion" id="observacion" rows="10" placeholder="Ingrese observacion al estudiante..."></textarea>
                    </div>
                </form>
            </div>
            <div class="popup__footer">
                <button class="btn btn--add" onclick="submitForm('#add_observador form')">Aceptar</button>
                <button class="btn btn--del" onclick="closePopup('add_observador')">Cancelar</button>
            </div>
        </div>
    </div>

    <div class="overlay" id="del_estudiante">
        <div class="popup">
            <div class="popup__head">
                <h2>Borrar Alumno</h2>
                <span class="popup__head-close"><img src="assets/icons/reject.png" alt="exit" width="32px" height="32px" onclick="closePopup('del_estudiante')"></span>
            </div>
            <div class="popup__body">
                <h3>Esta Seguro que desea borrar el alumno:</h3>
                <form action="programas/eliminar_estudiante.php" method="POST" class="form">
                    <div class="form__field">
                        <label for="id">ID:</label>
                        <input type="text" name="id" id="id" readonly>
                    </div>
                    <div class="form__field">
                        <label for="nombre">Nombre:</label>
                        <input type="text" name="nombre" id="nombre" readonly>
                    </div>
                </form>
            </div>
            <div class="popup__footer">
                <button class="btn btn--add" onclick="submitForm('#del_estudiante form')">Aceptar</button>
                <button class="btn btn--del" onclick="closePopup('del_estudiante')">Cancelar</button>
            </div>
        </div>
    </div>
    
    <script>
    function deleteEstudiante(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este estudiante?')) {
            // Enviar solicitud DELETE usando fetch
            fetch(`programas/eliminar_estudiante.php?id=${id}`, {
                method: 'DELETE',
            })
            .then(response => {
                if (response.ok) {
                    alert('Estudiante eliminado correctamente');
                    // Actualizar la página después de eliminar
                    window.location.reload();
                } else {
                    throw new Error('Error al eliminar el estudiante');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al eliminar el estudiante');
            });
        }
    }
</script>




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

        function submitForm(formSelector) {
            document.querySelector(formSelector).submit();
        }

        function closePopup(id) {
            document.getElementById(id).style.display = 'none';
        }

        function openPopup(id) {
            document.getElementById(id).style.display = 'flex';
        }

        function editEstudiante(estudiante) {
           const formulario = document.querySelector('#edit_estudiante form');

           formulario.id.value = estudiante.id;
           formulario.nombre.value = estudiante.nombre;
           formulario.celular.value = estudiante.celular;
           formulario.direccion.value = estudiante.direccion;
           formulario.localidad.value = estudiante.localidad;

           openPopup('edit_estudiante');
        }

        function delEstudiante(estudiante) {
            const formulario = document.querySelector('#del_estudiante form');

            formulario.id.value = estudiante.id;
            formulario.nombre.value = estudiante.nombre;

            openPopup('del_estudiante');
        }

        function addObservacion(estudiante) {
            const formulario = document.querySelector('#add_observador form');

            formulario.id_profesor.value = <?php echo $id; ?>;
            formulario.id_estudiante.value = estudiante.id;
            formulario.nombre.value = estudiante.nombre;

            openPopup('add_observador');
        }
    </script>
</body>
</html>