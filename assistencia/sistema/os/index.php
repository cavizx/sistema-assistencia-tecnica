<?php
require_once __DIR__ . '/../config/conexao.php';require_once __DIR__ . '/../includes/header.php';$titulo='Ordens de serviço';
$sql="SELECT os.*, e.tipo, e.marca, e.modelo, c.nome cliente_nome FROM ordens_servico os JOIN equipamentos e ON e.id=os.equipamento_id JOIN clientes c ON c.id=e.cliente_id ORDER BY os.data_abertura DESC";
$ordens=$pdo->query($sql)->fetchAll();
?>
<h1>Ordens de serviço</h1><a class="btn" href="novo.php">Abrir ordem</a>
<table><tr><th>ID</th><th>Abertura</th><th>Cliente</th><th>Equipamento</th><th>Defeito</th><th>Status</th><th>Valor</th><th>Ações</th></tr>
<?php foreach($ordens as $o):?><tr><td><?=(int)$o['id']?></td><td><?=e($o['data_abertura'])?></td><td><?=e($o['cliente_nome'])?></td><td><?=e($o['tipo'].' '.$o['marca'].' '.$o['modelo'])?></td><td><?=e($o['defeito_relatado'])?></td><td><?=e($o['status'])?></td><td>R$ <?=number_format((float)$o['valor'],2,',','.')?></td><td><a href="editar.php?id=<?=(int)$o['id']?>">Editar</a> | <a href="excluir.php?id=<?=(int)$o['id']?>" onclick="return confirm('Excluir ordem?')">Excluir</a></td></tr><?php endforeach;?></table>
<?php require __DIR__ . '/../includes/footer.php'; ?>
