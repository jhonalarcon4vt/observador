<?php
    include("programas/obtener_estudiante.php");
    include("programas/obtener_observaciones.php");

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
    <title>Estudiante <?php echo $nombre; ?></title>
    <link rel="stylesheet" href="css/estudiante.css">
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

        <div class="observador">
            <div class="observador__header">
                <div class="observador__brand">
                    <figure class="observador__brand-image">
                        <img src="assets/images/logo-porvenir.png" alt="brand" width="150px" height="150px">
                    </figure>
                    <div class="observador__brand-info">
                        <p>REPÚBLICA DE COLOMBIA</p>
                        <p>DISTRITO CAPITAL - BOGOTA</p>
                        <p>SECRETARIA DE EDUCACION</p>
                        <p>CENTRO EDUCATIVO “EL PORVENIR”</p>
                    </div>
                </div>
                <div class="observador__data">
                    <p>Nombre: 
                        <b> <?php echo $nombre; ?> </b>
                    </p>
                    <p>Direccion: 
                        <b> <?php echo $direccion; ?> </b>
                    </p>
                    <p>Localidad: 
                        <b> <?php echo $localidad; ?> </b>
                    </p>
                    <p>Celular: 
                        <b> <?php echo $celular; ?> </b>
                    </p>
                </div>
            </div>
            <div class="observador__table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>FECHA</th>
                            <th>HORA</th>
                            <th>OBSERVACIONES</th>
                            <th>PROFESOR</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($observaciones) > 0) {
                            while($row = mysqli_fetch_array($observaciones)) {
                                echo "
                                <tr>
                                    <td>$row[ID]</td>
                                    <td>$row[FECHA]</td>
                                    <td>$row[HORA]</td>
                                    <td>$row[OBSERVACION]</td>
                                    <td>$row[NOMBRE_PROFESOR]</td>
                                    
                                    <td class='observador__table-acciones'>

                                        <a class='btn' href='./estudiante.php?idE=$row[ID]' target='_blank'><img src='assets/icons/view.png' alt='add' width='16px'></a>
                                      
                                        <button class='btn btn--delete' onclick='deleteEstudiante($row[ID])'><img src='assets/icons/delete.png' alt='Eliminar' width='16px'></button>
                                    </td>
                                </tr>
                                ";
                            }
                        } else {
                            echo "<tr>NO SE ENCONTRARON REGISTROS</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</body>
</html>