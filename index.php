<?php

include('conexiondb.php');

// Obtener los productos
$sql = "SELECT * FROM contactos";
$stmt = $conexion->query($sql);
$contactos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Productos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Mi Agenda</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>telefono</th>
                <th>email</th>
                <th>direccion</th>
                <th>fecha_creacion</th>
                <th>Operaciones</th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contactos as $contacto): ?>
                <tr>
                    <td><?php echo $contacto['id']; ?></td>
                    <td><?php echo $contacto['nombre']; ?></td>
                    <td><?php echo $contacto['telefono']; ?></td>
                    <td><?php echo $contacto['email']; ?></td>
                    <td><?php echo $contacto['direccion']; ?></td>
                    <td><?php echo $contacto['fecha_creacion']; ?></td>
                    <td>
                        <!-- Enlaces de edición y eliminación -->
                        <a href="editar_contacto.php?id=<?php echo $contacto['id']; ?>">Editar</a>
                        <a href="eliminar_contacto.php?id=<?php echo $contacto['id']; ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a id="agregar" href="agregar_contacto.php">Añadir nuevo contacto</a>
</body>
</html>