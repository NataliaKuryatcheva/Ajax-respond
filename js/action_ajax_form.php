<?php

if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["comment"]) ) {

    // Формируем массив для JSON ответа
    $result = array(
        'name' => $_POST["name"],
        'email' => $_POST["email"],
        'comments' => $_POST["comment"]
    );

    // Переводим массив в JSON
    echo json_encode($result);
}

?>