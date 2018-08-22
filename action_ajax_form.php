<?php

$result = [];
$result['status'] = 'success';

$servername = "localhost";
$username = "root";
$password = "0000";
$dbname = "ajax_testpsd";

$insertStmt = "";
$selectStmt = "";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
}


if( empty($_POST['name']) || mb_strlen($_POST['name'], "UTF-8") > 50 ) {
    $result['status'] = 'error';
    if ( empty($_POST['name'])) {
        $result['name'] = 'Поле пустое. Пополните, пожалуйста.';
    }
    if ( mb_strlen($_POST['name'], "UTF-8") > 50 ) {
        $result['name'] = 'Слишком много символом: ' . mb_strlen($_POST['name'], "UTF-8");
    }
}

if (empty($_POST['email'])) {
    $result['status'] = 'error';
    $result['email'] = 'Ошибка валидации поля';
}

if (empty($_POST['comment'])) {
    $result['status'] = 'error';
    $result['comment'] = 'Поле пустое. Пополните, пожалуйста.';
}


try {
    if ($result['status'] == 'success') {
        $created = new DateTime();
        $insertStmt = $conn->prepare("INSERT INTO card (name, email, comment, status, created) VALUES (:name, :email, :comment, :status, :created)");
        $insertStmt->execute([
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'comment' => $_POST['comment'],
            'status' => $result['status'],
            'created' => $created->format("Y-m-d")
//            'created' => "2018-08-22"
        ]);
    }
} catch (Exception $e) {
    echo $e->getMessage() . $e->getCode();
}

$selectStmt = $conn->query("SELECT * FROM card");
while ($row = $selectStmt->fetch())
{
    $result['content'][] = $row;
}


echo json_encode($result);