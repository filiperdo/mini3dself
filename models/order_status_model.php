<?php

/**
 * Classe Order_status
 * @author __
 *
 * Data: 30/11/2016
 */


class Order_status_Model extends Model
{
	/**
	* Atributos Private
	*/
	private $id_order_status;
	private $description;

	public function __construct()
	{
		parent::__construct();

		$this->id_order_status = '';
		$this->description = '';
		$this->class = '';
	}

	/**
	* Metodos set's
	*/
	public function setId_order_status( $id_order_status )
	{
		$this->id_order_status = $id_order_status;
	}

	public function setDescription( $description )
	{
		$this->description = $description;
	}

	public function setClass( $class )
	{
		$this->class = $class;
	}

	/**
	* Metodos get's
	*/
	public function getId_order_status()
	{
		return $this->id_order_status;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getClass()
	{
		return $this->class;
	}


	/**
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "order_status", $data ) ){
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

		if( !$update = $this->db->update("order_status", $data, "id_order_status = {$id} ") ){
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

	 if( !$delete = $this->db->delete("order_status", "id_order_status = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/**
	* Metodo obterOrder_status
	*/
	public function obterOrder_status( $id_order_status )
	{
		$sql  = "select * ";
		$sql .= "from order_status ";
		$sql .= "where id_order_status = :id ";

		$result = $this->db->select( $sql, array("id" => $id_order_status) );
		return $this->montarObjeto( $result[0] );
	}

	/**
	* Metodo listarOrder_status
	*/
	public function listarOrder_status()
	{
		$sql  = "select * ";
		$sql .= "from order_status ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_order_status like :id "; // Configurar o like com o campo necessario da tabela
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
		$this->setId_order_status( $row["id_order_status"] );
		$this->setDescription( $row["description"] );
		$this->setClass( $row['class'] );

		return $this;
	}
}
?>
