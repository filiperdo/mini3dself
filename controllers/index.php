<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        Session::init();

        $this->view->title = 'Home';

        $this->view->menu = array(
            '#top'          => 'HOME',
            '#about'        => 'QUEM SOMOS',
            '#team'         => 'PRODUTOS',
            '#portfolio'    => 'PORTFOLIO',
            '#contact'      => 'CONTATO'
        );

        //$this->view->js[] = ''
        $this->view->render('header.site');
        $this->view->render('index/index');
        $this->view->render('footer.site');
    }

    public function produto( $id_product )
    {
        /*require_once 'models/product_model.php';
        $this->view->product = new Product_Model();
        $this->view->product->obterProduct( $id_product );*/

        $this->view->menu = array(
            '/'         => 'HOME',
            '#about'        => 'QUEM SOMOS',
            '#team'         => 'PRODUTOS',
            '#portfolio'    => 'PORTFOLIO',
            '#contact'      => 'CONTATO'
        );

        $this->view->title = 'Produto';
        $this->view->id = $id_product;

        $this->view->render('header.site');
        $this->view->render('index/produto');
        $this->view->render('footer.site');
    }

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

    public function editCart( $id_product, $amount )
    {
        Session::init();
    }


}
