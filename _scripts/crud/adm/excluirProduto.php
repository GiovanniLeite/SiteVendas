<?php require_once("../../conexao/conexaoVenda.php") ?>
<?php
    if( isset($_POST["codigo"]) ) {
        $codigo = $_POST["codigo"];
        
        $exclusao = "DELETE FROM produto ";
        $exclusao .= "WHERE codigo = {$codigo}";
        $con_exclusao = mysqli_query($conecta,$exclusao);
        if($con_exclusao) {
            $retorno["sucesso"] = true;
            $retorno["mensagem"] = "Transportadora excluida com sucesso.";
        } else {
            $retorno["sucesso"] = false;
            $retorno["mensagem"] = "Falha no sistema, tente mais tarde.";
        }
    }

    // converter retorno em json
    echo json_encode($retorno);

    // Fechar conexao
    mysqli_close($conecta);
?>