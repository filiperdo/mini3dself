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

							<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.5s">
								<h4>JÁ TENHO CADASTRO</h4>

								<form action="<?=URL?>user/login/" method="post" class="form-horizontal">
									<fieldset>
										<legend>Identificação</legend>
										<div class="form-group">
											<label for="name" class="col-md-2 col-sm-2 col-xs-12 control-label">E-mail</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<input type="text" name="email" id="email" placeholder="E-mail" class="form-control col-md-7 col-xs-12" required="required" value="" />
											</div>
										</div>

										<div class="form-group">
											<label for="cpf" class="col-md-2 col-sm-2 col-xs-12 control-label">Senha</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<input type="text" name="password" id="password" placeholder="Senha" class="form-control col-md-7 col-xs-12" required="required" value="" />
											</div>
										</div>
										<div class="col-md-9 col-sm-9 col-xs-12 col-sm-offset-2">
											<button type="submit" class="btn btn-success" name="button">Entrar</button>
										</div>
									</fieldset>
								</form>
							</div>

							<div class="col-md-6 col-sm-6 col-xs-12 wow fadeIn" data-wow-offset="50" data-wow-delay="0.5s">
								<form id="form1" name="form1" method="post" action="<?php echo URL;?>user/create/" class="form-horizontal">
								<h4>NÃO TENHO CADASTRO</h4>

								<fieldset>
									<legend>Dados pessoais</legend>

									<div class="form-group">
										<label for="name" class="col-md-2 col-sm-2 col-xs-12 control-label">Nome</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<input type="text" name="name" id="name" placeholder="Nome completo" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>
									</div>

									<div class="form-group">
										<label for="cpf" class="col-md-2 col-sm-2 col-xs-12 control-label">CPF</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<input type="text" name="cpf" id="cpf" placeholder="CPF" class="form-control col-md-7 col-xs-12 mask-cpf" required="required" value="" />
										</div>
									</div>

									<div class="form-group">
										<label for="email" class="col-md-2 col-sm-2 col-xs-12 control-label">E-mail</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<input type="email" name="email" id="email" placeholder="E-mail" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>
									</div>

									<div class="form-group">
										<label for="password" class="col-md-2 col-sm-2 col-xs-12 control-label">Senha</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<input type="password" name="password" id="password" placeholder="Senha" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>
									</div>

									<div class="form-group">
										<label for="phone1" class="col-md-2 col-sm-2 col-xs-12 control-label">Fones</label>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input type="text" name="phone1" id="phone1" placeholder="Telefone 1" class="form-control col-md-7 col-xs-12" value="" />
										</div>
										<div class="col-md-5 col-sm-5 col-xs-12">
											<input type="text" name="phone2" id="phone2" placeholder="Telefone 2" class="form-control col-md-7 col-xs-12" value="" />
										</div>
									</div>

								</fieldset>


								<fieldset>
									<legend>Dados de entrega</legend>
									<div class="form-group">
										<label for="complement" class="col-md-2 col-sm-2 col-xs-12 control-label">CEP</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<input type="text" name="cep" id="cep" placeholder="CEP" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>
									</div>

									<div class="form-group">
										<label for="adress" class="col-md-2 col-sm-2 col-xs-12 control-label">Endereço</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="adress" id="adress" placeholder="Endereço" class="form-control " required="required" value="" />
										</div>
										<div class="col-md-3 col-sm-3 col-xs-12">
											<input type="text" name="number" id="number" placeholder="Número" class="form-control " required="required" value="" />
										</div>
									</div>

									<div class="form-group">
										<label for="complement" class="col-md-2 col-sm-2 col-xs-12 control-label">Comp.</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<input type="text" name="complement" id="complement" placeholder="Complemento" class="form-control col-md-7 col-xs-12" value="" />
										</div>
									</div>

									<div class="form-group">
										<label for="district" class="col-md-2 col-sm-2 col-xs-12 control-label">Bairro</label>
										<div class="col-md-9 col-sm-9 col-xs-12">
											<input type="text" name="district" id="district" placeholder="Bairro" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>
									</div>

									<div class="form-group">
										<label for="city" class="col-md-2 col-sm-2 col-xs-12 control-label">Cidade</label>
										<div class="col-md-5 col-sm-5 col-xs-12">
											<input type="text" name="city" id="city" placeholder="Cidade" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>
										<div class="col-md-4 col-sm-4 col-xs-12">
											<input type="text" name="state" id="state" placeholder="Estado" class="form-control col-md-7 col-xs-12" required="required" value="" />
										</div>
									</div>
									<div class="col-md-9 col-sm-9 col-xs-12 col-sm-offset-2">
										<button type="submit" name="button" class="btn btn-success">Cadastrar</button>
									</div>

								</fieldset>


								</form>
							</div>

						</div>






    				</div>
				</div>
			</div>

		</div>
	</div>
</section>
<!-- end team -->
