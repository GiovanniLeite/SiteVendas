<?php

function gerarPedido() //gera um codigo aleatorio de pedido
{
    $alfabeto = "23456789ABCDEFGHJKMNPQRS";
    $tamanho = 20;
    $letra = "";
    $resultado = "";

    for($i = 1; $i < $tamanho ;$i++)
    {
        $letra = substr($alfabeto, rand(0,23), 1); //sorteia
        $resultado .= $letra;
    }

    date_default_timezone_set('America/Sao_Paulo');
    $agora = getdate();

    $codigoData = $agora['year'] . $agora["yday"];
    $codigoData .= $agora['hours'] . $agora['minutes'] . $agora['seconds'];

    return "PD" . $codigoData . $resultado . "PD";
}
