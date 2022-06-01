<?php
    function Conectar ($conectarbase){
        $conectarbase=new mySqli("localhost","root","","escuela");
        if ($conectarbase->connect_error){
            die ("LA BASE DE DATOS NO ESTA CREADA, NO ES LA CORRECTA O NO FUE CREADA");
        }
        return $conectarbase;
    }
    $conectar='';
    $conectar=Conectar($conectar);
    $usuario=$_POST['usuario'];
    $password=$_POST['clave'];
    $contador=0;
    $sql="SELECT * FROM usu_pass WHERE nombre = '$usuario'";
    $resultado=$conectar->query($sql);
    if (!$resultado){
        $alert ='El usuario es incorrecto';
        echo $alert;}
    else {
        while ($fila = $resultado->fetch_assoc()) {
            if (password_verify($password, $fila['password'])) {
                $contador++;
                $muestra = $fila['apellidoynombre'];
                $rol=$fila['rol'];
            }
        }
        if ($contador == 1) {
            session_start();
            $_SESSION['active'] = true;
            $_SESSION['usuario'] = $muestra;
            $_SESSION['rol']=$rol;
            if ($rol==TRUE){
                $mostrar='Admin';
            }
            else {$mostrar='Usuario';}
            $_SESSION['mostrar']=$mostrar;
            header('location: ../asistencia/index.php');
            }
        else {
            $alert = 'La clave es incorrecta';
            header("Location: ../index.php");
        }
    }
?>