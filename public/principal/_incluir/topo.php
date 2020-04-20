<header>
    <div id="header_central">
        <?php
            if( isset($_SESSION["user_portal"]) )
            {
                $user = $_SESSION["user_portal"];
                
                $saudacao = "SELECT nome ";
                $saudacao .= "FROM usuario ";
                $saudacao .= "WHERE codigo = {$user}";
                
                $saudacao_login = mysqli_query($conecta,$saudacao);
                
                if( !$saudacao_login )
                {
                    die("Falha  no banco");
                }
                
                $saudacao_login = mysqli_fetch_assoc($saudacao_login);
                $nome = $saudacao_login["nome"];
        ?>
        
        <div id="header_saudacao"><h5>Bem vindo, <?php echo $nome ?> - <a href="sair.php">Sair</a></h5></div>
        
        <?php
            }
        ?>
    </div>
</header>