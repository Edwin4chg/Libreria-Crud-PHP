<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- DATATABLES (sin jQuery) -->
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
  </head>
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
        <a href="agregar.php" class="btn btn-primary mb-3">Agregar</a>
        <a href="index.php" class="btn btn-primary mb-3">Libreria</a>
        <table id="tabla_datos" class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                <th scope="col" class="text-center">Código</th>
                <th scope="col" class="text-center">Año</th>
                <th scope="col" class="text-center">Autor</th>
                <th scope="col" class="text-center">Título</th>
                <th scope="col" class="text-center">Url</th>
                <th scope="col" class="text-center">Especialidad</th>
                <th scope="col" class="text-center">Editorial</th>
                <th scope="col" class="text-center">Imagen</th>                
                <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include "conexion.php";                    
                    $sql = "SELECT * FROM `libro`";

                    $resultado = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($resultado)){
                        ?>
                        <tr>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['año'] ?></td>
                            <td><?php echo $row['autor'] ?></td>
                            <td><?php echo $row['titulo'] ?></td>
                            <td><?php echo $row['url'] ?></td>
                            <td><?php echo $row['especialidad'] ?></td>
                            <td><?php echo $row['editorial'] ?></td>
                            <td>
                                <img src="<?php echo $row['imagen']; ?>" alt="Imagen" width="100" height="auto">
                            </td>                          
                            <td>
                                <a href="editar.php?id=<?php echo $row['id']?>"><i class="bi bi-pencil-square"></i></a>
                                <a href="eliminar.php?id=<?php echo $row['id']?>"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>  
                        <?php
                    }
                ?>                            
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#tabla_datos').DataTable();
      });
    </script>
    </body>
</html>