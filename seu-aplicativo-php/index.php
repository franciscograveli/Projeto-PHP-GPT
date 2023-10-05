<?php

if(!session_start()){
    session_start();
}

if(!isset($_SESSION['chat_history'])){
    $_SESSION['chat_history'] = array();
}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

</body>
</html>