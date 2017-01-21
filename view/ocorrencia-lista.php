<?php 

include_once '../model/alerta.class.php';
include_once '../model/ocorrencia.class.php';
include_once '../model/data.class.php';
include_once '../model/paginacao.class.php';
include_once '../model/aluno.class.php';

$objOcorrencia = new Ocorrencia();
$objAluno = new Aluno();

?>

<fieldset>
<legend>Ocorrencias</legend>
<div style="float: right; margin-top: -58px"><a href="index.php?p=ocorrencia-form" class="btn btn-small btn-success btn-form">Cadastrar Ocorrencia</a></div>

<?php if( $_SESSION["tcc_tipo"] == Tipologin::DIRETOR ) { ?>

<div style="float: right; ">
	<label>Turmas: 
	<select name="turma" id="turma">
		<option value="all">Todas</option>
		<?php foreach( $objAluno->listarTurmas() as $turma ) { ?>
		<option value="<?php echo $turma->getDS_TURMA()?>"><?php echo $turma->getDS_TURMA()?></option>
		<?php } ?>
	</select>
	</label>
</div>

<?php } ?>

<button type="button" class="btn btn-info" onclick="javascript:imprimirG();">Imprimir relatorio geral</button><br><br>
<div id="relatoriogeral">
<div id="printar">
<?php if (isset($_GET['st'])) { $objAlerta = new Alerta($_GET['st']); } ?>
<table class="table table-striped sortable">
<thead>
<tr>
<th>Cod Aluno </th>
<th>Turma </th>
<th>Nome do Aluno </th>
<th>Disciplina </th>
<th>Professor </th>
<th>Data Ocorr&ecirc;ncia </th>
<th>Ocorr&ecirc;ncia</th>
<th>
</th>
</tr>
</thead>
<tbody id="tb-ocorrencias">
<?php foreach( $objOcorrencia->listarOcorrencia() as $ocorrencia ) { ?>
<tr><td><?php echo $ocorrencia['id_aluno']; ?></td>
<td><?php echo $ocorrencia['ds_turma']; ?></td>
<td><?php echo $ocorrencia['nm_aluno']; ?></td>
<td><?php echo $ocorrencia['disciplina']; ?></td>
<td><?php echo $ocorrencia['nome_professor']; ?></td>
<td><?php echo Data::formataData( $ocorrencia['dt_ocorrencia'] ); ?></td>
<td><?php echo $ocorrencia['dsc_ocorrencia']; ?></td>
</div>
<td style="text-align: right">
<a href="index.php?p=ocorrencia-form&idOcorrencia=<?php echo $ocorrencia['id_ocorrencia'];?>" class="btn btn-small btn-info">Editar</a>
<a href="../controller/ocorrencia-controle.php?action=excluirOcorrencia&idOcorrencia=<?php echo $ocorrencia['id_ocorrencia']; ?>" class="btn btn-small btn-danger">Excluir</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</fieldset>

<script type="text/javascript">
	$(document).ready(function() {
		
		$('#turma').change(function(){
			$('#tb-ocorrencias').load( '../controller/ocorrencia-controle.php?action=montarTb&idTurma=' + $(this).val() );
		});
	});
</script>

<script type="text/javascript">
            function imprimirG(){
                var pagina = document.getElementById("printar").innerHTML;
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
