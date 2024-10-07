<?php
session_start();
require  '../../src/db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EficienSys - OPERADOR    
    </title>
</head>
<body>
<header style="margin: 0px 20px" class="cabecario">
        <a href="../reportar_maquina.php" class="topic" style="padding: 20px; text-decoration: none; color: green; font-size: 30px; margin-top: 3%; margin-left: 36%; ">Reportar Máquina</a>
        <a href="../logout.php" class="topic" style="padding: 20px; text-decoration: none; color: green; font-size: 30px; margin-top: 3%; ">Sair</a>
    </header>

        
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
<section id="target2" style="margin-top: 10%">
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
