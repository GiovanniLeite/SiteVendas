<?php require_once("../../conexao/conexaoVenda.php") ?>
<?php include_once("funcoes.php"); ?>
<?php

if (isset($_POST["nome"])) {

    $codigo = $_POST['codigoProduto'];

    /***************Apagando fotos antigas*****************/
    $pesquisa = "SELECT * FROM produto ";
    $pesquisa .= "WHERE codigo = {$codigo} ";

    $retorno = array();
    $conProduto = mysqli_query($conecta, $pesquisa);
    if ($conProduto) {
        $produto = mysqli_fetch_assoc($conProduto);
        $foto1 = $produto["foto1"];
        $foto2 = $produto["foto2"];
        $foto3 = $produto["foto3"];
        $foto4 = $produto["foto4"];
        $foto5 = $produto["foto5"];
        $foto6 = $produto["foto6"];
        $foto7 = $produto["foto7"];
        $foto8 = $produto["foto8"];

        $resultado9 = apagarImagem($foto1, "grande");
        $resultado10 = apagarImagem($foto2, "grande");
        $resultado11 = apagarImagem($foto3, "grande");
        $resultado12 = apagarImagem($foto4, "grande");
        $resultado13 = apagarImagem($foto5, "pequena");
        $resultado14 = apagarImagem($foto6, "pequena");
        $resultado15 = apagarImagem($foto7, "pequena");
        $resultado16 = apagarImagem($foto8, "pequena");

        $retorno["mensagem9"] = $resultado9;
        $retorno["mensagem10"] = $resultado10;
        $retorno["mensagem11"] = $resultado11;
        $retorno["mensagem12"] = $resultado12;
        $retorno["mensagem13"] = $resultado13;
        $retorno["mensagem14"] = $resultado14;
        $retorno["mensagem15"] = $resultado15;
        $retorno["mensagem16"] = $resultado16;
    } else {
        $retorno["mensagem9"] = "Falha ao apagar fotos. 1";
        $retorno["mensagem10"] = "Falha ao apagar fotos. 2";
        $retorno["mensagem11"] = "Falha ao apagar fotos. 3";
        $retorno["mensagem12"] = "Falha ao apagar fotos. 4";
        $retorno["mensagem13"] = "Falha ao apagar fotos. 5";
        $retorno["mensagem14"] = "Falha ao apagar fotos. 6";
        $retorno["mensagem15"] = "Falha ao apagar fotos. 7";
        $retorno["mensagem16"] = "Falha ao apagar fotos. 8";
    }
    /***************Apagando fotos antigas*****************/

    //Publicando fotos novas
    //Grandes
    $resultado1 = publicarImagem($_FILES['fotoGrande1'], "grande");
    $mensagem1 = $resultado1[0]; //recebendo mensagem de se foi publicada ou nao
    $resultado2 = publicarImagem($_FILES['fotoGrande2'], "grande");
    $mensagem2 = $resultado2[0];
    $resultado3 = publicarImagem($_FILES['fotoGrande3'], "grande");
    $mensagem3 = $resultado3[0];
    $resultado4 = publicarImagem($_FILES['fotoGrande4'], "grande");
    $mensagem4 = $resultado4[0];
    //Pequenas
    $resultado5 = publicarImagem($_FILES['fotoPequena1'], "pequena");
    $mensagem5 = $resultado5[0];
    $resultado6 = publicarImagem($_FILES['fotoPequena2'], "pequena");
    $mensagem6 = $resultado6[0];
    $resultado7 = publicarImagem($_FILES['fotoPequena3'], "pequena");
    $mensagem7 = $resultado7[0];
    $resultado8 = publicarImagem($_FILES['fotoPequena4'], "pequena");
    $mensagem8 = $resultado8[0];

    //recebendo o nome das fotos depois de publicadas
    $imagemGrande1  = $resultado1[1];
    $imagemGrande2  = $resultado2[1];
    $imagemGrande3  = $resultado3[1];
    $imagemGrande4  = $resultado4[1];
    $imagemPequena1 = $resultado5[1];
    $imagemPequena2 = $resultado6[1];
    $imagemPequena3 = $resultado7[1];
    $imagemPequena4 = $resultado8[1];


    $nome = $_POST['nome'];
    $fornecedor = $_POST['fornecedor'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    // Insercao no banco
    $alterar = "UPDATE produto ";
    $alterar .= "SET ";
    $alterar .= "nome = '{$nome}', ";
    $alterar .= "preco = '{$preco}', ";
    $alterar .= "descricao = '{$descricao}', ";
    $alterar .= "quantidade = '{$quantidade}', ";
    $alterar .= "nomeFornecedor = '{$fornecedor}', ";
    $alterar .= "foto1 = '{$imagemGrande1}', ";
    $alterar .= "foto2 = '{$imagemGrande2}', ";
    $alterar .= "foto3 = '{$imagemGrande3}', ";
    $alterar .= "foto4 = '{$imagemGrande4}', ";
    $alterar .= "foto5 = '{$imagemPequena1}', ";
    $alterar .= "foto6 = '{$imagemPequena2}', ";
    $alterar .= "foto7 = '{$imagemPequena3}', ";
    $alterar .= "foto8 = '{$imagemPequena4}' ";
    $alterar .= "WHERE codigo = {$codigo} ";

    $operacaoAlterar = mysqli_query($conecta, $alterar);

    if ($operacaoAlterar) {
        $retorno["sucesso"] = true;
        $retorno["mensagem"] = "Produto atualizado com sucesso.";
        $retorno["mensagem1"] = $mensagem1;
        $retorno["mensagem2"] = $mensagem2;
        $retorno["mensagem3"] = $mensagem3;
        $retorno["mensagem4"] = $mensagem4;
        $retorno["mensagem5"] = $mensagem5;
        $retorno["mensagem6"] = $mensagem6;
        $retorno["mensagem7"] = $mensagem7;
        $retorno["mensagem8"] = $mensagem8;
    } else {
        $retorno["sucesso"] = false;
        $retorno["mensagem"] = "Falha no sistema, tente mais tarde.";
        $retorno["mensagem1"] = $mensagem1;
        $retorno["mensagem2"] = $mensagem2;
        $retorno["mensagem3"] = $mensagem3;
        $retorno["mensagem4"] = $mensagem4;
        $retorno["mensagem5"] = $mensagem5;
        $retorno["mensagem6"] = $mensagem6;
        $retorno["mensagem7"] = $mensagem7;
        $retorno["mensagem8"] = $mensagem8;
    }

    echo json_encode($retorno);
}

unset($_POST);

// Fechar conexao
mysqli_close($conecta);
?>