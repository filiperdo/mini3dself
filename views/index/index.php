<!-- start home -->
	<section id="home">
		<div class="container">
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					<!--<h1 class="wow fadeIn" data-wow-offset="50" data-wow-delay="0.9s">Grandes momentos merecem ser eternizados com <span>uma miniatura 3D</span></h1>-->
					<!--<div class="element">
						<div class="sub-element">Hello, this is Typed.js</div>
						<div class="sub-element">Awesome Template is provided by templatemo.com website for everyone</div>
						<div class="sub-element">Download, edit and apply this awesome template for your websites</div>
					</div>
					<a data-scroll href="#about" class="btn btn-default wow fadeInUp" data-wow-offset="50" data-wow-delay="0.6s">Comece agora</a>-->
				</div>
			</div>
		</div>
	</section>
	<!-- end home -->

	<!-- start service -->
	<section id="service">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">ENTENDA <span>COMO FUNCIONA</span></h2>
				</div>
				<div class="col-md-4 wow fadeIn" data-wow-offset="50" data-wow-delay="0.2s">
					<img src="<?=URL?>public/img/bonc-2.png" alt="" width="140px">
					<h3>PASSO 1</h3>
					<h4>ESCOLHA O MODELO DE CORPO</h4>
					<!--<p>Lorem ipsum dolor sit amet, consectetur adipiscing elitquisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie. Adipiscing vitae vel quam proin eget mauris eget. Lorem ipsum dolor sit amet, consectetur adipiscing elitquisque tempus ac eget diam et laoreet phasellus ut nisi id leo molestie.</p>-->
				</div>
				<div class="col-md-4 wow fadeIn" data-wow-offset="50" data-wow-delay="0.3s">
					<img src="<?=URL?>public/img/bonc-1.png" alt="" width="140px">
					<h3>PASSO 2</h3>
					<h4>ENVIE AS FOTOS</h4>

				</div>
				<div class="col-md-4 wow fadeIn" data-wow-offset="50" data-wow-delay="0.4s">
					<img src="<?=URL?>public/img/bonc-3.png" alt="" width="140px">
					<h3>PASSO 3</h3>
					<h4>NÓS CONSTRUÍMOS SEU MODELO</h4>

				</div>
			</div>
		</div>
	</section>
	<!-- end servie -->



	<!-- start team -->
	<section id="team">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>MODELOS DE CORPO</span></h2>
				</div>

				<?php foreach( $this->product->listarProduct(12) as $product ) { ?>
				<div class="col-md-2 col-sm-3 col-xs-6 wow fadeIn produto-box" data-wow-offset="50" data-wow-delay="0.4s">
					<a href="<?php echo URL . 'index/produto/' . $product->getId_product();?>">
						<div class="team-wrapper">
							<img src="<?php echo URL; ?>public/img/product/<?php echo $product->getPath() . '/' . $product->getMainpicture();?>" class="img-responsive" alt="team img 1">
							<div class="team-des">
								<h4 style="color:#fff"><?php echo $product->getName(); ?></h4>
								<!--<span>R$ 99,00</span>-->
								<!--<p style="color:#eaeaea">Lorem ipsum dolor sit amet, consectetur adipiscing elitquisque tempus ac eget diam et laoreet phasellus ut nisi id leo molest.</p>-->
							</div>
						</div>
					</a>
				</div>
				<?php } ?>
				<div class="col-md-12">
					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><a href="<?php echo URL?>index/categoria" class="btn btn-info btn-lg">Visualizar todos</a></h2>
				</div>
			</div>
		</div>
	</section>
	<!-- end team -->



	<!-- start about -->
	<section id="about">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>QUEM SOMOS</span></h2>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInLeft" data-wow-offset="50" data-wow-delay="0.2s">
					<div class="media">
						<div class="media-heading-wrapper row">
							<div class="col-sm-2">
								<img src="<?=URL?>public/img/camera-lens-icon.png" alt="" width="100px">
							</div>
							<div class="col-sm-10">
								<h3 class="media-heading">MINIATURA 3D PARA EMPRESAS</h3>
							</div>
						</div>
						<div class="media-body">
							<p>Reconheça seus funcionários. Trabalhamos com conceitos especiais para reconhecimento e aumento de produtividade.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInUp" data-wow-offset="50" data-wow-delay="0.4s">
					<div class="media">
						<div class="media-heading-wrapper row">
							<div class="col-sm-2">
								<img src="<?=URL?>public/img/camera-lens-icon.png" alt="" width="100px">
							</div>
							<div class="col-sm-10">
								<h3 class="media-heading">MINIATURA 3D PARA MILITARES</h3>
							</div>
						</div>
						<div class="media-body">
							<p>Para você que é Militar, temos um grande prazer em eternizar a Miniatura 3D de alguém tão dedicado em proteger a sociedade.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12 wow fadeInRight" data-wow-offset="50" data-wow-delay="0.6s">
					<div class="media">
						<div class="media-heading-wrapper row">
							<div class="col-sm-2">
								<img src="<?=URL?>public/img/camera-lens-icon.png" alt="" width="100px">
							</div>
							<div class="col-sm-10">
								<h3 class="media-heading">MINIATURAS 3D INCRÍVEIS</h3>
							</div>
						</div>
						<div class="media-body">
							<p>Eternize momentos especiais.
									A mini3D está pronta para registrar os melhores momentos da sua vida.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end about -->


	<!-- start portfolio -->
	<section id="portfolio" >
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s">CONHEÇA NOSSO <span>PORTFOLIO</span> </h2>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.2s">
					<div class="portfolio-thumb">
					   <img src="<?php echo URL; ?>public/img/portfolio-img1.jpg" class="img-responsive" alt="portfolio img 1">
							<div class="portfolio-overlay">
								<h4>Nome projeto</h4>

								<a href="#" class="btn btn-default">Detalhes</a>
							</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.2s">
					<div class="portfolio-thumb">
					   <img src="<?php echo URL; ?>public/img/portfolio-img2.jpg" class="img-responsive" alt="portfolio img 2">
							<div class="portfolio-overlay">
								<h4>Nome projeto</h4>

								<a href="#" class="btn btn-default">Detalhes</a>
							</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.2s">
					<div class="portfolio-thumb">
					   <img src="<?php echo URL; ?>public/img/portfolio-img3.jpg" class="img-responsive" alt="portfolio img 3">
							<div class="portfolio-overlay">
								<h4>Nome projeto</h4>

								<a href="#" class="btn btn-default">Detalhes</a>
							</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.2s">
					<div class="portfolio-thumb">
					   <img src="<?php echo URL; ?>public/img/portfolio-img4.jpg" class="img-responsive" alt="portfolio img 4">
							<div class="portfolio-overlay">
								<h4>Nome projeto</h4>

								<a href="#" class="btn btn-default">Detalhes</a>
							</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.2s">
					<div class="portfolio-thumb">
					   <img src="<?php echo URL; ?>public/img/portfolio-img3.jpg" class="img-responsive" alt="portfolio img 3">
							<div class="portfolio-overlay">
								<h4>Nome projeto</h4>

								<a href="#" class="btn btn-default">Detalhes</a>
							</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.2s">
					<div class="portfolio-thumb">
					   <img src="<?php echo URL; ?>public/img/portfolio-img4.jpg" class="img-responsive" alt="portfolio img 4">
							<div class="portfolio-overlay">
								<h4>Nome projeto</h4>

								<a href="#" class="btn btn-default">Detalhes</a>
							</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.2s">
					<div class="portfolio-thumb">
					   <img src="<?php echo URL; ?>public/img/portfolio-img1.jpg" class="img-responsive" alt="portfolio img 1">
							<div class="portfolio-overlay">
								<h4>Nome projeto</h4>

								<a href="#" class="btn btn-default">Detalhes</a>
							</div>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.2s">
					<div class="portfolio-thumb">
					   <img src="<?php echo URL; ?>public/img/portfolio-img2.jpg" class="img-responsive" alt="portfolio img 2">
							<div class="portfolio-overlay">
								<h4>Nome projeto</h4>

								<a href="#" class="btn btn-default">Detalhes</a>
							</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end portfolio -->


	<!-- start paralax -->
	<section id="paralax"></section>
