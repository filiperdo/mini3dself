
<!-- Page Heading -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2 class="page-header"><?php echo $this->title; ?></h2>
		<div class="clearfix"></div>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>user_payment_method">Listar User_payment_method</a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>

<form id="form1" name="form1" method="post" action="<?php echo URL;?>user_payment_method/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
<input type="hidden" name="idUser_payment_method" value="<?=$this->obj->getId_user_payment_method()?>" />

<div class="form-group">
	<label for="id_user" class="col-md-2 col-sm-2 col-xs-12 control-label">Id_user</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
	<select name="id_user" id="id_user"  class="form-control col-md-7 col-xs-12" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="id_payment_method" class="col-md-2 col-sm-2 col-xs-12 control-label">Id_payment_method</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
	<select name="id_payment_method" id="id_payment_method"  class="form-control col-md-7 col-xs-12" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="card_number" class="col-md-2 col-sm-2 col-xs-12 control-label">Card_number</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="card_number" id="card_number"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getCard_number()?>" />
	</div>
</div>

<div class="form-group">
	<label for="validity" class="col-md-2 col-sm-2 col-xs-12 control-label">Validity</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="validity" id="validity"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getValidity()?>" />
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>user_payment_method" class="btn btn-primary">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>
</div>
</div>
</div>
<!-- /.row -->