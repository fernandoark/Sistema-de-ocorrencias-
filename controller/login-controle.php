<?php

session_start();

include_once "../config.php";
include_once "../model/bancodedados.class.php";
include_once '../model/login.class.php';

$objBd = new BancodeDados();

if (isset($_POST['action']))
{
    if ($_POST['action'] == 'autenticarUsuario')
    {
        $objLogin = new Login();
		
        if ( $objLogin->autenticarUsuario( $_POST['login'], $_POST['senha'] ) )
        {		
			echo "<script>window.location='../view/'</script>";
        }
        else
        {
        	echo "<script>window.location='../view/login.php?st=LOGIN_INCORRETO'</script>";
        }
    }
}
else if ( isset( $_GET['logout'] ) )
{
	if ( isset( $_SESSION['tcc_logado'] ) )
    {
    	unset( $_SESSION['tcc_logado'] );
        unset( $_SESSION["tcc_id_login"] );

        echo "<script>window.location='../view/'</script>";
        exit();
	}
    else
    {
    	echo "<script>window.location='../view/'</script>";
        exit();
	}	
    
}
?>