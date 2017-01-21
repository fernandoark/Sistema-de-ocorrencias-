<?php 

include_once "bancodedados.class.php";

class Disciplina
{
	private $bd;
	private $id_disciplina;
	private $disciplina;

	public function __construct( BancodeDados $bdParam = null )
	{
		if ($bdParam == null) {
			$this->bd = BancodeDados::getInstance();
		} else {
			$this->bd = $bdParam;
		}

		$this->id_disciplina = '';
		$this->disciplina = '';
	}

	public function setId_disciplina( $id_disciplina )
	{
		$this->id_disciplina = $id_disciplina;
	}

	public function setDisciplina( $disciplina )
	{
		$this->disciplina = $disciplina;
	}

	public function getId_disciplina()
	{
		return $this->id_disciplina;
	}

	public function getDisciplina()
	{
		return $this->disciplina;
	}

	public function obterDisciplina( $disciplinaID )
	{
		$result = $this->bd->obterRegistroPorId( "disciplina", $disciplinaID );
		return $this->montarObjeto( $result->fetch_array() );
	}

	public function listarDisciplina( Paginacao $objPaginacao = NULL )
	{
		$sql  = "select * ";
		$sql .= "from disciplina ";

		if ($objPaginacao)
		{
			$sql .= "limit " . $objPaginacao->getInicio() . "," . $objPaginacao->getResultPorPagina();
		}

		$result = $this->bd->executarSQL($sql);

		if ( $result->num_rows > 0 )
			return $this->montarLista($result);
		else
			return array();
	}

	private function montarLista( $result )
	{
		if( $result->num_rows > 0 )
		{
			while( $row = $result->fetch_array() )
			{
				$obj = new self();
				$obj->montarObjeto( $row );
				$objs[] = $obj;
				$obj = null;
			}
			return $objs;
		}
		else
		{
			return false;
		}
	}

	private function montarObjeto( $row )
	{
		$this->setId_disciplina( $row["id_disciplina"] );
		$this->setDisciplina( $row["disciplina"] );
	}
}
?>