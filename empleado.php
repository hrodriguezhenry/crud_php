<?php
ob_start();
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Empresa</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="https://umg.edu.gt/" target="_blank">UMG</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Empleado</a></li>
                        <li><a class="dropdown-item" href="#">Nuevo</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Vacío</a></li>
                    </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>
    </header>
    <h1>Formulario Empleado</h1>

    <div class="container">
        <form action="" method="post" class="form-group needs-validation" novalidate>
            <label for="lbl_id" class="form-label">ID</label>
            <input type="text" class="form-control" name="txt_id" id="txt_id" value="0">
            <label for="lbl_codigo" class="form-label">Código</label>
            <input type="text" class="form-control" name="txt_codigo" id="txt_codigo" placeholder="Ejemplo: E001" pattern="[E]{1}[0-9]{3}" required>

            <label for="lbl_nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" name="txt_nombres" id="txt_nombres" placeholder="Ejemplo: Nombre 1 Nombre 2" required>

            <label for="lbl_apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" name="txt_apellidos" id="txt_apellidos" placeholder="Ejemplo: Apellido 1 Apellido 2" required>

            <label for="lbl_direccion" class="form-label">Dirección</label>
            <input type="text" class="form-control" name="txt_direccion" id="txt_direccion" placeholder="Ejemplo: #casa calle avenida" required>

            <label for="lbl_telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" name="txt_telefono" id="txt_telefono" placeholder="Ejemplo: 25365898" required>

            <label for="lbl_fn" class="form-label">Nacimiento</label>
            <input type="date" class="form-control" name="txt_fn" id="txt_fn" required>
            
            <label for="lbl_puesto" class="form-label">Puesto</label>
            <select name="drop_puesto" id="drop_puesto" class="form-select" required>
                <option selected disabled value="" >Seleccione un puesto</option>

                <?php
                require_once "datos_conexion.php";
                $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                if($db_conexion){
                    $db_conexion->real_query("SELECT id_puesto, puesto FROM puestos;");
                    $resultado = $db_conexion->use_result();

                    while($fila = $resultado->fetch_assoc()){
                        echo "<option value=".$fila['id_puesto'].">".$fila['puesto']."</option>";
                    }
                }
                $db_conexion->close();
                ?>
            </select>
            <br>
            <button class="btn btn-primary" name="btn_crear" id="btn_crear" value="crear"><i class="bi bi-floppy2-fill"></i> Crear</button>
            <button class="btn btn-warning" name="btn_actualizar" id="btn_actualizar" value="actualizar"><i class="bi bi-pencil"></i> Actualizar</button>
            <button class="btn btn-danger" name="btn_borrar" id="btn_borrar" value="borrar" onclick="confirmarBorrado(event)"><i class="bi bi-trash-fill"></i> Borrar</button>
        </form><br>

        <table class="table table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Código</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Puesto</th>
                    <th>Nacimiento</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once "datos_conexion.php";
                $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

                if($db_conexion){
                    $db_conexion->real_query(
                    "SELECT e.id_empleado,
                                e.codigo,
                                e.nombres,
                                e.apellidos,
                                e.direccion,
                                e.telefono,
                                p.puesto,
                                e.fecha_nacimiento
                            FROM empleado AS e
                            INNER JOIN puestos AS p
                            ON e.id_puesto = p.id_puesto;"
                    );

                    $resultado = $db_conexion->use_result();

                    while($fila = $resultado->fetch_assoc()){
                        echo "<tr data-id=".$fila['id_empleado'].">";
                        echo "<td>".$fila['codigo']."</td>";
                        echo "<td>".$fila['nombres']."</td>";
                        echo "<td>".$fila['apellidos']."</td>";
                        echo "<td>".$fila['direccion']."</td>";
                        echo "<td>".$fila['telefono']."</td>";
                        echo "<td>".$fila['puesto']."</td>";
                        echo "<td>".$fila['fecha_nacimiento']."</td>";
                        echo "</tr>";
                    }
                }
                $db_conexion->close();
                ?>
            </tbody>
        </table>
    </div>

    <?php
    if(isset($_POST["btn_crear"])){
        require_once "datos_conexion.php";
        $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $txt_codigo = $_POST["txt_codigo"];
        $txt_nombres = $_POST["txt_nombres"];
        $txt_apellidos = $_POST["txt_apellidos"];
        $txt_direccion = $_POST["txt_direccion"];
        $txt_telefono = $_POST["txt_telefono"];
        $drop_puesto = $_POST["drop_puesto"];
        $txt_fn = $_POST["txt_fn"];

        $sql = "INSERT INTO empleado (codigo, nombres, apellidos, direccion, telefono, fecha_nacimiento, id_puesto)
        VALUES ('".$txt_codigo."', '".$txt_nombres."', '".$txt_apellidos."', '".$txt_direccion."', '".$txt_telefono."', '".$txt_fn."', ".$drop_puesto.");";

        if($db_conexion->query($sql)){
            $db_conexion->close();
            header("Location: empleado.php");
            ob_end_flush();
        } else{
            echo "Error ".$sql."<br>".$db_conexion->close();
        }
    }

    if(isset($_POST["btn_actualizar"])){
        require_once "datos_conexion.php";
        $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $txt_id = $_POST["txt_id"];
        $txt_codigo = $_POST["txt_codigo"];
        $txt_nombres = $_POST["txt_nombres"];
        $txt_apellidos = $_POST["txt_apellidos"];
        $txt_direccion = $_POST["txt_direccion"];
        $txt_telefono = $_POST["txt_telefono"];
        $drop_puesto = $_POST["drop_puesto"];
        $txt_fn = $_POST["txt_fn"];

        $sql = 
        "UPDATE empleado
        SET codigo = '".$txt_codigo."',
        nombres = '".$txt_nombres."',
        apellidos = '".$txt_apellidos."',
        direccion = '".$txt_direccion."',
        telefono = '".$txt_telefono."',
        fecha_nacimiento = '".$txt_fn."',
        id_puesto = ".$drop_puesto."
        WHERE id_empleado = ".$txt_id.";";

        if($db_conexion->query($sql)){
            $db_conexion->close();
            header("Location: empleado.php");
            ob_end_flush();
        } else{
            echo "Error ".$sql."<br>".$db_conexion->close();
        }
    }

    if(isset($_POST["btn_borrar"])){
        require_once "datos_conexion.php";
        $db_conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
        $txt_id = $_POST["txt_id"];

        $sql = "DELETE FROM empleado WHERE id_empleado = ".$txt_id.";";

        if($db_conexion->query($sql)){
            $db_conexion->close();
            header("Location: empleado.php");
            ob_end_flush();
        } else{
            echo "Error ".$sql."<br>".$db_conexion->close();
        }
    }
    ?>
    <script>
        (function () {
        'use strict'

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
            })
        })()
    </script>
    <script>
        function confirmarBorrado(event) {
            // Mostrar el mensaje de confirmación
            let confirmacion = confirm("¿Estás seguro de que deseas eliminar este registro?");

            if (!confirmacion) {
                // Si el usuario cancela, prevenimos el envío del formulario
                event.preventDefault();
                return;
            }

            // Si el usuario confirma, deshabilitamos la validación de los otros campos
            document.getElementById("txt_codigo").removeAttribute("required");
            document.getElementById("txt_nombres").removeAttribute("required");
            document.getElementById("txt_apellidos").removeAttribute("required");
            document.getElementById("txt_direccion").removeAttribute("required");
            document.getElementById("txt_telefono").removeAttribute("required");
            document.getElementById("txt_fn").removeAttribute("required");
            document.getElementById("drop_puesto").removeAttribute("required");
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>