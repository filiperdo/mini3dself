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
                        <table id="datatable-responsive" class="table table-striped" cellspacing="0" width="100%">
                        	<thead>
                        	<tr>
                                <th>Nome</th>
                                <th>Quantidade</th>
                                <th align="right">Valor</th>
                        		<th></th>
                        	</tr>
                        	</thead>
                        	<tbody>
                        	<?php foreach( $this->listarOrderProductByOrder as $order_produt ) { ?>
                        	<tr>
                                <td align="left"><?php echo $order_produt->getProduct()->getName(); ?></td>
                                <td ><?php echo $order_produt->getQuantity(); ?></td>
                                <td align="right"><?php echo Data::formataMoeda($order_produt->getPrice()*$order_produt->getQuantity()); ?></td>
                         		<td align="right">
                        			<a href="<?php echo URL;?>order/form/<?php echo $order_produt->getId_order_product();?>" class="btn btn-dark btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                        			<a href="<?php echo URL;?>order/delete/<?php echo $order_produt->getId_order_product();?>" class="delete btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                        		</td>
                        		</tr>
                        	<?php } ?>
                        	</tbody>
                        </table>
                        <p><a href="#" class="btn btn-success btn-lg">Finalizar compra</a></p>
    				</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- end team -->
