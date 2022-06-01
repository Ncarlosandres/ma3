<?php

include("../includes/conexion.php");
if (isset($_GET['legajo'])) {
    $id = $_GET["legajo"];
    $sql = "DELETE FROM personal WHERE legajo=$id";
    mysqli_query($conexion, $sql);
    header("location: index.php");
}
    ?>