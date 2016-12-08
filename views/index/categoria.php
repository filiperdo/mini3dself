<!-- start paralax -->
<section id="paralax"></section>

<!-- start team -->
<section id="team">
	<div class="container">
		<div class="row">
            <div class="col-md-3" style="background: #fff; color:#333">
                <h3>Categorias</h3>
                <ul>
                    <?php foreach ($this->category->listarCategory() as $category ) { ?>
                        <li><?php echo $category->getName(); ?></li>
                    <?php } ?>
                </ul>
            </div>

            <div class="col-md-9" >

    			<?php for ($i=1; $i <=12; $i++) { ?>
    			<div class="col-md-3 col-sm-3 col-xs-6 wow fadeIn produto-box" data-wow-offset="50" data-wow-delay="0.4s" style="margin-top:-20px; margin-bottom: 20px">
    				<div class="team-wrapper" id="<?php echo $i; ?>">
    					<img src="<?php echo URL; ?>public/img/product/<?php echo $i;?>/1.jpg" class="img-responsive" alt="team img 1">
    					<div class="team-des">
    						<h4 style="color:#fff">Nome produto</h4>
    						<span>R$ 99,00</span>
    						<!--<p style="color:#eaeaea">Lorem ipsum dolor sit amet, consectetur adipiscing elitquisque tempus ac eget diam et laoreet phasellus ut nisi id leo molest.</p>-->
    					</div>
    				</div>
    			</div>
    			<?php } ?>

            </div>
		</div>
	</div>
</section>
<!-- end team -->
