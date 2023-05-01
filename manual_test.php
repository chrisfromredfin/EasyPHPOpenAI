<?

use Dotenv\Dotenv;
use hstanleycrow\EasyPHPOpenAI\ApiConstants;
use hstanleycrow\EasyPHPOpenAI\CurlRequest;
use hstanleycrow\EasyPHPOpenAI\Endpoint;
use hstanleycrow\EasyPHPOpenAI\OpenAIAPI;

require 'vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
$OPENAI_API_KEY = $_ENV["OPENAI_API_KEY"];
#$url = "https://api.openai.com/v1/engines/text-davinci-002/completions";
#$url = "https://api.openai.com/v1/engines/davinci/completions";
$url = "https://api.openai.com/v1/completions";
$model = "davinci";
$model = "text-davinci-003";
echo "<pre>";
echo "Endpoint: $url " . PHP_EOL . "Modelo: $model" . PHP_EOL;
/**
 * endpoint: "https://api.openai.com/v1/completions"
 * modelo: "davinci"
 * resultado: funciona
 * endpoint: "https://api.openai.com/v1/completions"
 * modelo: "text-davinci-003"
 * resultado: funciona
 */

$curlRequest = new CurlRequest($url);
$prompt = "Por favor, genera un solo meta título basado en los título de los resultados de búsqueda de Google que proporciono basados en las keywords para las que quiero posicionar. Analiza lo mas relevante, trata de apegartea a la longitud de los titulos de muestra. Estos son los titulos de muestra:###\n1- Zapatos azules baratos\n2- Mejores Zapatos azules\n3- Zapatos Azules duraderos\n4- Zapatos deportivos azules baratos\n\n###";
$postData = [
    "model" => $model,
    "prompt" => $prompt,
    "temperature" => 0.7,
    "max_tokens" => 25,
    "top_p" => 1,
    "frequency_penalty" => 0,
    "presence_penalty" => 0,
    "stop" => ["\\n"]
];
$curlRequest->setPost(true);
$curlRequest->setPostData(json_encode($postData));
$curlRequest->setHttpHeader([
    "Content-Type: application/json",
    "Authorization: Bearer $OPENAI_API_KEY"
]);
$curlRequest->execute();
if ($curlRequest->isSuccessful()) :
    $response = $curlRequest->getResult();
    $response_data = json_decode($response, true);
    var_dump($response_data);
    if (!isset($response_data["choices"][0]["text"])) {
        die("No se pudo generar el título del artículo.");
    }

    $title = $response_data["choices"][0]["text"];
    echo "El titulo es: $title";
else :
    die("Error al comunicarse con la API de OpenAI.");
endif;
