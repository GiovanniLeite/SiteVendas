<?php require_once("../../conexao/conexaoVenda.php") ?>
<?php include_once("funcoes.php"); ?>
<?php
if( isset($_POST["codigo"]) ) 
{
    $codigo = $_POST["codigo"];

    //Apagando fotos ja publicadas
    $pesquisa = "SELECT * FROM produto ";
    $pesquisa .= "WHERE codigo = {$codigo} ";

    $retorno = array();
    $conProduto = mysqli_query($conecta,$pesquisa);
    if($conProduto) 
    {
        $produto = mysqli_fetch_assoc($conProduto);
        $foto1 = $produto["foto1"];
        $foto2 = $produto["foto2"];
        $foto3 = $produto["foto3"];
        $foto4 = $produto["foto4"];
        $foto5 = $produto["foto5"];
        $foto6 = $produto["foto6"];
        $foto7 = $produto["foto7"];
        $foto8 = $produto["foto8"];

        $resultado1 = apagarImagem($foto1,"grande");
        $resultado2 = apagarImagem($foto2,"grande");
        $resultado3 = apagarImagem($foto3,"grande");
        $resultado4 = apagarImagem($foto4,"grande");
        $resultado5 = apagarImagem($foto5,"pequena");
        $resultado6 = apagarImagem($foto6,"pequena");
        $resultado7 = apagarImagem($foto7,"pequena");
        $resultado8 = apagarImagem($foto8,"pequena");

        $retorno["mensagem1"] = $resultado1;
        $retorno["mensagem2"] = $resultado2;
        $retorno["mensagem3"] = $resultado3;
        $retorno["mensagem4"] = $resultado4;
        $retorno["mensagem5"] = $resultado5;
        $retorno["mensagem6"] = $resultado6;
        $retorno["mensagem7"] = $resultado7;
        $retorno["mensagem8"] = $resultado8;

    } 
    else 
    {
        $retorno["mensagem1"] = "Falha ao apagar fotos. 1";
        $retorno["mensagem2"] = "Falha ao apagar fotos. 2";
        $retorno["mensagem3"] = "Falha ao apagar fotos. 3";
        $retorno["mensagem4"] = "Falha ao apagar fotos. 4";
        $retorno["mensagem5"] = "Falha ao apagar fotos. 5";
        $retorno["mensagem6"] = "Falha ao apagar fotos. 6";
        $retorno["mensagem7"] = "Falha ao apagar fotos. 7";
        $retorno["mensagem8"] = "Falha ao apagar fotos. 8";
    }

    //Apagando o produto
    $exclusao = "DELETE FROM produto ";
    $exclusao .= "WHERE codigo = {$codigo}";
    $conExclusao = mysqli_query($conecta,$exclusao);
    if($conExclusao) {
        $retorno["sucesso"] = true;
        $retorno["mensagem"] = "Produto excluida com sucesso.";
    } else {
        $retorno["sucesso"] = false;
        $retorno["mensagem"] = "Falha no sistema, tente mais tarde.";
    }

    // converter retorno em json
    echo json_encode($retorno);
}
unset($_POST);

// Fechar conexao
mysqli_close($conecta);
?>