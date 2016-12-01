<?php 

/** 
 * Classe Order
 * @author __ 
 *
 * Data: 30/11/2016
 */ 


class Order_Model extends Model
{
	/** 
	* Atributos Private 
	*/

	public function __construct()
	{
		parent::__construct();

	}

	/** 
	* Metodos set's
	*/
	/** 
	* Metodos get's
	*/

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
		$sql .= "from order ";
		$sql .= "where id_order = :id ";

		$result = $this->db->select( $sql, array("id" => $id_order) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarOrder
	*/
	public function listarOrder()
	{
		$sql  = "select * ";
		$sql .= "from order ";

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

		return $this;
	}
}
?>