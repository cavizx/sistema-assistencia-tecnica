<?php
require_once __DIR__ . '/../config/conexao.php';require_once __DIR__ . '/../includes/auth.php';
$id=(int)($_GET['id']??0);$s=$pdo->prepare('SELECT * FROM equipamentos WHERE id=?');$s->execute([$id]);$equi=$s->fetch();if(!$equi)exit('Equipamento não encontrado.');
$clientes=$pdo->query('SELECT id,nome FROM clientes ORDER BY nome')->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){$s=$pdo->prepare('UPDATE equipamentos SET cliente_id=?,tipo=?,marca=?,modelo=?,numero_serie=?,descricao=? WHERE id=?');$s->execute([(int)$_POST['cliente_id'],trim($_POST['tipo']),trim($_POST['marca']),trim($_POST['modelo']),trim($_POST['numero_serie']??''),trim($_POST['descricao']??''),$id]);header('Location: index.php');exit;}
$titulo='Editar equipamento';require __DIR__ . '/../includes/header.php';
?>
<h1>Editar equipamento</h1><form method="post"><label>Cliente</label><select name="cliente_id"><?php foreach($clientes as $c):?><option value="<?=(int)$c['id']?>" <?=$c['id']==$equi['cliente_id']?'selected':''?>><?=e($c['nome'])?></option><?php endforeach;?></select>
<label>Tipo</label><input name="tipo" value="<?=e($equi['tipo'])?>" required><label>Marca</label><input name="marca" value="<?=e($equi['marca'])?>" required><label>Modelo</label><input name="modelo" value="<?=e($equi['modelo'])?>" required><label>Número de série</label><input name="numero_serie" value="<?=e($equi['numero_serie'])?>"><label>Descrição</label><textarea name="descricao"><?=e($equi['descricao'])?></textarea><button>Atualizar</button></form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
