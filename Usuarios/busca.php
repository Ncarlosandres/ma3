<html>
    <body>
        <div class="row justify-content-center" >
            <div class="container-fluid" style="align-content-center">
                <table class="table table-hover col2" style="border-radius: 25px;border: 3px solid black;">
                    <?php
                    include("../Includes/conexion.php");
                    session_start();
                    $q=$_GET['busca'];
                    if ($q==''){
                        $consulta = "SELECT * FROM usu_pass";
                    }
                    else{

                        $consulta ="SELECT * FROM usu_pass WHERE apellidoynombre LIKE '%".$q."%' OR email LIKE '%".$q."%'";
                    }

                    $result = mysqli_query($conexion, $consulta);
                    ?>
                    <thead class="thead-dark table-striped">
                        <tr class="titulo3">
                            <th>Apellido y Nombre</th>
                            <th>Nom. Usuario</th>
                            <th>Dirección</th>
                            <th>Email</th>
                            <th>Privilegios</th>
                            <?php
                            $valor=$_SESSION['mostrar'];
                            if ($valor=='Admin') {echo '<th colspan="2">ACCIONES</th>';}?>
                        </tr>
                    </thead>
                    <?php while($fila=mysqli_fetch_array($result)) {?>
                    <tr>
                        <td align="left"><?php echo $fila['1'];?></td>
                        <td><?php echo $fila['2']; ?></td>
                        <td><?php echo $fila['4']; ?></td>
                        <td><?php echo $fila['5']; ?></td>
                        <td><?php
                            if ($fila['6']==TRUE){
                                echo 'Administrador';
                            }
                            else{
                                echo 'Usuario';
                            }?></td>
                        <?php
                            $valor=$_SESSION['mostrar'];
                            if ($valor=='Admin') 
                                {echo '<td><a class="btn btn-secondary btn-block" href="modifi.php?id='
                                .$fila['id'].'"><i class="far fa-edit"></i></a></td>
                                <td><a class="btn btn-danger btn-block" href="borrar.php?id='.$fila['id'].'"><i class="fas fa-user-times"></i></a></td>';}?>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <br/>
    </body>
</html>