<?php require_once("../../conexao/conexaoVenda.php") ?>
<?php include_once("funcoes.php"); ?>
<?php

if (isset($_POST["nome"])) {
    //Publicando fotos
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

    $nome = $_POST['nome'];
    $fornecedor = $_POST['fornecedor'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];

    //recebendo o nome das fotos depois de publicadas
    $imagemGrande1  = $resultado1[1];
    $imagemGrande2  = $resultado2[1];
    $imagemGrande3  = $resultado3[1];
    $imagemGrande4  = $resultado4[1];
    $imagemPequena1 = $resultado5[1];
    $imagemPequena2 = $resultado6[1];
    $imagemPequena3 = $resultado7[1];
    $imagemPequena4 = $resultado8[1];

    // Insercao no banco
    $inserir = "INSERT INTO produto ";
    $inserir .= "(nome,preco,descricao,quantidade,nomeFornecedor,foto1,foto2,foto3,foto4,foto5,foto6,foto7,foto8) ";
    $inserir .= "VALUES ";
    $inserir .= "('$nome','$preco','$descricao','$quantidade','$fornecedor','$imagemGrande1','$imagemGrande2','$imagemGrande3','$imagemGrande4','$imagemPequena1','$imagemPequena2','$imagemPequena3','$imagemPequena4')";

    $retorno = array();
    $operacaoInserir = mysqli_query($conecta, $inserir);

    if ($operacaoInserir) {
        $retorno["sucesso"] = true;
        $retorno["mensagem"] = "Produto inserido com sucesso.";
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