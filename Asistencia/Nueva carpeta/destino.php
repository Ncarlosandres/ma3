<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="/estilos.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/570bb18b54.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css"
          integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos.css">
    <script src="js/jquery.js"> </script>
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    
<div class="row justify-content-center">
    <h3 style="margin-top: 20px">REPORTE</h3>
</div>
<div class="row">

            <div class="col">

                <?php
                    
                    include('data.php');

                    if ( isset( $_POST['buscar'] ) ) {

                        $legajo = $_POST['num_legajo'];
                        $chek = $_POST['check_asistencia'];
                        $fecha_desde = $_POST['fecha_desde'];
                        $fecha_hasta = $_POST['fecha_hasta'];
                        $consulta = "";

                        if ( $legajo != null and $fecha_desde != null and $fecha_hasta != null ) {

                            $consulta = "SELECT * FROM '$chek' WHERE legajo = '$legajo' AND fecha BETWEEN '$fecha_desde' AND '$fecha_hasta'";

                        } elseif ( $legajo == null and $fecha_desde == null and $fecha_hasta == null ) {

                            $consulta = "SELECT * FROM `$chek` WHERE 1;";

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

                            $consulta_articulos = "SELECT * FROM `articulos_justificativos` ";
                            
                            

                     echo '       
                    <div class="form-row mt-10" >
                        <div class="col-md-12">
                            <hr>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <a href="InasistenciasPDF.php?" target="_blank">
                                <button type="button" class="btn btn-success btn-block" style="margin-bottom: 20px">IMPRIMIR</button></a>
                        <div class="col-md-4"></div>
                    </div>';
                            
                            
                            
                            
                                                       
                            $query_variable = mysqli_query($con, $consulta_variable);

                            echo '<table class="table table-striped table-bordered" style="text-align: center">';
                            echo '<thead class="thead-dark">';
                            echo '<th>Legajo</th><th>Nombre</th><th>Fecha</th><th>Estado</th><th>Justificar con</th><th>Accion</th>';
                            echo '</thead>';

                            while($res_variable = mysqli_fetch_array($query_variable)){

                                $query_articulos = mysqli_query($con, $consulta_articulos);
                                
                            
                                echo '<td>'.$res_variable[1].'</td>';
                                
                                $mostrar_nombre="SELECT nombre from personal WHERE legajo='$res_variable[1]'";
                                $query_nombre=mysqli_query($con,$mostrar_nombre);
                                while($res_nombre = mysqli_fetch_array($query_nombre)){
                                        echo '<td>'.$res_nombre[0].'</td>';
                                    }
                                
                                echo '<td>'.date('d/m/Y',strtotime($res_variable[2])).'</td>';
                                echo '<td>'.$res_variable[3].'</td>';
                                
                                if($res_variable[3] != 'justificado'){
                                    
                                    echo '<td><form action="" method="GET">
                                
                                    <select name="articulo" class="custom-select">
                                        <option>Seleccione un artículo...</option>';

                                        while($res_articulos = mysqli_fetch_array($query_articulos)){
                                            echo '<option value='.$res_articulos[1].'>Artículo '.$res_articulos[1].'</option>';
                                        }

                                    echo '</select>
                                        <input type="hidden" value='.$res_variable[1].' name="legajo"/>
                                        <input type="hidden" value='.$res_variable[2].' name="fecha"/>
                                        </td>';
                                    echo 
                                        '<td> 
                                            <button type="submit" name="justificar" class="btn btn-success btn-sm">Impactar cambios</button></form>
                                        </td>';
                                    
                                }else{
                                    
                                    echo '<td colspan="2">'.$res_variable[4].'</td>';
                                    
                                }
                                
                                echo '</tr>';

                            }

                            echo '</table>';

                        } else {

                            $consulta_variable = $consulta;
                            $query_variable = mysqli_query($con, $consulta_variable);

                            
                            echo '       
                            <div class="form-row mt-10" >
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <a href="InasistenciasPDF.php?" target="_blank">
                                        <button type="button" class="btn btn-success btn-block" style="margin-bottom: 20px">IMPRIMIR</button></a>
                                <div class="col-md-4"></div>
                            </div>';
                            
                            
                            
                            
                            
                            echo '<table class="table table-striped table-bordered" style="text-align: center">';
                            echo '<thead class="thead-dark">';
                            echo '<th>Legajo</th><th>Nombre</th><th>Fecha</th><th>Hora</th>';
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
                
                    if(isset($_GET['justificar'])){
                        
                        $justificar_legajo = $_GET['legajo'];
                        $justificar_articulo = $_GET['articulo'];
                        $justificar_fecha = $_GET['fecha'];
                        
                        if($justificar_articulo == 'Seleccione un artículo...'){
                            
                            //echo 'Debe seleccionar un artículo válido';
                            
                        }else{
                            
                            $query_justificar = "UPDATE ausentes set estado = 'justificado' WHERE legajo = $justificar_legajo AND fecha = '$justificar_fecha'";
                            $query_descripcion = "UPDATE ausentes set Obsevaciones = 'justificado con artículo $justificar_articulo ' WHERE legajo = $justificar_legajo AND fecha = '$justificar_fecha'";
                            $consulta_justificar = mysqli_query($con, $query_justificar);
                            $consulta_descripcion = mysqli_query($con, $query_descripcion);   
                        }
                    }

                ?>

            </div>

        </div>

    
</body>
</html>
