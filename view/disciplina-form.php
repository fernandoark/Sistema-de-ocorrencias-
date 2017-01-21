<?php

include_once '../model/disciplina.class.php';

$objDisciplina = new Disciplina();

$action = "inserirDisciplina";

$titulo = 'Cadastrar Disciplina';

if( isset( $_GET["idDisciplina"] ) )
{
	$action = "editarDisciplina";
	
	$titulo = 'Editar Disciplina';
	
	$objDisciplina->obterDisciplina( $_GET["idDisciplina"] );
}

?>

<script src="../js/jquery.validate.min.js"></script>

<div class="row-fluid">
<div class="span6">

<h3 class="page-header"><?php echo $titulo; ?></h3>

<form id="form1" name="form1" method="post" action="../controller/disciplina-controle.php"  class="form-inline">

<input type="hidden" name="action" value="<?=$action?>" />
<input type="hidden" name="idDisciplina" value="<?=$objDisciplina->getId_disciplina()?>" />

<div class="control-group">
	<label class="control-label span3" for="disciplina">Disciplina</label> 
	<input type="text" name="disciplina" id="disciplina"  class="span9" required="true" value="<?=$objDisciplina->getDisciplina()?>" />
</div>

<div class="span9" style="margin-left: 110px">
	<a href="index.php?p=disciplina-lista" class="btn btn-info">Cancelar</a>
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
</div>

</form>
</div>
</div>