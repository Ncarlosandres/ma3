<?php
include("../Includes/conexion.php");
if (isset($_POST['grabar'])) {
    $numero_articulo=$_POST['numero'];
    $descripcion=$_POST['descripcion'];
    $dias_justificados=$_POST['dias_aplicacion'];
    if (($numero_articulo==null)or($descripcion==null)or($dias_justificados==null)) {
        $_SESSION['message']='FALTAN DATOS';
        $_SESSION['message_type']='danger';
        header("Location: index.php");
    } else {
        $consulta="SELECT * FROM articulos_justificativos WHERE numero_articulo='$numero_articulo'";
        $resultado=$conexion->query($consulta);
        if (!$resultado) {
            echo '<a href="index.php">Regresar a Menu Principal'.'</a>';
            die("OCURRIO UN FALLO AL GRABAR LA CONSULTA");
        } else {
            $fila=$resultado->fetch_assoc();
            if (($numero_articulo==$fila['$numero_articulo'])) {
                $_SESSION['message']='ARTICULO EXISTENTE';
                $_SESSION['message_type']='danger';
                header("Location: ../index.php");
            } else {

                    $insertar = "INSERT INTO articulos_justificativos (numero_articulo,descripcion, dias_justificados) VALUES ('$numero_articulo','$descripcion', '$dias_justificados')";
                    $conexion->query($insertar);
                    $_SESSION['message']='ARTICULO AGREGADO';
                    $_SESSION['message_type']='success';
                    header("Location: index.php");
                    $_POST = array();
                }
            }
        }

}
?>