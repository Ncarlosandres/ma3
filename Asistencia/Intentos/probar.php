<?php        
    include('data.php');    
    $legajo=1002;
    $consulta="SELECT nombre FROM personal";
    $resultado=mysqli_query($con,$consulta);
    while ($fila=mysqli_fetch_array($resultado)){
        echo $fila[0].'<br/>';
    }
    ?>