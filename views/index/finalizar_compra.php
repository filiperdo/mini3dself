<script src="<?php echo URL;?>public/js/jquery.maskedinput-1.3.js"></script>
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
						<div class="row">
							<form id="form1" name="form1" method="post" action="<?php echo URL;?>user/create/" >
								<input type="hidden" name="id_order" value="<?php echo $this->id_order;?>">
								<div class="col-md-5 col-sm-5 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.5s">

									<h4>1. DADOS PESSOAIS</h4>

										<div class="form-group">
											<label for="name" class="control-label">Nome</label>
											<input type="text" name="name" id="name" placeholder="Nome completo" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>

										<div class="form-group">
											<label for="cpf" class="control-label">CPF</label>
											<input type="text" name="cpf" id="cpf" placeholder="CPF" class="form-control col-md-7 col-xs-12 mask-cpf" required="required" value="" />
										</div>

										<div class="form-group">
											<label for="email" class="control-label">E-mail</label>
											<input type="email" name="email" id="email" placeholder="E-mail" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>

										<div class="form-group row">
											<label for="password" class="col-md-12 control-label">Senha</label>
											<div class="col-md-6">
												<input type="password" name="password" id="password" placeholder="Senha" class="form-control col-md-7 col-xs-12" required="required" value="" />
											</div>
											<div class="col-md-6">
												<input type="password" name="password" id="password" placeholder="Confirmar Senha" class="form-control col-md-7 col-xs-12" required="required" value="" />
											</div>
										</div>

										<div class="form-group">
											<label for="phone1" class=" control-label">Telefone</label>
											<input type="text" name="phone1" id="phone1" placeholder="Telefone" class="form-control col-md-7 col-xs-12" value="" />
										</div>

										<div class="form-group row">
											<label for="complement" class="col-md-12 control-label">CEP</label>
											<div class="col-md-8 col-sm-8 col-xs-12">
												<input type="text" name="cep_entrega" id="cep_entrega" placeholder="CEP" class="form-control" required="required" value="" />
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<button type="button" id="btnCalcularFrete" class="btn btn-primary col-md-12" name="button">Calcular</button>
											</div>
										</div>

										<div class="form-group row">
											<label for="adress" class="control-label col-md-12">Endereço</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<input type="text" name="adress" id="adress" placeholder="Endereço" class="form-control " required="required" value="" />
											</div>
											<div class="col-md-3 col-sm-3 col-xs-12">
												<input type="text" name="number" id="number" placeholder="Número" class="form-control " required="required" value="" />
											</div>
										</div>

										<div class="form-group">
											<label for="complement" class=" control-label">Comp.</label>
											<input type="text" name="complement" id="complement" placeholder="Complemento" class="form-control col-md-7 col-xs-12" value="" />
										</div>

										<div class="form-group">
											<label for="district" class="control-label">Bairro</label>
											<input type="text" name="district" id="district" placeholder="Bairro" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>

										<div class="form-group row">
											<label for="city" class="col-md-12 control-label">Cidade</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="city" id="city" placeholder="Cidade" class="form-control col-md-7 col-xs-12" required="required" value="" />
											</div>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<select class="form-control" required="required" name="state" id="state">
													<option value="">Estado</option>
													<option value="ac">Acre</option>
													<option value="al">Alagoas</option>
													<option value="am">Amazonas</option>
													<option value="ap">Amapá</option>
													<option value="ba">Bahia</option>
													<option value="ce">Ceará</option>
													<option value="df">Distrito Federal</option>
													<option value="es">Espírito Santo</option>
													<option value="go">Goiás</option>
													<option value="ma">Maranhão</option>
													<option value="mt">Mato Grosso</option>
													<option value="ms">Mato Grosso do Sul</option>
													<option value="mg">Minas Gerais</option>
													<option value="pa">Pará</option>
													<option value="pb">Paraíba</option>
													<option value="pr">Paraná</option>
													<option value="pe">Pernambuco</option>
													<option value="pi">Piauí</option>
													<option value="rj">Rio de Janeiro</option>
													<option value="rn">Rio Grande do Norte</option>
													<option value="ro">Rondônia</option>
													<option value="rs">Rio Grande do Sul</option>
													<option value="rr">Roraima</option>
													<option value="sc">Santa Catarina</option>
													<option value="se">Sergipe</option>
													<option value="sp">São Paulo</option>
													<option value="to">Tocantins</option>
												</select>
											</div>
										</div>

								</div><!-- col-md-4 -->

								<div class="col-md-7 col-sm-7 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.5s">
									<h4>2. FRETE</h4>
									<div class="" id="exibeResumoFrete">
										Preencha o campo CEP para calcular o valor e prazo do frete.
									</div>
									<div class="" id="exibeOpcoesFrete" style="display: none;">
										<input type="radio" name="opcaoFrete" value="" id="idFretePAC" /><div id="htmlPac"></div><br />
										<input type="radio" name="opcaoFrete" value="" id="idFreteSEDEX" /><div id="htmlSedex"></div>
									</div>
									<h4 style="padding-top:20px">3. FORMAS DE PAGAMENTO</h4>
									<p>Transferência bancária</p>
									<p>Banco - Itaú <br> <strong>AG:</strong> 0263 <br><strong>C/C:</strong> 79762-3</p>
									<p>Maicon Santana dos Santos <br> <strong>CPF:</strong> 352.828.218-50</p>
									<h4 style="padding-top:20px">4. RESUMO DO PEDIDO</h4>
									<table id="datatable-responsive" class="table table-hover" cellspacing="5" width="100%" >
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
			                        	<?php foreach( $this->listarOrderProductByOrder as $order_produt ) { ?>
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
									<button type="submit" class="btn btn-lg btn-success" name="button">Finalizar Compra</button>

								</div>

							</form>
						</div><!-- row -->

    				</div>
				</div>

			</div><!-- col-12 -->

		</div>
	</div>
</section>
<!-- end team -->

<script type="text/javascript" src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>

<script type="text/javascript">
PagSeguroDirectPayment.getPaymentMethods({
	amount: <?php echo $total;?>
	success: function(response) {
		console.log(response);
	},
	error: function(response) {
		//tratamento do erro
	},
	complete: function(response) {
		//tratamento comum para todas chamadas
	}
});
</script>

<!-- script start-->
<script type="text/javascript">

	var valorFretePac;
	var valorFreteSedex;
	var totalCarrinho;
	var valorTotal;

	$('#cep_entrega').on('blur',function(){
		calcularFrete();
		buscaCep()
	});

	$('#btnCalcularFrete').on('click',function(){
		calcularFrete();
		buscaCep()
	});

	function calcularFrete()
	{
		$.post('<?php echo URL . 'index/calcularFrete/';?>' + $('#cep_entrega').val(), function(result){
			valorFretePac = Number(result.valor_pac.replace(',', '.'));
			valorFreteSedex = Number(result.valor_sedex.replace(',', '.'));

			$('#htmlPac').html('PAC - Em média '+ result.prazo_pac +' dia(s) úteis R$ ' + result.valor_pac);
			$('#htmlPac').html('SEDEX - Em média '+ result.prazo_sedex +' dia(s) úteis R$ ' + result.valor_sedex);

			$('#exibeOpcoesFrete').css('display', '');
		});
	}

	$('#idFretePAC').on('click',function(){
		if ($("#idFretePAC").is(":checked")) {
			somaFrete(valorFretePac);
		}
	});

	$('#idFreteSEDEX').on('click',function(){
		if ($("#idFreteSEDEX").is(":checked")) {
			somaFrete(valorFreteSedex);
		}
	});

	function somaFrete(valorFrete) {

		totalCarrinho = Number($('#totalCarrinho').val());
		valorTotal =  (totalCarrinho + valorFrete).toFixed(2);

		$('#exibeFrete').html('R$ ' + valorFrete.toString().replace('.', ','));
		$('#exibeTotal').html('R$ ' + valorTotal.toString().replace('.', ','));
		$('#linhaFrete').css('display', '');
	}

	function buscaCep() {
		$.post('<?php echo URL . 'index/consultaCep/';?>' + $('#cep_entrega').val(), function(result){
			if (result.erro) {
				$("#adress").val("");
				$("#district").val("");
				$("#city").val("");
				$("#state").val("");
				alert("CEP não encontrado");
			} else {
				$("#adress").val(result.end);
				$("#district").val(result.bairro);
				$("#city").val(result.cidade);
				$("#state").val(result.uf.toLowerCase());
			}
			$("#number").focus();
		});
	}

</script>
<!-- script end -->
