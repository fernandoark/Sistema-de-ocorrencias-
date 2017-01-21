<?php 

session_start();

include_once "../config.php";
include_once "../model/bancodedados.class.php";
include_once "../model/data.class.php";
include_once "../model/professor.class.php";
include_once "../model/tipologin.class.php";

if (isset($_POST["action"]))
{
	if ($_POST["action"] == "inserirProfessor")
	{
		$objBd = new BancodeDados();
		
		$dados = array(
			"login" 	=> $_POST["login"],
			"senha" 	=> $_POST["senha"],
			"tipologin" => Tipologin::PROFESSOR
		);
		
		if( !$idLogin = $objBd->insert( "login", $dados ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=login-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		$dados = array(
			'nome_professor' 	=> $_POST["nome_professor"],
			'id_login'			=> $idLogin
		);

		if( !$idProfessor = $objBd->insert( "professor", $dados ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=professor-lista&st=" . $msg . "'</script>";
			exit();
		}

		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=professor-lista&st=" . $msg . "'</script>";
		exit();
	}
	else if ( $_POST["action"] == "editarProfessor" )
	{
		$objBd = new BancodeDados();
		$objProfessor = new Professor();
		$objProfessor->obterProfessor( $_POST["idProfessor"] );
		
		$dados_login = array(
			'login'		=> $_POST['login'],
			'senha'		=> $_POST['senha']
		);
		
		if( !$objBd->edit( "login", $dados_login, $objProfessor->getId_login() ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=professor-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		$dados = array(
			"nome_professor" => $_POST["nome_professor"],
		);

		if( !$objBd->edit( "professor", $dados, $objProfessor->getId_professor() ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=professor-lista&st=" . $msg . "'</script>";
			exit();
		}

		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=professor-lista&st=" . $msg . "'</script>";
		exit();
	}
}
else if ( isset( $_GET["action"] ) )
{
	if ( $_GET["action"] == "excluirProfessor" )
	{
		$objBd = new BancodeDados();
		$objProfessor = new Professor();
		$objProfessor->obterProfessor( $_GET["idProfessor"] );
		
		if( !$objBd->delete('login', $objProfessor->getId_login()) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=professor-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		if( !$objBd->delete('professor', $objProfessor->getId_professor()) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=professor-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=professor-lista&st=" . $msg . "'</script>";
		exit();
		
	}
}
