<?php
    include("conexion.php");

            $nombre = trim($_POST['nombre']);
            $emai = trim($_POST['email']);
            $tel = trim($_POST['tel']);
            $direccion = trim($_POST['direccion']);
            $notas = trim($_POST['notas']);
            $fecha = date("d/m/y");

            $consulta = "INSERT INTO clientes(nombre_cliente,correo_cliente,telefono_cliente,direccion_cliente,notas_cliente,fecha_registro)
            VALUES('$nombre','$emai','$tel','$direccion','$notas','$fecha')";
            $resultado = mysql_query($conex,$consulta);
       /* if (isset($_POST['ingresar'])){
        if(
            strlen($_POST['nombre']) >= 1 &&
            strlen($_POST['email']) >= 1 &&
            strlen($_POST['tel']) >= 1 &&
            strlen($_POST['direccion']) >= 1 &&
            strlen($_POST['notas']) >= 1 &&
        ){
            $nombre = trim($_POST['nombre']);
            $emai = trim($_POST['email']);
            $tel = trim($_POST['tel']);
            $direccion = trim($_POST['direccion']);
            $notas = trim($_POST['notas']);
            $fecha = date("d/m/y");
            $consulta = "INSERT INTO clientes(nombre_cliente,correo_cliente,telefono_cliente,direccion_cliente,notas_cliente,fecha_registro)
            VALUES('$nombre','$emai','$tel','$direccion','$notas','$fecha')";
            $resultado = mysql_query($conex,$consulta);
            if ($resultado){
                ?>
                <h3 class="seccess">Tu registro se ha completado</h3>
                <?
            }
            else {
                ?>
                <h3 class="error">Ocurrio un error</h3>
                <?
            }
            }else{
                ?>
                <h3 class="error">Llena todos los campos</h3>
                <?}
    }*/
?> 