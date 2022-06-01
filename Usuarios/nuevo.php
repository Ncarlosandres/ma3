<?php
    include("../Includes/conexion.php");
    if (isset($_POST['enviar'])) {
    //CAMPOS A AGREGAR
        $apellidoynombre=$_POST['apellidoynombre'];
        $nombre=$_POST['nombre'];
        $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
        $direccion=$_POST['direccion'];
        $email=$_POST['email'];
        $rolstring=$_POST['rol'];
        if (($nombre==null)or($password=='')or($apellidoynombre==null)) {
            $_SESSION['message']='FALTAN DATOS';
            $_SESSION['message_type']='danger';
            //header("Location: index.php");
        } else {
            $consulta="SELECT * FROM usu_pass WHERE nombre='$nombre'";
            $resultado=$conexion->query($consulta);
            if (!$resultado) {
                echo '<a href="index.php">Regresar a Menu Principal'.'</a>';
                die("OCURRIO UN FALLO AL GRABAR LA CONSULTA");
            } else {
                $fila=$resultado->fetch_assoc();
                if ($nombre==$fila['nombre']) {
                    $_SESSION['message']='PERSONAL EXISTENTE / DATOS COMPARTIDOS';
                    $_SESSION['message_type']='danger';
                    //header("Location: ../index.php");
                } else {
                    if (($nombre=='') or ($password=='') or ($rolstring=='')) {
                        $_SESSION['message']='FALTAN VALORES';
                        $_SESSION['message_type']='danger';
                        //header("Location: ../index.php");
                    } else {
                        if ($rolstring=='Usuario'){
                            $rol=FALSE;
                        }
                        else{
                            $rol=TRUE;
                        }
                        $insertar = "INSERT INTO usu_pass (apellidoynombre, nombre, password, direccion, email, rol) VALUES ('$apellidoynombre', '$nombre', '$password', '$direccion', '$email', '$rol')";
                        $conexion->query($insertar);
                        $_SESSION['message']='USUARIO AGREGADO';
                        $_SESSION['message_type']='success';
                        header("Location: index.php");
                        $_POST = array();
                    }
                }
            }
        }
    }
?>