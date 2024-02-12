<?php
require 'ChatGPTClass.php';
  
// Raghad

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize the response variable
$response = "";
$content = "";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['question'])) {
    $chatGPT = new ChatGPT('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', 'gpt-3.5-turbo', 'You are a helpful assistance bot.','https://api.openai.com/v1/');
    
    // Send the message and get the response
    $response = $chatGPT->sendMessage($_POST['question']);
    
    // Decode the response from json to assositve array in php
    $responseData = json_decode($response, true);
    
    // Check if the decoding was successful and the expected data is present
    if ($responseData && isset($responseData['choices'][0]['message']['content'])) {
        // navigate the array to reach the actual message to display to user
        $content = $responseData['choices'][0]['message']['content'];
    } else {
        $content = "Error: Invalid response structure.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet">

    <title>ChatGPT</title>
   
    <style>
          .navbar {
            background-color: #EAE6F5;
            padding: 5px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;

        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;

        }

        .navbar li a {
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000000;
            padding: 8px 20px;
            font-family: "Poppins", sans-serif;
            text-decoration: none;
            border-radius: 25px;
            transition: background-color 0.3s;
            height: 40px;
        }

        .navbar li a:hover,
        .navbar li a.active {
            background-color: #4B208C;
            color: white;
        }

        .navbar .logo {
            display: flex;
            align-items: center;
            height: 40px;

        }

        .navbar .logo img {
            height: 100%;
            width: auto;
        }

        .navbar .logo .website-name {
            font-size: 1.5em;
            font-family: "Poppins", sans-serif;
            color: #4B0082;
            font-weight: bold;
            line-height: 40px;
            padding: 10px;
        }

       
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 6px 5px rgba(0,0,0,0.1);
            max-width: 600px;
            margin: auto;
        }
        h1 {
            color: #4B208C;
            text-align: center;
            font-family: "Poppins", sans-serif;

        }
        form   {
            margin-bottom: 100px;
            margin-bottom: 8px; 
        }
        button {
            display: block;
            background-color: #4B208C;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 0;
            cursor: pointer;
            font-size: 16px;
            margin: 5px 0;
            margin-bottom: 0;
        } 
        button:hover {
            background-color: #5625A8;
        }
        input[type="text"] {
        width: 80%; 
        padding: 12px;
        border-radius: 5px;
        border: 1px solid #ddd;
        margin-bottom: 0;
       }
   
        .response-box {
            margin-top: 0;
            background-color: white;
            white-space: pre-wrap;
       }
   
    </style>
</head>
<body>

<div class="navbar">
        <div class="logo">
            <img src="https://github.com/jumanah-na/codeBridge/blob/main/pictures/codeBridge.png?raw=true" alt="Logo">
            <span class="website-name">codeBridge</span>
        </div>
        <ul>

            <li><a href="">PROJECTS</a></li>
            <li><a href="AssigenmentForm.html">ASSIGNMENETS</a></li>
            <li><a href="toturail.html">TUTOIRALS</a></li>
            <li><a href="">CHATAI</a></li>
            <li> <a href="Helper.html">HELPER</a></li>
        </ul>
    </div>
    <div class="container">
        <h1>ChatGPT</h1>
        <img src="https://github.com/jumanah-na/codeBridge/blob/main/pictures/chatgpt.png?raw=true" width="50" height="50" style="display:block; margin:auto;">
<br>
        <form id="questionForm" method="post">
        <input type="text" id="question" name="question" placeholder="Message ChatGPT...">
        <button type="submit" style="display: inline-block;">SEND</button>
     </form>
            <div class="response-box">
            <?php 
            // Print the formatted content
            echo htmlspecialchars($content);
            ?>
        </div>
    </div>
  

</body>
</html>