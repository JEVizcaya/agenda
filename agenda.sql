create database agenda;
use agenda;
create table contactos(
id 	INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(255),
telefono VARCHAR(10),
email VARCHAR (255),
direccion TEXT,
fecha_creacion TIMESTAMP);