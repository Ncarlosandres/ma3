<?php

include("../includes/conexion.php");
if (isset($_GET['id'])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM usu_pass WHERE id=$id";
    mysqli_query($conexion, $sql);
    header("location: index.php");
}
    ?>