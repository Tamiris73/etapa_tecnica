<!-- Código desenvolido por Tamiris Oliveira-->
<!DOCTYPE HTML>
<html lang="pt-br">  
    <head>  
        <meta charset="utf-8">
        <title>Registrar</title>
		<link href="./style.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
		<section>
			<form method="post" id="insert_form">
				<div class="legend">
				<legend>Informações Básicas</legend>
				</div>
					<div class="labels"> 
						<!-- Campos de preenchimento-->
						<div class="campos">
							<label class="col-sm-2 col-form-label">Nome</label>
							<div class="col-sm-10">
								<input name="nome" type="text" class="form-control" id="nome" placeholder="Priscilla Barros">
							</div>
						</div>
						
						<div class="campos">
							<label class="col-sm-2 col-form-label">Email</label>
							<div class="col-sm-10">
								<input name="email" type="email" class="form-control" id="email" placeholder="priscilla.barros@netwall.com.br">
							</div>
						</div>
						<!-- Botão de salvar-->
						<div class="form-group row">
							<div class="col-sm-10">
								<input type="submit" name="CadUser" id="CadUser" value="Salvar" class="btn btn-outline-success">
							</div>
						</div>
					</div>
				</form>
				<!--Mensagens de confirmação-->
				<div id="msgCadSucesso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header bg-success text-center">
								<h5 class="modal-title" id="visulUsuarioModalLabel">Usuário</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								Usuário cadastrado com sucesso!
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-info" data-dismiss="modal">Fechar</button>
							</div>
						</div>
					</div>
				</div>
		</section>
		<!-- Mensagens de alerta-->
		<script>
			$('#insert_form').on('submit', function(event){
					event.preventDefault();
					if($('#nome').val() == ""){
						//Alerta de campo nome vazio
						$("#msg-error").html('<div class="alert alert-danger" role="alert">Necessário prencher o campo nome!</div>');
					}else if($('#email').val() == ""){
						//Alerta de campo email vazio
						$("#msg-error").html('<div class="alert alert-danger" role="alert">Necessário prencher o campo e-mail!</div>');						
					}else{
						//Receber os dados do formulário
						var dados = $("#insert_form").serialize();
						$.post("cadastrar.php", dados, function (retorna){
							if(retorna){
								
								//Limpar os campo
								$('#insert_form')[0].reset();
								
								//Fechar a janela modal cadastrar
								$('#addUsuarioModal').modal('hide');
								
								//Alerta de cadastro realizado com sucesso
								//$("#msg").html('<div class="alert alert-success" role="alert">Usuário cadastrado com sucesso!</div>'); 
								$('#msgCadSucesso').modal('show');
								
								//Limpar mensagem de erro
								$("#msg-error").html('');	
								
								listar_usuario(1, 50);
							}else{
								
							}
							
						});
					}
				});
		</script>
    </body>
</html>
