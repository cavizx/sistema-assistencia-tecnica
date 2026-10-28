<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../includes/header.php';
$titulo = 'Clientes';
$termo = trim($_GET['busca'] ?? '');
$stmt = $pdo->query('SELECT * FROM clientes ORDER BY nome');
$clientes = $stmt->fetchAll();
if ($termo !== '') {
    $clientes = array_values(array_filter($clientes, function($c) use ($termo, $chaveCriptografia) {
        return stripos($c['nome'], $termo) !== false ||
               stripos($c['telefone'], $termo) !== false ||
               stripos(cpfDescriptografar($c['cpf_criptografado'], $chaveCriptografia), $termo) !== false;
    }));
}
?>
<h1>Clientes</h1><a class="btn" href="novo.php">Cadastrar cliente</a>
<form method="get"><label>Buscar por nome, telefone ou CPF</label><input name="busca" value="<?= e($termo) ?>"><button>Buscar</button></form>
<table><tr><th>Nome</th><th>CPF</th><th>Telefone</th><th>Ações</th></tr>
<?php foreach ($clientes as $c): ?><tr>
<td><?= e($c['nome']) ?></td><td><?= e(cpfDescriptografar($c['cpf_criptografado'], $chaveCriptografia)) ?></td><td><?= e($c['telefone']) ?></td>
<td><a href="editar.php?id=<?= (int)$c['id'] ?>">Editar</a> | <a href="excluir.php?id=<?= (int)$c['id'] ?>" onclick="return confirm('Excluir este cliente?')">Excluir</a></td>
</tr><?php endforeach; ?></table>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
