<?php require_once("../../_scripts/conexao/conexaoVenda.php"); ?>
<?php
    session_start();

    if ( isset($_POST["usuario"]) )
    {
        $usuario = $_POST["usuario"];
        $senha = $_POST["senha"];
        
        $login = "SELECT * ";
        $login .= "FROM usuario ";
        $login .= "WHERE usuario = '{$usuario}' and senha = '{$senha}' ";
        
        $acesso = mysqli_query($conecta, $login);
        if( !$acesso )
        {
            die("Falha na consulta ao banco");
        }
        
        $informacao = mysqli_fetch_assoc($acesso);
        if( empty($informacao) )
        {
            $mensagem = "Login sem sucesso.";
        }
        else
        {   
            $_SESSION["user_portal"] = $informacao["codigo"];
            header("location:listagem.php");
        }
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        
        <script src="https://kit.fontawesome.com/9a0becbb52.js" crossorigin="anonymous"></script>
        <link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- estilo -->
        <link href="../../_css/estilo.css" rel="stylesheet">
        <link href="../../_css/login.css" rel="stylesheet">
    </head>

    <body>
        <?php include_once("_incluir/topo.php"); ?>
        
        <main>  
            <div id="janelaLogin">
                <div class="container">
                    <form action="login.php" method="post">
                        <h2>Tela de Login</h2>
                        <input class="form-control" type="text" name="usuario" placeholder="Usuário">
                        <input class="form-control" type="password" name="senha" placeholder="Senha">
                        <button class="btn btn-success btn-block" type="submit" title="Fazer login">Login</button>


                        <p><a href="../cadastros/formCriarConta.php">Cadastre-se</a></p>
                        <?php
                            if( isset($mensagem) )
                            {
                        ?>
                            <p id="mensagem"><?php echo $mensagem ?></p>
                        <?php
                            }
                        ?>
                    </form>
                </div>
            </div>
        </main>

        <?php include_once("_incluir/rodape.php"); ?> 
        
        <script src="../../_scripts/js/topo.js">
        </script>
    </body>
</html>

<?php
    // Fechar conexao
    mysqli_close($conecta);
?>