<?php

session_start();	

include_once '../config.php';
include_once '../controller/verifica-login.php';
include_once '../model/aluno.class.php';
include_once '../model/ocorrencia.class.php';
include_once '../model/data.class.php';

paginaRestrita();

$objAluno = new Aluno();
$objAluno->obterAlunoPorLogin( $_SESSION["tcc_id_login"] );

$objOcorrencia = new Ocorrencia();

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
			    
			    
			    <div style="float:right; margin-top:8px;">Ol&aacute;, <?php echo $objAluno->getNM_ALUNO(); ?> | <a href="../controller/login-controle.php?logout=1">Sair</a></div>
			    <ul class="nav">
			    
			     	<li><a href="index.php"><i class="icon-user"></i> <?php echo NOME_DO_SITE?></a></li>
			    
			        
			        
			        <li  class="active">
			            <a href="#"> Minhas Ocorrências</a>
			      	</li>
			        
			        
			        
			    </ul>
			  
			 </div>
			</div>
			
			
			<div class="row-fluid">
				<fieldset>
				<legend>Ocorrencias</legend>
				
				
				<button type="button" class="btn btn-info" onclick="javascript:imprimirG();">Imprimir</button><br><br>
				<div id="relatoriogeral">
				<div id="printar">
				<table class="table table-striped sortable">
				<thead>
				<tr>
				
				
				
				<th>Disciplina </th>
				<th>Professor </th>
				<th>Data Ocorr&ecirc;ncia </th>
				<th>Ocorr&ecirc;ncia</th>
				
				</tr>
				</thead>
				<tbody>
				<?php foreach( $objOcorrencia->listarOcorrenciaProAluno( $objAluno->getId_aluno() ) as $ocorrencia ) { ?>
				<tr>
				
				
				
				<td><?php echo $ocorrencia['disciplina']; ?></td>
				<td><?php echo $ocorrencia['nome_professor']; ?></td>
				<td><?php echo Data::formataData( $ocorrencia['dt_ocorrencia'] ); ?></td>
				<td><?php echo $ocorrencia['dsc_ocorrencia']; ?></td>
				</div>
				
				</tr>
				<?php } ?>
				</tbody>
				</table>
				</div>
				</fieldset>
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

<script type="text/javascript">
            function imprimirG(){
                var pagina = document.getElementById("relatoriogeral").innerHTML;
                //var relg = "<h2>Relatorio Geral</h2>";
                var novaJanela = window.open('Relatorio','_blank','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=940,height=480,directories=no,location=no');
                novaJanela.document.write("<head>");
				novaJanela.document.write("<meta http-equiv='content-type' content='text/html; charset=iso-8859-1' />");
				novaJanela.document.write("<style tyle='text/css' media='print'>button{display: none;}</style>");
				novaJanela.document.write("<style tyle='text/css' media='all'>a{color: #0000FF;}</style>");
				novaJanela.document.write("</head>");
                //novaJanela.document.write("<button type='button' onclick='javascript:window.print();'>Imprimir PÃ¡gina</button>");
				novaJanela.document.write(pagina);
                novaJanela.document.write("<button type='button' onclick='javascript:window.print();'>Imprimir</button>");
            }
        </script>