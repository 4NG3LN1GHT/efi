<?php
$host = 'localhost';
$dbname = 'eficienSys';
$user = 'root'; // substitua pelo usuário do banco de dados
$password = 'aluno123'; // substitua pela senha do banco de dados

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    exit(); // Encerra o script se a conexão falhar
}
?>
