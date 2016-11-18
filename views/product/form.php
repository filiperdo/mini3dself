
<!-- Styles -->
<link href="<?php echo URL?>util/jqueryfiler/css/jquery.filer.css" rel="stylesheet">
<link href="<?php echo URL?>util/jqueryfiler/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet">

<!-- Jvascript -->
<script src="<?php echo URL?>util/jqueryfiler/js/jquery.filer.min.js" type="text/javascript"></script>
<script src="<?php echo URL?>util/jqueryfiler/js/custom.js" type="text/javascript"></script>

<!-- Page Heading -->
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
	<div class="x_title">
		<h2 class="page-header"><?php echo $this->title; ?></h2>
		<div class="clearfix"></div>
		<ol class="breadcrumb">
			<li><a href="<?php echo URL; ?>">Home</a></li>
			<li><a href="<?php echo URL; ?>product/lista">Listar Produto</a></li>
			<li class="active"><?php echo $this->title; ?></li>
		</ol>
	</div>

<div class="row">

<div class="col-md-8 col-sm-8 col-lg-8 col-xs-12">
<form id="form1" name="form1" method="post" action="<?php echo URL;?>product/<?php echo $this->action;?>/" class="form-horizontal">
<input type="hidden" name="idProduct" value="<?=$this->obj->getId_product()?>" />
<input type="hidden" name="path" value="<?=$this->path?>" />

<div class="form-group">
	<label for="status" class="col-md-2 col-sm-2 col-xs-12 control-label">Status</label>
	<div class="col-md-9 col-sm-9 col-xs-12">
		<select class="form-control col-md-7 col-xs-12" name="status">
			<option value="ACTIVE" <?php if($this->obj->getStatus()=='ACTIVE'){?>selected="selected"<?php } ?>>ATIVO</option>
			<option value="INACTIVE" <?php if($this->obj->getStatus()=='INACTIVE'){?>selected="selected"<?php } ?>>INATIVO</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label for="categoria" class="col-md-2 col-sm-2 col-xs-12 control-label">Categoria</label>
	<div class="col-md-9 col-sm-9 col-xs-12">
		<select class="form-control col-md-7 col-xs-12" name="categoria" id="categoria" >
			<?php foreach ( $this->listCategory as $category ) { ?>
			<option value="<?php echo $category->getId_category(); ?>" <?php if(in_array($category->getId_category(), $this->array_category)){?>selected="selected"<?php } ?>>
					<?php echo $category->getName(); ?>
			</option>
			<?php }  ?>
		</select>
	</div>
</div>

<div class="form-group">
	<label for="name" class="col-md-2 col-sm-2 col-xs-12 control-label">Name</label>
	<div class="col-md-9 col-sm-9 col-xs-12">
		<input type="text" name="name" id="name"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getName()?>" />
	</div>
</div>

<div class="form-group">
	<label for="mainpicture" class="col-md-2 col-sm-2 col-xs-12 control-label">Imagem principal</label>
	<div class="col-md-9 col-sm-9 col-xs-12">
		<input type="text" name="mainpicture" id="mainpicture"  class="form-control col-md-7 col-xs-12" required="required" value="<?=$this->obj->getMainpicture()?>" />
	</div>
</div>

<div class="form-group">
	<label for="description" class="col-md-2 col-sm-2 col-xs-12 control-label">Descrição</label>
	<div class="col-md-9 col-sm-9 col-xs-12">
		<textarea class="form-control" id="description" name="description" class="form-control col-md-7 col-xs-12" rows="13"><?=$this->obj->getDescription()?></textarea>
	</div>
</div>

<div class="form-group">
	<div class="col-sm-10  col-sm-offset-2">
		<input type="submit" name="salvar" id="salvar" value="Salvar" class="btn btn-success" />
		<a href="<?php echo URL; ?>product/lista" class="btn btn-primary">Cancelar</a>
	</div>
</div>

</form>
</div>

<div class="col-md-4 col-sm-4 col-lg-4 col-xs-12">

	<!--debug<form name="form5" action="http://localhost/educacional/product/wideimage_ajax/" method="post" enctype="multipart/form-data" >
		<input type="file" name="files[]"  multiple="multiple" >
		<input type="submit">
	</form>-->

	<input type="hidden" name="action_product" id="action_post" value="<?php echo $this->method_upload; ?>">
	<input type="file" name="files[]" id="filer_input2" multiple="multiple">

	<div id="output-files">
	<ul class="jFiler-items-list jFiler-items-grid" style="padding: 0">
		<?php if( $this->path != '' ) { ?>
		<?php foreach ( Data::getImgPost('product', $this->path, true ) as $img ) { ?>
		<li class="jFiler-item">
			<div class="jFiler-item-container">
				<div class="jFiler-item-inner">
					<div class="jFiler-item-thumb"><img alt="" src="<?=URL.$img?>" ></div>
					<div class="jFiler-item-assets jFiler-row">

						<ul class="list-inline pull-right">
							<?php $link_img = str_replace('/thumb/', '/', $img);?>
							<li>
								<button class="bt-copy btn btn-info btn-xs" data-clipboard-action="copy" data-clipboard-text="<?='../../'.$link_img?>"><i class="glyphicon glyphicon-link"></i></button>
								<a href="<?php echo URL?>product/delete_img/<?php echo base64_encode($img);?>"  class="btn btn-danger btn-xs"><i class="icon-jfi-trash jFiler-item-trash-action"></i></a>
							</li>
						</ul>

					</div>
				</div>
			</div>
		</li>
		<?php } // end foreach?>
		<?php } // end if ?>
	</ul>
	</div>

</div>

</div>


</div>
</div>
</div>
<!-- /.row -->

<script>

	var clipboard = new Clipboard('.bt-copy');

    clipboard.on('success', function(e) {
        console.log(e);
    });

    clipboard.on('error', function(e) {
        console.log(e);
    });

</script>

<script src='<?php echo URL?>util/tinymce/tinymce.min.js'></script>
<script>

  tinymce.init({
	  selector: '#description',
	  theme: 'modern',
	  menubar:false,
	  image_prepend_url: "<?php echo URL?>",
	  plugins: [
	    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
	    'searchreplace wordcount visualblocks visualchars code fullscreen',
	    'insertdatetime media nonbreaking save table contextmenu directionality',
	    'emoticons template paste textcolor colorpicker textpattern imagetools'
	  ],
	  toolbar1: ' bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor source code',
  });

</script>
