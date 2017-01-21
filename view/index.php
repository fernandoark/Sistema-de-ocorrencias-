<?php

session_start();	

include_once '../config.php';
include_once '../controller/verifica-login.php';
include_once '../model/tipologin.class.php';

paginaRestrita();

if( $_SESSION["tcc_tipo"] == Tipologin::DIRETOR )
{
	require '../model/professor.class.php';
	$objUsrLogado = new Professor();
	$objUsrLogado->obterProfessorPorLogin( $_SESSION["tcc_id_login"] );
	
	$menu = array(
		'professor-lista'	=> "Professor",
		'disciplina-lista'	=> "Disciplinas",
		'aluno-lista'		=> 'Alunos',
		'ocorrencia-lista'	=> 'Ocorrências'
	);
}
else if( $_SESSION["tcc_tipo"] == Tipologin::PROFESSOR )
{
	
	require '../model/professor.class.php';
	$objUsrLogado = new Professor();
	$objUsrLogado->obterProfessorPorLogin( $_SESSION["tcc_id_login"] );
	
	$menu = array(
		'ocorrencia-lista'	=> "Ocorrências"
	);
}
else
{
	header('Location: aluno-ocorrencia.php');
}


isset( $_GET['p'] ) ? $pagina = $_GET['p'] : $pagina = "ocorrencia-lista";

$menuKeys = array_keys($menu);

function compararPaginas( $pagina1, $pagina2 )
{
	$valor1 = explode("-", $pagina1);
	$valor2 = explode("-", $pagina2);

	if( $valor1[0] == $valor2[0] )
		return true;
	else
		return false;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>
<head>
	
  	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="author" content="Oriente">
	<link href='' rel='shortcut icon' type='image/x-icon'>
	<title><?php echo NOME_DO_SITE; ?></title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic">
	<link rel="stylesheet" href="../css/style.css">
  
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
		$(document).ready(function() {
			//
		});
	</script>
  </head>
  <body>
    <div id="website">
	  <div class="w-corpo">
      	
      	
      	<!-- <a class="brand" href="index.php"><img src="../img/bandeira.jpg"  alt=" " width="150px"></a>  -->

			<div class="navbar">
			  <div class="navbar-inner">
			    
			    
			    <div style="float:right; margin-top:8px;">Ol&aacute;, <?php echo $objUsrLogado->getNome_professor(); ?> | <a href="../controller/login-controle.php?logout=1">Sair</a></div>
			    <ul class="nav">
			    
			     	<li><a href="index.php"><i class="icon-user"></i> <?php echo NOME_DO_SITE?></a></li>
			    
			        <?php for($i=0; $i<count($menu); $i++) { ?>
			        
			        <li <?php if( compararPaginas($pagina, $menuKeys[$i]) ) { echo ' class="active"'; }?>>
			            
			            <a href="index.php?p=<?=$menuKeys[$i]?>"> <?=$menu[$menuKeys[$i]]?></a>
			      	</li>
			        
			        <?php } ?>
			        
			    </ul>
			  
			 </div>
			</div>
			
			
			<div class="row-fluid">
				<?php include_once( $pagina.'.php' ); ?>
			</div>
			

      </div>
    </div>
    
    <footer>
      
	  <div class="w-corpo">
	  	
        <div class="row-fluid">
         
            <p class="pull-right"><img src="/img/footerlogo2.png"></p>
			<p>&copy; Copyright <?php echo date('Y');?></p>
         
        </div>
      </div>
      
    </footer>
    
  </body>
</html>