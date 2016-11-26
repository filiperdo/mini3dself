<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index()
    {
        $this->view->title = 'Home';

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

      $this->view->title = 'Produto';

      $this->view->id = $id_product;

    	$this->view->render('header.site');
    	$this->view->render('index/produto');
    	$this->view->render('footer.site');
    }
}
