<?php 

include_once '../model/alerta.class.php';
include_once '../model/disciplina.class.php';
include_once '../model/data.class.php';
include_once '../model/paginacao.class.php';

$objDisciplina = new Disciplina();
$objPaginacao = new Paginacao( $objDisciplina->listarDisciplina(), 15 );?>

<fieldset>
<legend>Disciplinas</legend>
<div style="float: right; margin-top: -58px"><a href="index.php?p=disciplina-form" class="btn btn-success btn-form">Cadastrar Disciplina</a></div>

<?php if (isset($_GET['st'])) { $objAlerta = new Alerta($_GET['st']); } ?>

<table class="table table-striped sortable">
<thead>
<tr>
<th>Id Disciplina</th>
<th>Disciplina </th>
<th>
</th>
</tr>
</thead>
<tbody>
<?php foreach( $objDisciplina->listarDisciplina() as $disciplina ) { ?>
<tr><td><?php echo $disciplina->getId_disciplina(); ?></td>
<td><?php echo $disciplina->getDisciplina(); ?></td>
<!--<td><span class="label label-success">ativo</span></td>-->
<td style="text-align: right">
<a href="index.php?p=disciplina-form&idDisciplina=<?php echo $disciplina->getId_disciplina();?>" class="btn btn-small btn-info">Editar</a>
<a href="../controller/disciplina-controle.php?action=excluirDisciplina&idDisciplina=<?php echo $disciplina->getId_disciplina(); ?>" class="btn btn-small btn-danger">Excluir</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
<?php $objPaginacao->drawPaginacao(); ?>
</fieldset>
