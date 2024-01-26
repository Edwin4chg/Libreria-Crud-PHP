<?php 
    include "conexion.php";

    if (isset($_POST['submit'])) {
        $año = $_POST['año'];
        $autor = $_POST['autor'];
        $titulo = $_POST['titulo'];
        $url = $_POST['url'];
        $especialidad = $_POST['especialidad'];
        $editorial = $_POST['editorial'];
        
        // Verificar si se cargó una imagen y si no hubo errores
        if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
            $imagen = $_FILES['imagen'];
            $imagen_nombre = $imagen['name'];
            $imagen_tmp = $imagen['tmp_name'];
            
            // Ruta donde se almacenará la imagen
            $ruta = "uploads/" . $imagen_nombre;
            
            // Mover la imagen al directorio de imágenes
            move_uploaded_file($imagen_tmp, $ruta);
        } else {
            // Manejar error de carga de imagen aquí (puedes mostrar un mensaje de error)
            echo "Error al cargar la imagen.";
            exit; // O manejarlo de acuerdo a tus necesidades
        }

        // Almacena la ruta de la imagen en la base de datos en lugar de los datos binarios
        $sql = "INSERT INTO `libro`(`id`, `año`, `autor`, `titulo`, `url`, `especialidad`, `editorial`, `imagen`) VALUES (NULL,'$año','$autor','$titulo','$url','$especialidad','$editorial','$ruta')";
 
        $resultados = mysqli_query($conn, $sql);

        if ($resultados) {
            header("Location: Data.php?msg=Registro satisfactorio");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--ICONS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>
  <body>
    <nav class="navbar navbar-light justify-content-center p-3 mb-5" style="background-color: #A0CBEC;">
        <h1>Lista de Libros</h1>
    </nav>

    <div class="container">
        <div class="text-center">
            <h2>Agregar Libro</h2>
            <p>Complete los campos requeridos para agregar un libro.</p>
        </div>

        <div class="container d-flex justify-content-center">
        <form method="POST" enctype="multipart/form-data">
            <label for="año">Año:</label>
            <input type="text" class="form-control" name="año" placeholder="Ingrese el año" required>
            <label for="autor">Autor:</label>
            <input type="text" class="form-control" name="autor" placeholder="Ingrese el autor" required>
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" name="titulo" placeholder="Ingrese el título" required>
            <label for="url">URL:</label>
            <input type="text" class="form-control" name="url" placeholder="Ingrese la URL" required>
            <label for="especialidad">Especialidad:</label>
            <input type="text" class="form-control" name="especialidad" placeholder="Ingrese la especialidad" required>
            <label for="editorial">Editorial:</label>
            <input type="text" class="form-control" name="editorial" placeholder="Ingrese la editorial" required>
            <label for="imagen">Imagen:</label>
            <input type="file" class="form-control" name="imagen" accept="image/*" required>
            <div class="mt-3">
                <button type="submit" class="btn btn-success" name="submit">Agregar</button>
                <a href="Data.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>