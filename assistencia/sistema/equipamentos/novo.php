<?php
require_once __DIR__ . '/../config/conexao.php'; require_once __DIR__ . '/../includes/auth.php';
$clientes=$pdo->query('SELECT id,nome FROM clientes ORDER BY nome')->fetchAll(); $erro='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    $cliente=(int)($_POST['cliente_id']??0); $tipo=trim($_POST['tipo']??''); $marca=trim($_POST['marca']??''); $modelo=trim($_POST['modelo']??'');
    if(!$cliente||!$tipo||!$marca||!$modelo) $erro='Preencha os campos obrigatórios.';
    else {$s=$pdo->prepare('INSERT INTO equipamentos(cliente_id,tipo,marca,modelo,numero_serie,descricao) VALUES(?,?,?,?,?,?)');$s->execute([$cliente,$tipo,$marca,$modelo,trim($_POST['numero_serie']??''),trim($_POST['descricao']??'')]);header('Location: index.php');exit;}
}
$titulo='Novo equipamento';require __DIR__ . '/../includes/header.php';
?>
<h1>Novo equipamento</h1><?php if($erro):?><p class="erro"><?=e($erro)?></p><?php endif;?>
<form method="post"><label>Cliente</label><select name="cliente_id" required><option value="">Selecione</option><?php foreach($clientes as $c):?><option value="<?=(int)$c['id']?>"><?=e($c['nome'])?></option><?php endforeach;?></select>
<label>Tipo</label><input name="tipo" required><label>Marca</label><input name="marca" required><label>Modelo</label><input name="modelo" required><label>Número de série</label><input name="numero_serie"><label>Descrição / problema</label><textarea name="descricao"></textarea><button>Salvar</button></form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
