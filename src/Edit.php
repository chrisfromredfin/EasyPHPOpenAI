<?php

namespace chrisfromredfin\EasyPHPOpenAI;

class Edit extends AbstractAPIRequest
{
    protected OpenAIAPI $openAIAPI;

    public function __construct(OpenAIAPI $openAIAPI)
    {
        parent::__construct($openAIAPI);
    }
    public function execute(string $input, string $instruction, ?float $temperature = null, ?float $top_p = null): string | bool
    {
        $temperature = $temperature ?? ApiConstant::TEMPERATURE_DEFAULT;
        $top_p = $top_p ?? ApiConstant::TOP_P_DEFAULT;
        $postData =
            [
                "model" => $this->openAIAPI->model(),
                "input" => $input,
                "instruction" => $instruction,
                "temperature" => $temperature,
                "top_p" => $top_p,
            ];
        return $this->doRequest($postData);
    }

    protected function isValidData(array $response_data): bool
    {
        return isset($response_data["choices"][0]["text"]);
    }
    protected function data(array $response_data): mixed
    {
        return $response_data["choices"][0]["text"];
    }
}
