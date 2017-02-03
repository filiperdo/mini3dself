<?php

/**
 * Classe Shipment
 * @author __
 *
 * Data: 30/11/2016
 */

include_once 'invoice_model.php';
include_once 'order_model.php';

class Shipment_Model extends Model
{
	/**
	* Atributos Private
	*/
	private $id_shipment;
	private $name;
	private $date;
	private $tracking;
	private $invoice;

	public function __construct()
	{
		parent::__construct();

		$this->id_shipment = '';
		$this->name = '';
		$this->date = '';
		$this->tracking = '';
		$this->invoice = new Invoice_Model();
	}

	/**
	* Metodos set's
	*/
	public function setId_shipment( $id_shipment )
	{
		$this->id_shipment = $id_shipment;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setTracking( $tracking )
	{
		$this->tracking = $tracking;
	}

	public function setInvoice( Invoice_Model $invoice )
	{
		$this->invoice = $invoice;
	}

	/**
	* Metodos get's
	*/
	public function getId_shipment()
	{
		return $this->id_shipment;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getTracking()
	{
		return $this->tracking;
	}

	public function getInvoice()
	{
		return $this->invoice;
	}


	/**
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "shipment", $data ) ){
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

		if( !$update = $this->db->update("shipment", $data, "id_shipment = {$id} ") ){
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

	 if( !$delete = $this->db->delete("shipment", "id_shipment = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/**
	* Metodo obterShipment
	*/
	public function obterShipment( $id_shipment )
	{
		$sql  = "select * ";
		$sql .= "from shipment ";
		$sql .= "where id_shipment = :id ";

		$result = $this->db->select( $sql, array("id" => $id_shipment) );
		return $this->montarObjeto( $result[0] );
	}

	/**
	* Metodo listarShipment
	*/
	public function listarShipment()
	{
		$sql  = "select * ";
		$sql .= "from shipment ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_shipment like :id "; // Configurar o like com o campo necessario da tabela
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
		$this->setId_shipment( $row["id_shipment"] );
		$this->setName( $row['name'] );
		$this->setDate( $row["date"] );
		$this->setTracking( $row["tracking"] );

		$objInvoice = new Invoice_Model();
		$objInvoice->obterInvoice( $row["id_invoice"] );
		$this->setInvoice( $objInvoice );

		return $this;
	}
}
?>
