<?php 

/** 
 * Classe Invoice_status
 * @author __ 
 *
 * Data: 30/11/2016
 */ 


class Invoice_status_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_invoice_status;
	private $name;

	public function __construct()
	{
		parent::__construct();

		$this->id_invoice_status = '';
		$this->name = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_invoice_status( $id_invoice_status )
	{
		$this->id_invoice_status = $id_invoice_status;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	/** 
	* Metodos get's
	*/
	public function getId_invoice_status()
	{
		return $this->id_invoice_status;
	}

	public function getName()
	{
		return $this->name;
	}


	/** 
	* Metodo create
	*/
	public function create( $data )
	{
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "invoice_status", $data ) ){
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

		if( !$update = $this->db->update("invoice_status", $data, "id_invoice_status = {$id} ") ){
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

	 if( !$delete = $this->db->delete("invoice_status", "id_invoice_status = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterInvoice_status
	*/
	public function obterInvoice_status( $id_invoice_status )
	{
		$sql  = "select * ";
		$sql .= "from invoice_status ";
		$sql .= "where id_invoice_status = :id ";

		$result = $this->db->select( $sql, array("id" => $id_invoice_status) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarInvoice_status
	*/
	public function listarInvoice_status()
	{
		$sql  = "select * ";
		$sql .= "from invoice_status ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_invoice_status like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_invoice_status( $row["id_invoice_status"] );
		$this->setName( $row["name"] );

		return $this;
	}
}
?>