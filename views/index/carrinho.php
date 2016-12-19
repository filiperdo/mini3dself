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
                        <table id="datatable-responsive" class="table table-hover" cellspacing="5" width="100%">
                        	<thead>
                        	<tr>
								<th width="120"></th>
								<th>Nome</th>
								<th>Tamanho</th>
                                <th>Quantidade</th>
                                <th>Preço</th>
                        		<th></th>
                        	</tr>
                        	</thead>
                        	<tbody>

                        	<?php foreach( $this->listarOrderProductByOrder as $order_produt ) { ?>
                        	<tr>
								<td><img src="<?php echo URL;?>public/img/product/<?php echo $order_produt->getProduct()->getPath();?>/thumb/img-1.jpg" width="80px" alt=""></td>
								<td align="left"><?php echo $order_produt->getProduct()->getName(); ?></td>
								<td align="left"><?php echo $order_produt->getSize() == 15 ? '15,5' : $order_produt->getSize();?>cm</td>
                                <td ><?php echo $order_produt->getQuantity(); ?></td>
                                <td ><?php echo 'R$ ' . Data::formataMoeda($order_produt->getPrice()*$order_produt->getQuantity()); ?></td>
                         		<td align="right">
                        			<a href="<?php echo URL;?>index/removeItemCart/<?php echo base64_encode($order_produt->getId_order_product());?>" class="delete btn btn-danger"><i class="glyphicon glyphicon-trash"></i></a>
                        		</td>
                        		</tr>
                        	<?php } ?>
                        	</tbody>
                        </table>
                        <p><a href="#" class="btn btn-success btn-lg">Finalizar compra</a>
						<a href="<?php echo URL?>index/categoria/" class="btn btn-info btn-lg">Continuar comprando</a></p>
    				</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- end team -->
