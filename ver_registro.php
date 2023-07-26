<?php
  //Incluir la conexion
  include_once __DIR__."/conexion_sqlite.php";

  // mostrar registros

  $query = "SELECT * FROM regsitros";
  $stmt= $baseDatos->query($query);


  $registros = $stmt->fetchAll(PDO::FETCH_OBJ);


  //mostrarlos en pantalla

  var_dump($registros);


?>