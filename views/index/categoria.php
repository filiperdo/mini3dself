
<!-- start team -->
<section id="team">
	<div class="container">
		<div class="row">
            <div class="col-md-3" style="background: #fff; color:#333">
                <h3>Categorias</h3>
                <ul>
					<li><a href="<?php echo URL . 'index/categoria/';?>">Todos</a></li>
                    <?php foreach ($this->category->listarCategory() as $category ) { ?>
					<li><a href="<?php echo URL . 'index/categoria/'.$category->getId_category();?>"><?php echo $category->getName(); ?></a></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-md-9" >

    			<?php foreach( $this->listarProduct as $product ) { ?>
    			<div class="col-md-3 col-sm-3 col-xs-6 wow fadeIn produto-box" data-wow-offset="50" data-wow-delay="0.4s" style="margin-top:-20px; margin-bottom: 20px">
					<a href="<?php echo URL . 'index/produto/' . $product->getId_product();?>">
						<div class="team-wrapper" >
	    					<img src="<?php echo URL; ?>public/img/product/<?php echo $product->getPath() . '/'.$product->getMainpicture();?>" class="img-responsive" alt="team img 1">
	    					<div class="team-des">
	    						<h4 style="color:#fff"><?php echo $product->getName(); ?></h4>

	    						<!--<p style="color:#eaeaea">Lorem ipsum dolor sit amet, consectetur adipiscing elitquisque tempus ac eget diam et laoreet phasellus ut nisi id leo molest.</p>-->
	    					</div>
	    				</div>
					</a>
    			</div>
    			<?php } ?>

            </div>
		</div>
	</div>
</section>
<!-- end team -->
