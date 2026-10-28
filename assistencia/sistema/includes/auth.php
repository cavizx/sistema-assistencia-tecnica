<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    ini_set('session.use_strict_mode', '1');
    session_start();
}
$tempoExpiracao = 900; // 15 minutos
if (isset($_SESSION['ultima_atividade']) &&
    time() - $_SESSION['ultima_atividade'] > $tempoExpiracao) {
    $_SESSION = [];
    session_destroy();
    header('Location: ../login.php?expirada=1');
    exit;
}
if (!isset($_SESSION['usuario_id'])) {
    header('Location: ../login.php');
    exit;
}
$_SESSION['ultima_atividade'] = time();
