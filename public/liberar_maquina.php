<?php
session_start();
require '../src/db.php';

if ($_SESSION['role'] !== 'manutentor') {
    echo 'Acesso negado.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar e sanitizar a entrada
    $machine_id = filter_input(INPUT_POST, 'machine_id', FILTER_VALIDATE_INT);

    if ($machine_id === false) {
        echo 'ID da máquina inválido.';
        exit();
    }

    try {
        // Atualiza o status da máquina para "normal" e limpa quem atendeu
        $stmt = $pdo->prepare('UPDATE machines SET status = :status, last_reported_by = NULL, attended_by_name = NULL WHERE id = :machine_id');
        $stmt->execute([
            ':status' => 'normal',
            ':machine_id' => $machine_id,
        ]);

        // Atualiza o status da chamada para "precisa_atendimento"
        $stmt = $pdo->prepare('UPDATE machines SET Status_Chamada = :status_chamada WHERE id = :machine_id');
        $stmt->execute([
            ':status_chamada' => 'precisa_atendimento',
            ':machine_id' => $machine_id,
        ]);

        echo 'Máquina liberada com sucesso.';
    } catch (PDOException $e) {
        // Registra o erro e mostra uma mensagem amigável
        error_log($e->getMessage());
        
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../script.css">
    <script src="script.js" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>


<div class="login-box">
    <h2>Atender Chamado</h2>
    <form class="modal-content animate" method="post">
      <div class="user-box">
            
      <input type="number" name="machine_id" placeholder="ID da máquina" required>
      </div>
      
      <button type="submit">Liberar Máquina</button>
        <button type="button" onclick="goBack()"> Voltar </button>
    </form>
    </div>
</body>
</html>


<?php
// mostrar todas as maquinas
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
</head>
<body>
<section id="target2" style="margin-top: 27%">
    <section class="service">
        <div class="section-container service-container">
        <div class="service-grid">
        <div class="service-card">
            <main>
                <h2>Máquinas</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Área</th>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Status</th>
                            <th>Chamada</th>
                            <th>atendido</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($machines)): ?>
                            <tr>
                                <td colspan="5">Nenhuma máquina encontrada.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($machines as $machine): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($machine['area_id']); ?></td>
                                    <td><?php echo htmlspecialchars($machine['id']); ?></td>
                                    <td><?php echo htmlspecialchars($machine['name']); ?></td>
                                    <td><?php echo htmlspecialchars($machine['status']); ?></td>

                                    <td>
                                        <?php
                                        if (!empty($machine['last_reported_by'])): ?>
                                            <?php echo htmlspecialchars($machine['last_reported_by']); ?>
                                        <?php else: ?>
                                            Não reportada
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if (!empty($machine['attended_by_name'])): ?>
                                            <?php echo htmlspecialchars($machine['attended_by_name']); ?>
                                        <?php else: ?>
                                            Não atendida
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </main>
        </div>
        </div>
    </section>
</section>
</body>
</html>
