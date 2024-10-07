<?php
require '../src/db.php';

// Verifica se o formulário foi enviado e se a ação é adicionar um usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    // Verifica se o usuário já existe
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        echo 'Usuário já existe. Escolha um nome de usuário diferente.';
    } else {
        // Insere o novo usuário no banco de dados com a senha em texto claro
        $stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
        $stmt->execute([$username, $password, $role]);
        
        
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Funcionário - eficienSys</title>
    <link rel="stylesheet" href="/../script.css">
    <script src="script.js" defer></script>
</head>
<body>
    

    <div class="login-box">
    <h2>Adicionar Novo Funcionário</h2>
    <form class="modal-content animate" method="post">
      <div class="user-box">
            
            <input type="text" name="username" placeholder="Nome de usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
      </div>
      <select name="role" required>
                <option value="operario">Operário</option>
                <option value="manutentor">Manutentor</option>
                <option value="gerente">Gerente</option>
            </select>
        <button type="submit" name="add_user">Adicionar Funcionário</button>
        <button type="button" onclick="goBack()"> Voltar </button>
    </form>
    </div>
</body>
</html>

