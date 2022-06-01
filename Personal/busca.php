<html>
    <div class="row justify-content-center" >
        <div class="container-fluid" style="align-content-center">
            <table class="table table-hover col2" style="border: 3px solid black;">

            <?php
            include("../Includes/conexion.php");
            session_start();
            if (!isset($_GET['busca']))
                { $consulta="SELECT * FROM personal WHERE legajo BETWEEN '1000' AND '1099'";}
            Else
                {
                $q=@$_GET['busca'];
                $consulta ="SELECT * FROM personal WHERE (nombre LIKE '%".$q."%' OR legajo LIKE '".$q."%' )AND (legajo BETWEEN '1000' AND '1099')";
                }
                $result = $conexion->query($consulta);
                ?>
                <thead class="thead-dark table-striped">
                <tr class="titulo3">
                    <th>Legajo</th>
                    <th>Apellido y Nombre</th>
                    <th>Domicilio</th>
                    <th>Telefono</th>
                    <th>Entrada</th>
                    <th>Salida</th>
                    <?php 
                    if ($_SESSION['mostrar']=='Admin'){
                        echo '<th colspan="2">Acciones</th>';}?>
                </tr>
                </thead>
                <?php
                    while($fila=$result->fetch_array()) { ?>
                        <tr> 
                            <td><?php echo $fila[0];?></td>
                            <td align="left"><?php echo $fila[1]; ?></td>
                            <td><?php echo $fila[2]; ?></td>
                            <td><?php echo $fila[3]; ?></td>
                            <td><?php echo $fila[4]; ?></td>
                            <td><?php echo $fila[5]; ?></td>
                            <?php
                            if ($_SESSION['mostrar']=='Admin'){
                                echo '<td><a class="btn btn-secondary btn-block" href="modifi.php?legajo='
                                     .$fila[0].'"><i class="far fa-edit"></i></a></td>
                                      <td><a class="btn btn-danger btn-block" href="borrar.php?legajo='
                                     .$fila[0].'"><i class="fas fa-user-times"></i></a></td>'; }?>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</html>