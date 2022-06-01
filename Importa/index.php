    <?php
    include ("../Includes/header.php");?>
      
    <body>
    
    <div class="container">
        <hr>
        <div class="row">
                
            <div class="col">
                
                <form target="popup" onsubmit="window.open('', 'popup', 'width = 600, height = 240')" action="modulo_asistencia.php">
                
                    <button type="submit" class="btn btn-warning">Importar archivo de Lector</button>
                
                </form>
                
            </div>
                 
            <div class="col">
                
                <form target="popup" onsubmit="window.open('', 'popup', 'width = 600, height = 240')" action="modulo_insert_personal.php">
                
                    <button type="submit" class="btn btn-warning">Importar archivo de Legajos</button>
                
                </form>
                
            </div>     
                  
        </div>
           
    
        <br/>
    </body>
    <?php
    include ("../Includes/footer.php");?>
