<?php

namespace hstanleycrow\EasyPHPOpenAI;

class ApiConstant
{
    const COMPLETION_MODEL_DEFAULT = "davinci"; # because is free
    const COMPLETION_ENDPOINT = "https://api.openai.com/v1/completions";
    const EDIT_MODEL_DEFAULT = "text-davinci-edit-001";
    const EDIT_ENDPOINT = "https://api.openai.com/v1/edits";
    const TEMPERATURE_DEFAULT = 0.7;
    const MAX_TOKENS_DEFAULT = 50;
    const TOP_P_DEFAULT = 1;
    const FREQUENCY_PENALTY_DEFAULT = 0;
    const PRESENCE_PENALTY_DEFAULT = 0;
    const STOP_DEFAULT = ["\\n"];
}
