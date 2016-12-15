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
		$this->view->title = "Produto";
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
		Session::init();

		$this->view->title = "Cadastrar Produto";
		$this->view->action = "create";
		$this->view->js[] = 'clipboard.min.js';
		$this->view->method_upload = URL . 'product/wideimage_ajax/';
		$this->view->obj = $this->model;

		require_once 'models/category_model.php';
		$this->view->category = new Category_Model();

		if( $id == NULL )
		{
			if( !Session::get('path_product') )
			{
				Session::set( 'path_product', 'product_' . date('Ymd_his') );
			}
			Session::set('act_post', 'create');
			$this->view->path = Session::get('path_product');
		}
		else
		{
			$this->view->title = "Editar Produto";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterProduct( $id );

			$this->view->path = $this->view->obj->getPath();
			Session::set( 'path_edit_product', $this->view->obj->getPath() );
			Session::set('act_post', 'edit');

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
		Session::init();

		$data = array(
			//'code' 		=> $_POST["code"],
			'name' 			=> $_POST["name"],
			'slug'			=> Data::formatSlug($_POST["name"]),
			//'price' 		=> $_POST["price"],
			'note' 			=> $_POST["note"],
			//'color' 		=> $_POST["color"],
			//'size' 		=> $_POST["size"],
			'id_category' 	=> $_POST["id_category"],
			'path'			=> $_POST['path'],
			'mainpicture'	=> str_replace('../', '', $_POST['mainpicture']),
			'id_user'		=> 30 // teste
			//'id_provider' => $_POST["id_provider"],
			//'id_manufacturer' => $_POST["id_manufacturer"],
		);

		$this->model->create( $data ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		// Destruir sessao do path do post
		Session::destroy('path_product');

		header("location: " . URL . "product?st=".$msg);
	}

	/**
	* Metodo edit
	*/
	public function edit( $id )
	{
		$data = array(
			//'code' 			=> $_POST["code"],
			'name' 				=> $_POST["name"],
			'slug'				=> Data::formatSlug($_POST["name"]),
			//'price' 			=> $_POST["price"],
			'note' 				=> $_POST["note"],
			//'color' 			=> $_POST["color"],
			//'size' 			=> $_POST["size"],
			'id_category' 		=> $_POST["id_category"],
			'path'				=> $_POST['path'],
			'mainpicture'		=> str_replace('../', '', $_POST['mainpicture']),
			//'id_provider' 	=> $_POST["id_provider"],
			//'id_manufacturer' => $_POST["id_manufacturer"],
		);

		$this->model->edit( $data, $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		// Destruir sessao do path do post
		Session::destroy('path_product');

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

	public function delete_img()
	{
		Session::init();

		$img_name = base64_decode( $_POST['img_name'] );

		$path =  'public/img/product/' . base64_decode($_POST['path']) . '/';

		if(is_dir($path))
		{
 			unlink($path.$img_name);
			unlink($path.'thumb/'.$img_name);

			echo 'Deletou: ' .$path.$img_name.'<br>';
			echo 'Deletou: ' .$path.'thumb/'.$img_name;
 		}
		else
		{
			echo 'Nao deletou '.$path . $img_name;
		}
	}


	/**
	 * Faz o upload das imagens recebidas de um form
	 */
	public function wideimage_ajax()
	{
		Session::init();

		require_once 'util/wideimage/WideImage.php';

		date_default_timezone_set("Brazil/East");

		$name 	= $_FILES['files']['name'];
		$tmp_name = $_FILES['files']['tmp_name'];

		$allowedExts = array(".gif", ".jpeg", ".jpg", ".png"); // passar estes parametros para o config

		// Verifica a acao para pegar a variavel do path correta
		Session::get('act_post') == 'create' ? $var_path = Session::get('path_product') : $var_path = Session::get('path_edit_product');

		$dir = 'public/img/product/'. $var_path .'/';

		for($i = 0; $i < count($tmp_name); $i++)
		{
			$ext = strtolower(substr($name[$i],-4));

			if(in_array($ext, $allowedExts))
			{
				//$new_name = strtolower( PREFIX_SESSION ).date('Ymd_his').'_'.$name[$i];

				$indice_img = ($i+1); // para nao criar img-0.jpg
				$new_name = 'img-' . $indice_img . '.jpg'; // converte sempre para jpg
				while ( file_exists($dir.$new_name) ) {
					$indice_img++;
					$new_name = 'img-' . $indice_img . '.jpg';
				}

				// cria a img default =========================================
				$image = WideImage::load( $tmp_name[$i] );
				$image = $image->resize(367, 700, 'inside');
				//$image = $image->crop('center', 'center', 170, 180);

				// verifica so o diretorio existe
				// caso contrario, criamos o diretorio com permissao para escrita
				if( !is_dir( $dir ) )
					mkdir( $dir, 0777, true);

				$image->saveToFile( $dir . $new_name, 70 );

				// cria a img thumb ==========================================
				$image_thumb = WideImage::load( $tmp_name[$i] );
				$image_thumb = $image_thumb->resize(170, 150, 'outside');
				$image_thumb = $image_thumb->crop('center', 'top', 170, 150);

				$dir_thumb = $dir.'thumb/';
				// verifica so o diretorio existe
				// caso contrario, criamos o diretorio com permissao para escrita
				if( !is_dir( $dir_thumb ) )
					mkdir( $dir_thumb, 0777, true);

				$image_thumb->saveToFile( $dir_thumb . $new_name );
			}
		}

		echo json_encode($new_name);
	}
}
