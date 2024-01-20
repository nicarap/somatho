<?php

return [
    "chatgpt" => [
        "model" => env('GPT_MODEL', "gpt-3.5-turbo"),
        "endpoint" => env('GPT_ENDPOINT', "https://api.openai.com/v1/chat/completions"),
        "api_key" => env('GPT_API_KEY'),
    ]
];
