<?php require_once("../../_scripts/conexao/conexaoVenda.php"); ?>

<?php
    // conferir se a navegacao veio pelo preenchimento do formulario
    if( isset($_POST['nome']) ) {
        
        $adm = '0';
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $rg = $_POST['rg'];
        $telefone = $_POST['telefone'];
        $celular = $_POST['celular'];
        $cep = $_POST['cep'];
        $endereco = $_POST['endereco'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $email = $_POST['email'];
        $usuario = $_POST['usuario'];
        $senha = $_POST['senha'];
        
        // Insercao no banco
        $inserir = "INSERT INTO usuario ";
        $inserir .="(adm,nome,cpf,rg,telefone,celular,cep,endereco,bairro,cidade,estado,email,usuario,senha) ";
        $inserir .="VALUES ";
        $inserir .="('$adm','$nome','$cpf','$rg','$telefone','$celular','$cep','$endereco','$bairro','$cidade','$estado','$email','$usuario','$senha')";
        $qInserir = mysqli_query($conecta,$inserir);
        if(!$qInserir) {
            die("Erro na insercao");   
        } else {
            $mensagem = "Inserção ocorreu com sucesso.";
        }
    }

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Criar Conta</title>
        
        <script src="../../_scripts/js/jquery.js"></script>
        
        <!-- estilo -->
        <link href="../../_css/estilo.css" rel="stylesheet">
        <link href="../../_css/criarConta.css" rel="stylesheet">
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            header {
                height:66px;
            }
        </style>
    </head>

    <body>
        <?php include_once("../principal/_incluir/topo.php"); ?>
        
        <main>  
            <div id="formulario">
                <div class="container">
                    <form action="formCriarConta.php" method="post">
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="nome">Nome*</label>
                                    <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome" title="Campo Obrigatório"/>
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
                                    <input class="form-control" type="text" name="rg" id="rg" placeholder="RG" title="Campo Obrigatório"/>
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
                                    <input class="form-control" type="text" name="endereco" id="endereco" placeholder="Endereço" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="bairro">Bairro*</label>
                                    <input class="form-control" type="text" name="bairro" id="bairro" placeholder="Bairro" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="cidade">Cidade*</label>
                                    <input class="form-control" type="text" name="cidade" id="cidade" placeholder="Cidade" title="Campo Obrigatório">
                                </div>
                            </div>
                                    
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="estado">Estado*</label>
                                    <input class="form-control" type="text" name="estado" id="estado" placeholder="Estado" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label for="email">Email*</label>
                                    <input class="form-control" type="email" name="email" id="email" placeholder="Email" title="Campo Obrigatório"/>
                                </div>
                            </div>
                            
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="usuario">Usuário*</label>
                                    <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuário" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">       
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="senha">Senha*</label>
                                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha" title="Campo Obrigatório">
                                </div>
                            </div>
                            
                             <div class="col-6">
                                <div class="form-group">
                                    <label for="confirmarSenha">Confirmar Senha*</label>
                                    <input class="form-control" type="password" name="confirmarSenha" id="confirmarSenha" placeholder="Confirmar Senha" title="Campo Obrigatório">
                                </div>
                            </div>
                        </div>

                        <input class="btn btn-success btn-block" id="criarConta" type="submit" value="Criar Conta">
                        
                        <?php
                            if( isset($mensagem) ) {
                                echo "<p>" . $mensagem . "</p>";
                            }
                        ?>
                    </form>
                </div>
                <a href="../principal/login.php">Login</a>
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
                    url:endereco,
                    async:false
                }).done(function(data){
                    $('#bairro').val(data.bairro);
                    $('#cidade').val(data.localidade);
                    $('#estado').val(data.uf);
                    $('#endereco').val(data.logradouro);
                }).fail(function(){
                    console.log("erro");
                });
            }
        </script>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>

