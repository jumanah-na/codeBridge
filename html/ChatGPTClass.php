<?php
 // Raghad
class ChatGPT {
    private $endpoint = 'https://api.openai.com/v1/'; // URL of OpenAI API
    private $apiKey; // Secret key for authentication with OpenAI
    private $languageModel; // GPT 3.5
    private $systemMessage; // Pre-defined message for the AI model provided by OpenAI

    // Constructor called when a new instance of ChatGPT class is created
    public function __construct($apiKey, $languageModel, $systemMessage, $endpoint) {
        $this->endpoint = $endpoint;
        $this->apiKey = $apiKey;
        $this->languageModel = $languageModel;
        $this->systemMessage = $systemMessage;
    }

    // Sends the message from the user to OpenAI API
    public function sendMessage($question, $sessionId = null) {
        $headers = $this->handleHeaders();
        $data = $this->handleData($question, $sessionId);
        $response = $this->APIRequest($data, $headers);

        return $response;
    }

    // Prepares the headers for the API request
    private function handleHeaders() {
        return [
            'Authorization: Bearer ' . $this->apiKey, // The secret key
            'Content-Type: application/json', // The type of the request is in JSON format
        ];
    }

    // Prepares the data  for the API request
    private function handleData($question, $sessionId) {
        $data = [
            'messages' => [
                ['role' => 'system', 'content' => $this->systemMessage],
                ['role' => 'user', 'content' => $question]
            ],
            'model' => $this->languageModel,
        ];

        if ($sessionId) {
            $data['session_id'] = $sessionId;
        }

        return $data;
    }

    // Makes the actual API request to OpenAI
    private function APIRequest($data, $headers) {
        $ch = curl_init($this->endpoint . 'chat/completions'); // chat/completions is the specific service that we want from the URL
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST'); // Send HTTP Request
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Convert Data array to JSON format which is the required format for OpenAI API
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); // Send the headers in JSON format
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the result as a string

        $response = curl_exec($ch); // Sends the HTTP request to the API
        if ($response === false) {
            $error = curl_error($ch); // Return error message
            curl_close($ch); // Close the session in case of error
            throw new Exception("Curl request error: $error");
        }

        curl_close($ch);

        return $response;
    }
}

