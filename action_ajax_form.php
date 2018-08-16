<?php

$result = [];

if( empty($_POST['name']) || mb_strlen($_POST['name'], "UTF-8") > 50 ) {
    $result['status'] = 'error';
    $result['name'] = 'Ошибка валидации поля';
}

if (empty($_POST['email'])) {
    $result['status'] = 'error';
    $result['email'] = 'Ошибка валидации поля';
}

if (empty($_POST['comment'])) {
    $result['status'] = 'error';
    $result['comment'] = 'Ошибка валидации поля';
}

echo json_encode($result);