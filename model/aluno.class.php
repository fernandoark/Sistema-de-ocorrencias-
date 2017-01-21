<?php 

include_once "bancodedados.class.php";

class Aluno
{
	private $bd;
	private $id_aluno;
	private $NM_ALUNO;
	private $PERIODO;
	private $DS_TURMA;
	private $CD_HANDKEY;
	private $nivel;
	private $id_login;
	
	public function __construct( BancodeDados $bdParam = null )
	{
		if ($bdParam == null) {
			$this->bd = BancodeDados::getInstance();
		} else {
			$this->bd = $bdParam;
		}

		$this->id_aluno = '';
		$this->NM_ALUNO = '';
		$this->PERIODO = '';
		$this->DS_TURMA = '';
		$this->CD_HANDKEY = '';
		$this->nivel = '';
		$this->id_login = '';
	}

	public function setId_aluno( $id_aluno )
	{
		$this->id_aluno = $id_aluno;
	}

	public function setNM_ALUNO( $NM_ALUNO )
	{
		$this->NM_ALUNO = $NM_ALUNO;
	}

	public function setPERIODO( $PERIODO )
	{
		$this->PERIODO = $PERIODO;
	}

	public function setDS_TURMA( $DS_TURMA )
	{
		$this->DS_TURMA = $DS_TURMA;
	}
	
	public function setCD_HANDKEY( $CD_HANDKEY )
	{
		$this->CD_HANDKEY = $CD_HANDKEY;
	}

	public function setNivel( $nivel )
	{
		$this->nivel = $nivel;
	}

	public function setId_login( $id_login )
	{
		$this->id_login = $id_login;
	}
	
	public function getId_aluno()
	{
		return $this->id_aluno;
	}

	public function getNM_ALUNO()
	{
		return $this->NM_ALUNO;
	}

	public function getPERIODO()
	{
		return $this->PERIODO;
	}

	public function getDS_TURMA()
	{
		return $this->DS_TURMA;
	}
	
	public function getCD_HANDKEY()
	{
		return $this->CD_HANDKEY;
	}

	public function getNivel()
	{
		return $this->nivel;
	}

	public function getId_login()
	{
		return $this->id_login;
	}
	
	public function obterAluno( $alunoID )
	{
		$result = $this->bd->obterRegistroPorId( "aluno", $alunoID );
		return $this->montarObjeto( $result->fetch_array() );
	}
	
	public function obterAlunoPorLogin( $id_login )
	{
		$sql  = 'select * ';
		$sql .= 'from aluno as a ';
		$sql .=	'where a.id_login = '. $id_login . ' ';
		
		$result = $this->bd->executarSQL($sql);
		
		if ( $result->num_rows > 0 )
			return $this->montarObjeto( $result->fetch_array() );
	}
	
	public function listarAluno( $idTurma = NULL )
	{
		$sql  = "select * ";
		$sql .= "from aluno as a ";

		if ( $idTurma )
		{
			$sql .= "where a.DS_TURMA =" . $idTurma . ' ';
		}

		$result = $this->bd->executarSQL($sql);

		if ( $result->num_rows > 0 )
			return $this->montarLista($result);
		else
			return array();
	}

	public function listarTurmas()
	{
		$sql  = "select * ";
		$sql .= "from aluno as a ";
		$sql .= "group by a.DS_TURMA ";
	
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
		$this->setId_aluno( $row["id_aluno"] );
		$this->setNM_ALUNO( $row["NM_ALUNO"] );
		$this->setPERIODO( $row["PERIODO"] );
		$this->setDS_TURMA( $row["DS_TURMA"] );
		$this->setCD_HANDKEY( $row["CD_HANDKEY"] );
		$this->setNivel( $row["nivel"] );
		$this->setId_login( $row["id_login"] );
	}
	
	
}
?>