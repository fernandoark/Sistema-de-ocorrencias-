<?php

include_once '../model/ocorrencia.class.php';
include_once '../model/aluno.class.php';
include_once '../model/disciplina.class.php';
include_once '../model/professor.class.php';
include_once '../model/data.class.php';

$objAluno = new Aluno();
$objDisciplina = new Disciplina();
$objProfessor = new Professor();
$objOcorrencia = new Ocorrencia();

$action = "inserirOcorrencia";

$titulo = 'Cadastrar OcorrÍncia';

if( isset( $_GET["idOcorrencia"] ) )
{
	$action = "editarOcorrencia";
	
	$titulo = 'Editar OcorrÍncia';
	
	$objOcorrencia->obterOcorrencia( $_GET["idOcorrencia"] );
}

?>

<script src="../js/jquery.validate.min.js"></script>
<script src="../js/jquery-ui.js"></script>
<link rel="stylesheet" href="../css/jquery-ui.css" />

<div class="row-fluid">
<div class="span6">

<h3 class="page-header"><?php echo $titulo; ?></h3>

<form id="form1" name="form1" method="post" action="../controller/ocorrencia-controle.php"  class="form-inline">

<input type="hidden" name="action" value="<?=$action?>" />
<input type="hidden" name="idOcorrencia" value="<?=$objOcorrencia->getId_ocorrencia()?>" />

<div class="control-group">
	<label for="aluno" class="control-label span3">Aluno</label>
	<select name="aluno" id="aluno" class="span9" required="true">
	<option value="" disabled="disabled" selected="selected">Selecione a aluno</option>
	<?php foreach( $objAluno->listarAluno() as $aluno ) { ?>
		<option value="<?=$aluno->getId_aluno()?>" <?php if( $aluno->getId_aluno() == $objOcorrencia->getAluno() ){ ?>selected="selected"<?php } ?>>
		<?=$aluno->getNM_ALUNO()?></option>
	<?php } ?>
	</select>
</div>

<div class="control-group">
	<label for="disciplina" class="control-label span3">Disciplina</label>
	<select name="disciplina" id="disciplina" class="span9" required="true">
	<option value="" disabled="disabled" selected="selected">Selecione a disciplina</option>
	<?php foreach( $objDisciplina->listarDisciplina() as $disciplina ) { ?>
		<option value="<?=$disciplina->getId_disciplina()?>" <?php if( $disciplina->getId_disciplina() == $objOcorrencia->getDisciplina() ){ ?>selected="selected"<?php } ?>>
		<?=$disciplina->getDisciplina()?></option>
	<?php } ?>
	</select>
</div>

<div class="control-group">
	<label for="professor" class="control-label span3">Professor</label>
	
	<?php if( $_SESSION["tcc_tipo"] == Tipologin::PROFESSOR ) { ?>
	
	<select name="professor" id="professor" class="span9" required="true">
	<?php foreach( $objProfessor->listarProfessor() as $professor ) { ?>
		<option value="<?=$professor->getId_professor()?>" <?php if( $professor->getId_professor() == $objUsrLogado->getId_professor() ){ ?>selected="selected"<?php } ?>>
		<?=$professor->getNome_professor()?></option>
	<?php } ?>
	</select>
	
	<?php } else { ?>
	
	<select name="professor" id="professor" class="span9" required="true">
	<option value="" disabled="disabled" selected="selected">Selecione a professor</option>
	<?php foreach( $objProfessor->listarProfessor() as $professor ) { ?>
		<option value="<?=$professor->getId_professor()?>" <?php if( $professor->getId_professor() == $objOcorrencia->getProfessor() ){ ?>selected="selected"<?php } ?>>
		<?=$professor->getNome_professor()?></option>
	<?php } ?>
	</select>
	
	<?php } ?>
	
</div>

<div class="control-group">
	<label class="control-label span3" for="dt_ocorrencia">Data</label> 
	<input type="text" name="dt_ocorrencia" id="calendario" class="span9" value="<?=Data::formataData( $objOcorrencia->getDt_ocorrencia() )?>" required="true" <?php echo date('d-m-Y');?>/>
</div>

<div class="control-group">
	<label class="control-label span3" for="dsc_ocorrencia">OcorrÍncia</label> 
	<textarea rows="5" cols="" required="true" name="dsc_ocorrencia" id="dsc_ocorrencia" class="span9"><?=$objOcorrencia->getDsc_ocorrencia()?></textarea>
	
</div>
	
<div class="span9" style="margin-left: 110px">
	<a href="index.php?p=ocorrencia-lista" class="btn btn-info">Cancelar</a>
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
</div>

</form>
</div>
</div>

<script>
$(function() {
    $("#calendario").datepicker({
		maxDate: "+1d -1d",
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Ter√ßa','Quarta','Quinta','Sexta','S√°bado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','S√°b','Dom'],
        monthNames: ['Janeiro','Fevereiro','Mar√ßo','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
});
</script>