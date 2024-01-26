<?php
include "conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta para obtener los datos del libro por su ID
    $sql = "SELECT * FROM `libro` WHERE `id` = $id";
    $resultado = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($resultado)) {
        // Obtener los datos del libro
        $año = $row['año'];
        $autor = $row['autor'];
        $titulo = $row['titulo'];
        $url = $row['url'];
        $especialidad = $row['especialidad'];
        $editorial = $row['editorial'];
        $imagen = $row['imagen']; // Esto podría ser la ruta de la imagen en lugar de datos binarios
    } else {
        echo "Libro no encontrado.";
        exit;
    }
} else {
    echo "ID de libro no proporcionado.";
    exit;
}

if (isset($_POST['submit'])) {
    $nuevo_año = $_POST['año'];
    $nuevo_autor = $_POST['autor'];
    $nuevo_titulo = $_POST['titulo'];
    $nuevo_url = $_POST['url'];
    $nuevo_especialidad = $_POST['especialidad'];
    $nuevo_editorial = $_POST['editorial'];

    // Verificar si se cargó una nueva imagen y si no hubo errores
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $imagen = $_FILES['imagen'];
        $imagen_nombre = $imagen['name'];
        $imagen_tmp = $imagen['tmp_name'];
        
        // Ruta donde se almacenará la nueva imagen
        $ruta = "uploads/" . $imagen_nombre;
        
        // Mover la nueva imagen al directorio de imágenes
        move_uploaded_file($imagen_tmp, $ruta);

        // Actualizar la ruta de la imagen en la base de datos
        $sql = "UPDATE `libro` SET `año` = '$nuevo_año', `autor` = '$nuevo_autor', `titulo` = '$nuevo_titulo', `url` = '$nuevo_url', `especialidad` = '$nuevo_especialidad', `editorial` = '$nuevo_editorial', `imagen` = '$ruta' WHERE `id` = $id";
    } else {
        // Si no se cargó una nueva imagen, actualizar solo los otros campos
        $sql = "UPDATE `libro` SET `año` = '$nuevo_año', `autor` = '$nuevo_autor', `titulo` = '$nuevo_titulo', `url` = '$nuevo_url', `especialidad` = '$nuevo_especialidad', `editorial` = '$nuevo_editorial' WHERE `id` = $id";
    }

    $resultados = mysqli_query($conn, $sql);

    if ($resultados) {
        header("Location: Data.php?msg=Libro actualizado exitosamente");
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
    <title>Editar Libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!--ICONS-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  </head>
  <body>
    <nav class="navbar navbar-light justify-content-center p-3 mb-5" style="background-color: #A0CBEC;">
        <h1>Editar Libro</h1>
    </nav>

    <div class="container">
        <div class="text-center">
            <h2>Modificar Libro</h2>
            <p>Complete los campos para modificar el libro.</p>
        </div>

        <div class="container d-flex justify-content-center">
        <form method="POST" enctype="multipart/form-data">
            <label for="año">Año:</label>
            <input type="text" class="form-control" name="año" value="<?php echo $año; ?>" required>
            <label for="autor">Autor:</label>
            <input type="text" class="form-control" name="autor" value="<?php echo $autor; ?>" required>
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" name="titulo" value="<?php echo $titulo; ?>" required>
            <label for="url">URL:</label>
            <input type="text" class="form-control" name="url" value="<?php echo $url; ?>" required>
            <label for="especialidad">Especialidad:</label>
            <input type="text" class="form-control" name="especialidad" value="<?php echo $especialidad; ?>" required>
            <label for="editorial">Editorial:</label>
            <input type="text" class="form-control" name="editorial" value="<?php echo $editorial; ?>" required>
            <label for="imagen">Imagen:</label>
            <input type="file" class="form-control" name="imagen" accept="image/*">
            <div class="mt-3">
                <button type="submit" class="btn btn-success" name="submit">Guardar Cambios</button>
                <a href="Data.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
