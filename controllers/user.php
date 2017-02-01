<?php

class User extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/**
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "User";
		$this->view->listarUser = $this->model->listarUser();

		$this->view->render( "header" );
		$this->view->render( "user/index" );
		$this->view->render( "footer" );
	}

	/**
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar User";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id )
		{
			$this->view->title = "Editar User";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterUser( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "user/form" );
		$this->view->render( "footer" );
	}

	public function login()
    {
        $this->model->login();
    }

	/**
	* Metodo create
	*/
	public function create()
	{
		$data_user = array(
			'name' 			=> $_POST["name"],
			'email' 		=> $_POST["email"],
			'login' 		=> $_POST["email"],
			'password' 		=> $_POST["password"],
			'adress' 		=> $_POST["adress"],
			'number' 		=> $_POST["number"],
			'cpf' 			=> $_POST["cpf"],
			'cep'			=> $_POST['cep_entrega'],
			'complement' 	=> $_POST["complement"],
			'district' 		=> $_POST["district"],
			'city' 			=> $_POST["city"],
			'state' 		=> $_POST["state"],
			'phone1' 		=> $_POST["phone1"],
			'id_usertype' 	=> 2, // customer
		);

		$this->model->db->beginTransaction();

		if( $id_user = $this->model->create( $data_user ) )
		{
			// Efetuar login
			Session::init();
			Session::set( 'loggedIn', true );
			Session::set( 'user_name', $_POST["name"]);
			Session::set( 'userid', $id_user );

			// Atualizar tabela order colocando o id_user
			$data_order = array(
				'id_user' 			=> $id_user,
				'id_order_status'	=> 2, // em aberto
				'total'				=> Data::formataMoedaBD($_POST['totalCarrinho'])
			);

			$this->model->db->update("order", $data_order, "id_order = " . $_POST["id_order"]);
		}

		$this->model->db->commit();

		Session::destroy('path_photo');
		Session::destroy('session_order');

		$msg = base64_encode( "OPERACAO_SUCESSO" );
        header("location: " . URL . "index/minhaconta/?st=".$msg);

	}

	/**
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			'name' 			=> $_POST["name"],
			'email' 		=> $_POST["email"],
			'login' 		=> $_POST["email"],
			'password' 		=> $_POST["password"],
			'adress' 		=> $_POST["adress"],
			'number' 		=> $_POST["number"],
			'cpf' 			=> $_POST["cpf"],
			'cep'			=> $_POST['cep'],
			'complement' 	=> $_POST["complement"],
			'district' 		=> $_POST["district"],
			'city' 			=> $_POST["city"],
			'state' 		=> $_POST["state"],
			'phone1' 		=> $_POST["phone1"],
			'phone2' 		=> $_POST["phone2"]
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "user?st=".$msg);
	}

	/**
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "user?st=".$msg);
	}
}
