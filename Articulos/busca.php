<html>
    <div class="row justify-content-center" >
        <div class="container-fluid" style="align-content-center">
            <table class="table table-hover col2" style="border-radius: 25px;border: 3px solid black;">
            <?php
            include("../Includes/conexion.php");
            session_start();
            $q=$_GET['busca'];
            if ($q==''){
                $consulta = "SELECT * FROM articulos_justificativos";
            }
            else{
                $consulta ="SELECT * FROM articulos_justificativos WHERE numero_articulo LIKE '".$q."%' OR descripcion LIKE '%".$q."%'";
            }

            $result = mysqli_query($conexion, $consulta);
            ?>
            <thead class="thead-dark table-striped">
            <tr class="titulo3">
                <th>Art. Número</th>
                <th>Descripcion</th>
                <th>Cantidad de Dias</th>
                <?php
                    $valor=$_SESSION['mostrar'];
                    if ($valor=='Admin') {
                    echo '<th colspan="2">ACCIONES</th>';}?>
            </tr>
            </thead>
            <?php while($fila=mysqli_fetch_array($result)) {?>
                <tr>
                    <td><?php echo $fila['1'];?></td>
                    <td align="left"><?php echo $fila['3']; ?></td>
                    <td><?php echo $fila['2']; ?></td>
                    <?php
                        $valor=$_SESSION['mostrar'];
                        if ($valor=='Admin') {
                        echo '<td><a class="btn btn-secondary btn-block" href="modifi.php?id='.$fila['id'].'"><i class="far fa-edit"></i></a></td>
                        <td><a class="btn btn-danger btn-block" href="borrar.php?id='.$fila['id'].'"><i class="fas fa-user-times"></i></a></td>';}?>
                </tr>
            <?php } ?>
            </table>
        </div>
    </div>
    <br/>
</html>