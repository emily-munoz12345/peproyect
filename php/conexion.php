<?php

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'bd_proyecto';
    
    $conex= new mysqli ($host,$username,$password,$dbname);

    if ($conex->connect_error){
        die("Conexion fallida: ".$conex->connect_error);
    }

            $nombre = $_POST['nombre'];
            $emai = $_POST['email'];
            $tel = $_POST['tel'];
            $direccion = $_POST['direccion'];
            $notas = $_POST['notas'];
            $fecha = date("d/m/y");

            $sql = "INSERT INTO clientes(nombre_cliente,correo_cliente,telefono_cliente,direccion_cliente,fecha_registro,notas_cliente)
            VALUES('$nombre','$emai','$tel','$direccion','$fecha','$notas')";

            if ($conex->query($sql)=== TRUE){
                echo "<script>
                alert('Registro exitoso');
                window.local.href = 'index.html';
                </script>";
            }else{
                echo"Error: " . $conex->error;
            }
            $conex->close();
?>