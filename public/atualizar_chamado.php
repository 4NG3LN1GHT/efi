<?php
require '../src/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $machine_id = $_POST['machine_id'];
    $status_chamada = $_POST['status_chamada'];

    // Atualiza o status da chamada da máquina
    $stmt = $pdo->prepare('UPDATE machines SET Status_Chamada = ? WHERE id = ?');
    $stmt->execute([$status_chamada, $machine_id]);

    echo 'Status da máquina atualizado com sucesso.';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Status da Máquina - eficienSys</title>
    <link rel="stylesheet" href="/../script.css">
    <script src="script.js" defer></script>
    </head>
<body>
    <main>
        <h2>Atualizar Status da Máquina</h2>
        <form method="post">
            <input type="number" name="machine_id" placeholder="ID da Máquina" required>
            <select name="status_chamada" required>
                <option value="Não atendido">Não Atendido</option>
                <option value="---">Não se Aplica</option>
                <!-- Outros status podem ser adicionados conforme necessário -->
            </select>
            <button type="submit" name="update_status">Atualizar Status</button>
            <button type="button" onclick="goBack()"> Voltar </button>
        </form>
    </main>
</body>
</html>

