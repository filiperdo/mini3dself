<?php

/**
 * Classe Product
 * @author __
 *
 * Data: 14/10/2016
 */

include_once 'models/user_model.php';

class Product_Model extends Model
{
	/**
	* Atributos Private
	*/
	private $id_product;
	private $name;
	private $data;
	private $description;
	private $user;
	private $status;
	private $path;
	private $mainpicture;
	private $slug;

	public function __construct()
	{
		parent::__construct();

		$this->id_product = '';
		$this->name = '';
		$this->data = '';
		$this->description = '';
		$this->user = new User_Model();
		$this->status = '';
		$this->path = '';
		$this->mainpicture = '';
		$this->slug = '';
	}

	/**
	* Metodos set's
	*/
	public function setId_product( $id_product )
	{
		$this->id_product = $id_product;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setData( $data )
	{
		$this->data = $data;
	}

	public function setDescription( $description )
	{
		$this->description = $description;
	}

	public function setUser( User_Model $user )
	{
		$this->user = $user;
	}

	public function setStatus( $status )
	{
		$this->status = $status;
	}

	public function setPath( $path )
	{
		$this->path = $path;
	}

	public function setMainpicture( $mainpicture )
	{
		$this->mainpicture = $mainpicture;
	}

	public function setSlug( $slug )
	{
		$this->slug = $slug;
	}

	/**
	* Metodos get's
	*/
	public function getId_product()
	{
		return $this->id_product;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getDescription()
	{
		return $this->description;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function getStatus()
	{
		return $this->status;
	}

	public function getPath()
	{
		return $this->path;
	}

	public function getMainpicture()
	{
		return $this->mainpicture;
	}

	public function getSlug()
	{
		return $this->slug;
	}


	/**
	* Metodo create
	*/
	public function create( $data )
	{
		//$this->db->beginTransaction();

		if( !$id = $this->db->insert( "product", $data ) ){
			$this->db->rollBack();
			return false;
		}

		//$this->db->commit();
		return true;
	}

	/**
	* Metodo edit
	*/
	public function edit( $data, $id )
	{
		//$this->db->beginTransaction();

		if( !$update = $this->db->update("product", $data, "id_product = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		//$this->db->commit();
		return $update;
	}

	/**
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->db->beginTransaction();

	 	if( !$delete = $this->db->delete("product", "id_product = {$id} ") ){
			$this->db->rollBack();
			return false;
		}

		$this->db->commit();
		return $delete;
	}

	/**
	* Metodo obterProduct
	*/
	public function obterProduct( $id_product )
	{
		$sql  = "select * ";
		$sql .= "from product ";
		$sql .= "where id_product = :id ";

		$result = $this->db->select( $sql, array("id" => $id_product) );
		return $this->montarObjeto( $result[0] );
	}

	/**
	* Metodo getProductBySlug
	*/
	public function getProductBySlug( $slug )
	{
		$sql  = "select * ";
		$sql .= "from product ";
		$sql .= "where slug = :slug ";

		$result = $this->db->select( $sql, array("slug" => $slug) );
		return $this->montarObjeto( $result[0] );
	}

	/**
	* Metodo listarProduct
	*/
	public function listarProduct()
	{
		$sql  = "select * ";
		$sql .= "from product ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where id_product like :id "; // Configurar o like com o campo necessario da tabela
			$result = $this->db->select( $sql, array("id" => "%{$_POST["like"]}%") );
		}
		else
			$result = $this->db->select( $sql );

		return $this->montarLista($result);
	}

	/**
	* Metodo listarProductByCategory
	*/
	public function listarProductByCategory( Array $category )
	{
		$split_categoria = implode(',', $category);

		$sql  = "select p.* ";
		$sql .= "from product as p ";
		$sql .= "inner join product_category as pc ";
		$sql .= "on pc.`id_product` = p.`id_product` ";
		$sql .= "where pc.`id_category` in (" . $split_categoria . ") ";

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
		$this->setId_product( $row["id_product"] );
		$this->setName( $row["name"] );
		$this->setData( $row["data"] );
		$this->setDescription( $row['description'] );

		$objUser = new User_Model();
		$objUser->obterUser( $row["id_user"] );
		$this->setUser( $objUser );
		$this->setStatus( $row["status"] );
		$this->setPath( $row["path"] );
		$this->setMainpicture( $row["mainpicture"] );
		$this->setSlug( $row["slug"] );

		return $this;
	}
}
?>
