<?php

include('contactos.php');  


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nombre'])) {
    
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $fecha_creacion = $_POST['fecha'];
   

  
    if (!empty($nombre) && !empty($telefono) && !empty($email) && !empty($direccion) && !empty($fecha_creacion)) {
        
        agregarContacto($nombre, $telefono, $email, $direccion, $fecha_creacion );
        header('Location: index.php');
            exit(); 
        } else {
            echo "<p style='color: red;'>Error al agregar el contacto.</p>";
        }
    } 


function agregarContacto($nombre, $telefono, $email, $direccion, $fecha_creacion) {
    global $conexion;

   
    $sql = "INSERT INTO contactos (nombre, telefono, email, direccion, fecha_creacion) VALUES (:nombre, :telefono, :email, :direccion, :fecha_creacion)";
    
    
    $stmt = $conexion->prepare($sql);

   
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':fecha_creacion', $fecha_creacion);

    if ($stmt->execute()) {
        
        echo "<p style='color: red;'>Error al agregar el contacto.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Contacto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Añadir Nuevo Contacto</h1>

   
    <form method="POST" action="">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>
        <label for="telefono">Telefono:</label>
        <input type="tel" name="telefono" id="telefono"required><br><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br><br>
        <label for="direccion">Direccion</label>
        <input type="text" name="direccion" id="direccion" required><br><br>
        <label for="fecha">Fecha</label>
        <input type="date" name="fecha" id="fecha">

        <button type="submit" name="agregar_contacto.php">Añadir Contacto</button>
    </form>

</body>
</html>