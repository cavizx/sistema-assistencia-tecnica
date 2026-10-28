<?php
require_once __DIR__ . '/config/conexao.php';
session_start();
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php'); exit;
}
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['usuario'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $stmt = $pdo->prepare('SELECT id, usuario, senha_hash, nome FROM usuarios WHERE usuario = ?');
    $stmt->execute([$login]);
    $u = $stmt->fetch();
    if ($u && password_verify($senha, $u['senha_hash'])) {
        session_regenerate_id(true);
        $_SESSION['usuario_id'] = $u['id'];
        $_SESSION['nome'] = $u['nome'];
        $_SESSION['ultima_atividade'] = time();
        header('Location: dashboard.php'); exit;
    }
    $erro = 'Usuário ou senha inválidos.';
}
?>
<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>Login</title><link rel="stylesheet" href="style.css"></head><body><main>
<h1>Sistema de Assistência Técnica</h1>
<?php if (isset($_GET['expirada'])): ?><p class="erro">Sua sessão expirou. Entre novamente.</p><?php endif; ?>
<?php if ($erro): ?><p class="erro"><?= e($erro) ?></p><?php endif; ?>
<form method="post">
<label>Usuário</label><input name="usuario" required autocomplete="username">
<label>Senha</label><input type="password" name="senha" required autocomplete="current-password">
<button type="submit">Entrar</button>
</form><small>Login de demonstração: admin / password</small>
</main></body></html>
