<?php
require_once __DIR__ . '/../config/conexao.php';require_once __DIR__ . '/../includes/auth.php';
$id=(int)($_GET['id']??0);$s=$pdo->prepare('SELECT * FROM ordens_servico WHERE id=?');$s->execute([$id]);$o=$s->fetch();if(!$o)exit('Ordem não encontrada.');
if($_SERVER['REQUEST_METHOD']==='POST'){$s=$pdo->prepare('UPDATE ordens_servico SET defeito_relatado=?,diagnostico=?,status=?,valor=? WHERE id=?');$s->execute([trim($_POST['defeito_relatado']),trim($_POST['diagnostico']??''),$_POST['status'],(float)$_POST['valor'],$id]);header('Location: index.php');exit;}
$titulo='Editar ordem';require __DIR__ . '/../includes/header.php';
?>
<h1>Editar ordem #<?=(int)$o['id']?></h1><form method="post"><label>Defeito relatado</label><textarea name="defeito_relatado" required><?=e($o['defeito_relatado'])?></textarea><label>Diagnóstico</label><textarea name="diagnostico"><?=e($o['diagnostico'])?></textarea><label>Status</label><select name="status"><?php foreach(['Aberta','Em andamento','Aguardando peça','Concluída','Cancelada'] as $st):?><option <?=$o['status']===$st?'selected':''?>><?=e($st)?></option><?php endforeach;?></select><label>Valor (R$)</label><input type="number" name="valor" min="0" step="0.01" value="<?=e($o['valor'])?>"><button>Atualizar</button></form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
