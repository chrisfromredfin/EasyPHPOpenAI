<?php

use Dotenv\Dotenv;
use hstanleycrow\EasyPHPOpenAI\OpenAIAPI;

require 'vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$OPENAI_API_KEY = $_ENV["OPENAI_API_KEY"];
#It is important to define the time zone with the same Wordpress Time Zone
date_default_timezone_set("America/El_Salvador");

$openAIAPI = new OpenAIAPI($OPENAI_API_KEY);
#vdd($openAIAPI->models());

#Example completion
/*
$prompt = "Por favor, genera un solo meta título basado en los título de los resultados de búsqueda de Google que proporciono basados en las keywords para las que quiero posicionar. Analiza lo mas relevante, trata de apegartea a la longitud de los titulos de muestra. Estos son los titulos de muestra:###\n1- Zapatos azules baratos\n2- Mejores Zapatos azules\n3- Zapatos Azules duraderos\n4- Zapatos deportivos azules baratos\n\n###";

if ($response = $openAIAPI->complete($prompt)) :
    echo "Titulo: $response";
else :
    echo $openAIAPI->errorMessage();
endif;
die();
*/

#Example Edit
$input = "What day of the wek is it?";
$instruction = "Fix the spelling mistakes";
$openAIAPI->setModel("text-davinci-edit-001");
if ($response = $openAIAPI->edit($input, $instruction)) :
    echo "Respuesta: $response";
else :
    echo $openAIAPI->errorMessage();
endif;
die();

//TODO revisar donde debr ir los set de temperature, top_p, etc y corregir