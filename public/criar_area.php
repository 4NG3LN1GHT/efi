<?php
require '../src/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    $stmt = $pdo->prepare('INSERT INTO areas (name) VALUES (?)');
    $stmt->execute([$name]);

    
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EficienSys</title>
    <link rel="stylesheet" href="/../script.css">
    <script src="script.js" defer></script>
</head>
<body>

<div class="login-box">
    <h2>Criar Área</h2>
    <form class="modal-content animate" method="post">
      <div class="user-box">     
        <input type="text" name="name" placeholder="Nome da área" required>
      </div>
      <button type="submit">Criar Área</button>
    <button type="button" onclick="goBack()"> Voltar </button>

    </form>
    </div>
</body>
</html>

