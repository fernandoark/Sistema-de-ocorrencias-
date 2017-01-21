<?php 

include_once "bancodedados.class.php";

class Professor
{
	private $bd;
	private $id_professor;
	private $nome_professor;
	private $id_login;

	public function __construct( BancodeDados $bdParam = null )
	{
		if ($bdParam == null) {
			$this->bd = BancodeDados::getInstance();
		} else {
			$this->bd = $bdParam;
		}

		$this->id_professor = '';
		$this->nome_professor = '';
		$this->id_login = '';
	}

	public function setId_professor( $id_professor )
	{
		$this->id_professor = $id_professor;
	}

	public function setNome_professor( $nome_professor )
	{
		$this->nome_professor = $nome_professor;
	}

	public function setId_login( $id_login )
	{
		$this->id_login = $id_login;
	}
	
	public function getId_professor()
	{
		return $this->id_professor;
	}

	public function getNome_professor()
	{
		return $this->nome_professor;
	}

	public function getId_login()
	{
		return $this->id_login;
	}
	
	public function obterProfessor( $professorID )
	{
		$result = $this->bd->obterRegistroPorId( "professor", $professorID );
		return $this->montarObjeto( $result->fetch_array() );
	}

	public function obterProfessorPorLogin( $id_login )
	{
		$sql  = 'select * ';
		$sql .= 'from professor as p ';
		$sql .= 'where p.id_login = '. $id_login .' ';
		$sql .= 'limit 1 ';
		
		$result = $this->bd->executarSQL($sql);
		
		if ( $result->num_rows > 0 )
			return $this->montarObjeto( $result->fetch_array() );
	}
	
	public function listarProfessor( Paginacao $objPaginacao = NULL )
	{
		$sql  = "select * ";
		$sql .= "from professor ";

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
		$this->setId_professor( $row["id_professor"] );
		$this->setNome_professor( $row["nome_professor"] );
		$this->setId_login( $row["id_login"] );
	}
}
?>