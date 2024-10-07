<?php
session_start();
require '../src/db.php';

if ($_SESSION['role'] != 'gerente') {
    echo 'Acesso negado.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $area_id = $_POST['area_id'];

    $stmt = $pdo->prepare('INSERT INTO machines (name, area_id) VALUES (?, ?)');
    $stmt->execute([$name, $area_id]);
    
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
    <h2>Criar Maquinas</h2>
    <form class="modal-content animate" method="post">
      <div class="user-box">
        <input type="text" name="name" placeholder="Nome da máquina" required>
      </div>
      <div class="user-box">
      <input type="number" name="area_id" placeholder="ID da área" required>
      </div>
      
      <button type="submit">Criar Máquina</button>
    <button type="button" onclick="goBack()"> Voltar </button>
    </form>
    </div>
</body>
</html>



