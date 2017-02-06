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

    public function minhaconta()
    {
        Session::init();
        $this->view->menu = array(
            0 => array('link' => URL,               'class' => 'external', 'label' => 'HOME'),
            1 => array('link' => URL.'#about',      'class' => 'external', 'label' => 'QUEM SOMOS'),
            2 => array('link' => URL.'index/categoria',       'class' => 'external', 'label' => 'PRODUTOS'),
            3 => array('link' => URL.'#portfolio',  'class' => 'external', 'label' => 'PORTFOLIO'),
            4 => array('link' => '#contact',        'class' => '',         'label' => 'CONTATO'),
        );

        require_once 'models/user_model.php';
        $objUser = new User_Model();
        $this->view->user = $objUser->obterUser( Session::get('userid') );        

        require_once 'models/order_model.php';
        $objOrder = new Order_Model();
        $this->view->order = $objOrder;

        $this->view->title = 'Minha conta';

        $this->view->render('header.site');
        $this->view->render('index/minhaconta');
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
        $this->view->model_size = array(12 => '299', 14 => '399', 15 => '490', 17 => '599');

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

    /*
     * Remove um item do carrinho
     */
    public function removeItemCart( $id_order_product )
    {
        Session::init();
        $this->model->db->beginTransaction();

        require_once 'models/order_product_model.php';
        $objOrderProduct = new Order_product_Model();
        $objOrderProduct->obterOrder_product(base64_decode($id_order_product));

        if( !$this->model->db->delete("order_product", "id_order_product = " . $objOrderProduct->getId_order_product()) ){
   			$this->model->db->rollBack();
            $msg = base64_encode( "OPERACAO_ERRO" );
   			header("location: " . URL . "index/carrinho/".base64_encode($objOrderProduct->getId_order_product())."?st=".$msg);
   		}

        // Remover as fotos referentes a este item

        $this->model->db->commit();
        $msg = base64_encode( "OPERACAO_SUCESSO" );
        header("location: " . URL . "index/carrinho/".base64_encode($objOrderProduct->getOrder()->getId_order())."?st=".$msg);

    }

    /*
     * Adiciona um novo item ao carrinho gravando no banco
     */
    public function addCart( $id_product )
    {
        Session::init();

        require_once 'models/order_model.php';
        $objOrder = new Order_Model();

        $this->model->db->beginTransaction();

        // Verifica se ja foi gravado uma order para esta sessao
        $objOrder->obterOrderBySession( Session::get('session_order') );

        if( $objOrder->getId_order() == '' )
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

        // Destruir sessao do path das fotos do cliente
		Session::destroy('path_photo');

        $msg = base64_encode( "OPERACAO_SUCESSO" );
        //echo "<br>OPERACAO_SUCESSO";
        header("location: " . URL . "index/carrinho/".base64_encode($id_order)."?st=".$msg);
    }



    public function carrinho( $id_order = NULL )
    {
        Session::init();

        //$this->view->id_order = base64_decode($id_order);

        require_once 'models/order_product_model.php';
        $objOrderProduct = new Order_product_Model();

        if( $id_order )
        {
            $id_order = base64_decode($id_order);
        }
        else if( Session::get('session_order') != null )
        {
            require_once 'models/order_model.php';
            $objOrder = new Order_Model();
            $objOrder->obterOrderBySession( Session::get('session_order') );
            $id_order = $objOrder->getId_order();
        }

        $this->view->listarOrderProductByOrder = $objOrderProduct->listarOrder_productByOrder($id_order);

        $this->view->menu = array(
            0 => array('link' => URL,                           'class' => 'external', 'label' => 'HOME'),
            1 => array('link' => URL.'#about',                  'class' => 'external', 'label' => 'QUEM SOMOS'),
            2 => array('link' => URL.'index/categoria',         'class' => 'external', 'label' => 'PRODUTOS'),
            3 => array('link' => URL.'#portfolio',              'class' => 'external', 'label' => 'PORTFOLIO'),
            4 => array('link' => '#contact',                    'class' => '',         'label' => 'CONTATO'),
        );


        require_once 'models/user_model.php';
        $objUser = new User_Model();

        if(Session::get('userid'))
        {
            $objUser->obterUser(Session::get('userid'));
            $this->view->user = $objUser;
        }
        else
        {
            $this->view->user = $objUser;
        }

        $this->view->render('header.site');
        $this->view->render('index/carrinho');
        //$this->view->render('footer.site');
    }


    public function finalizar_compra()
    {
        Session::init();

        $this->view->menu = array(
            0 => array('link' => URL,                           'class' => 'external', 'label' => 'HOME'),
            1 => array('link' => URL.'#about',                  'class' => 'external', 'label' => 'QUEM SOMOS'),
            2 => array('link' => URL.'index/categoria',         'class' => 'external', 'label' => 'PRODUTOS'),
            3 => array('link' => URL.'#portfolio',              'class' => 'external', 'label' => 'PORTFOLIO'),
            4 => array('link' => '#contact',                    'class' => '',         'label' => 'CONTATO'),
        );

        require_once 'models/user_model.php';
        $objUser = new User_Model();

        require_once 'models/order_product_model.php';
        $objOrderProduct = new Order_product_Model();

        require_once 'models/order_model.php';
        $objOrder = new Order_Model();
        $objOrder->obterOrderBySession( Session::get('session_order') );
        $id_order = $objOrder->getId_order();
        $this->view->id_order = $id_order;

        $this->view->listarOrderProductByOrder = $objOrderProduct->listarOrder_productByOrder($id_order);

        $this->view->render('header.site');
        $this->view->render('index/finalizar_compra');

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

    public function calcularFrete($cep)
    {
        $client = new SoapClient('http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx?WSDL');
        $function = 'CalcPrecoPrazo';
        $arguments = array('CalcPrecoPrazo' => array(
                'nCdEmpresa' => 0,
                'sDsSenha' => '',
                'nCdServico' => 41106,
                'sCepOrigem' => '08653300',
                'sCepDestino' => $cep,
                'nVlPeso' => 0,
                'nCdFormato' => 1,
                'nVlComprimento' => 16,
                'nVlAltura' => 2,
                'nVlLargura' => 11,
                'nVlDiametro' => 0,
                'sCdMaoPropria' => 'N',
                'nVlValorDeclarado' => 0,
                'sCdAvisoRecebimento' => 'N'
            )
        );

        $options = array('location' => 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.asmx');
        //$result = $client->__soapCall($function, $arguments, $options);

        $arguments['CalcPrecoPrazo']['nCdServico'] = 41106;
        $result = $client->__soapCall($function, $arguments, $options);
        $valor_frete_pac = $result->CalcPrecoPrazoResult->Servicos->cServico->Valor;
        $prazo_pac = $result->CalcPrecoPrazoResult->Servicos->cServico->PrazoEntrega;

        $arguments['CalcPrecoPrazo']['nCdServico'] = 40010;
        $result = $client->__soapCall($function, $arguments, $options);
        $valor_frete_sedex = $result->CalcPrecoPrazoResult->Servicos->cServico->Valor;
        $prazo_sedex = $result->CalcPrecoPrazoResult->Servicos->cServico->PrazoEntrega;

        header("Content-type: application/json; charset=utf-8");
        $retorno = array(
            "valor_pac" => $valor_frete_pac,
            "prazo_pac" => $prazo_pac,
            "valor_sedex" => $valor_frete_sedex,
            "prazo_sedex" => $prazo_sedex
        );

        echo json_encode($retorno);

        //echo json_encode(array("valor" => $result->CalcPrecoPrazoResult->Servicos->cServico->Valor));
    }

    public function consultaCep($cep)
    {
        $client = new SoapClient('https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente?wsdl');

        $arguments = array('consultaCEP' => array('cep' => $cep));
        $options = array('location' => 'https://apps.correios.com.br/SigepMasterJPA/AtendeClienteService/AtendeCliente');
        $function = 'consultaCEP';
        header("Content-type: application/json; charset=utf-8");
        try {
            $result = $client->__soapCall($function, $arguments, $options);
            echo json_encode($result->return);
        } catch (Exception $e) {
            echo json_encode(array('erro' => true));
        }
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


}
