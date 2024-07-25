<?php

namespace chrisfromredfin\EasyPHPOpenAI;

class Model extends AbstractAPIRequest
{
    protected OpenAIAPI $openAIAPI;
    private array $models;

    const MODELS_ENDPOINT = "https://api.openai.com/v1/models";
    public function __construct(OpenAIAPI $openAIAPI)
    {
        $this->openAIAPI = $openAIAPI;
        $this->getModels();
    }
    private function getModels(): void
    {
        $this->models = $this->doRequest([], false);
    }
    protected function isValidData(array $response_data): bool
    {
        return isset($response_data["data"]);
    }

    protected function data(array $response_data): mixed
    {
        $models = [];
        foreach ($response_data['data'] as $model) :
            $models[] = $model['id'];
        endforeach;
        return $models;
    }

    public function isValidModel(string $model): bool
    {
        return in_array($model, $this->models);
    }

    /**
     * Get the value of models
     */
    public function models()
    {
        return $this->models;
    }
}
