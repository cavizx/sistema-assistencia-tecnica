<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../includes/auth.php';
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    $telefone = trim($_POST['telefone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    if ($nome === '' || $cpf === '' || $telefone === '') $erro = 'Preencha nome, CPF e telefone.';
    else {
        $stmt = $pdo->prepare('INSERT INTO clientes (nome,cpf_criptografado,telefone,email) VALUES (?,?,?,?)');
        $stmt->execute([$nome, cpfCriptografar($cpf, $chaveCriptografia), $telefone, $email ?: null]);
        header('Location: index.php'); exit;
    }
}
$titulo = 'Novo cliente'; require __DIR__ . '/../includes/header.php';
?>
<h1>Novo cliente</h1><?php if ($erro): ?><p class="erro"><?= e($erro) ?></p><?php endif; ?>
<form method="post"><label>Nome</label><input name="nome" required>
<label>CPF</label><input name="cpf" required maxlength="14">
<label>Telefone</label><input name="telefone" required>
<label>E-mail</label><input type="email" name="email">
<button>Salvar</button> <a href="index.php">Cancelar</a></form>
<?php require __DIR__ . '/../includes/footer.php'; ?>
