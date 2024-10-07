<?php
require '../src/db.php';

// Verifica se o usuário está autenticado e tem o papel de gerente
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'gerente') {
    header('Location: ../public/login.php');
    exit();
}

// Adiciona um novo funcionário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    // Hash da senha
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    // Insere o novo usuário no banco de dados
    $stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
    $stmt->execute([$username, $hashedPassword, $role]);
    
    echo 'Novo funcionário adicionado com sucesso.';
}

// Consulta para obter as máquinas e seus status
$stmt = $pdo->prepare('SELECT * FROM machines');
$stmt->execute();
$machines = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard do Gerente - eficienSys</title>
    <link rel="stylesheet" href="/../script.css">
    <script src="script.js" defer></script>
</head>
<body>
    <main>
        <!-- Formulário para adicionar um novo funcionário -->
        <h2>Adicionar Novo Funcionário</h2>
        <form method="post">
            <input type="text" name="username" placeholder="Nome de usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <select name="role" required>
                <option value="operario">Operário</option>
                <option value="manutentor">Manutentor</option>
                <option value="gerente">Gerente</option>
            </select>
            <button type="submit" name="add_user">Adicionar Funcionário</button>
            <button type="button" onclick="goBack()"> Voltar </button>
        </form>
</body>
</html>
