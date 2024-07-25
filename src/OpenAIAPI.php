<?php

namespace chrisfromredfin\EasyPHPOpenAI;

use hstanleycrow\EasyPHPcURLRequest\CurlRequest;

class OpenAIAPI
{
    private string $openAiApiKey;
    protected CurlRequest $curlRequest;
    protected Model $models;
    #protected array $models;
    protected string $model;
    protected string $errorMessage;

    public function __construct(string $openAiApiKey)
    {
        $this->openAiApiKey = $openAiApiKey;
        $this->init();
    }
    private function init()
    {
        $this->getModels();
    }
    private function getModels(): void
    {
        $this->curlRequest = new CurlRequest(Model::MODELS_ENDPOINT);
        $this->models = new Model($this);
    }
    public function setModel(string $model): void
    {
        if ($this->models->isValidModel($model)) :
            $this->model = $model;
        else :
            throw new \Exception("Invalid Model, check the list with models() method");
        endif;
    }
    public function complete(string $prompt, ?string $model = null, ?float $temperature = null, ?float $top_p = null, ?int $max_tokens = null, ?int $frequency_penalty = null, ?int $presence_penalty = null, ?array $stop = []): string
    {
        $model = $model ?? ApiConstant::COMPLETION_MODEL_DEFAULT;
        $this->setModel($model);
        $this->curlRequest = new CurlRequest(ApiConstant::COMPLETION_ENDPOINT);
        try {
            return (new Completion($this))->execute($prompt, $temperature, $top_p, $max_tokens, $frequency_penalty, $presence_penalty, $stop);
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
        return false;
    }
    public function edit(string $input, string $instruction, ?string $model = null, ?float $temperature = null, ?float $top_p = null): string
    {
        $this->model = $this->setModel($model) ?? ApiConstant::EDIT_MODEL_DEFAULT;
        $this->curlRequest = new CurlRequest(ApiConstant::EDIT_ENDPOINT);
        try {
            return (new Edit($this))->execute($input, $instruction, $temperature, $top_p);
        } catch (\Exception $e) {
            $this->errorMessage = $e->getMessage();
        }
        return false;
    }

    /**
     * Get the value of openAiApiKey
     */
    public function openAiApiKey(): string
    {
        return $this->openAiApiKey;
    }
    /**
     * Get the value of curlRequest
     */
    public function curlRequest(): CurlRequest
    {
        return $this->curlRequest;
    }
    /**
     * Get the value of models
     */
    public function models(): array
    {
        return $this->models->models();
    }
    public function errorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * Get the value of model
     */
    public function model()
    {
        return $this->model;
    }
}
