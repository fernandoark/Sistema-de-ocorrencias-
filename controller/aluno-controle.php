<?php 

session_start();

include_once "../model/bancodedados.class.php";
include_once "../model/data.class.php";
include_once "../model/aluno.class.php";
include_once "../model/tipologin.class.php";

if (isset($_POST["action"]))
{
	if ($_POST["action"] == "inserirAluno")
	{
		$objBd = new BancodeDados();

		$dados_login = array(
				"login" 	=> $_POST["login"],
				"senha" 	=> $_POST["senha"],
				"tipologin" => Tipologin::ALUNO
		);
		
		if( !$idLogin = $objBd->insert( "login", $dados_login ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=login-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		$dados = array(
			"NM_ALUNO" 	=> $_POST["NM_ALUNO"],
			"PERIODO" 	=> $_POST["PERIODO"],
			"DS_TURMA" 	=> $_POST["DS_TURMA"],
			"nivel" 	=> $_POST["nivel"],
			'id_login'	=> $idLogin
		);

		if( !$idAluno = $objBd->insert( "aluno", $dados ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=aluno-lista&st=" . $msg . "'</script>";
			exit();
		}

		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=aluno-lista&st=" . $msg . "'</script>";
		exit();
	}
	else if ( $_POST["action"] == "editarAluno" )
	{
		$objBd = new BancodeDados();
		$objAluno = new Aluno();
		$objAluno->obterAluno( $_POST["idAluno"] );
	
		$dados_login = array(
			'login'		=> $_POST['login'],
			'senha'		=> $_POST['senha']
		);
		
		if( !$objBd->edit( "login", $dados_login, $objAluno->getId_login() ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=aluno-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		$dados = array(
			"NM_ALUNO" 		=> $_POST["NM_ALUNO"],
			"PERIODO" 		=> $_POST["PERIODO"],
			"DS_TURMA" 		=> $_POST["DS_TURMA"],
			"nivel" 		=> $_POST["nivel"],
		);

		if( !$objBd->edit( "aluno", $dados, $objAluno->getId_aluno() ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=aluno-lista&st=" . $msg . "'</script>";
			exit();
		}

		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=aluno-lista&st=" . $msg . "'</script>";
		exit();
	}
}
else if ( isset( $_GET["action"] ) )
{
	if ( $_GET["action"] == "excluirAluno" )
	{
		$objBd = new BancodeDados();
		$objAluno = new Aluno();
		$objAluno->obterAluno( $_GET["idAluno"] );
		
		if( !$objBd->delete('login', $objAluno->getId_login() ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=aluno-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		if( !$objBd->delete('aluno', $objAluno->getId_aluno()) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=aluno-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=aluno-lista&st=" . $msg . "'</script>";
		exit();
	}
}
