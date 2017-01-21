<?php 

include_once "bancodedados.class.php";

class Login
{
	private $bd;
	private $id_login;
	private $login;
	private $senha;
	private $tipologin;

	public function __construct( BancodeDados $bdParam = null )
	{
		if ($bdParam == null) {
			$this->bd = BancodeDados::getInstance();
		} else {
			$this->bd = $bdParam;
		}

		$this->id_login = '';
		$this->login = '';
		$this->senha = '';
		$this->tipologin = '';
	}

	public function setId_login( $id_login )
	{
		$this->id_login = $id_login;
	}

	public function setLogin( $login )
	{
		$this->login = $login;
	}

	public function setSenha( $senha )
	{
		$this->senha = $senha;
	}

	public function setTipologin( $tipologin )
	{
		$this->tipologin = $tipologin;
	}

	public function getId_login()
	{
		return $this->id_login;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function getSenha()
	{
		return $this->senha;
	}

	public function getTipologin()
	{
		return $this->tipologin;
	}

	public function obterLogin( $loginID )
	{
		$result = $this->bd->obterRegistroPorId( "login", $loginID );
		return $this->montarObjeto( $result->fetch_array() );
	}

	public function listarLogin( Paginacao $objPaginacao = NULL )
	{
		$sql  = "select * ";
		$sql .= "from login ";

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
		$this->setId_login( $row["id_login"] );
		$this->setLogin( $row["login"] );
		$this->setSenha( $row["senha"] );
		$this->setTipologin( $row["tipologin"] );
	}
	
	public function autenticarUsuario( $login, $senha )
	{
		$login = addslashes( $login );
		$senha = addslashes( $senha );
	
		$sql  = "select * ";
		$sql .= "from login as l ";
		$sql .= "where l.login = '" . $login . "' ";
		$sql .= "and l.senha = '" . $senha . "' ";
	
		$result = $this->bd->executarSQL($sql);
	
		if ( $result->num_rows == 1 )
		{
			$this->montarObjeto( $result->fetch_array() );
	
			$_SESSION['tcc_logado'] = true;
			$_SESSION["tcc_id_login"] = $this->id_login;
			$_SESSION["tcc_tipo"] = $this->tipologin;
			
			//setcookie( "logado", 1 );
			//$log = 1;
	
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>