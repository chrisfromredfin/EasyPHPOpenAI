<?php

namespace hstanleycrow\EasyPHPOpenAI;

class Completion extends AbstractAPIRequest
{
    protected OpenAIAPI $openAIAPI;

    public function __construct(OpenAIAPI $openAIAPI)
    {
        parent::__construct($openAIAPI);
    }

    public function execute(string $prompt, ?float $temperature = null, ?float $top_p = null, ?int $max_tokens = null, ?int $frequency_penalty = null, ?int $presence_penalty = null, ?array $stop = []): string | bool
    {
        $temperature = $temperature ?? ApiConstant::TEMPERATURE_DEFAULT;
        $top_p = $top_p ?? ApiConstant::TOP_P_DEFAULT;
        $max_tokens = $max_tokens ?? ApiConstant::MAX_TOKENS_DEFAULT;
        $frequency_penalty = $frequency_penalty ?? ApiConstant::FREQUENCY_PENALTY_DEFAULT;
        $presence_penalty = $presence_penalty ?? ApiConstant::PRESENCE_PENALTY_DEFAULT;
        $stop = (count($stop) == 0) ? ApiConstant::STOP_DEFAULT : $stop;
        $postData = [
            "model" => $this->openAIAPI->model(),
            "prompt" => $prompt,
            "temperature" => $temperature,
            "top_p" => $top_p,
            "max_tokens" => $max_tokens,
            "frequency_penalty" => $frequency_penalty,
            "presence_penalty" => $presence_penalty,
            "stop" => $stop
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
