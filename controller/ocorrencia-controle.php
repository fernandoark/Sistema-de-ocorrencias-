<?php 

session_start();

include_once "../config.php";
include_once "../model/bancodedados.class.php";
include_once "../model/alerta.class.php";
include_once "../model/data.class.php";
include_once "../model/ocorrencia.class.php";

if (isset($_POST["action"]))
{
	if ($_POST["action"] == "inserirOcorrencia")
	{
		$objBd = new BancodeDados();

		$dados = array(
			"id_aluno" 			=> $_POST["aluno"],
			"id_disciplina" 	=> $_POST["disciplina"],
			"id_professor" 		=> $_POST["professor"],
			"dt_ocorrencia" 	=> Data::formataDataBD( $_POST["dt_ocorrencia"] ),
			"dsc_ocorrencia" 	=> $_POST["dsc_ocorrencia"]
		);

		if( !$idOcorrencia = $objBd->insert( "ocorrencia", $dados ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=ocorrencia-lista&st=" . $msg . "'</script>";
			exit();
		}

		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=ocorrencia-lista&st=" . $msg . "'</script>";
		exit();
	}
	else if ( $_POST["action"] == "editarOcorrencia" )
	{
		$objBd = new BancodeDados();
		$objOcorrencia = new Ocorrencia();
		$objOcorrencia->obterOcorrencia( $_POST["idOcorrencia"] );

		$dados = array(
			"id_aluno" 			=> $_POST["aluno"],
			"id_disciplina" 	=> $_POST["disciplina"],
			"id_professor" 		=> $_POST["professor"],
			"dt_ocorrencia" 	=> Data::formataDataBD( $_POST["dt_ocorrencia"] ),
			"dsc_ocorrencia" 	=> $_POST["dsc_ocorrencia"],
		);

		if( !$objBd->edit( "ocorrencia", $dados, $objOcorrencia->getId_ocorrencia() ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=ocorrencia-lista&st=" . $msg . "'</script>";
			exit();
		}

		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=ocorrencia-lista&st=" . $msg . "'</script>";
		exit();
	}
}
else if ( isset( $_GET["action"] ) )
{
	if ( $_GET["action"] == "excluirOcorrencia" )
	{
		$objBd = new BancodeDados();
		$objOcorrencia = new Ocorrencia();
		$objOcorrencia->obterOcorrencia( $_GET["idOcorrencia"] );
		
		if( !$objBd->delete( "ocorrencia", $objOcorrencia->getId_ocorrencia() ) )
		{
			$objBd->rollback();
			$msg = "OPERACAO_ERRO";
			echo "<script>window.location='../view/index.php?p=ocorrencia-lista&st=" . $msg . "'</script>";
			exit();
		}
		
		$objBd->commit();
		$msg = "OPERACAO_SUCESSO";
		echo "<script>window.location='../view/index.php?p=ocorrencia-lista&st=" . $msg . "'</script>";
		exit();
	}
	else if( $_GET['action'] == 'montarTb' )
	{
		$objBd = new BancodeDados();
		$objOcorrencia = new Ocorrencia();
	
		$html = '';
		
		foreach( $objOcorrencia->listarOcorrencia( $_GET['idTurma'] ) as $ocorrencia ) 
		{
			$html .= '<tr><td>'. $ocorrencia['id_aluno'].'</td>';
			$html .= '<td>'. $ocorrencia['ds_turma'].'</td>';
			$html .= '<td>'. $ocorrencia['nm_aluno'].'</td>';
			$html .= '<td>'. $ocorrencia['disciplina'].'</td>';
			$html .= '<td>'. $ocorrencia['nome_professor'].'</td>';
			$html .= '<td>'. Data::formataData( $ocorrencia['dt_ocorrencia'] ).'</td>';
			$html .= '<td>'. $ocorrencia['dsc_ocorrencia'].'</td>';
			$html .= '</div>';
			$html .= '<td style="text-align: right">';
			$html .= '<a href="index.php?p=ocorrencia-form&idOcorrencia='. $ocorrencia['id_ocorrencia'].'" class="btn btn-small btn-info">Editar</a>';
			$html .= '<a href="../controller/ocorrencia-controle.php?action=excluirOcorrencia&idOcorrencia=' . $ocorrencia['id_ocorrencia'] .'" class="btn btn-small btn-danger">Excluir</a>';
			$html .= '</td>';
			$html .= '</tr>';
		}
		ini_set('default_charset', 'utf-8');
		echo $html;
	}
}
