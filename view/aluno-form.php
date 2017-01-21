<?php

include_once '../model/aluno.class.php';
include_once '../model/login.class.php';

$objAluno = new Aluno();
$objLogin = new Login();

$action = "inserirAluno";

$titulo = 'Cadastrar Aluno';

if( isset( $_GET["idAluno"] ) )
{
	$action = "editarAluno";
	
	$titulo = 'Editar Aluno';
	
	$objAluno->obterAluno( $_GET["idAluno"] );
	
	$objLogin->obterLogin( $objAluno->getId_login() );
}

?>

<script src="../js/jquery.validate.min.js"></script>

<div class="row-fluid">
<div class="span6">

<h3 class="page-header"><?php echo $titulo; ?></h3>

<form id="form1" name="form1" method="post" action="../controller/aluno-controle.php"  class="form-inline">

<input type="hidden" name="action" value="<?=$action?>" />
<input type="hidden" name="idAluno" value="<?=$objAluno->getId_aluno()?>" />

<div class="control-group">
	<label class="control-label span3" for="NM_ALUNO">NOME</label> 
	<input type="text" name="NM_ALUNO" id="NM_ALUNO"  class="span9" required="true" value="<?=$objAluno->getNM_ALUNO()?>" />
</div>

<div class="control-group">
	<label class="control-label span3" for="PERIODO">PERIODO</label> 
	<input type="text" name="PERIODO" id="PERIODO"  class="span9" required="true" value="<?=$objAluno->getPERIODO()?>" />
</div>

<div class="control-group">
	<label class="control-label span3" for="DS_TURMA">TURMA</label> 
	<input type="text" name="DS_TURMA" id="DS_TURMA"  class="span9" required="true" value="<?=$objAluno->getDS_TURMA()?>" />

</div>

<div class="control-group">
	<label class="control-label span3" for="login">LOGIN</label> 
	<input type="text" name="login" id="login"  class="span9" required="true" value="<?=$objLogin->getLogin()?>" />
</div>

<div class="control-group">
	<label class="control-label span3" for="senha">SENHA</label> 
	<input type="text" name="senha" id="senha"  class="span9" required="true" value="<?=$objLogin->getSenha()?>" />
</div>

<div style="display:none;" class="control-group">
	<label class="control-label span3" for="nivel">Nivel</label> 
	<input type="text" name="nivel" id="nivel"  class="span9" required="true" value="1" />
</div>

<div class="span9" style="margin-left: 110px">
	<a href="index.php?p=aluno-lista" class="btn btn-info">Cancelar</a>
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
</div>

</form>
</div>
</div>