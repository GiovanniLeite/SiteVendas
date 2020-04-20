 <?php include_once("funcoes.php"); ?>
<?php
    // conferir se a navegacao veio pelo preenchimento do formulario
    if(isset($_POST["nome"])) {
        
        $resultado1 = publicarImagem($_FILE['fotoGrande']);
        $resultado2 = publicarImagem($_FILE['fotoPequena']);
        $mensagem1 = $resultado1[0]; 
        $mensagem2 = $resultado2[0];

        $nome = $_POST['nome'];
        $codigoFornecedor = $_POST['codigoFornecedor'];
        $fornecedor = $_POST['fornecedor'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $quantidade = $_POST['quantidade'];

        $imagemGrande  = $resultado1[1];
        $imagemPequena = $resultado2[1];

        // Insercao no banco
        $inserir = "INSERT INTO produto ";
        $inserir .="(nome,preco,descricao,fotoPequena,fotoGrande,quantidade,codFornecedor,nomeFornecedor) ";
        $inserir .="VALUES ";
        $inserir .="('$nome','$preco','$descricao','$imagemPequena','$imagemGrande','$quantidade','$codigoFornecedor','$fornecedor')";
        
        $retorno = array();
        $operacaoInserir = mysqli_query($conecta,$inserir);
        if($operacaoInserir) {
            $retorno["sucesso"] = true;
            $retorno["mensagem"] = "Cadastro alterado com sucesso.";
            $retorno["mensagem1"] = $mensagem1;
            $retorno["mensagem2"] = $mensagem2;
        } else {
            $retorno["sucesso"] = false;
            $retorno["mensagem"] = "Falha no sistema, tente mais tarde.";
            $retorno["mensagem1"] = $mensagem1;
            $retorno["mensagem2"] = $mensagem2;
        }
        
        echo json_encode($retorno); 
    }

    unset($_POST);

	// Fechar conexao
    mysqli_close($conecta);
?>