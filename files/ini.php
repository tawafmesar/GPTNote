<?php

// Error Reporting

  ini_set('display_errors' , 'On');
  error_reporting(E_ALL);

  include 'files/dbconnect.php';

  $sessionUser = '';
  if (isset($_SESSION['user'])) {
    $sessionUser = $_SESSION['user'];

  }

  function filter_string_polyfill(string $string): string
{
    $str = preg_replace('/\x00|<[^>]*>?/', '', $string);
    return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
}


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


function convertToHTML($content)
{
    // Split the content into lines
    $lines = explode("\n", $content);

    // Initialize HTML
    $html = '<div>';

    foreach ($lines as $line) {
        // Skip empty lines
        if (trim($line) === '') {
            continue;
        }

        // Check if the line starts with a hyphen (for bullet list items)
        if (strpos($line, '-') === 0) {
            $html .= '<ul>';
            $html .= '<li>' . substr($line, 1) . '</li>';
        } elseif (strpos($line, 'Meeting Date') === 0 || strpos($line, 'Meeting Time') === 0 || strpos($line, 'Location') === 0) {
            // Handling meeting details
            $html .= '<p>' . $line . '</p>';
        } elseif (preg_match('/^\d+\./', $line)) {
            // Handling numbered list items
            $html .= '<ol>';
            $html .= '<li>' . substr($line, strpos($line, '.') + 1) . '</li>';
        } else {
            // Regular text
            $html .= '<p>' . $line . '</p>';
        }

        // Check for closing tags
        if (isset($htmlClose)) {
            $html .= $htmlClose;
            unset($htmlClose);
        }
    }

    // Close any remaining list tags
    if (isset($htmlClose)) {
        $html .= $htmlClose;
    }

    // Close the main div
    $html .= '</div>';

    return $html;
}


 // include the Important file


  include 'files/head.php';
