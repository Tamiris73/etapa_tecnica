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
    
    var nome = $('#nome').val();
    var email = $('#email').val();
    
    // Realizar a verificação se o email já foi cadastrado
    $.ajax({
        type: 'POST',
        url: 'verificar.php',
        data: {email: email},
        dataType: 'json',
        success: function(response) {
            if (response.success == false) {
                // Email já cadastrado, exibir mensagem de erro
                $("#msg-error").html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
            } else {
                // Email ainda não cadastrado, realizar a submissão do formulário
                $.post("cadastrar.php", {nome: nome, email: email}, function (retorna){
                    if (retorna.success == true) {
                        // Limpar os campos
                        $('#insert_form')[0].reset();
                        
                        // Exibir mensagem de sucesso
                        $('#msgCadSucesso').modal('show');
                        
                        // Limpar mensagem de erro
                        $("#msg-error").html(''); 
                        
                        // Atualizar a listagem de usuários
                        listar_usuario(1, 50);
                    } else {
                        // Exibir mensagem de erro
                        $("#msg-error").html('<div class="alert alert-danger" role="alert">' + retorna.message + '</div>');
                    }
                }, 'json');
            }
        },
        error: function() {
            // Exibir mensagem de erro
            $("#msg-error").html('<div class="alert alert-danger" role="alert">Erro ao verificar o email no servidor.</div>');
        }
    });
});

		</script>
    </body>
</html>
