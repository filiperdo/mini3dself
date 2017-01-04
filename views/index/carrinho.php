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

			<div class="col-md-12 col-sm-12 col-xs-12 wow fadeIn produto-box" data-wow-offset="50" data-wow-delay="0.5s">
				<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>
				<div class="team-product">
    				<div class="team-des">

						<div class="row">

							<div class="col-md-12 col-sm-12 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.5s">
								<fieldset>
									<legend>SEU PEDIDO</legend>

			                        <table id="datatable-responsive" class="table table-hover" cellspacing="5" width="100%">
			                        	<thead>
			                        	<tr>
											<th width="120"></th>
											<th>Nome</th>
											<th>Tamanho</th>
			                                <th></th>
			                                <th>Preço</th>
			                        		<th></th>
			                        	</tr>
			                        	</thead>
			                        	<tbody>
										<?php $total = 0; ?>
			                        	<?php foreach( $this->listarOrderProductByOrder as $order_produt ) { ?>
			                        	<tr>
											<td><img src="<?php echo URL;?>public/img/product/<?php echo $order_produt->getProduct()->getPath();?>/thumb/img-1.jpg" width="80px" alt=""></td>
											<td align="left"><?php echo $order_produt->getProduct()->getName(); ?></td>
											<td align="left"><?php echo $order_produt->getSize() == 15 ? '15,5' : $order_produt->getSize();?>cm</td>
			                                <td ><?php echo $order_produt->getQuantity().'x'; ?></td>
			                                <td ><?php echo 'R$ ' . Data::formataMoeda($order_produt->getPrice()*$order_produt->getQuantity()); ?></td>
											<?php $total += $order_produt->getPrice()*$order_produt->getQuantity(); ?>
			                         		<td align="right">
			                        			<a href="<?php echo URL;?>index/removeItemCart/<?php echo base64_encode($order_produt->getId_order_product());?>" class="delete btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
			                        		</td>
			                        	</tr>
			                        	<?php } ?>
										<tr style="background: #eaeaea">
											<td colspan="4" align="right"><strong>Total</strong></td>
											<td colspan="2"><strong><?php echo 'R$ ' . Data::formataMoeda($total); ?></strong></td>
										</tr>
			                        	</tbody>
			                        </table>
								</fieldset>
							</div>

							<div class="col-md-5 col-sm-5 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.5s">
								<fieldset>
									<legend>CALCULO DE FRETE</legend>

									<p>Simule o prazo de entrega e o frete para seu CEP abaixo:</p>
									<form id="form1" name="form1" method="post" action="" class="form-horizontal">

										<div class="form-group">

											<div class="col-md-9 col-sm-9 col-xs-12">
												<input type="text" name="cep_entrega" id="cep_entrega" placeholder="CEP de entrega" class="form-control col-md-7 col-xs-12" required="required" value="" />
												<button style="margin-top:5px" type="submit" name="button" class="btn btn-primary">Calcular</button> <a href="#">Não sei meu cep</a>
											</div>
										</div>

										<p><strong>Atenção:</strong> O prazo começa a contar a partir da aprovação do pagamento.</p>
									</form>
								</fieldset>

							</div>

							<div class="col-md-7 col-sm-7 col-xs-12" data-wow-offset="50" data-wow-delay="0.5s">
								<?php if( $this->user->getName() != '' ) { ?>
								<fieldset>
									<legend>DADOS PARA ENTREGA</legend>
									<p><?php echo $this->user->getName(); ?></p>
									<p><?php echo $this->user->getEmail(); ?></p>
									<p><?php echo $this->user->getCep(); ?></p>
									<p><?php echo $this->user->getAdress().', '.$this->user->getNumber(); ?></p>
								</fieldset>
								<?php } ?>
								<p align="right"><a href="<?=URL?>index/finalizar_compra" class="btn btn-success">Finalizar compra</a>
								<a href="<?php echo URL?>index/categoria/" class="btn btn-info">Escolher mais modelos</a></p>
							</div>
						</div>

    				</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- end team -->
