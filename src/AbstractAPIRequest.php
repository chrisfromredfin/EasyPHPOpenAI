<?php

namespace chrisfromredfin\EasyPHPOpenAI;

abstract class AbstractAPIRequest
{
    protected OpenAIAPI $openAIAPI;

    public function __construct(OpenAIAPI $openAIAPI)
    {
        $this->openAIAPI = $openAIAPI;
    }
    abstract protected function isValidData(array $response_data): bool;
    abstract protected function data(array $response_data): mixed;

    protected function doRequest(array $postData = [], $post = true): mixed
    {
        $this->openAIAPI->curlRequest()->setPost($post);
        if (count($postData) > 0) $this->openAIAPI->curlRequest()->setPostData(json_encode($postData));
        $this->openAIAPI->curlRequest()->setHttpHeader([
            "Content-Type: application/json",
            "Authorization: Bearer " . $this->openAIAPI->openAiApiKey()
        ]);
        $this->openAIAPI->curlRequest()->execute();
        if ($this->openAIAPI->curlRequest()->isSuccessful()) :
            $response = $this->openAIAPI->curlRequest()->getResult();
            $response_data = json_decode($response, true);
            if ($this->isValidData($response_data)) :
                return $this->data($response_data);
            else :
                throw new \Exception("The process could not be completed. The request returned: " . $response_data["error"]["message"]);
                return false;
            endif;

        else :
            throw new \Exception("Error communicating with the OpenAI API.");
        endif;
    }
}
