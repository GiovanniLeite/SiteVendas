<?php require_once("../conexao/conexao.php") ?>
<?php
    if( isset($_POST["codigoC"]) ) {
        $codigo = $_POST["codigoC"];
        
        $exclusao = "DELETE FROM usuario ";
        $exclusao .= "WHERE codigo = {$codigo}";
        $conExclusao = mysqli_query($conecta,$exclusao);
        if($conExclusao) {
            $retorno["sucesso"] = true;
            $retorno["mensagem"] = "Conta excluida com sucesso.";
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