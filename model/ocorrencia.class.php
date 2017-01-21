<?php 

include_once "bancodedados.class.php";
include_once 'aluno.class.php';
include_once 'disciplina.class.php';
include_once 'professor.class.php';

class Ocorrencia
{
	private $bd;
	private $id_ocorrencia;
	private $aluno;
	private $disciplina;
	private $professor;
	private $dt_ocorrencia;
	private $dsc_ocorrencia;

	public function __construct( BancodeDados $bdParam = null )
	{
		if ($bdParam == null) {
			$this->bd = BancodeDados::getInstance();
		} else {
			$this->bd = $bdParam;
		}

		$this->id_ocorrencia = '';
		$this->aluno = "";
		$this->disciplina = "";
		$this->professor = "";
		$this->dt_ocorrencia = '';
		$this->dsc_ocorrencia = '';
	}

	public function setId_ocorrencia( $id_ocorrencia )
	{
		$this->id_ocorrencia = $id_ocorrencia;
	}

	public function setAluno( $aluno )
	{
		$this->aluno = $aluno;
	}

	public function setDisciplina( $disciplina )
	{
		$this->disciplina = $disciplina;
	}

	public function setProfessor( $professor )
	{
		$this->professor = $professor;
	}

	public function setDt_ocorrencia( $dt_ocorrencia )
	{
		$this->dt_ocorrencia = $dt_ocorrencia;
	}

	public function setDsc_ocorrencia( $dsc_ocorrencia )
	{
		$this->dsc_ocorrencia = $dsc_ocorrencia;
	}

	public function getId_ocorrencia()
	{
		return $this->id_ocorrencia;
	}

	public function getAluno()
	{
		return $this->aluno;
	}

	public function getDisciplina()
	{
		return $this->disciplina;
	}

	public function getProfessor()
	{
		return $this->professor;
	}

	public function getDt_ocorrencia()
	{
		return $this->dt_ocorrencia;
	}

	public function getDsc_ocorrencia()
	{
		return $this->dsc_ocorrencia;
	}

	public function obterOcorrencia( $ocorrenciaID )
	{
		$result = $this->bd->obterRegistroPorId( "ocorrencia", $ocorrenciaID );
		return $this->montarObjeto( $result->fetch_array() );
	}

	public function listarOcorrencia( $id_turma = NULL )
	{
		$sql  = 'select ';
		$sql .= 'o.id_ocorrencia, ';
		$sql .= 'a.ds_turma, ';
		$sql .= 'a.id_aluno, ';
		$sql .= 'a.nm_aluno, '; 
		$sql .= 'd.disciplina, ';
		$sql .= 'p.nome_professor, '; 
		$sql .= 'o.dt_ocorrencia, ';
		$sql .= 'o.dsc_ocorrencia ';
		$sql .= 'from aluno a, ocorrencia o, disciplina d, professor p ';
		$sql .= 'WHERE o.id_aluno = a.id_aluno ';
		$sql .= 'AND o.id_professor = p.id_professor ';
		$sql .= 'AND o.id_disciplina = d.id_disciplina ';
		
		if( $id_turma &&  $id_turma != 'all' )
			$sql .= 'AND a.ds_turma = "' . $id_turma . '" ';
		
		$sql .= 'ORDER BY a.nm_aluno';

		$result = $this->bd->executarSQL($sql);

		if ( $result->num_rows > 0 )
			return $result;
		else
			return array();
	}
	
	
	public function listarOcorrenciaProAluno( $id_aluno )
	{
		$sql  = 'select ';
		$sql .= 'd.disciplina, ';
		$sql .= 'p.nome_professor, ';
		$sql .= 'o.dt_ocorrencia, ';
		$sql .= 'o.dsc_ocorrencia '; 
		$sql .= 'from aluno a, ocorrencia o, disciplina d, professor p ';
		$sql .= 'WHERE o.id_aluno = a.id_aluno ';
		$sql .= 'AND o.id_professor = p.id_professor ';
		$sql .= 'AND o.id_disciplina = d.id_disciplina ';
		$sql .= 'AND a.id_aluno = '. $id_aluno . ' ';
		
		$result = $this->bd->executarSQL($sql);
		
		if ( $result->num_rows > 0 )
			return $result;
		else
			return array();
	}
	
	 
		public function listarOcorrenciaPorTurma( $ds_turma )
	{
		
		$sql  = 'select ';
		$sql .= 'o.id_ocorrencia, ';
		$sql .= 'a.ds_turma, ';
		$sql .= 'a.id_aluno, ';
		$sql .= 'a.nm_aluno, '; 
		$sql .= 'd.disciplina, ';
		$sql .= 'p.nome_professor, '; 
		$sql .= 'o.dt_ocorrencia, ';
		$sql .= 'o.dsc_ocorrencia ';
		$sql .= 'from aluno a, ocorrencia o, disciplina d, professor p ';
		$sql .= 'WHERE o.id_aluno = a.id_aluno ';
		$sql .= 'AND o.id_professor = p.id_professor ';
		$sql .= 'AND o.id_disciplina = d.id_disciplina ';
		$sql .= 'AND a.ds_turma = '. $ds_turma . ' ';
		$sql .= 'ORDER BY a.nm_aluno';
		
		$result = $this->bd->executarSQL($sql);

		if ( $result->num_rows > 0 )
			return $result;
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
		$this->setId_ocorrencia( $row["id_ocorrencia"] );
		$this->setAluno( $row["id_aluno"] );
		$this->setDisciplina( $row["id_disciplina"] );
		$this->setProfessor( $row["id_professor"] );
		$this->setDt_ocorrencia( $row["dt_ocorrencia"] );
		$this->setDsc_ocorrencia( $row["dsc_ocorrencia"] );
	}
}
?>