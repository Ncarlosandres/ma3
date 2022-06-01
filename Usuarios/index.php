<?php
include ("../Includes/header.php");?>
<header>
    <script>
        function showHint(str) {
            if (str.length == 0) {
                document.getElementById("idtabla").innerHTML = "";
                return;
            }
            else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("idtabla").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET","busca.php?busca=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</header>
<body>
    <div class="container-fluid" style="align-content-center">
        <div class="row justify-content-center" >
            <div class="col-lg-2 centrado">
            <br/>
                <div class="card col2 centrado" style="border-radius: 25px;border: 3px solid black;">
                    <h5><center>Ingresar Datos</center></h5>
                    <p></p>
                    <form action="nuevo.php" method="POST" class="mx-auto">
                    <center>
                        <div class="form-group">
                            <input type="text" name="apellidoynombre" class="form-control"
                                   placeholder="Apellido y Nombre Real" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control"
                            placeholder="Nombre Usuario" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control"
                            placeholder="Contraseña" autofocus maxlength="10">
                        </div>

                        <div class="form-group">
                            <input type="text" name="email" class="form-control"
                            placeholder="Email" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" name="direccion" class="form-control"
                            placeholder="Direccion" autofocus>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="rol" name="rol">
                                <option>Usuario</option>
                                <option>Administrador</option>
                            </select>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" name="enviar" value="Grabar USUARIO">
                    </center>
                    </form>
                    <br/>
                </div>
            </div>
            <div class="col-lg-7 fluid centrado" style="margin-top: 20px;">
                <div class="row justify-content-center" style="padding-block: 5px;">    
                    <h3 >USUARIOS</h3>
                </div>
                <div class="card col2 container-fluid" style="border-radius: 15px;border: 3px solid black;padding-block: 15px;">
                    <div class="container-fluid">
                        <label style="font-size: 20px;padding-inline: 15px;" for="busqueda">Nombre o Mail</label>
                        <input type="text" name="busqueda" placeholder="PULSE LA BARRA ESPACIADORA PARA LISTAR"
                               class="col-5 container-fluid" style="border-radius: 15px;border: 3px solid black;margin-inline: 10px" onkeyup="showHint(this.value)">
                        <a href="reportePDF.php?" target="_blank">
                        <button type="button" class="btn btn-success" >IMPRIMIR</button></a>
                    </div>
                </div>
                <span id="idtabla" class="align-content-lg-center" >
                        </span>
            </div>
        </div>
    </div>
    <br/>
</body>
<?php
include ("../Includes/footer.php");?>
