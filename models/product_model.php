<?php

/**
 * Classe Product
 * @author __
 *
 * Data: 30/11/2016
 */

include_once 'category_model.php';
include_once 'provider_model.php';
include_once 'manufacturer_model.php';
require_once 'models/user_model.php';

class Product_Model extends Model
{
	/**
	* Atributos Private
	*/
	private $id_product;
	private $code;
	private $name;
	private $price;
	private $note;
	private $color;
	private $size;
	private $category;
	private $provider;
	private $user;
	private $manufacturer;
	private $path;
	private $mainpicture;
	private $slug;

	public function __construct()
	{
		parent::__construct();

		$this->id_product = '';
		$this->code = '';
		$this->name = '';
		$this->price = '';
		$this->note = '';
		$this->color = '';
		$this->size = '';
		$this->category = new Category_Model();
		//$this->provider = new Provider_Model();
		//$this->manufacturer = new Manufacturer_Model();
		$this->user = new User_Model();
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

	public function setCode( $code )
	{
		$this->code = $code;
	}

	public function setName( $name )
	{
		$this->name = $name;
	}

	public function setPrice( $price )
	{
		$this->price = $price;
	}

	public function setNote( $note )
	{
		$this->note = $note;
	}

	public function setColor( $color )
	{
		$this->color = $color;
	}

	public function setSize( $size )
	{
		$this->size = $size;
	}

	public function setCategory( Category_Model $category )
	{
		$this->category = $category;
	}

	public function setProvider( Provider_Model $provider )
	{
		$this->provider = $provider;
	}

	public function setManufacturer( Manufacturer_Model $manufacturer )
	{
		$this->manufacturer = $manufacturer;
	}

	public function setUser( User_Model $user )
	{
		$this->user = $user;
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

	public function getCode()
	{
		return $this->code;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getPrice()
	{
		return $this->price;
	}

	public function getNote()
	{
		return $this->note;
	}

	public function getColor()
	{
		return $this->color;
	}

	public function getSize()
	{
		return $this->size;
	}

	public function getCategory()
	{
		return $this->category;
	}

	public function getProvider()
	{
		return $this->provider;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function getManufacturer()
	{
		return $this->manufacturer;
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
		$this->db->beginTransaction();

		if( !$id = $this->db->insert( "product", $data ) ){
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

		if( !$update = $this->db->update("product", $data, "id_product = {$id} ") ){
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
	* Metodo listarProduct
	*/
	public function listarProduct( $limit = NULL )
	{
		$sql  = "select * ";
		$sql .= "from product ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "where name like :name "; // Configurar o like com o campo necessario da tabela

			if ( $limit ) {
				$sql .= "limit " . $limit . " ";
			}

			$result = $this->db->select( $sql, array("name" => "%{$_POST["like"]}%") );
		}
		else
		{
			if ( $limit ) {
				$sql .= "limit " . $limit . " ";
			}

			$result = $this->db->select( $sql );
		}


		return $this->montarLista($result);
	}

	/**
	* Metodo listarProduct
	*/
	public function listarProductByCategory( $id_category = NULL )
	{
		$sql  = "select * ";
		$sql .= "from product as p ";
		$sql .= "where p.id_product > 1 ";

		if ( isset( $_POST["like"] ) )
		{
			$sql .= "and p.name like :name ";
			$result = $this->db->select( $sql, array("name" => "%{$_POST["like"]}%") );
		}
		else if( $id_category )
		{
			$sql .= "and p.id_category = :id_category ";
			$result = $this->db->select( $sql, array("id_category" => $id_category ) );
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
		$this->setId_product( $row["id_product"] );
		$this->setCode( $row["code"] );
		$this->setName( $row["name"] );
		$this->setPrice( $row["price"] );
		$this->setNote( $row["note"] );
		$this->setColor( $row["color"] );
		$this->setSize( $row["size"] );

		$objCategory = new Category_Model();
		$objCategory->obterCategory( $row["id_category"] );
		$this->setCategory( $objCategory );

		//$objProvider = new Provider_Model();
		//$objProvider->obterProvider( $row["id_provider"] );
		//$this->setProvider( $objProvider );

		//$objManufacturer = new Manufacturer_Model();
		//$objManufacturer->obterManufacturer( $row["id_manufacturer"] );
		//$this->setManufacturer( $objManufacturer );

		$objUser = new User_Model();
		$objUser->obterUser( $row['id_user'] );
		$this->setUser( $objUser );

		$this->setPath( $row['path'] ) ;
		$this->setMainpicture( $row['mainpicture'] );
		$this->setSlug( $row['slug'] );

		return $this;
	}
}
?>
