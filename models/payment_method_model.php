<?php 

/** 
 * Classe Payment_method
 * @author __ 
 *
 * Data: 30/11/2016
 */ 


class Payment_method_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_payment_method;
	private $name;

	public function __construct()
	{
		parent::__construct();

		$this->id_payment_method = '';
		$this->name = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_payment_method( $id_payment_method )
	{
		$this->id_payment_method = $id_payment_method;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	/** 
	* Metodos get's
	*/
	public function getId_payment_method()
	{
		return $this->id_payment_method;
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

		if( !$id = $this->db->insert( "payment_method", $data ) ){
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

		if( !$update = $this->db->update("payment_method", $data, "id_payment_method = {$id} ") ){
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

	 if( !$delete = $this->db->delete("payment_method", "id_payment_method = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterPayment_method
	*/
	public function obterPayment_method( $id_payment_method )
	{
		$sql  = "select * ";
		$sql .= "from payment_method ";
		$sql .= "where id_payment_method = :id ";

		$result = $this->db->select( $sql, array("id" => $id_payment_method) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarPayment_method
	*/
	public function listarPayment_method()
	{
		$sql  = "select * ";
		$sql .= "from payment_method ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_payment_method like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_payment_method( $row["id_payment_method"] );
		$this->setName( $row["name"] );

		return $this;
	}
}
?>