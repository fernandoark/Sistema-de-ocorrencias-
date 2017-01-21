<?php 

session_start();

include_once "../config.php";
include_once "../model/bancodedados.class.php";
include_once "../model/data.class.php";
include_once "../model/disciplina.class.php";

if (isset($_POST["action"]))
{
	if ($_POST["action"] == "inserirDisciplina")
	{
		$objBd = new BancodeDados();

		$dados = array(
			"disciplina" => $_POST["disciplina"]
		);

		if( !$idDisciplina = $objBd->insert( "disciplina", $dados ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=disciplina-lista&st=" . $msg . "'</script>";
			exit();
		}

		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=disciplina-lista&st=" . $msg . "'</script>";
		exit();
	}
	else if ( $_POST["action"] == "editarDisciplina" )
	{
		$objBd = new BancodeDados();
		$objDisciplina = new Disciplina();
		$objDisciplina->obterDisciplina( $_POST["idDisciplina"] );

		$dados = array(
			"disciplina" => $_POST["disciplina"],
		);

		if( !$objBd->edit( "disciplina", $dados, $objDisciplina->getId_disciplina() ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=disciplina-lista&st=" . $msg . "'</script>";
			exit();
		}

		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=disciplina-lista&st=" . $msg . "'</script>";
		exit();
	}
}
else if ( isset( $_GET["action"] ) )
{
	if ( $_GET["action"] == "excluirDisciplina" )
	{
		$objBd = new BancodeDados();
		
		if( !$objBd->delete('disciplina', $_GET['idDisciplina'] ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=disciplina-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=disciplina-lista&st=" . $msg . "'</script>";
		exit();
	}
}
