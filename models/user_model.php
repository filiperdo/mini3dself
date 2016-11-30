<?php 

/** 
 * Classe User
 * @author __ 
 *
 * Data: 30/11/2016
 */ 

include_once 'usertype_model.php';

class User_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_user;
	private $name;
	private $email;
	private $login;
	private $password;
	private $date;
	private $lastlogin;
	private $adress1;
	private $adress2;
	private $phone1;
	private $phone2;
	private $num_login;
	private $usertype;

	public function __construct()
	{
		parent::__construct();

		$this->id_user = '';
		$this->name = '';
		$this->email = '';
		$this->login = '';
		$this->password = '';
		$this->date = '';
		$this->lastlogin = '';
		$this->adress1 = '';
		$this->adress2 = '';
		$this->phone1 = '';
		$this->phone2 = '';
		$this->num_login = '';
		$this->usertype = new Usertype_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_user( $id_user )
	{
		$this->id_user = $id_user;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setEmail( $email )
	{
		$this->email = $email;
	}

	public function setLogin( $login )
	{
		$this->login = $login;
	}

	public function setPassword( $password )
	{
		$this->password = $password;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setLastlogin( $lastlogin )
	{
		$this->lastlogin = $lastlogin;
	}

	public function setAdress1( $adress1 )
	{
		$this->adress1 = $adress1;
	}

	public function setAdress2( $adress2 )
	{
		$this->adress2 = $adress2;
	}

	public function setPhone1( $phone1 )
	{
		$this->phone1 = $phone1;
	}

	public function setPhone2( $phone2 )
	{
		$this->phone2 = $phone2;
	}

	public function setNum_login( $num_login )
	{
		$this->num_login = $num_login;
	}

	public function setUsertype( Usertype_Model $usertype )
	{
		$this->usertype = $usertype;
	}

	/** 
	* Metodos get's
	*/
	public function getId_user()
	{
		return $this->id_user;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getLogin()
	{
		return $this->login;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getLastlogin()
	{
		return $this->lastlogin;
	}

	public function getAdress1()
	{
		return $this->adress1;
	}

	public function getAdress2()
	{
		return $this->adress2;
	}

	public function getPhone1()
	{
		return $this->phone1;
	}

	public function getPhone2()
	{
		return $this->phone2;
	}

	public function getNum_login()
	{
		return $this->num_login;
	}

	public function getUsertype()
	{
		return $this->usertype;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "user", $data ) ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return true;
	}

	/** 
	* Metodo edit
	*/
	public function edit( $data, $id )
	{
		$this->db->beginTransaction();

		if( !$update = $this->db->update("user", $data, "id_user = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $update;
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->db->beginTransaction();

	 if( !$delete = $this->db->delete("user", "id_user = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterUser
	*/
	public function obterUser( $id_user )
	{
		$sql  = "select * ";
		$sql .= "from user ";
		$sql .= "where id_user = :id ";

		$result = $this->db->select( $sql, array("id" => $id_user) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarUser
	*/
	public function listarUser()
	{
		$sql  = "select * ";
		$sql .= "from user ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_user like :id "; // Configurar o like com o campo necessario da tabela 
			$result = $this->db->select( $sql, array("id" => "%{$_POST["like"]}%") );
		}
		else
			$result = $this->db->select( $sql );

		return $this->montarLista($result);
	}

	/** 
	* Metodo montarLista
	*/
	private function montarLista( $result )
	{
		$objs = array();
		if( !empty( $result ) )
		{
			foreach( $result as $row )
			{
				$obj = new self();
				$obj->montarObjeto( $row );
				$objs[] = $obj;
				$obj = null;
			}
		}
		return $objs;
	}

	/** 
	* Metodo montarObjeto
	*/
	private function montarObjeto( $row )
	{
		$this->setId_user( $row["id_user"] );
		$this->setName( $row["name"] );
		$this->setEmail( $row["email"] );
		$this->setLogin( $row["login"] );
		$this->setPassword( $row["password"] );
		$this->setDate( $row["date"] );
		$this->setLastlogin( $row["lastlogin"] );
		$this->setAdress1( $row["adress1"] );
		$this->setAdress2( $row["adress2"] );
		$this->setPhone1( $row["phone1"] );
		$this->setPhone2( $row["phone2"] );
		$this->setNum_login( $row["num_login"] );

		$objUsertype = new Usertype_Model();
		$objUsertype->obterUsertype( $row["id_usertype"] );
		$this->setUsertype( $objUsertype );

		return $this;
	}
}
?>