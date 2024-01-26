<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- DATATABLES (sin jQuery) -->
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-light justify-content-center p-3 mb-5" style="background-color: #A0CBEC;">
        <h1>Lista de Libros</h1>
    </nav>
    <div class="container">
        <?php
            if (isset($_GET['msg'])) {
                $msg = $_GET['msg'];
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                '.$msg.'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        ?>
        <a href="Data.php" class="btn btn-primary mb-3">Administrar Libreria</a>

        <!-- Inicio de la estructura para mostrar los libros en filas -->
        <div class="row">
            <?php
                include "conexion.php";
                $sql = "SELECT * FROM `libro`";
                $resultado = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($resultado)) {
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo $row['imagen']; ?>" class="card-img-top" alt="Imagen del Libro" style="height: 63vh;">
                            <div class="card-body">
                                <h5 class="card-title text-center"><?php echo $row['titulo']; ?></h5>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Año:</strong> <?php echo $row['año']; ?></li>
                                    <li class="list-group-item"><strong>Autor:</strong> <?php echo $row['autor']; ?></li>
                                    <li class="list-group-item"><strong>Especialidad:</strong> <?php echo $row['especialidad']; ?></li>
                                    <li class="list-group-item"><strong>Editorial:</strong> <?php echo $row['editorial']; ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            ?>
        </div>
        <!-- Fin de la estructura para mostrar los libros en filas -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
</body>
</html>
