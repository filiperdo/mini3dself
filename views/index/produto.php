
<style media="screen">
    .img-modelos img{
        z-index:100;
    }
</style>
<!-- start slider -->
<!-- Reduzir slide para paginas internas -->
<section id="pagina">
	<div class="container">

	</div>
</section>
<!-- end slider  -->

<!-- start team -->
<section id="team">
	<div class="container">
		<div class="row">

			<div class="col-md-5 col-sm-5 col-xs-12 wow fadeIn produto-box" data-wow-offset="50" data-wow-delay="0.3s">
				<div class="produto-item">
					<div class="row">
						<div class="col-md-6 col-sm-6 ">
							<img src="<?php echo URL; ?>public/img/product/<?php echo $this->product->getPath(); ?>/img-1.jpg" second-image="<?php echo URL; ?>public/img/product/<?php echo $this->product->getPath(); ?>/img-1.jpg" class="img-responsive second-image" alt="team img 1">
						</div>
						<div class="col-md-6 col-sm-6">
							<img src="<?php echo URL; ?>public/img/product/<?php echo $this->product->getPath(); ?>/img-2.jpg" second-image="<?php echo URL; ?>public/img/product/<?php echo $this->product->getPath(); ?>/img-2.jpg" class="img-responsive second-image" alt="team img 1">
						</div>
					</div>

					<div class="row img-modelos" style="margin-top:25px">
						<?php for ($i=1; $i <=4; $i++) { ?>
							<div class="col-md-3">
								<img class="second-image" src="<?php echo URL?>public/img/product/<?php echo $this->product->getPath().'/thumb/img-'.$i.'.jpg'; ?>" data-image-opened="<?php echo URL;?>public/img/product/<?php echo $this->product->getPath().'/img-'.$i.'.jpg'; ?>" width="100%" alt="<?php echo 'Imagem ' . $this->product->getName();?>">
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="col-md-7 col-sm-7 col-xs-12 wow fadeIn produto-box" data-wow-offset="50" data-wow-delay="0.5s">
				<div class="team-product">
    				<div class="team-des">
						<form class="" action="<?=URL.'index/addCart/'.$this->product->getId_product();?>" method="post" enctype="multipart/form-data">
							<input type="hidden" name="price" id="price" value="299">
							<div class="row" style="margin-bottom:20px">
								<div class="col-md-6 col-sm-6 col-xs-12">
		    					<h3><?php echo $this->product->getName(); ?></h3>
		                        <h4>Cod. <?php echo $this->product->getId_product(); ?></h4>
		    					<h3><span id="label-price">R$ 299,00</span></h3>

								<p>Selecione as fotos como no exemplo abaixo e adicione ao carrinho!</p>

								</div>
								<div class="col-md-6 col-sm-6 col-xs-12">
								<h4>Selecione o tamanho</h4>
								<?php foreach ($this->model_size as $size => $price) {?>
									<div class="radio">
									  <label>
									    <input type="radio" name="size" class="model-size" title="<?php echo $price; ?>" value="<?php echo $size;?>" <?php if($size==12){?> checked<?php } ?>>
										<?php echo $size == 15 ? '15,5' : $size;?>cm
									  </label>
									</div>
								<?php } ?>
								</div>
							</div><!-- row -->

                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-6">
									<div class="foto-manual"><img id="foto-user-1" src="<?php echo URL?>public/img/foto-manual1.jpg" width="100%" alt="<?php echo 'Nome';?>"></div>
									<p>Foto frontal</p>
                                    <input name="fileUpload1" id="1" class="btn-foto-user" required type="file" />
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
									<div class="foto-manual"><img id="foto-user-2" src="<?php echo URL?>public/img/foto-manual2.jpg" width="100%" alt="<?php echo 'Nome';?>"></div>
                                    <p>Perfil direito</p>
                                    <input name="fileUpload2" id="2" class="btn-foto-user" required type="file" />
                                </div>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<div class="foto-manual"><img id="foto-user-3" src="<?php echo URL?>public/img/foto-manual3.jpg" width="100%" alt="<?php echo 'Nome';?>"></div>
                                    <p>Perfil esquerdo</p>
                                    <input name="fileUpload3" id="3" class="btn-foto-user" required type="file" />
                                </div>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<div class="foto-manual"><img id="foto-user-4" src="<?php echo URL?>public/img/foto-manual4.jpg" width="100%" alt="<?php echo 'Nome';?>"></div>
                                    <p>Foto da nuca</p>
                                    <input name="fileUpload4" id="4" class="btn-foto-user" required type="file" />
                                </div>
                            </div><!-- row -->

                            <div class="row" style="margin-top:25px">
                                <div class="col-md-12">
                                    <input type="hidden" id="idProduct" value="<?php echo $this->id; ?>">
                                    <button type="submit" class="btn btn-success btn-lg" name="Enviar">Comprar</button>
									<a href="<?php echo URL.'index/categoria';?>" class="btn btn-info btn-lg" name="button">Voltar</a>
                                </div>
                            </div><!-- row -->
    					</form>
    				</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- end team -->
<style media="screen">
	.foto-manual{
		margin-bottom: 15px;
		height: 155px;
		background: #ccc;
		text-align: center;
		font-size: 18px;
	}
</style>

<script type="text/javascript">

	var URL = '<?=URL;?>';
	$('.btn-foto-user').change(function() {
		var id = $(this).attr('id');
		var filename = $(this)[0].files[0]['name'];
		$target = '#foto-user-'+id;
		$($target).attr('src',URL+'public/img/img-ok.jpg');
	});

</script>


<!-- Mini lightbox
================================================ -->
<script src="<?php echo URL;?>util/mini-lightbox/mini-lightbox.js"></script>
<link rel="stylesheet" href="<?php echo URL;?>util/mini-lightbox/mini-lightbox.css">
<script>
  MiniLightbox.customClose = function () {
      var self = this;
      self.img.classList.add("animated", "fadeOutDown");
      setTimeout(function () {
          self.box.classList.add("animated", "fadeOut");
          setTimeout(function () {
              self.box.classList.remove("animated", "fadeOut");
              self.img.classList.remove("animated", "fadeOutDown");
              self.box.style.display = "none";
          }, 500);
      }, 500);
      return false;
  };

  MiniLightbox.customOpen = function () {
      this.box.classList.add("animated", "fadeIn");
      this.img.classList.add("animated", "fadeInUp");
  };

  window.onload = function () {
      MiniLightbox(".second-image");
  };
</script>
