<?php
    //Incluir la conexion
    include_once __DIR__."/conexion_sqlite.php";

    //configurar la zona horaria
    date_default_timezone_set('America/Bogota');

    //INSERTAMOS DATOS
    if (isset ($_POST['btnRegistrarse'])) {
        
        //obtener los valores
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $direccion = $_POST['direccion'];
        $departamento = $_POST['departamento'];
        $ciudad = $_POST['ciudad'];

        //validar que los campos no esten vacíos

        if (empty($cedula)||empty($nombre)||empty($telefono)||
        empty($email)||empty($direccion)||empty($departamento)||empty($ciudad)) {
           $error = "Error, algunos campos obligarios estan vacíos";
           header('Location: index.php?error='.urlencode($error));
        }else {
            //VALIDAR si ya existe la cedula
            $query = "SELECT * FROM regsitros WHERE cedula=:cedula";
            $stmt= $baseDatos->prepare($query);
            $stmt->bindParam(":cedula",$cedula, PDO::PARAM_STR);
            $resultado = $stmt->execute();

            $registroCedula = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($registroCedula) {
                $error = "Error, el numero de cedula ya se encuentra registrado";
                header('Location: index.php?error='.urlencode($error));
            }else {
                //entra cuando la cedula no existe

                $query= "INSERT INTO regsitros(cedula,nombre,telefono,email,direccion,departamento,ciudad)
                VALUES(:cedula,:nombre,:telefono,:email,:direccion,:departamento,:ciudad)";

                $stmt = $baseDatos->prepare($query); 
                //debemos pasarle al bindparam las variables
                $stmt->bindParam(":cedula",$cedula,PDO::PARAM_STR);
                $stmt->bindParam(":nombre",$nombre,PDO::PARAM_STR);
                $stmt->bindParam(":telefono",$telefono,PDO::PARAM_STR);
                $stmt->bindParam(":email",$email,PDO::PARAM_STR);
                $stmt->bindParam(":direccion",$direccion,PDO::PARAM_STR);
                $stmt->bindParam(":departamento",$departamento,PDO::PARAM_STR);
                $stmt->bindParam(":ciudad",$ciudad,PDO::PARAM_STR);

                $resultado = $stmt->execute();

                if ($resultado== true) {
                    //validar creacion y obtener el ultimo ID que seriía el codigo

                    $codigId = $baseDatos->lastInsertId();
                    $mensaje = "Registro creado correctamente ";
                    header('Location: index.php?mensaje='.urlencode($mensaje).'&codigo='.urlencode($codigId));
                    exit();
                }else {

                    $error = "Error, no se pudo crear el registro";
                    header('Location: index.php?error='.urlencode($error));
                    exit();
                }

            }
        }
    }
        