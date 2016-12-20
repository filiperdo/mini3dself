<?php

Session::init();
$totalCart = 0;

if( Session::get('session_order') != null )
{
	require_once 'models/order_product_model.php';
	$objOrderProduct = new Order_product_Model();
	$totalCart = $objOrderProduct->countOrder_productBySession( Session::get('session_order') );
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<!--
        Awesome Template
        http://www.templatemo.com/preview/templatemo_450_awesome
        -->
		<title>3DSelfie</title>
		<meta name="keywords" content="">
		<meta name="description" content="">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="<?php echo URL; ?>public/css/animate.min.css">
		<link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo URL; ?>public/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="<?php echo URL; ?>public/css/templatemo-style.css">
		<script src="<?php echo URL; ?>public/js/jquery.js"></script>

        <script src="<?php echo URL; ?>public/js/jquery.singlePageNav.min.js"></script>
		<script src="<?php echo URL; ?>public/js/typed.js"></script>
		<script src="<?php echo URL; ?>public/js/wow.min.js"></script>
		<script src="<?php echo URL; ?>public/js/custom.js"></script>
		<script src="<?php echo URL; ?>public/js/bootstrap.min.js"></script>
	</head>
	<body id="top">

		<!-- start preloader -->
		<div class="preloader">
			<div class="sk-spinner sk-spinner-wave">
     	 		<div class="sk-rect1"></div>
       			<div class="sk-rect2"></div>
       			<div class="sk-rect3"></div>
      	 		<div class="sk-rect4"></div>
      			<div class="sk-rect5"></div>
     		</div>
    	</div>
    	<!-- end preloader -->

        <!-- start header -->
        <header>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <!--<p><i class="fa fa-phone" ></i> (11) 95569-1005</p>-->
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <!--<p><i class="fa fa-envelope-o"></i> <a href="#">contato@3dself.com</a> <i class="fa fa-phone" ></i> (11) 95569-1005</p>-->
                    </div>
                    <div class="col-md-5 col-sm-4 col-xs-12">
                        <ul class="social-icon">
                            <li><span>Siga-nos</span></li>
                            <li><a href="#" class="fa fa-facebook" style="background:#1c90dd; "></a></li>
                            <li><a href="#" class="fa fa-twitter" style="background:#1c90dd; "></a></li>
                            <li><a href="#" class="fa fa-instagram" style="background:#1c90dd; "></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <!-- end header -->

    	<!-- start navigation -->
		<nav class="navbar navbar-default templatemo-nav" role="navigation">
			<div class="container" style="margin-bottom:5px; margin-top:5px">
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
						<span class="icon icon-bar"></span>
					</button>
					<div style="margin-top:-70px"><a href="<?php echo URL?>" class="navbar-brand"><img src="<?php echo URL?>public/img/logo-3dself.png" height="150" alt=""></a></div>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav navbar-right">
						<?php foreach ($this->menu as $value) { ?>
							<li><a href="<?php echo $value['link'] ?>" class="<?=$value['class'];?>"><?php echo $value['label'] ?></a></li>
						<?php } ?>
						<li><a href="<?php echo URL?>index/carrinho/" class="external"><i class="glyphicon glyphicon-shopping-cart cart"></i> <span id="amount-cart">(<?php echo $totalCart; ?>)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- end navigation -->
