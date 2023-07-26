<?php

//instancia de PDO para conexion SQLITE
//creacion de base de datos usuarios.db

$baseDatos = new PDO("sqlite:". __DIR__."/usuarios.db");
$baseDatos->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


//definicion de la tabla
$definicionTabla = "CREATE TABLE IF NOT EXISTS regsitros(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    cedula TEXT NOT NULL,
    nombre TEXT NOT NULL,
    telefono TEXT NOT NULL,
    email TEXT NOT NULL,
    direccion TEXT NOT NULL,
    departamento TEXT NOT NULL,
    ciudad TEXT NOT NULL,
    fecha_creacion DATE
);";


$resultado = $baseDatos->exec($definicionTabla);

//echo "Tabla creada correctamente";