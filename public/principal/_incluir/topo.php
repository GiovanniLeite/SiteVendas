<script src="https://kit.fontawesome.com/9a0becbb52.js" crossorigin="anonymous"></script>
<header>
    <?php
    if (isset($_SESSION["user_portal"])) {
        $user = $_SESSION["user_portal"];

        $saudacao = "SELECT * ";
        $saudacao .= "FROM usuario ";
        $saudacao .= "WHERE codigo = {$user}";

        $saudacaoLogin = mysqli_query($conecta, $saudacao);

        if (!$saudacaoLogin) {
            die("Falha  no banco");
        }

        $saudacaoLogin = mysqli_fetch_assoc($saudacaoLogin);
        $nome = $saudacaoLogin["nome"];
        $adm = $saudacaoLogin["adm"];

        if ($adm != 1) {
            printf('<script>var adm = 0;</script>');
        } else if ($adm == 1) {
            printf('<script>var adm = 1;</script>');
        }
    ?>
        <div class="headerSaudacao">
            <ul class="menu">
                <li><a href="#" class="inicio" title="HOME">Home</a></li>
                <li>|</li>
                <li>Bem vindo(a),</li>
                <li><a href="#" id="clienteAdm" title="Gerenciar conta"><?php echo $nome  ?></a></li>
                <li>|</li>
                <li><a href="#" id="topoCompras" title="Compras">Compras</a></li>
                <li id="topoB1">|</li>
                <li><a href="#" id="topoCarrinho" title="Carrinho"><i class="fas fa-shopping-cart"></i></a></li>
                <li id="topoB2">|</li>
                <li><a href="sair.php" id="sair" title="Sair">Sair</a></li>
            </ul>
        </div>
    <?php
    } else {
        printf('<script>var adm = 2;</script>');
    ?>
        <div class="headerSaudacao">
            <ul class="menu">
                <li><a href="#" class="inicio" title="HOME">Home</a></li>
                <li>|</li>
                <li><a href="../cadastros/formCriarConta.php" title="Criar Conta">Crie a sua conta</a></li>
                <li>|</li>
                <li><a href="login.php" id="topoC1" title="Entrar">Entrar</a></li>
                <li>|</li>
                <li><a href="login.php" id="topoC2" title="Compras">Compras</a></li>
                <li>|</li>
                <li><a href="login.php" id="topoC3" title="Carrinho"><i class="fas fa-shopping-cart"></i></a></li>
            </ul>
        </div>
    <?php
    }
    ?>
    <div id="headerCentral">
        <a href="#" id="linkCentral" title="HOME"><img src="#" id="imagemCentral"></a>
    </div>
</header>