<?php

class Product extends Controller {

	public function __construct() {
		parent::__construct();
		//Auth::handleLogin();
	}

	/**
	* Metodo index
	*/
	public function index( $id_category = 2 )
	{
		$this->view->title = 'Produtos';

		require_once 'models/category_model.php';
		$this->view->category = new Category_Model();

		$categorias = array($id_category);
		$this->view->category->obterCategory($id_category);
		$this->view->titleCategory = $this->view->category->getName();

		require_once 'models/product_model.php';
		$objProduct = new Product_Model();
		$this->view->listProduct = $objProduct->listarProductByCategory($categorias);

		$this->view->render('header.site');
		$this->view->render('index/slider');
		$this->view->render('index/produtos');
		$this->view->render('footer.site');
	}

	public function lista()
	{
		$this->view->title = "Produtos";
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

		require_once 'models/typecategory_model.php';
		require_once 'models/category_model.php';
		$objCategoria = new Category_Model();
		$this->view->listCategory = $objCategoria->listarCategoryByType( Typecategory_Model::PRODUTO );

		$this->view->path = '';
		$this->view->array_category = array();

		if( $id == NULL )
		{
			if( !Session::get('path_product') )
			{
				Session::set( 'path_product', 'img_product_' . date('Ymd_his') );
			}
			Session::set('act_product', 'create');
			$this->view->path = Session::get('path_product');
		}
		else
		{
			$this->view->title = "Editar Produto";
			$this->view->action = "edit/".$id;
			$this->view->obj = $this->model->obterProduct( $id );

			$this->view->path = $this->model->getPath();
			Session::set('act_product', 'edit');
			Session::set('path_edit_product', $this->model->getPath());

			if ( empty( $this->view->obj ) ) {
				die( "Valor invalido!" );
			}

			// Monta o array com as categorias vinculadas ao post
			foreach ( $objCategoria->listCategoryByProduct( $id ) as $category )
			{
				$this->view->array_category[] = $category->getId_category();
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

		$this->model->db->beginTransaction();

		$data = array(
			'name' 			=> $_POST["name"],
			'description'	=> $_POST['description'],
			'id_user' 		=> Session::get('userid'),
			'status' 		=> $_POST["status"],
			'path' 			=> $_POST["path"],
			'mainpicture' 	=> str_replace('../', '', $_POST['mainpicture']),
			'slug' 			=> Data::formatSlug($_POST["name"]),
		);



		if( !$id_product = $this->model->create( $data ) )
		{
			$this->model->db->rollBack();
			$msg = base64_encode( "OPERACAO_ERRO" );
			header("location: " . URL . "product/lista/?st=".$msg);
		}

		/**
		 * Cadastra as categorias do post
		 */
		if( isset($_POST['categoria']) )
		{
			$arr_categorias = array($_POST['categoria']);

			foreach( $arr_categorias as $id_categoria )
			{
				$data_category = array(
					'id_product'		=> $id_product,
					'id_category'	=> $id_categoria
				);

				if( !$this->model->db->insert( "product_category", $data_category, false ) )
				{
					$this->model->db->rollBack();
					$msg = base64_encode( "OPERACAO_ERRO" );
					header("location: " . URL . "product/lista/?st=".$msg);
				}
			}
		}

		// Destruir sessao do path do post
		Session::destroy('path_product');

		/**
		 * Realiza o commit e retorna a view
		 */
		$this->model->db->commit();
		$msg = base64_encode( "OPERACAO_SUCESSO" );
		header("location: " . URL . "product/lista/?st=".$msg);
	}

	/**
	* Metodo edit
	*/
	public function edit( $id )
	{
		Session::init();

		$this->model->db->beginTransaction();

		$data = array(
			'name' 			=> $_POST["name"],
			'description'	=> $_POST['description'],
			'id_user' 		=> Session::get('userid'),
			'status' 		=> $_POST["status"],
			'mainpicture' 	=> str_replace('../', '', $_POST['mainpicture']),
			'slug' 			=> Data::formatSlug($_POST["name"]),
		);

		if( !$this->model->edit( $data, $id )  )
		{
			$this->model->db->rollBack();
			$msg = base64_encode( "OPERACAO_ERRO" );
			header("location: " . URL . "product/lista/?st=".$msg."&erro=1");
		}

		/**
		 * Cadastra as categorias do post
		 */
		// Deleta todas as categorias vinculadas ao post
		$this->model->db->deleteComposityKey( 'product_category', "id_product = {$id}" );

		if( isset($_POST['categoria']) )
		{
			$arr_categorias = array($_POST['categoria']);

			foreach( $arr_categorias as $id_categoria )
			{
				$data_category = array(
					'id_product'	=> $id,
					'id_category'	=> $id_categoria
				);

				if( !$this->model->db->insert( "product_category", $data_category, false ) )
				{
					$this->model->db->rollBack();
					$msg = base64_encode( "OPERACAO_ERRO" );
					header( "location: " . URL . "product/lista/?st=".$msg."&erro=3" );
				}
			}
		}

		// Destruir sessao do path do post
		Session::destroy('path_product');

		/**
		 * Realiza o commit e retorna a view
		 */
		$this->model->db->commit();

		$msg = base64_encode( "OPERACAO_SUCESSO" );
		header("location: " . URL . "product/lista/?st=".$msg);
	}

	/**
	* Metodo delete
	*/
	public function delete( $id )
	{
		// deletar primeiro os ids da tabela post_categor

		// estudar o que fazer com as imagens
		// talvez deixar a opcao para selecionar opcionalmente para deletar o post e as imagens
		echo 'Debug';
		exit();

		$this->model->delete( $id ) ? $msg = base64_encode( "OPERACAO_SUCESSO" ) : $msg = base64_encode( "OPERACAO_ERRO" );

		header("location: " . URL . "product?st=".$msg);
	}

	public function delete_img( $img )
	{
		//$img = '../../'.base64_decode($img);
		$img = URL.base64_decode($img);

		if(file_exists($img)){
			unlink($img);
			echo 'deletou: ' . $img;
		}
		else {
			echo 'nao deletou<br>';
			echo '<img src="'.$img.'" alt="" />';
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

		$allowedExts = array(".gif", ".jpeg", ".jpg", ".png");

		// Verifica a acao para pegar a variavel do path correta
		Session::get('act_product') == 'create' ? $var_path = Session::get('path_product') : $var_path = Session::get('path_edit_product');

		$dir = 'public/img/product/'. $var_path .'/';

		for($i = 0; $i < count($tmp_name); $i++)
		{
			$ext = strtolower(substr($name[$i],-4));

			if(in_array($ext, $allowedExts))
			{
				$new_name = strtolower( PREFIX_SESSION ).date('Ymd_his').'_'.$name[$i];

				// cria a img default =========================================
				$image = WideImage::load( $tmp_name[$i] );

				$image = $image->resize(800, 600, 'inside');
				//$image = $image->crop('center', 'center', 170, 180);

				// verifica so o diretorio existe
				// caso contrario, criamos o diretorio com permissao para escrita
				if( !is_dir( $dir ) )
					mkdir( $dir, 0777, true);

				$image->saveToFile( $dir . $new_name );

				// cria a img thumb ==========================================
				$image_thumb = WideImage::load( $tmp_name[$i] );
				$image_thumb = $image_thumb->resize(170, 150, 'outside');
				$image_thumb = $image_thumb->crop('center', 'center', 170, 150);

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
