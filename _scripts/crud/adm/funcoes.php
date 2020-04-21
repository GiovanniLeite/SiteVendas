<?php
    function gerarCodigoUnico() {
        $alfabeto = "23456789ABCDEFGHJKMNPQRS";
        $tamanho = 50;
        $letra = "";
        $resultado = "";

        for($i = 1; $i < $tamanho ;$i++)
        {
            $letra = substr($alfabeto, rand(0,23), 1); //sorteia
            $resultado .= $letra;
        }

        date_default_timezone_set('America/Sao_Paulo');
        $agora = getdate();

        $codigo_data = $agora['year'] . "_" . $agora["yday"];
        $codigo_data .= $agora['hours'] . $agora['minutes'] . $agora['seconds'];

        return "foto_" . $codigo_data . "_" . $resultado;
    }
    function getExtensao($nome) {
        return strrchr($nome,"."); //pega oq tiver depois do "."
    }
    function publicarImagem($imagem) {
        $arquivo_temporario = $imagem['tmp_name'];
        $nome_original      = $imagem['name'];
        $nome_novo          = gerarCodigoUnico() . getExtensao($nome_original);
        $nome_completo      = "../../principal/images/product_images/" . $nome_novo;
        /****mudanca****/
        $caminhoCerto = "images/product_images/" . $nome_novo;
        /****mudanca****/
        /***Mudanca necessaria para ele intender o local correto, sera mudado posteriormente***/
        /*
        $seila = move_uploaded_file($arquivo_temporario, $nome_completo);
        
        return $seila;*/
        
        if(move_uploaded_file($arquivo_temporario, $nome_completo)) 
        {
            return array("Imagem publicada com sucesso",$caminhoCerto);  
            /***mudanca***/
            /* return array("Imagem publicada com sucesso",$nome_completo); */
            /***mudanca***/
        } 
        else 
        {
            return array("Erro","caminhoErrado");
            //return array(retornarErro($imagem['error']),"");            
        }      
    }
    function retornarErro($numero_erro) {
        $array_erro = array(
            UPLOAD_ERR_OK =>            "Sem erro.",
            UPLOAD_ERR_INI_SIZE =>      "O arquivo enviado excede o limite definido na diretiva upload_max_filesize do php.ini.",
            UPLOAD_ERR_FORM_SIZE =>     "O arquivo excede o limite máximo de 600Kb.",
            UPLOAD_ERR_PARTIAL =>       "O upload do arquivo foi feito parcialmente.",
            UPLOAD_ERR_NO_FILE =>       "Nenhum arquivo foi enviado.",
            UPLOAD_ERR_NO_TMP_DIR =>    "Pasta temporária ausente.",
            UPLOAD_ERR_CANT_WRITE =>    "Falha em escrever o arquivo em disco.",
            UPLOAD_ERR_EXTENSION =>     "Uma extensão do PHP interrompeu o upload do arquivo."
        ); 
        
        return $array_erro[$numero_erro];
    }
?>