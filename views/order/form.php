
<!-- Page Heading -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2 class="page-header"><?php echo $this->title; ?></h2>
		<div class="clearfix"></div>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>order">Listar Order</a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>

<form id="form1" name="form1" method="post" action="<?php echo URL;?>order/<?php echo $this->action;?>/" >
<input type="hidden" name="idOrder" value="<?=$this->obj->getId_order()?>" />
<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
<h3>Detalhes da entrega</h3>
<p><?php echo '<strong>Cod. ' . $this->obj->getId_order() . '</strong> por ' . $this->obj->getUser()->getName() . ' - ' . $this->obj->getUser()->getPhone1() .'<br>' . $this->obj->getUser()->getEmail(); ?></p>
<p><?php echo $this->obj->getUser()->getAdress() . ', ' . $this->obj->getUser()->getNumber() . ' - ' . $this->obj->getUser()->getComplement() . ' - ' . $this->obj->getUser()->getCep(); ?></p>
<p>Via <?php echo $this->obj->getShipment(); ?></p>

<div class="form-group">

	<table id="datatable-responsive" class="table" cellspacing="5" width="100%" >
		<thead>
		<tr>
			<th></th>
			<th>Produto</th>
			<th></th>
			<th>Preço</th>
		</tr>
		</thead>
		<tbody>
		<?php $total = 0; ?>
		<?php foreach( $this->order_product->listarOrder_productByOrder($this->obj->getId_order()) as $order_produt ) { ?>
		<?php $tamanho = $order_produt->getSize() == 15 ? '15,5' : $order_produt->getSize(); ?>
		<tr>
			<td><img src="<?php echo URL;?>public/img/product/<?php echo $order_produt->getProduct()->getPath();?>/thumb/img-1.jpg" width="40px" alt=""></td>
			<td align="left"><?php echo $order_produt->getProduct()->getName().' ('.$tamanho.'cm)'; ?></td>
			<td ><?php echo $order_produt->getQuantity().'x'; ?></td>
			<td ><?php echo 'R$ ' . Data::formataMoeda($order_produt->getPrice()*$order_produt->getQuantity()); ?></td>
			<?php $total += $order_produt->getPrice()*$order_produt->getQuantity(); ?>
		</tr>
		<?php } ?>
		<tr id="linhaFrete" style="display: none;">
			<td colspan="3" align="right">Valor Frete</td>
			<td colspan="1" align="left"><div id="exibeFrete"></div></td>
		</tr>
		<tr style="background: #eaeaea">
			<td colspan="3" align="right"><strong>Total</strong></td>
			<td colspan="1">
				<strong id="exibeTotal"><?php echo 'R$ ' . Data::formataMoeda($total); ?></strong>
				<input type="hidden" name="totalCarrinho" id="totalCarrinho" value="<?php echo $total;?>">
			</td>
		</tr>
		</tbody>
	</table>
</div>

<div class="form-group">
	<label for="order_status" class="control-label">Status</label>

	<select name="order_status" id="order_status"  class="form-control" required="required">
		<?php foreach ( $this->status->listarOrder_status() as $status ) { ?>
			<option value="<?php echo $status->getId_order_status(); ?>" <?php if($this->obj->getOrder_status()->getId_order_status() == $status->getId_order_status() ) {?> selected="selected" <?php } ?>>
				<?php echo $status->getDescription(); ?>
			</option>
		<?php } ?>
	</select>

</div>

<div class="form-group" >
	<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
	<a href="<?php echo URL; ?>order" class="btn btn-primary">Cancelar</a>
</div>

</div>

<div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
	<div class="row"><h2>Fotos do cliente:</h2></div>
	<?php foreach ($this->order_product->listarOrder_productByOrder($this->obj->getId_order()) as $order_produt) { ?>

	<div class="row">
		<p>Produto: <?php echo $order_produt->getProduct()->getId_product(); ?></p>
		<?php for($i=1; $i<=4; $i++) { ?>
		<div class="col-md-3 col-sm-3 col-lg-3 col-xs-12">
			<a href="<?=URL?>public/img/user/<?php echo $order_produt->getPath().'/img-'.$i.'.jpg';?>" target="_blank">
				<img src="<?=URL?>public/img/user/<?php echo $order_produt->getPath().'/img-'.$i.'.jpg';?>" width="100%" alt="">
			</a>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>

</div>

</form>
</div>
</div>
</div>
<!-- /.row -->
