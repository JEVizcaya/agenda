<?php

include('conexiondb.php');


if (isset($_GET['id'])) {
    $id = $_GET['id'];

   
    $sql = "SELECT * FROM contactos WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $contacto = $stmt->fetch(PDO::FETCH_ASSOC);

   
    if (!$contacto) {
        echo "<p>Contacto no encontrado.</p>";
        exit;
    }

 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];
        $fecha_creacion = $_POST['fecha'];

        
        if (!empty($nombre) && !empty($telefono) && !empty($email) && !empty($direccion) && !empty($fecha_creacion)) {
            // Actualizar el producto
            $sql = "UPDATE contactos SET nombre = :nombre, telefono = :telefono, email = :email, direccion=:direccion, fecha_creacion=:fecha_creacion WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':fecha_creacion', $fecha_creacion);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
               
                header('Location: index.php');
                exit();
            } else {
                echo "<p style='color: red;'>Error al actualizar el contacto.</p>";
            }
        } else {
            echo "<p style='color: red;'>Todos los campos son obligatorios.</p>";
        }
    }
} else {
    echo "<p>No se especificó el contacto a editar.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Editar Producto</h1>

    
    <form method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $contacto['nombre']; ?>" required><br><br>

        <label for="telefono">telefono:</label>
        <input type="tel" id="telefono" name="telefono"  value="<?php echo $contacto['telefono']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $contacto['email']; ?>" required><br><br>
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" value="<?php echo $contacto['direccion']; ?>" required><br><br>
        <label for="fecha_creacion">Fecha</label>
        <input type="date" name="fecha" id="fecha" value="<?php echo $contacto['fecha_creacion']; ?>" required><br><br>
        <button type="submit">Actualizar Contacto</button>
    </form>
</body>
</html>