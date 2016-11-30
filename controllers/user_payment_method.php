<?php 

class User_payment_method extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/** 
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "User_payment_method";
		$this->view->listarUser_payment_method = $this->model->listarUser_payment_method();

		$this->view->render( "header" );
		$this->view->render( "user_payment_method/index" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar User_payment_method";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id ) 
		{
			$this->view->title = "Editar User_payment_method";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterUser_payment_method( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "user_payment_method/form" );
		$this->view->render( "footer" );
	}

	/** 
	* Metodo create
	*/
	public function create()
	{
		$data = array(
			'id_user' => $_POST["id_user"], 
			'id_payment_method' => $_POST["id_payment_method"], 
			'card_number' => $_POST["card_number"], 
			'validity' => $_POST["validity"], 
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "user_payment_method?st=".$msg);
	}

	/** 
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'id_user' => $_POST["id_user"], 
			'id_payment_method' => $_POST["id_payment_method"], 
			'card_number' => $_POST["card_number"], 
			'validity' => $_POST["validity"], 
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "user_payment_method?st=".$msg);
	}

	/** 
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "user_payment_method?st=".$msg);
	}
}
