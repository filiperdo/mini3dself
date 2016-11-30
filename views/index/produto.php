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
			<div class="col-md-12">
				<h2 class="wow bounceIn" data-wow-offset="50" data-wow-delay="0.3s"><span>PRODUTO</span> <?php echo $this->id; ?></h2>
			</div>

			<div class="col-md-5 col-sm-5 col-xs-12 wow fadeIn produto-box" data-wow-offset="50" data-wow-delay="1.3s">
				<div class="produto-item">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<img src="<?php echo URL; ?>public/img/product/<?php echo $this->id; ?>/1.jpg" class="img-responsive" alt="team img 1">
						</div>
						<div class="col-md-6 col-sm-6">
							<img src="<?php echo URL; ?>public/img/product/<?php echo $this->id; ?>/2.jpg" class="img-responsive" alt="team img 1">
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-7 col-sm-7 col-xs-12 wow fadeIn produto-box" data-wow-offset="50" data-wow-delay="1.3s">
				<div class="team-product">
    				<div class="team-des">
    					<h3>Nome do produto</h3>
                        <h4>REF. 001</h4>
    					<h3><span>R$ 99,00</span></h3>
    					<form class="" action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 col-sm-6">
                                    <p>Foto frontal</p>
                                    <input name="fileUpload1" id="fileUpload1" type="file" />
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <p>Foto de perfil</p>
                                    <input name="fileUpload2" id="fileUpload2" type="file" />
                                </div>
                            </div>

                            <div class="row" style="margin-top:25px">
                                <div class="col-md-6 col-sm-6">
                                    <button type="button" class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-lg">Saiba como devem ser as fotos</button>
                                </div>
                            </div>

                            <div class="row" style="margin-top:25px">
                                <div class="col-md-6 col-sm-6">
                                    <input type="hidden" id="idProduct" value="<?php echo $this->id; ?>">
                                    <button type="button" class="btn btn-info" id="addCart" name="button">Adicionar ao carrinho</button>
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
