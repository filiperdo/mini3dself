<?php

/**
 * Classe Order
 * @author __
 *
 * Data: 30/11/2016
 */

include_once 'user_model.php';
include_once 'order_status_model.php';

class Order_Model extends Model
{
	/**
	* Atributos Private
	*/
	private $id_order;
	private $user;
	private $date;
	private $order_status;
	private $session;
	private $total;

	public function __construct()
	{
		parent::__construct();

		$this->id_order = '';
		$this->user = new User_Model();
		$this->date = '';
		$this->order_status = new Order_status_Model();
		$this->session = '';
		$this->total = '';
	}

	/**
	* Metodos set's
	*/
	public function setId_order($id_order)
	{
		$this->id_order = $id_order;
	}

	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setOrder_status( Order_status_Model $order_status )
	{
		$this->order_satus = $order_status;
	}

	public function setSession( $session )
	{
		$this->session = $session;
	}

	public function setTotal( $total )
	{
		$this->total = $total;
	}

	/**
	* Metodos get's
	*/
	public function getId_order()
	{
		return $this->id_order;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getOrder_status()
	{
		return $this->order_satus;
	}

	public function getSession()
	{
		return $this->session;
	}

	public function getTotal()
	{
		return $this->total;
	}

	/**
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "order", $data ) ){
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

		if( !$update = $this->db->update("order", $data, "id_order = {$id} ") ){
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

	 if( !$delete = $this->db->delete("order", "id_order = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/**
	* Metodo obterOrder
	*/
	public function obterOrder( $id_order )
	{
		$sql  = "select * ";
		$sql .= "from `order` ";
		$sql .= "where id_order = :id ";

		$result = $this->db->select( $sql, array("id" => $id_order) );
		return $this->montarObjeto( $result[0] );
	}

	/**
	* Metodo obterOrderBySession
	* Para recuperar o carrinho
	*/
	public function obterOrderBySession( $session )
	{
		$sql  = "select * ";
		$sql .= "from `order` ";
		$sql .= "where session = :sess ";

		$result = $this->db->select( $sql, array("sess" => $session) );

		if( !empty( $result ) )
			return $this->montarObjeto( $result[0] );
		else {
			return $this;
		}
	}

	/**
	* Metodo listOrderByUser
	*/
	public function listOrderByUser( $id_user )
	{
		$sql  = "select * ";
		$sql .= "from `order` ";
		$sql .= "where id_user = :id_user ";

		$result = $this->db->select( $sql, array("id_user" => $id_user) );

		return $this->montarLista($result);

	}

	/**
	* Metodo listarOrder
	*/
	public function listarOrder()
	{
		$sql  = "select * ";
		$sql .= "from `order` ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_order like :id "; // Configurar o like com o campo necessario da tabela
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
		$this->setId_order( $row['id_order'] );

		$objUser = new User_Model();
		$objUser->obterUser( $row['id_user'] );
		$this->setUser($objUser);

		$this->setDate( $row['date'] );

		$objOrderStatus = new Order_status_Model();
		$objOrderStatus->obterOrder_status( $row['id_order_status'] );
		$this->setOrder_status($objOrderStatus);

		$this->setSession($row['session']);
		$this->setTotal( $row['total'] );

		return $this;
	}
}
?>
