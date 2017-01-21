<?php 

include_once '../model/alerta.class.php';
include_once '../model/aluno.class.php';
include_once '../model/data.class.php';
include_once '../model/paginacao.class.php';

$objAluno = new Aluno();
$objPaginacao = new Paginacao( $objAluno->listarAluno(), 50 );?>

<fieldset>
<legend>Alunos</legend>
<div style="float: right; margin-top: -58px"><a href="index.php?p=aluno-form" class="btn btn-success btn-form">Cadastrar Aluno</a></div>

<?php if (isset($_GET['st'])) { $objAlerta = new Alerta($_GET['st']); } ?>

<table class="table table-striped sortable">
<thead>
<tr>
<th>Id_aluno </th>
<th>Nome do Aluno </th>
<th>Periodo </th>
<th>Turma </th>
<!--<th>CD_HANDKEY </th>-->
<!--<th>Nivel </th>-->
<th>
</th>
</tr>
</thead>
<tbody>
<?php foreach( $objAluno->listarAluno() as $aluno ) { ?>
<tr><td><?php echo $aluno->getId_aluno(); ?></td>
<td><?php echo $aluno->getNM_ALUNO(); ?></td>
<td><?php echo $aluno->getPERIODO(); ?></td>
<td><?php echo $aluno->getDS_TURMA(); ?></td>
<!--<td><?php //echo $aluno->getCD_HANDKEY(); ?></td>-->
<!--<td><?php //echo $aluno->getNivel(); ?></td>-->
<!--<td><span class="label label-success">ativo</span></td>-->
<td style="text-align: right">
<a href="index.php?p=aluno-form&idAluno=<?php echo $aluno->getId_aluno();?>" class="btn btn-small btn-info">Editar</a>
<a href="../controller/aluno-controle.php?action=excluirAluno&idAluno=<?php echo $aluno->getId_aluno(); ?>" class="btn btn-small btn-danger">Excluir</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>

</fieldset>
