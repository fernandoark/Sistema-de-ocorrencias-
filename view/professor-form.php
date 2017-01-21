<?php

include_once '../model/professor.class.php';
include_once '../model/login.class.php';

$objProfessor = new Professor();
$objLogin = new Login();

$action = "inserirProfessor";

$titulo = 'Cadastrar Professor';

if( isset( $_GET["idProfessor"] ) )
{
	$action = "editarProfessor";
	
	$titulo = 'Editar Professor';
	
	$objProfessor->obterProfessor( $_GET["idProfessor"] );
	
	$objLogin->obterLogin( $objProfessor->getId_login() );
}

?>

<script src="../js/jquery.validate.min.js"></script>

<div class="row-fluid">
<div class="span6">

<h3 class="page-header"><?php echo $titulo; ?></h3>

<form id="form1" name="form1" method="post" action="../controller/professor-controle.php"  class="form-inline">

<input type="hidden" name="action" value="<?=$action?>" />
<input type="hidden" name="idProfessor" value="<?=$objProfessor->getId_professor()?>" />

<div class="control-group">
	<label class="control-label span3" for="nome_professor">Nome professor</label> 
	<input type="text" name="nome_professor" id="nome_professor"  class="span9" required="required" value="<?=$objProfessor->getNome_professor()?>" />
</div>

<div class="control-group">
	<label class="control-label span3" for="login">Login</label> 
	<input type="text" name="login" id="login"  class="span9" required="required" value="<?=$objLogin->getLogin()?>" />
</div>

<div class="control-group">
	<label class="control-label span3" for="senha">Senha</label> 
	<input type="password" name="senha" id="senha"  class="span9" required="required" value="<?php echo $objLogin->getSenha()?>" />
</div>

<div class="span9" style="margin-left: 110px">
	<a href="index.php?p=professor-lista" class="btn btn-info">Cancelar</a>
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
</div>

</form>
</div>
</div>