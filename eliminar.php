<?php
include "conexion.php";

$id = $_GET['id'];

// Consulta para obtener la ruta de la imagen antes de eliminar el registro
$sql = "SELECT imagen FROM `libro` WHERE id=$id";
$resultados = mysqli_query($conn, $sql);

if ($resultados && $row = mysqli_fetch_assoc($resultados)) {
    $imagen_ruta = $row['imagen'];

    // Eliminar el registro de la base de datos
    $sql = "DELETE FROM `libro` WHERE id=$id";
    $resultados = mysqli_query($conn, $sql);

    if ($resultados) {
        // Eliminar la imagen si existe
        if (file_exists($imagen_ruta)) {
            unlink($imagen_ruta);
        }

        header("Location: Data.php?msg=Registro Eliminado");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
