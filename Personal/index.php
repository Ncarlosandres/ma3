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
    <div class="container" style="align-content-center">
        <div class="row justify-content-center" >
            <div class="col-lg-12 fluid centrado" style="margin-top: 20px;">
                <div class="row justify-content-center" style="padding-block: 5px;">    
                    <h3 >PERSONAL</h3>
                </div>
                    <div class="card col2 container-fluid" style="border-radius: 15px;border: 3px solid black;padding-block: 15px;">
                        <div class="container-fluid">
                            <label style="font-size: 20px;padding-inline: 15px;" for="busqueda">Legajo, DNI o Nombre</label>
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
