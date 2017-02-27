
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
                <div class="team-product">
    				<div class="team-des">
                        <?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>
                        <h2>Minha conta</h2>
                        <h3>Dados pessoais</h3>
                        <p><?php echo $this->user->getName() . '<br>' . $this->user->getEmail(); ?></p>
                        <h3 style="padding-top:20px">Meus pedidos</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Pedido</th>
                                <th>Data</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach( $this->order->listOrderByUser( Session::get('userid') ) as $order ) {?>
                            <tr>
                                <td><?php echo $order->getId_order(); ?></td>
                                <td><?php echo Data::formatDateShort($order->getDate()); ?></td>
                                <td><label class="<?php echo $order->getOrder_status()->getClass(); ?>"><?php echo $order->getOrder_status()->getDescription(); ?></label></td>
                                <td><?php echo 'R$ ' . Data::formataMoeda($order->getTotal()); ?></td>
                            </tr>
                            <?php } ?>
                            <tbody>
                        </table>

						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<h3 style="padding-top:20px">Endereço de entrega</h3>
		                        <p><?php echo $this->user->getAdress() . ', ' . $this->user->getNumber() . ' - ' . $this->user->getComplement();?></p>
		                        <p><?php echo $this->user->getCep(); ?></p>
		                        <p><?php echo $this->user->getDistrict().' - '.$this->user->getCity().' - '.$this->user->getState(); ?></p>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">								
								<h3 style="padding-top:20px">Dados para o pagamento	</h3>
								<p>Transferência bancária</p>
								<p>Banco - Itaú <br> <strong>AG:</strong> 0263 <br><strong>C/C:</strong> 79762-3</p>
								<p>Maicon Santana dos Santos <br> <strong>CPF:</strong> 352.828.218-50</p>
							</div>
						</div>



                    </div>
                </div>
            </div>

		</div>
	</div>
</section>
<!-- end team -->
