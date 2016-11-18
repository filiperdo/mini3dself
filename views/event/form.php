
<!-- Page Heading -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2 class="page-header"><?php echo $this->title; ?></h2>
		<div class="clearfix"></div>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>event">Listar Event</a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>

<form id="form1" name="form1" method="post" action="<?php echo URL;?>event/<?php echo $this->action;?>/" class="form-horizontal">

<div class="row">

<div class="col-md-6 col-sm-6 col-lg-6 col-xs-12">
<input type="hidden" name="idEvent" value="<?=$this->obj->getId_event()?>" />

<div class="form-group">
	<label for="title" class="col-md-2 col-sm-2 col-xs-12 control-label">Title</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="title" id="title"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getTitle()?>" />
	</div>
</div>

<div class="form-group">
	<label for="date" class="col-md-2 col-sm-2 col-xs-12 control-label">Date</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="date" id="date"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getDate()?>" />
	</div>
</div>

<div class="form-group">
	<label for="content" class="col-md-2 col-sm-2 col-xs-12 control-label">Content</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="content" id="content"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getContent()?>" />
	</div>
</div>

<div class="form-group">
	<label for="path" class="col-md-2 col-sm-2 col-xs-12 control-label">Path</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
		<input type="text" name="path" id="path"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getPath()?>" />
	</div>
</div>

<div class="form-group">
	<label for="id_user" class="col-md-2 col-sm-2 col-xs-12 control-label">Id_user</label> 
	<div class="col-md-9 col-sm-9 col-xs-12"> 
	<select name="id_user" id="id_user"  class="form-control col-md-7 col-xs-12" required="required">
		<option value=""></option>
	</select>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>event" class="btn btn-primary">Cancelar</a>
	</div>
</div>


</div>
</div>

</form>
</div>
</div>
</div>
<!-- /.row -->