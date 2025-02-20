<?php

include('conexiondb.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql = "DELETE FROM contactos WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        
        header('Location: index.php');
        exit();
    } else {
        echo "<p style='color: red;'>Error al eliminar el contacto.</p>";
    }
} else {
    echo "<p>No se especificó el contacto a eliminar.</p>";
}
?>