<?php 

include_once '../model/alerta.class.php';
include_once '../model/professor.class.php';
include_once '../model/data.class.php';
include_once '../model/paginacao.class.php';

$objProfessor = new Professor();
$objPaginacao = new Paginacao( $objProfessor->listarProfessor(), 50 );

?>

<fieldset>
<legend>Professor</legend>
<div style="float: right; margin-top: -58px"><a href="index.php?p=professor-form" class="btn btn-success btn-form">Cadastrar Professor</a></div>

<?php if (isset($_GET['st'])) { $objAlerta = new Alerta($_GET['st']); } ?>

<table class="table table-striped sortable">
<thead>
<tr>
<th>Id Professor</th>
<th>Nome Professor </th>
<th>
</th>
</tr>
</thead>
<tbody>
<?php foreach( $objProfessor->listarProfessor() as $professor ) { ?>
<tr><td><?php echo $professor->getId_professor(); ?></td>
<td><?php echo $professor->getNome_professor(); ?></td>
<!--<td><span class="label label-success">ativo</span></td>-->
<td style="text-align: right">
<a href="index.php?p=professor-form&idProfessor=<?php echo $professor->getId_professor();?>" class="btn btn-small btn-info">Editar</a>
<a href="../controller/professor-controle.php?action=excluirProfessor&idProfessor=<?php echo $professor->getId_professor()?>" class="btn btn-small btn-danger">Excluir</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
<?php $objPaginacao->drawPaginacao(); ?>
</fieldset>
