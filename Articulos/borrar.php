<?php

include("../includes/conexion.php");
if (isset($_GET['id'])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM articulos_justificativos WHERE id=$id";
    mysqli_query($conexion, $sql);
    header("location: index.php");
}
    ?>