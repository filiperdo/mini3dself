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
	private $cep;
	private $adress;
	private $number;
	private $cpf;
	private $complement;
	private $district;
	private $city;
	private $state;
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
		$this->cep = '';
		$this->adress = '';
		$this->number = '';
		$this->cpf = '';
		$this->complement = '';
		$this->district = '';
		$this->city = '';
		$this->state = '';
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

	public function setCep( $cep )
	{
		$this->cep = $cep;
	}

	public function setAdress( $adress )
	{
		$this->adress = $adress;
	}

	public function setNumber( $number )
	{
		$this->number = $number;
	}

	public function setCpf( $cpf )
	{
		$this->cpf = $cpf;
	}

	public function setComplement( $complement )
	{
		$this->complement = $complement;
	}

	public function setDistrict( $district )
	{
		$this->district = $district;
	}

	public function setCity( $city )
	{
		$this->city = $city;
	}

	public function setState( $state )
	{
		$this->state = $state;
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

	public function getCep()
	{
		return $this->cep;
	}

	public function getAdress()
	{
		return $this->adress;
	}

	public function getNumber()
	{
		return $this->number;
	}

	public function getCpf()
	{
		return $this->cpf;
	}

	public function getComplement()
	{
		return $this->complement;
	}

	public function getDistrict()
	{
		return $this->district;
	}

	public function getCity()
	{
		return $this->city;
	}

	public function getState()
	{
		return $this->state;
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
		//$this->db->beginTransaction();

		if( !$update = $this->db->update("user", $data, "id_user = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		//$this->db->commit();
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


	/*
	 * Metodo login customer
	 */
	public function login()
    {
    	$sql  = 'SELECT * ';
    	$sql .= 'FROM user ';
    	$sql .= 'WHERE email = :email ';
    	$sql .= 'AND password = :password ';

        $sth = $this->db->prepare( $sql );
        $sth->execute(array(
            ':email' 	=> $_POST['email'],
            ':password' => $_POST['password']
        ));

        $data = $sth->fetch();

        if ( $sth->rowCount() > 0 )
        {
            // login
            Session::init();
            Session::set( 'loggedIn', true );
            Session::set( 'user_name', $data['name']);
            Session::set( 'userid', $data['id_user'] );
            header('location: '.URL.'index/carrinho/');
        }
        else
        {
        	$msg = base64_encode( 'LOGIN_INCORRETO' );
            header('location: '.URL.'finalizar_compra/?st=' . $msg );
        }
    }

    public function logout()
    {
    	Session::init();
    	Session::destroy();
    	header('location: ../login');
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

		if( !empty( $result ) )
			return $this->montarObjeto( $result[0] );
		else {
			return $this;
		}
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
		$this->setCep( $row['cep'] );
		$this->setAdress( $row["adress"] );
		$this->setNumber( $row["number"] );
		$this->setCpf( $row["cpf"] );
		$this->setComplement( $row["complement"] );
		$this->setDistrict( $row["district"] );
		$this->setCity( $row["city"] );
		$this->setState( $row["state"] );
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
