<?php
// productos.php
include('conexiondb.php'); 

class Contactos {
    private $id;
    private $nombre;
    private $telefono;
    private $email;
    private $direccion;
    private $fecha_creacion;

    public function __construct($id, $nombre, $telefono, $email, $direccion, $fecha_creacion) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->fecha_creacion = $fecha_creacion;

    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getTelefono() {
        return $this->telefono;
    }

    public function getEmail() {
        return $this->email;
    }
    public function getDireccion() {
        return $this->direccion;
    }
    public function getFecha_creacion() {
        return $this->fecha_creacion;
    }
}


function obtenerContactos() {
    global $conexion; 

    $sql = "SELECT * FROM contactos";
    $stmt = $conexion->query($sql);  
    
    $contactos = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $contacto = new Contactos($row['id'], $row['nombre'], $row['telefono'], $row['email'], $row['direccion'], $row['fecha_creacion']);
        $contactos[] = $contacto;
    }

    return $contactos;
}
?>