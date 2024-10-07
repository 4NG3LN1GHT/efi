


<?php
if (!isset($_SESSION['username'])) {
    header('Location: ../public/login.php');
    exit();
}

echo "<h1>Bem-vindo ao eficienSys, {$_SESSION['username']}</h1>";
// Adicione links para criar áreas, máquinas e outras funcionalidades conforme o papel do usuário.
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eficienSys</title>
    <link rel="stylesheet" href="script.css">
</head>
<body>
    <header>
        <nav>
            <?php if ($_SESSION['role'] === 'gerente'): 
                header('Location: cargos/gerente.php');
                ?>
                <?php endif; ?>
            <?php if ($_SESSION['role'] === 'operario'): 
                header('Location: cargos/operador.php')
                 ?>
                <?php endif; ?>
            <?php if ($_SESSION['role'] === 'manutentor'): 
                 header('Location: cargos/manutentor.php')
                ?>
            <?php endif; ?>
        </nav>
    </header>
    <main>

