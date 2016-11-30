<?php 

/** 
 * Classe Payment
 * @author __ 
 *
 * Data: 30/11/2016
 */ 

include_once 'invoice_model.php';

class Payment_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_payment;
	private $date;
	private $total;
	private $invoice;

	public function __construct()
	{
		parent::__construct();

		$this->id_payment = '';
		$this->date = '';
		$this->total = '';
		$this->invoice = new Invoice_Model();
	}

	/** 
	* Metodos set's
	*/
	public function setId_payment( $id_payment )
	{
		$this->id_payment = $id_payment;
	}

	public function setDate( $date )
	{
		$this->date = $date;
	}

	public function setTotal( $total )
	{
		$this->total = $total;
	}

	public function setInvoice( Invoice_Model $invoice )
	{
		$this->invoice = $invoice;
	}

	/** 
	* Metodos get's
	*/
	public function getId_payment()
	{
		return $this->id_payment;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getTotal()
	{
		return $this->total;
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

		if( !$id = $this->db->insert( "payment", $data ) ){
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

		if( !$update = $this->db->update("payment", $data, "id_payment = {$id} ") ){
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

	 if( !$delete = $this->db->delete("payment", "id_payment = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterPayment
	*/
	public function obterPayment( $id_payment )
	{
		$sql  = "select * ";
		$sql .= "from payment ";
		$sql .= "where id_payment = :id ";

		$result = $this->db->select( $sql, array("id" => $id_payment) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarPayment
	*/
	public function listarPayment()
	{
		$sql  = "select * ";
		$sql .= "from payment ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_payment like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_payment( $row["id_payment"] );
		$this->setDate( $row["date"] );
		$this->setTotal( $row["total"] );

		$objInvoice = new Invoice_Model();
		$objInvoice->obterInvoice( $row["id_invoice"] );
		$this->setInvoice( $objInvoice );

		return $this;
	}
}
?>