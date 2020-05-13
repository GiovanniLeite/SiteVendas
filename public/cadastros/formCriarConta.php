<?php
    session_start();
    
    if(isset($_SESSION["user_portal"]))//se tiver usuario logado redireciona a pagina
    {
       header("location:../principal/login.php");
    }
?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cadastramento do cliente</title>
        
        
        <script src="../../_scripts/js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        
        <link href="../../_css/estilo.css" rel="stylesheet">
        <link href="../../_css/criarConta.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("../principal/_incluir/topo.php"); ?>
        
        <main>  
            <div id="formulario">
                <h2>Cadastre-se</h2>
                
                <div class="container">
                    <form id="formCriarConta">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="nome">Nome*</label>
                                    <input class="form-control" type="text" name="nome" id="nome" maxlength="43" placeholder="Nome" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cpf">CPF*</label>
                                    <input class="form-control" type="text" name="cpf" id="cpf" placeholder="CPF" title="Campo Obrigatório"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="rg">RG*</label>
                                    <input class="form-control" type="text" name="rg" id="rg" maxlength="12" placeholder="RG" title="Campo Obrigatório"/>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="telefone">Telefone*</label>
                                    <input class="form-control" type="text" name="telefone" id="telefone" placeholder="Ex: (15)3227-5064" title="Campo Obrigatório"/>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="celular">Celular*</label>
                                    <input class="form-control" type="text" name="celular" id="celular" placeholder="Ex: (15)98127-5064" title="Campo Obrigatório"/>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="cep">CEP*</label>
                                    <input class="form-control" type="text" name="cep" id="cep" maxlength="9" placeholder="Ex: 18016-410" title="Campo Obrigatório">
                                </div>
                            </div>
                            
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="endereco">Endereço*</label>
                                    <input class="form-control" type="text" name="endereco" id="endereco" maxlength="45" placeholder="Endereço" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="bairro">Bairro*</label>
                                    <input class="form-control" type="text" name="bairro" id="bairro" maxlength="60" placeholder="Bairro" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cidade">Cidade*</label>
                                    <input class="form-control" type="text" name="cidade" id="cidade" maxlength="30" placeholder="Cidade" title="Campo Obrigatório">
                                </div>
                            </div>
                                    
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="estado">Estado*</label>
                                    <input class="form-control" type="text" name="estado" id="estado" maxlength="30" placeholder="Estado" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input class="form-control" type="email" name="email" id="email" maxlength="45" placeholder="Email" title="Campo Obrigatório"/>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="usuario">Usuário*</label>
                                    <input class="form-control" type="text" name="usuario" id="usuario" maxlength="16" placeholder="Usuário" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">       
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="senha">Senha*</label>
                                    <input class="form-control" type="password" name="senha" id="senha" maxlength="25" placeholder="Senha" title="Campo Obrigatório">
                                </div>
                            </div>
                            
                             <div class="col-6">
                                <div class="form-group">
                                    <label for="confirmarSenha">Confirmar Senha*</label>
                                    <input class="form-control" type="password" name="confirmarSenha" id="confirmarSenha" maxlength="25" placeholder="Confirmar Senha" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-success btn-block" id="criarConta" type="submit" title="Criar Conta">Criar Conta</button>
                        
                        <span class="resposta">
                            <div id="mensagem">
                                <p></p>
                            </div>
                        </span>
                    </form>
                </div>
            </div>
            
            
        </main>

        <?php include_once("../principal/_incluir/rodape.php"); ?>  
        
                
        <script>
            $('#cep').blur(function(e){
                var cep = $('#cep').val();
                var url = "https://viacep.com.br/ws/" + cep + "/json/";
                var validaCEP = /^[0-9]{5}-?[0-9]{3}$/;
                
                if(validaCEP.test(cep))
                {
                    $('#mensagem').hide();
                    var retorno = pesquisarCEP(url);
                }
                else
                {
                    $('#mensagem').show();
                    $('#mensagem p').html("CEP inválido");
                }
            });
            
            function pesquisarCEP(endereco){
                $.ajax({
                    type:"GET",
                    url:endereco
                }).done(function(data){
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                    $('#endereco').val(data.logradouro);
                }).fail(function(){
                    console.log("erro");
                });
            } 
            
            $("#cpf").mask("000.000.000-00");
            $("#telefone").mask("(00) 0000-0000");
            $("#celular").mask("(00) 00000-0000");
            $("#cep").mask("00000-000");
        </script>
        
        <script src="../../_scripts/js/topo.js"></script>
        
        <script src="../../_scripts/js/topo3.js"></script>
        
        <script src="../../_scripts/js/cliente/criarConta.js"></script>
    </body>
</html>

