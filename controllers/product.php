<?php 

class Product extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Product";
		$this->view->listarProduct = $this->model->listarProduct();

		$this->view->render( "header" );
		$this->view->render( "product/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Product";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar Product";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterProduct( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "product/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'code' => $_POST["code"], 
			'name' => $_POST["name"], 
			'price' => $_POST["price"], 
			'note' => $_POST["note"], 
			'color' => $_POST["color"], 
			'size' => $_POST["size"], 
			'id_category' => $_POST["id_category"], 
			'id_provider' => $_POST["id_provider"], 
			'id_manufacturer' => $_POST["id_manufacturer"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "product?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'code' => $_POST["code"], 
			'name' => $_POST["name"], 
			'price' => $_POST["price"], 
			'note' => $_POST["note"], 
			'color' => $_POST["color"], 
			'size' => $_POST["size"], 
			'id_category' => $_POST["id_category"], 
			'id_provider' => $_POST["id_provider"], 
			'id_manufacturer' => $_POST["id_manufacturer"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "product?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "product?st=".$msg);
	}
}
