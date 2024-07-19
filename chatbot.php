<?php
// get api key
$api_key = "***************************************************" ;


###############################################
#      "REAL" FUNCTIONS FOR CHATGPT           #
###############################################

function get_current_weather( $location ) {
    return "The weather is nice and sunny";
}


###############################################
#              HELPER FUNCTION                #
###############################################

function function_is_available( $function_name, $functions ) {
    foreach( $functions as $function ) {
        if( $function["name"] == trim( $function_name ) ) {
            return true;
        }
    }

    return false;
}


###############################################
#     FUNCTION TO INTERACT WITH CHATGPT       #
###############################################

function send_message(array $message, $api_key, $systemContent, $userContent, array $messages = [])
{
    // set system message on first call
    if (empty($messages)) {
        $messages[] = [
            "role" => "system",
            "content" => $systemContent,
        ];
    }

    // add user message to message list
    $messages[] = $message;

    // make ChatGPT API request
    $ch = curl_init("https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer $api_key"
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(
        [
            "model" => "gpt-3.5-turbo-0301",
            "messages" => [
                ["role" => "system", "content" => $systemContent],
                ["role" => "user", "content" => $userContent],
            ],
        ]
    ));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // get ChatGPT response
    $curl_exec = curl_exec($ch);
    $response = json_decode($curl_exec);

    // somewhat handle errors
    if (!isset($response->choices[0]->message)) {
        if (isset($response->error)) {
            $error = trim($response->error->message . " (" . $response->error->type . ")");
        } else {
            $error = $curl_exec;
        }
        throw new \Exception("Error in OpenAI request: " . $error);
    }

    // add response to messages
    $messages[] = $response->choices[0]->message;

    // return old messages + user message + ChatGPT response
    return $messages;
}




// ask for user message
echo "ChatGPT: How can I assist you today?\n";
echo "You: ";
$prompt = "what is TERMINAL";

echo "\n";

$systemContent = "You are Marv, a chatbot that reluctantly answers questions with arabic or english sarcastic responses .";
$userContent = "من انت";

$messages = send_message(
    [
        "role" => "user",
        "content" => $userContent,
    ],
    $api_key,
    $systemContent,
    $userContent
);

// get response from ChatGPT
$message = $messages[count($messages)-1];

 echo "\nChatGPT: " . $message->content . "\n";