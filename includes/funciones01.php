<html>
<form>
    Ingresa la pagina: <input type="text" name="codigo">
    Ingresa tamaño de registros: <input type="text" name="tamaniotabla">
    Ingresa tamaño de la pagina: <input type="text" name="tamaniopagina">
    <input type="submit" name="enviar" value="enviar">
    </form><br />

</html>

<?php
    Function Paginar ($tamaniotabla,$cantidad_paginas,$tamaniopagina)
    {
        $limite = ($pagina - 1) * $tamaniopagina;
        return $limite;

    }
        $tamaniopagina = $_GET['tamaniopagina'];
        $tamaniotabla = $_GET['tamaniotabla'];
        $cantidad_paginas = ceil($tamaniotabla / $tamaniopagina);
        $pagina = $_GET['codigo'];
        $pagina = ($pagina - 1) * $tamaniopagina;
        echo 'tamaño tabla: ' . $tamaniotabla . '<br />';
        echo 'cantidad de paginas: ' . $cantidad_paginas . '<br />';
        echo 'tamaño de pagina: ' . $tamaniopagina . '<br />';
        echo 'agregar : ' . 'LIMIT ' . $pagina . ' , ' . $tamaniopagina;
    }

?>
