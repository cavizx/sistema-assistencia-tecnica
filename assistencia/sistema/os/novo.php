<?php
require_once __DIR__ . '/../config/conexao.php';require_once __DIR__ . '/../includes/auth.php';
$equipamentos=$pdo->query('SELECT e.id,e.tipo,e.marca,e.modelo,c.nome cliente FROM equipamentos e JOIN clientes c ON c.id=e.cliente_id ORDER BY c.nome')->fetchAll();$erro='';
if($_SERVER['REQUEST_METHOD']==='POST'){$eq=(int)($_POST['equipamento_id']??0);$defeito=trim($_POST['defeito_relatado']??'');if(!$eq||!$defeito)$erro='Selecione o equipamento e descreva o defeito.';else{$s=$pdo->prepare('INSERT INTO ordens_servico(equipamento_id,defeito_relatado,diagnostico,status,valor) VALUES(?,?,?, ?,?)');$s->execute([$eq,$defeito,trim($_POST['diagnostico']??''),$_POST['status']??'Aberta',(float)($_POST['valor']??0)]);header('Location: index.php');exit;}}
$titulo='Nova ordem de serviço';require __DIR__ . '/../includes/header.php';
?>
<h1>Abrir ordem de serviço</h1><?php if($erro):?><p class="erro"><?=e($erro)?></p><?php endif;?>
<form method="post"><label>Equipamento / cliente</label><select name="equipamento_id" required><option value="">Selecione</option><?php foreach($equipamentos as $e):?><option value="<?=(int)$e['id']?>"><?=e($e['cliente'].' — '.$e['tipo'].' '.$e['marca'].' '.$e['modelo'])?></option><?php endforeach;?></select>
<label>Defeito relatado</label><textarea name="defeito_relatado" required></textarea><label>Diagnóstico</label><textarea name="diagnostico"></textarea><label>Status</label><select name="status"><option>Aberta</option><option>Em andamento</option><option>Aguardando peça</option><option>Concluída</option><option>Cancelada</option></select><label>Valor (R$)</label><input type="number" name="valor" min="0" step="0.01" value="0"><button>Salvar</button></form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
