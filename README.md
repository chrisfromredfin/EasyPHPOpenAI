<h1 align="center">
  <br>
   Easy PHP OpenAI
  <br>
</h1>

<h4 align="center">Free PHP Library to use OpenAI API into any PHP project</h4>

<p align="center">
  <a href="#how-to-use">How To Use</a> •
  <a href="#download">Download</a> •
  <a href="#license">License</a>
</p>


## How To Use

```bash
# Clone this repository
$ git clone https://github.com/chrisfromredfin/EasyPHPOpenAI/

# install libraries
$ composer update
```
or 
```bash
# Install using composer
$ composer require chrisfromredfin/easyphpopenai

### Using Examples
You can adjdust the parameters like temperature, stop, max_tokens, see full list of parameters on the methods.

```php
$openAIAPI = new OpenAIAPI($OPENAI_API_KEY);

# Get Model lists 
var_dump($openAIAPI->models());

# Completion Example
/*
$prompt = "Por favor, genera un solo meta título basado en los título de los resultados de búsqueda de Google que proporciono basados en las keywords para las que quiero posicionar. Analiza lo mas relevante, trata de apegartea a la longitud de los titulos de muestra. Estos son los titulos de muestra:###\n1- Zapatos azules baratos\n2- Mejores Zapatos azules\n3- Zapatos Azules duraderos\n4- Zapatos deportivos azules baratos\n\n###";

if ($response = $openAIAPI->complete($prompt)) :
    echo "Titulo: $response";
else :
    echo $openAIAPI->errorMessage();
endif;

# Edit Example
$input = "What day of the wek is it?";
$instruction = "Fix the spelling mistakes";
$openAIAPI->setModel("text-davinci-edit-001");
if ($response = $openAIAPI->edit($input, $instruction)) :
    echo "Respuesta: $response";
else :
    echo $openAIAPI->errorMessage();
endif;

```

## Download

You can [download](https://github.com/chrisfromredfin/EasyPHPOpenAI/) the latest version here.

## PHP Versions
I have tested this class only in this PHP versions. So, if you have an older version and do not work, let me know.
| PHP Version |
| ------------- |
| PHP 8.0 | 
| PHP 8.1 |
| PHP 8.2 |

## Support

<a href="https://www.buymeacoffee.com/haroldcrow" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/purple_img.png" alt="Buy Me A Coffee" style="height: 41px !important;width: 174px !important;box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;-webkit-box-shadow: 0px 3px 2px 0px rgba(190, 190, 190, 0.5) !important;" ></a>

## License

MIT

---

> [www.hablemosdeseo.net](https://www.hablemosdeseo.net) &nbsp;&middot;&nbsp;
> GitHub [@chrisfromredfin](https://github.com/chrisfromredfin) &nbsp;&middot;&nbsp;
> Twitter [@harold_crow](https://twitter.com/harold_crow)

