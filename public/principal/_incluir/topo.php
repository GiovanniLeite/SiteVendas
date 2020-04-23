<header>
    <?php
        if( isset($_SESSION["user_portal"]) )
        {
            $user = $_SESSION["user_portal"];

            $saudacao = "SELECT * ";
            $saudacao .= "FROM usuario ";
            $saudacao .= "WHERE codigo = {$user}";

            $saudacao_login = mysqli_query($conecta,$saudacao);

            if( !$saudacao_login )
            {
                die("Falha  no banco");
            }

            $saudacao_login = mysqli_fetch_assoc($saudacao_login);
            $nome = $saudacao_login["nome"];
            $adm = $saudacao_login["adm"];
    ?>

    <div id="headerSaudacao">
        <p>Bem vindo(a), <a href="#" id="clienteAdm" title="Gerenciar conta"><?php echo $nome ?></a> - <a href="sair.php" title="Sair">Sair</a></p>
    </div>

    <?php
            if($adm != 1)
            {
               printf('<script>var adm = 0;</script>'); 

            }
            else if($adm == 1)
            {
               printf('<script>var adm = 1;</script>'); 

            }
            /*print_r($saudacao_login);*/

        }    
    ?>
    <div id="headerCentral">
        <a href="login.php"></a>
    </div>
</header>