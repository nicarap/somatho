<?php

return [
    "chatgpt" => [
        "model" => env('GTP_MODEL', "gpt-3.5-turbo"),
        "endpoint" => env('GTP_ENDPOINT', "https://api.openai.com/v1/chat/completions"),
        "api_key" => env('GTP_API_KEY'),
    ]
];
