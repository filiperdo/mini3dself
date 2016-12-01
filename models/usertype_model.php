<?php 

/** 
 * Classe Usertype
 * @author __ 
 *
 * Data: 30/11/2016
 */ 


class Usertype_Model extends Model
{
	/** 
	* Atributos Private 
	*/
	private $id_usertype;
	private $name;

	public function __construct()
	{
		parent::__construct();

		$this->id_usertype = '';
		$this->name = '';
	}

	/** 
	* Metodos set's
	*/
	public function setId_usertype( $id_usertype )
	{
		$this->id_usertype = $id_usertype;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	/** 
	* Metodos get's
	*/
	public function getId_usertype()
	{
		return $this->id_usertype;
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

		if( !$id = $this->db->insert( "usertype", $data ) ){
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

		if( !$update = $this->db->update("usertype", $data, "id_usertype = {$id} ") ){
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

	 if( !$delete = $this->db->delete("usertype", "id_usertype = {$id} ") ){ 
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/** 
	* Metodo obterUsertype
	*/
	public function obterUsertype( $id_usertype )
	{
		$sql  = "select * ";
		$sql .= "from usertype ";
		$sql .= "where id_usertype = :id ";

		$result = $this->db->select( $sql, array("id" => $id_usertype) );
		return $this->montarObjeto( $result[0] );
	}

	/** 
	* Metodo listarUsertype
	*/
	public function listarUsertype()
	{
		$sql  = "select * ";
		$sql .= "from usertype ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_usertype like :id "; // Configurar o like com o campo necessario da tabela 
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
		$this->setId_usertype( $row["id_usertype"] );
		$this->setName( $row["name"] );

		return $this;
	}
}
?>