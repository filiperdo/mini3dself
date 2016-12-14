<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        Session::init();

        $this->view->title = 'Home';

        require_once 'models/product_model.php';
        $this->view->product = new Product_Model();

        $this->view->menu = array(
            0 => array('link' => '#top',        'class' => '', 'label' => 'HOME'),
            1 => array('link' => '#about',      'class' => '', 'label' => 'QUEM SOMOS'),
            2 => array('link' => '#team',       'class' => '', 'label' => 'PRODUTOS'),
            3 => array('link' => '#portfolio',  'class' => '', 'label' => 'PORTFOLIO'),
            4 => array('link' => '#contact',    'class' => '', 'label' => 'CONTATO'),
        );

        //$this->view->js[] = ''
        $this->view->render('header.site');
        $this->view->render('index/index');
        $this->view->render('footer.site');
    }

    public function produto( $id_product )
    {
        Session::init();
        require_once 'models/product_model.php';
        $this->view->product = new Product_Model();
        $this->view->product->obterProduct( $id_product );

        // Cria a session para guardar o path da imagem do cliente
        if( !Session::get('session_order') )
        {
            Session::set( 'session_order', 'order_' . date('Ymd_his') );
        }

        // Cria a session para guardar o path da imagem do cliente
        if( !Session::get('path_photo') )
        {
            Session::set( 'path_photo', 'photo_' . date('Ymd_his') );
        }
        //$this->view->path = Session::get('path_photo');

        // Valores por tamanho, passar para o banco de dados
        $this->view->model_size = array(12 => '200', 14 => '260', 15 => '300', 17 => '450');

        $this->view->menu = array(
            0 => array('link' => URL,               'class' => 'external', 'label' => 'HOME'),
            1 => array('link' => URL.'#about',      'class' => 'external', 'label' => 'QUEM SOMOS'),
            2 => array('link' => URL.'index/categoria',       'class' => 'external', 'label' => 'PRODUTOS'),
            3 => array('link' => URL.'#portfolio',  'class' => 'external', 'label' => 'PORTFOLIO'),
            4 => array('link' => '#contact',        'class' => '',         'label' => 'CONTATO'),
        );

        $this->view->title = 'Produto';

        // debug
        $this->view->test_session_order = Session::get( 'session_order');
        $this->view->test_path_photo = Session::get( 'path_photo');

        $this->view->render('header.site');
        $this->view->render('index/produto');
        $this->view->render('footer.site');
    }

    public function addCart( $id_product )
    {
        Session::init();

        require_once 'models/order_model.php';
        $objOrder = new Order_Model();

        $this->model->db->beginTransaction();

        // Verifica se ja foi gravado uma order para esta sessao
        $objOrder->obterOrderBySession( Session::get('session_order') );

        if( empty($objOrder->getId_order()) )
        {
            // Insere os dados do pedido ==========================
            $data_order = array(
                'session'           => Session::get('session_order'),
                'id_order_status'   => 1
            );

            if( !$id_order = $this->model->db->insert( "order", $data_order) )
            {
                $this->model->db->rollBack();
                $msg = base64_encode( "OPERACAO_ERRO" );
                echo "<br>OPERACAO_ERRO 1 ";
                //header("location: " . URL . "index/produto/".$id_product."?st=".$msg);
            }
            //======================================================
            //======================================================

            echo 'Inseriu ID: ' . $id_order;
        }
        else {
            $id_order = $objOrder->getId_order();
            echo 'Resgatou ID: ' . $id_order;
        }

        // Insere os dados dos itens do pedido =================
        $data_order_product = array(
            'id_product'    => $id_product,
            'id_order'      => $id_order,
            'quantity'      => 1,
            'price'         => Data::formataMoedaBD($_POST['price']),
            'path'          => Session::get('path_photo'),
            'size'          => $_POST['size']
        );

        if( !$this->model->db->insert( "order_product", $data_order_product ) )
        {
            $this->model->db->rollBack();
            $msg = base64_encode( "OPERACAO_ERRO" );
            echo "<br>OPERACAO_ERRO 2 ";
            //header("location: " . URL . "index/produto/".$id_product."?st=".$msg);
        }

        //======================================================
        //======================================================

        $this->model->db->commit();

        // Faz upload das fotos do cliente =====================
        for ($i=1; $i <=4; $i++) {
            $array_imagens[] = $_FILES['fileUpload'.$i];
        }

        require_once 'util/wideimage/WideImage.php';

        $allowedExts = array(".gif", ".jpeg", ".jpg", ".png"); // passar estes parametros para o config

        $dir = 'public/img/user/'. Session::get('path_photo') .'/';

        foreach( $array_imagens as $key => $img )
        {
            $ext = strtolower(substr($img['name'],-4));

            if(in_array($ext, $allowedExts))
            {
                $indice_img = ($key+1); // para nao criar img-0.jpg
                $new_name = 'img-' . $indice_img . '.jpg'; // converte sempre para jpg
                while ( file_exists($dir.$new_name) ) {
                    $indice_img++;
                    $new_name = 'img-' . $indice_img . '.jpg';
                }

                // cria a img default =========================================
                $image = WideImage::load( $img['tmp_name'] );

                if( !is_dir( $dir ) )
                    mkdir( $dir, 0777, true);

                $image->saveToFile( $dir . $new_name);
            }
        }
        //======================================================
        //======================================================

        // Destruir sessao do path do post
		Session::destroy('path_photo');

        $msg = base64_encode( "OPERACAO_SUCESSO" );
        //echo "<br>OPERACAO_SUCESSO";
        header("location: " . URL . "index/carrinho/".base64_encode($id_order)."?st=".$msg);
    }

    public function carrinho( $id_order )
    {
        Session::init();

        $this->view->id_order = base64_decode($id_order);

        require_once 'models/order_product_model.php';
        $objOrderProduct = new Order_product_Model();
        $this->view->listarOrderProductByOrder = $objOrderProduct;

        $this->view->menu = array(
            0 => array('link' => URL,               'class' => 'external', 'label' => 'HOME'),
            1 => array('link' => URL.'#about',      'class' => 'external', 'label' => 'QUEM SOMOS'),
            2 => array('link' => URL.'index/categoria',       'class' => 'external', 'label' => 'PRODUTOS'),
            3 => array('link' => URL.'#portfolio',  'class' => 'external', 'label' => 'PORTFOLIO'),
            4 => array('link' => '#contact',        'class' => '',         'label' => 'CONTATO'),
        );

        $this->view->render('header.site');
        $this->view->render('index/carrinho');
        //$this->view->render('footer.site');
    }

    /*
     * Lista os produtos por categoria
     */
    public function categoria( $id_category = NULL )
    {
        require_once 'models/category_model.php';
        $this->view->category = new Category_Model();

        require_once 'models/product_model.php';
        $objProduct = new Product_Model();
        $this->view->listarProduct = $objProduct->listarProductByCategory($id_category);

        $this->view->menu = array(
            0 => array('link' => URL,               'class' => 'external', 'label' => 'HOME'),
            1 => array('link' => URL.'#about',      'class' => 'external', 'label' => 'QUEM SOMOS'),
            2 => array('link' => '#top',            'class' => 'external', 'label' => 'PRODUTOS'),
            3 => array('link' => URL.'#portfolio',  'class' => 'external', 'label' => 'PORTFOLIO'),
            4 => array('link' => '#contact',        'class' => '',         'label' => 'CONTATO'),
        );

        $this->view->title = 'Produtos';

        $this->view->render('header.site');
        $this->view->render('index/categoria');
        $this->view->render('footer.site');
    }

    /*
    public function addCart( $id_product )
    {
        Session::init();
        if( isset($_SESSION[PREFIX_SESSION.'carrinho']) )
        {
            foreach ($_SESSION[PREFIX_SESSION.'carrinho'] as $key)
            {
                if( $id_product !=  $key )
                {
                    $_SESSION[PREFIX_SESSION.'carrinho'][$id_product] = 1; // id => quantidade (neste caso, será sempre 1)
                }
            }
        }
        else
        {
            $_SESSION[PREFIX_SESSION.'carrinho'][$id_product] = 1;
        }

        unset($_COOKIE['carrinho']);
        setcookie('carrinho', serialize($_SESSION[PREFIX_SESSION.'carrinho']), time()+3600);

        echo count($_SESSION[PREFIX_SESSION.'carrinho']);
    }
    */

    public function editCart( $id_product, $amount )
    {
        Session::init();
    }


}
