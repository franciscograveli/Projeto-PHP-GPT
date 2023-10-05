<?php

if(!session_start()){
    session_start();
}

if(!isset($_SESSION['chat_history'])){
    $_SESSION['chat_history'] = array();
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //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
    $apiKey = "";
    $userInput =($_POST['user_input']) ? $_POST['user_input']: 'Dados não econtrados.';
    $response = callGPTAPI($userInput, $apiKey);
    $data = json_decode($response);
}

function callGPTAPI($input, $apiKey){
    $url = "https://api.openai.com/v1/chat/completions";

    $data = json_encode(
        array(
            "model" => "gpt-3.5-turbo",
            "messages" => 
                array(
                    array(
                        "role" => "user",
                        "content" => $input
                    )
                ),
            'max_tokens' => 20,
            'temperature' => 0.2
        )    
    );

    $headers = array(
        'Authorization: Bearer ' . $apiKey,
        'Content-Type: application/json',
    );

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $response = curl_exec($ch);

    if($response === false){
        echo "Erro: " . curl_error($ch) ;
    }

    curl_close($ch);

    return $response;

}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/favicon/favicon.ico" type="image/x-icon">
    <title>Introdução ao GPT</title>
</head>
<body>
    <h1>
        ALEGRIAAA
    </h1>
        <div id="chat-container">
            <?php 
            if(!empty($_SESSION['chat-history'])){
                foreach ($_SESSION['chat-history'] as $entry){
                    echo '
                    <div class="message ' . $entry['sender'] .'">'
                    .$entry['message'] . '</div>';
                }
            }
            ?>
        </div>
        <form action="" method="POST">
            <label for="user_input">
                Digite sua pergunta ? 
            </label>
            <br>
            <input type="text" id="user_input" name="user_input">
            <br>
            <br>
            <input type="submit" value="Enviar!" id="btn_enviar">
        </form>

</body>
</html>