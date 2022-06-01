<div class="row">

            <div class="col">

                <form action="" method="post">
                    <div class="form-row mt-3">
                        <div class="form-group col-md-12">
                            <h4>Búsqueda Asistencia</h4>
                            <hr>
                        </div>
                    </div>
                    

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <h3>Busqueda por Legajo</h3><br />
                            <input type="number" class="form-control col-md-8" id="campo_legajo" name="num_legajo" placeholder="Nº de legajo">
                        </div>

                        <div class="form-group col-md-3">
                            <h3>Filtrar</h3><br />

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check_asistencias" name="check_asistencia" value="presentes" checked />
                                <label class="form-check-label" for="check_asistencias">Asistencias</label><br />
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check_inasistencias" name="check_asistencia" value="ausentes" />
                                <label class="form-check-label" for="check_inasistencias">Inasistencias</label><br />
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" id="check_tardes" name="check_asistencia" value="llegadas_tardes">
                                <label class="form-check-label" for="check_tardes">Llegadas Tardes</label><br />
                            </div>
                        </div>
                    

                    <div class="form-group col-md-5 align-items-center">
                        <div class="form-group col-md-12">
                            <h3>Busqueda por fecha</h3>
                        </div>
                        
                        <div class="form-group col-md-12">
                            <label for="fecha_desde">Desde
                            <input type="date" class="form-control col-md-12" name="fecha_desde" id="fecha_desde" /></label>

                            <label for="fecha_hasta">Hasta
                            <input type="date" class="form-control col-md-12" name="fecha_hasta" id="fecha_hasta" /></label>
                        </div>
                    </div>
                </div>    
                    <div class="row justify-content-center">
                        <div class="form-group col-md-12">
                            <hr>
                            <button type="submit" name="buscar" class="btn btn-success btn-block">Buscar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <div class="row">

            <div class="col">

                <?php

                    if ( isset( $_POST['buscar'] ) ) {

                        $legajo = $_POST['num_legajo'];
                        $chek = $_POST['check_asistencia'];
                        $fecha_desde = $_POST['fecha_desde'];
                        $fecha_hasta = $_POST['fecha_hasta'];
                        $consulta = "";

                        if ( $legajo != null and $fecha_desde != null and $fecha_hasta != null ) {

                            $consulta = "SELECT * FROM '$chek' WHERE legajo = '$legajo' AND fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'";

                        } elseif ( $legajo == null and $fecha_desde == null and $fecha_hasta == null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE 1";

                        } elseif ( $legajo == null and $fecha_desde != null and $fecha_hasta != null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE Fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'";

                        } elseif ( $legajo == null and $fecha_desde == null and $fecha_hasta != null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE Fecha <= '$fecha_hasta';";

                        } elseif ( $legajo == null and $fecha_desde != null and $fecha_hasta == null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE Fecha >= '$fecha_desde';";

                        } elseif ( $legajo != null and $fecha_desde == null and $fecha_hasta == null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE legajo = '$legajo'";

                        } elseif ( $legajo != null and $fecha_desde != null and $fecha_hasta == null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE Legajo = '$legajo' AND Fecha >= '$fecha_desde';";

                        } else {

                            $consulta = "SELECT * FROM `$chek` WHERE Legajo = '$legajo' AND Fecha <= '$fecha_hasta';";
                        }

                        if ( $chek == 'ausentes' ) {

                            $consulta_variable = $consulta;

                            $consulta_articulos = "SELECT * FROM `articulos_justificativos` WHERE 1";

                            $query_variable = mysqli_query($con, $consulta_variable);

                            echo '<table class="table table-striped">';
                            echo '<thead class="thead-dark table-striped">';
                            echo '<th>Legajo</th><th>Nombre</th><th>Fecha</th><th>Estado</th><th>Justificar con</th><th>Accion</th>';
                            echo '</thead>';
                            while($res_variable = mysqli_fetch_array($query_variable)){
                                $query_articulos = mysqli_query($con, $consulta_articulos);
                                $res_variable[2] = date('d/m/Y',strtotime($res_variable[2]));
                                echo '<tr>';
                                 echo '<td>'.$res_variable[1].'</td>'; 
                                $mostrar_nombre="SELECT nombre from personal WHERE legajo='$res_variable[1]'";
                                $query_nombre=mysqli_query($con,$mostrar_nombre);
                                while($res_nombre = mysqli_fetch_array($query_nombre)){
                                        echo '<td>'.$res_nombre[0].'</td>';
                                    }
                                echo '<td>'.$res_variable[2].'</td>';
                                echo '<td>'.$res_variable[3].'</td>';
                                echo '<td><select><option>Seleccione un artículo...</option>';

                                    while($res_articulos = mysqli_fetch_array($query_articulos)){
                                        echo '<option>Artículo '.$res_articulos[1].'</option>';
                                    }

                                echo '</select></td>';
                                echo '<td> <button class="btn btn-primary btn-sm">Impactar cambios</button></td>';
                                echo '</tr>';

                            }

                            echo '</table>';


                        } else {

                            $consulta_variable = $consulta;
                            $query_variable = mysqli_query($con, $consulta_variable);

                            echo '<table class="table table-striped">';
                            echo '<thead class="thead-dark table-striped">';
                            echo '<th>Legajo</th><th>Apellido y Nombre</th><th>Fecha</th><th>Hora</th>';
                            echo '</thead>';
                            while($res_variable = mysqli_fetch_array($query_variable)){

                                $res_variable[2] = date('d/m/Y',strtotime($res_variable[2]));
                                echo '<tr>';
                                echo '<td>'.$res_variable[1].'</td>';
                                $mostrar_nombre="SELECT nombre from personal WHERE legajo='$res_variable[1]'";
                                $query_nombre=mysqli_query($con,$mostrar_nombre);
                                while($res_nombre = mysqli_fetch_array($query_nombre)){
                                        echo '<td>'.$res_nombre[0].'</td>';
                                    }
                                echo '<td>'.$res_variable[2].'</td>';
                                echo '<td>'.$res_variable[3].'</td>';
                                echo '</tr>';
                            }
                            echo '</table>';

                        }

                    }

                ?>

            </div>

        </div>

