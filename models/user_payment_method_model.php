<?php 

/** 
 * Classe User_payment_method
 * @author __ 
 *
 * Data: 30/11/2016
 */ 

include_once 'user_model.php';
include_once 'payment_method_model.php';

class User_payment_method_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $user;
	private $payment_method;
	private $card_number;
	private $validity;

	public function __construct()
	{
		parent::__construct();

		$this->user = new User_Model();
		$this->payment_method = new Payment_method_Model();
		$this->card_number = '';
		$this->validity = '';
	}

	/** 
	* Metodos set's
	*/
	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	public function setPayment_method( Payment_method_Model $payment_method )
	{
		$this->payment_method = $payment_method;
	}

	public function setCard_number( $card_number )
	{
		$this->card_number = $card_number;
	}

	public function setValidity( $validity )
	{
		$this->validity = $validity;
	}

	/** 
	* Metodos get's
	*/
	public function getUser()
	{
		return $this->user;
	}

	public function getPayment_method()
	{
		return $this->payment_method;
	}

	public function getCard_number()
	{
		return $this->card_number;
	}

	public function getValidity()
	{
		return $this->validity;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "user_payment_method", $data ) ){
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

		if( !$update = $this->db->update("user_payment_method", $data, "id_user_payment_method = {$id} ") ){
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

	 if( !$delete = $this->db->delete("user_payment_method", "id_user_payment_method = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterUser_payment_method
	*/
	public function obterUser_payment_method( $id_user_payment_method )
	{
		$sql  = "select * ";
		$sql .= "from user_payment_method ";
		$sql .= "where id_user_payment_method = :id ";

		$result = $this->db->select( $sql, array("id" => $id_user_payment_method) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarUser_payment_method
	*/
	public function listarUser_payment_method()
	{
		$sql  = "select * ";
		$sql .= "from user_payment_method ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_user_payment_method like :id "; // Configurar o like com o campo necessario da tabela 
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

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );

		$objPayment_method = new Payment_method_Model();
		$objPayment_method->obterPayment_method( $row["id_payment_method"] );
		$this->setPayment_method( $objPayment_method );
		$this->setCard_number( $row["card_number"] );
		$this->setValidity( $row["validity"] );

		return $this;
	}
}
?>