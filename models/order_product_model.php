<?php

/**
 * Classe Order_product
 * @author __
 *
 * Data: 30/11/2016
 */

include_once 'product_model.php';
include_once 'order_model.php';

class Order_product_Model extends Model
{
	/**
	* Atributos Private
	*/
	private $id_order_product;
	private $product;
	private $order;
	private $quantity;
	private $price;
	private $path;
	private $size;

	public function __construct()
	{
		parent::__construct();

		$this->id_order_product = '';
		$this->product = new Product_Model();
		$this->order = new Order_Model();
		$this->quantity = '';
		$this->price = '';
		$this->path = '';
		$this->size = '';
	}

	/**
	* Metodos set's
	*/
	public function setId_order_product( $id_order_product )
	{
		$this->id_order_product = $id_order_product;
	}

	public function setProduct( Product_Model $product )
	{
		$this->product = $product;
	}

	public function setOrder( Order_Model $order )
	{
		$this->order = $order;
	}

	public function setQuantity( $quantity )
	{
		$this->quantity = $quantity;
	}

	public function setPrice( $price )
	{
		$this->price = $price;
	}

	public function setPath( $path )
	{
		$this->path = $path;
	}

	public function setSize( $size )
	{
		$this->size = $size;
	}

	/**
	* Metodos get's
	*/
	public function getId_order_product()
	{
		return $this->id_order_product;
	}

	public function getProduct()
	{
		return $this->product;
	}

	public function getOrder()
	{
		return $this->order;
	}

	public function getQuantity()
	{
		return $this->quantity;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function getSize()
	{
		return $this->size;
	}


	/**
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "order_product", $data ) ){
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

		if( !$update = $this->db->update("order_product", $data, "id_order_product = {$id} ") ){
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

	 if( !$delete = $this->db->delete("order_product", "id_order_product = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/**
	* Metodo obterOrder_product
	*/
	public function obterOrder_product( $id_order_product )
	{
		$sql  = "select * ";
		$sql .= "from order_product ";
		$sql .= "where id_order_product = :id ";

		$result = $this->db->select( $sql, array("id" => $id_order_product) );
		return $this->montarObjeto( $result[0] );
	}

	/*
	 * Conta quantos itens tem no carrinho
	 */
	public function countOrder_productBySession( $session )
	{
		$sql  = "select count(id_order_product) as total ";
		$sql .= "from order_product as op ";
		$sql .= "inner join `order`  as o ";
		$sql .= "on o.id_order = op.id_order ";
		$sql .= "where o.session = :session ";

		$result = $this->db->select( $sql, array("session" => $session) );

		return $result[0]['total'];
	}

	/**
	* Metodo listarOrder_productByOrder
	*/
	public function listarOrder_productByOrder( $id_order )
	{
		$sql  = "select * ";
		$sql .= "from order_product ";
		$sql .= "where id_order = :id ";

		$result = $this->db->select( $sql, array("id" => $id_order) );

		return $this->montarLista($result);
	}

	/**
	* Metodo listarOrder_product
	*/
	public function listarOrder_product()
	{
		$sql  = "select * ";
		$sql .= "from order_product ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_order_product like :id "; // Configurar o like com o campo necessario da tabela
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
		$this->setId_order_product( $row["id_order_product"] );

		$objProduct = new Product_Model();
		$objProduct->obterProduct( $row["id_product"] );
		$this->setProduct( $objProduct );

		$objOrder = new Order_Model();
		$objOrder->obterOrder( $row["id_order"] );
		$this->setOrder( $objOrder );
		$this->setQuantity( $row["quantity"] );
		$this->setPrice( $row["price"] );
		$this->setPath( $row['path'] );
		$this->setSize( $row['size'] );

		return $this;
	}
}
?>
