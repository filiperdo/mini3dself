<!-- Page Heading -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2 class="page-header"><?php echo $this->title; ?></h2>
		<div class="clearfix"></div>
		<div class="row">
			<div class="col-lg-8 col-md-8">
				<ol class="breadcrumb">
					<li><a href="<?php echo URL;?>home">Home</a></li>
					<li class="active"><a href="<?php echo URL;?>order"><?php echo $this->title; ?></a></li>
				</ol>
			</div>
			<div class="col-lg-4 col-md-3">
			<form name="form-search" action="<?php echo URL;?>order" method="post">
				<div class="form-group input-group">
					<input type="text" class="form-control" required="required" name="like" id="busca">
					<span class="input-group-btn">
						<button class="btn btn-default" type="submit">
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</span>
				</div>
				</form>
			</div>

		</div>
	</div>

<div class="x_content">

<?php if (isset($_GET["st"])) { $objAlert = new Alerta($_GET["st"]); } ?>

<table id="datatable-responsive" class="table table-striped" cellspacing="0" width="100%">
	<thead>
	<tr>
		<th>Pedido</th>
		<th>Telefone</th>
		<th>Enviar para</th>
		<th>Data</th>
		<th>Status</th>
		<th></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $this->listarOrder as $order ) { ?>
	<tr>
		<td><?php echo $order->getId_order() . ' por ' . $order->getUser()->getName() . ' - ' . $order->getUser()->getPhone1() .'<br>' . $order->getUser()->getEmail(); ?></td>
		<td><?php echo $order->getPhone(); ?></td>
		<td>
			<?php echo $order->getUser()->getAdress() . ', ' . $order->getUser()->getNumber() . ' - ' . $order->getUser()->getComplement() . ' - ' . $order->getUser()->getCep(); ?><br>
			<?php //echo $order->getShip ?>
		</td>
		<td><?php echo Data::formatDateShort($order->getDate()); ?></td>
		<td><span class="<?php echo $order->getOrder_status()->getClass(); ?>"><?php echo $order->getOrder_status()->getDescription(); ?></span></td>
		<td align="right">
			<a href="<?php echo URL;?>order/form/<?php echo $order->getId_order();?>" class="btn btn-dark btn-sm"><i class="glyphicon glyphicon-eye-open"></i> Visualizar</a>
		</td>
	</tr>
	<?php } ?>
	</tbody>
</table>
</div>
</div>
</div>
</div>

<script>
$(function() {
	$(".delete").click(function(e) {
		var c = confirm("Deseja realmente deletar este registro?");
		if (c == false) return false;
	});
 });
</script>
