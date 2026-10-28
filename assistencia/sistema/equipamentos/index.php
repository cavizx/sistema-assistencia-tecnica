<?php
require_once __DIR__ . '/../config/conexao.php'; require_once __DIR__ . '/../includes/header.php';
$titulo='Equipamentos';
$sql='SELECT e.*, c.nome cliente_nome FROM equipamentos e JOIN clientes c ON c.id=e.cliente_id ORDER BY e.id DESC';
$equipamentos=$pdo->query($sql)->fetchAll();
?>
<h1>Equipamentos</h1><a class="btn" href="novo.php">Cadastrar equipamento</a>
<table><tr><th>Tipo</th><th>Marca / modelo</th><th>Cliente</th><th>Nº série</th><th>Ações</th></tr>
<?php foreach($equipamentos as $e): ?><tr><td><?=e($e['tipo'])?></td><td><?=e($e['marca'].' '.$e['modelo'])?></td><td><?=e($e['cliente_nome'])?></td><td><?=e($e['numero_serie'])?></td><td><a href="editar.php?id=<?=(int)$e['id']?>">Editar</a> | <a href="excluir.php?id=<?=(int)$e['id']?>" onclick="return confirm('Excluir equipamento?')">Excluir</a></td></tr><?php endforeach; ?></table>
<?php require __DIR__ . '/../includes/footer.php'; ?>
