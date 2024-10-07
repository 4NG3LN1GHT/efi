
<?php
require '../src/db.php';

// Verifique se o usuário está logado e tem a função de 'manutentor'
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'manutentor') {
    echo 'Acesso negado.';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valide e sanitize a entrada
    $machine_id = filter_input(INPUT_POST, 'machine_id', FILTER_VALIDATE_INT);

    if ($machine_id === false) {
        echo 'ID da máquina inválido.';
        exit();
    }

    // Capture o nome do usuário que está atendendo o chamado
    $attended_by_name = $_SESSION['username'];

    // Atualize o status da máquina
    $stmt = $pdo->prepare('UPDATE machines SET Status_Chamada = "em_atendimento", attended_by_name = ? WHERE id = ?');
    $stmt->execute([$attended_by_name, $machine_id]);

    echo 'Chamado atendido com sucesso.';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atender Chamado</title>
    <link rel="stylesheet" href="../script.css">
    <script src="script.js" defer></script>
    
    </head>
<body>

    

    <div class="login-box">
    <h2>Atender Chamado</h2>
    <form class="modal-content animate" method="post">
      <div class="user-box">
            
        <input type="number" id="machine_id" name="machine_id" placeholder="ID da máquina" required>
      </div>
      
      <button type="submit">Atender Chamado</button>
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
<section id="target2" style="margin-top: 15%">
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
