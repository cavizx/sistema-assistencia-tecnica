<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../includes/auth.php';
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM clientes WHERE id=?'); $stmt->execute([$id]); $c = $stmt->fetch();
if (!$c) exit('Cliente não encontrado.');
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? ''); $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    $telefone = trim($_POST['telefone'] ?? ''); $email = trim($_POST['email'] ?? '');
    if ($nome === '' || $cpf === '' || $telefone === '') $erro = 'Preencha nome, CPF e telefone.';
    else {
        $stmt = $pdo->prepare('UPDATE clientes SET nome=?,cpf_criptografado=?,telefone=?,email=? WHERE id=?');
        $stmt->execute([$nome, cpfCriptografar($cpf,$chaveCriptografia),$telefone,$email ?: null,$id]);
        header('Location: index.php'); exit;
    }
}
$titulo='Editar cliente'; require __DIR__ . '/../includes/header.php';
?>
<h1>Editar cliente</h1><?php if($erro): ?><p class="erro"><?=e($erro)?></p><?php endif; ?>
<form method="post"><label>Nome</label><input name="nome" value="<?=e($c['nome'])?>" required>
<label>CPF</label><input name="cpf" value="<?=e(cpfDescriptografar($c['cpf_criptografado'],$chaveCriptografia))?>" required>
<label>Telefone</label><input name="telefone" value="<?=e($c['telefone'])?>" required>
<label>E-mail</label><input type="email" name="email" value="<?=e($c['email'])?>">
<button>Atualizar</button> <a href="index.php">Cancelar</a></form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
