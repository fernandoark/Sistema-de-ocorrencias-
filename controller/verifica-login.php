<?php

ob_start();

function paginaRestrita()
{
    if ( isset($_SESSION['tcc_logado'] ) )
    {
        if ($_SESSION['tcc_logado'] == false)
        {
            echo "<script>window.location='../view/login.php'</script>";
            exit;
        }
    }
    else
    {
        echo "<script>window.location='../view/login.php'</script>";
        exit;
    }
}

ob_end_flush();

?>