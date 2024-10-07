<?php
session_start();
require  '../src/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ? and password = ? ');
    $stmt->execute([$username, $password]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
 if ($user) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        require_once __DIR__ . "../../index.php";
        exit();
    } else {
        echo 'Nome de usuário ou senha incorretos.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EficienSys</title>
    <link rel="stylesheet" href="/../script.css">
</head>
<body>
     


    <div class="login-box">
    <h2>Login</h2>
    <form class="modal-content animate" method="post">
      <div class="user-box">
            
            <input class="input" type="text" name="username" placeholder="Nome de usúario" required>
      </div>
      <div class="user-box">
                
                <input class="input" type="password" name="password" placeholder="Senha" required> 
      </div>
      <button>
      <a href="#" >
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <center>Entrar</center>
      </a>
      </button>
    </form>
    </div>
    
</body>
</html>

