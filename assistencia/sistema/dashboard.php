<?php
require_once __DIR__ . '/config/conexao.php';
require_once __DIR__ . '/includes/header.php';
$titulo = 'Página inicial';
$clientes = $pdo->query('SELECT COUNT(*) FROM clientes')->fetchColumn();
$equipamentos = $pdo->query('SELECT COUNT(*) FROM equipamentos')->fetchColumn();
$ordens = $pdo->query('SELECT COUNT(*) FROM ordens_servico')->fetchColumn();
?>
<h1>Bem-vindo(a), <?= e($_SESSION['nome']) ?>!</h1>
<p>Escolha uma funcionalidade abaixo.</p>
<div class="card"><strong>Clientes:</strong> <?= (int)$clientes ?></div>
<div class="card"><strong>Equipamentos:</strong> <?= (int)$equipamentos ?></div>
<div class="card"><strong>Ordens de serviço:</strong> <?= (int)$ordens ?></div>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
