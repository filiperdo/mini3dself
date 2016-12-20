<?php

class Order extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/**
	* Metodo index
	*/
	public function index()
	{
		$this->view->title = "Pedidos";
		$this->view->listarOrder = $this->model->listarOrder();

		$this->view->render( "header" );
		$this->view->render( "order/index" );
		$this->view->render( "footer" );
	}

	/**
	* Metodo editForm
	*/
	public function form( $id = NULL )
	{
		$this->view->title = "Cadastrar Order";
		$this->view->action = "create";
		$this->view->obj = $this->model;

		if( $id )
		{
			$this->view->title = "Editar Order";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterOrder( $id );

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}
		}

		$this->view->render( "header" );
		$this->view->render( "order/form" );
		$this->view->render( "footer" );
	}

	/**
	* Metodo create
	*/
	public function create()
	{
		$data = array(
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "order?st=".$msg);
	}

	/**
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "order?st=".$msg);
	}

	/**
	* Metodo delete
	*/
	public function delete( $id )
	{
		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "order?st=".$msg);
	}
}
