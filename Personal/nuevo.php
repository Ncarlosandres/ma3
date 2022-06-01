<?php
include("../Includes/conexion.php");
if (isset($_POST['grabar'])) {
    $legajo=$_POST['legajo'];
    $nombre=$_POST['nombre'];
    $dni=$_POST['dni'];
    $telefono=$_POST['telefono'];
    $domicilio=$_POST['domicilio'];
    $entrada=$_POST['entrada'];
    $salida=$_POST['salida'];
    if (($nombre==null)or($dni==0)or($legajo==null)) {
        $_SESSION['message']='FALTAN DATOS';
        $_SESSION['message_type']='danger';
        header("Location: index.php");
    } else {
        $consulta="SELECT * FROM personal";
        $resultado=$conexion->query($consulta);
        if (!$resultado) {
            echo '<a href="index.php">Regresar a Menu Principal'.'</a>';
            die("OCURRIO UN FALLO AL GRABAR LA CONSULTA");
        } else {

            $fila=$resultado->fetch_assoc();
            if (($dni==$fila['dni'])or($legajo==$fila['legajo'])) {
                $_SESSION['message']='PERSONAL EXISTENTE';
                $_SESSION['message_type']='danger';
                header("Location: ../index.php");
            } else {
                if (($nombre=='') or ($dni==0) or ($legajo==0)) {
                    $_SESSION['message']='FALTAN VALORES';
                    $_SESSION['message_type']='danger';
                    header("Location: ../index.php");
                } else {
                    $insertar = "INSERT INTO personal (legajo,nombre,dni,telefono,domicilio,entrada,salida) VALUES ('$legajo','$nombre', '$dni', '$telefono', '$domicilio', '$entrada','$salida')";
                    $conexion->query($insertar);
                    $_SESSION['message']='PERSONAL AGREGADO';
                    $_SESSION['message_type']='success';
                    header("Location: index.php");
                    $_POST = array();
                }
            }
        }
    }
}
?>