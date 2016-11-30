<?php 

/** 
 * Classe Invoice
 * @author __ 
 *
 * Data: 30/11/2016
 */ 

include_once 'order_model.php';
include_once 'invoice_status_model.php';

class Invoice_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_invoice;
	private $order;
	private $invoice_status;

	public function __construct()
	{
		parent::__construct();

		$this->id_invoice = '';
		$this->order = new Order_Model();
		$this->invoice_status = new Invoice_status_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_invoice( $id_invoice )
	{
		$this->id_invoice = $id_invoice;
	}

	public function setOrder( Order_Model $order )
	{
		$this->order = $order;
	}

	public function setInvoice_status( Invoice_status_Model $invoice_status )
	{
		$this->invoice_status = $invoice_status;
	}

	/** 
	* Metodos get's
	*/
	public function getId_invoice()
	{
		return $this->id_invoice;
	}

	public function getOrder()
	{
		return $this->order;
	}

	public function getInvoice_status()
	{
		return $this->invoice_status;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "invoice", $data ) ){
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

		if( !$update = $this->db->update("invoice", $data, "id_invoice = {$id} ") ){
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

	 if( !$delete = $this->db->delete("invoice", "id_invoice = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterInvoice
	*/
	public function obterInvoice( $id_invoice )
	{
		$sql  = "select * ";
		$sql .= "from invoice ";
		$sql .= "where id_invoice = :id ";

		$result = $this->db->select( $sql, array("id" => $id_invoice) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarInvoice
	*/
	public function listarInvoice()
	{
		$sql  = "select * ";
		$sql .= "from invoice ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_invoice like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_invoice( $row["id_invoice"] );

		$objOrder = new Order_Model();
		$objOrder->obterOrder( $row["id_order"] );
		$this->setOrder( $objOrder );

		$objInvoice_status = new Invoice_status_Model();
		$objInvoice_status->obterInvoice_status( $row["id_invoice_status"] );
		$this->setInvoice_status( $objInvoice_status );

		return $this;
	}
}
?>