
<!-- Page Heading -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2 class="page-header"><?php echo $this->title; ?></h2>
		<div class="clearfix"></div>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>product">Listar Product</a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>

<form id="form1" name="form1" method="post" action="<?php echo URL;?>product/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
<input type="hidden" name="idProduct" value="<?=$this->obj->getId_product()?>" />

<div class="form-group">
	<label for="code" class="col-md-2 col-sm-2 col-xs-12 control-label">Code</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="code" id="code"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getCode()?>" />
	</div>
</div>

<div class="form-group">
	<label for="name" class="col-md-2 col-sm-2 col-xs-12 control-label">Name</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="name" id="name"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getName()?>" />
	</div>
</div>

<div class="form-group">
	<label for="price" class="col-md-2 col-sm-2 col-xs-12 control-label">Price</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="price" id="price"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getPrice()?>" />
	</div>
</div>

<div class="form-group">
	<label for="note" class="col-md-2 col-sm-2 col-xs-12 control-label">Note</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="note" id="note"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getNote()?>" />
	</div>
</div>

<div class="form-group">
	<label for="color" class="col-md-2 col-sm-2 col-xs-12 control-label">Color</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="color" id="color"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getColor()?>" />
	</div>
</div>

<div class="form-group">
	<label for="size" class="col-md-2 col-sm-2 col-xs-12 control-label">Size</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="size" id="size"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getSize()?>" />
	</div>
</div>

<div class="form-group">
	<label for="id_category" class="col-md-2 col-sm-2 col-xs-12 control-label">Id_category</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
	<select name="id_category" id="id_category"  class="form-control col-md-7 col-xs-12" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="id_provider" class="col-md-2 col-sm-2 col-xs-12 control-label">Id_provider</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
	<select name="id_provider" id="id_provider"  class="form-control col-md-7 col-xs-12" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<label for="id_manufacturer" class="col-md-2 col-sm-2 col-xs-12 control-label">Id_manufacturer</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
	<select name="id_manufacturer" id="id_manufacturer"  class="form-control col-md-7 col-xs-12" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>product" class="btn btn-primary">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>
</div>
</div>
</div>
<!-- /.row -->