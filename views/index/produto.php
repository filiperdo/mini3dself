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
							<img src="<?php echo URL; ?>public/img/product/<?php echo $this->id; ?>/1.jpg" class="img-responsive" alt="team img 1">
						</div>
						<div class="col-md-6 col-sm-6">
							<img src="<?php echo URL; ?>public/img/product/<?php echo $this->id; ?>/2.jpg" class="img-responsive" alt="team img 1">
						</div>
					</div>

					<div class="row" style="margin-top:25px">
						<?php for ($i=0; $i < 4; $i++) { ?>
							<div class="col-md-3">
								<img src="<?php echo URL?>public/img/team-img2.jpg" width="100%" alt="<?php echo 'Nome';?>">
							</div>
						<?php } ?>
					</div>
				</div>
			</div>

			<div class="col-md-7 col-sm-7 col-xs-12 wow fadeIn produto-box" data-wow-offset="50" data-wow-delay="0.5s">
				<div class="team-product">
    				<div class="team-des">
						<div class="row" style="margin-bottom:20px">
							<div class="col-md-6 col-sm-6 col-xs-12">
	    					<h3>Nome do produto</h3>
	                        <h4>Cod. 001</h4>
	    					<h3><span id="label-price">R$ 200,00</span></h3>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
							<h4>Selecione o tamanho</h4>
							<?php foreach ($this->model_size as $size => $price) {?>
								<div class="radio">
								  <label>
								    <input type="radio" name="optionsRadios" class="model-size" id="optionsRadios1" title="<?php echo $price; ?>" value="<?php echo $size;?>" <?php if($size==12){?> checked<?php } ?>>
									<?php echo $size == 15 ? '15,5' : $size;?>cm
								  </label>
								</div>
							<?php } ?>
							</div>
						</div>
    					<form class="" action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-6">
									<p><img src="<?php echo URL?>public/img/team-img3.jpg" width="100%" alt="<?php echo 'Nome';?>"></p>
									<p>Foto frontal</p>
                                    <input name="fileUpload1" id="fileUpload1" required type="file" />
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6">
									<p><img src="<?php echo URL?>public/img/team-img3.jpg" width="100%" alt="<?php echo 'Nome';?>"></p>
                                    <p>Perfil direito</p>
                                    <input name="fileUpload2" id="fileUpload2" required type="file" />
                                </div>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<p><img src="<?php echo URL?>public/img/team-img3.jpg" width="100%" alt="<?php echo 'Nome';?>"></p>
                                    <p>Perfil esquerdo</p>
                                    <input name="fileUpload2" id="fileUpload3" required type="file" />
                                </div>
								<div class="col-md-3 col-sm-3 col-xs-6">
									<p><img src="<?php echo URL?>public/img/team-img3.jpg" width="100%" alt="<?php echo 'Nome';?>"></p>
                                    <p>Foto da nuca</p>
                                    <input name="fileUpload2" id="fileUpload4" required type="file" />
                                </div>
                            </div>

                            <div class="row" style="margin-top:25px">
                                <div class="col-md-12">
                                    <input type="hidden" id="idProduct" value="<?php echo $this->id; ?>">
                                    <button type="submit" class="btn btn-info" name="Enviar">Adicionar ao carrinho</button>
									<a href="<?php echo URL;?>" class="btn btn-success" name="button">Continuar comprando</a>
                                </div>
                            </div>
    					</form>
    				</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- end team -->
