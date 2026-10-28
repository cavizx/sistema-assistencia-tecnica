<?php
require_once __DIR__ . '/../config/conexao.php';require_once __DIR__ . '/../includes/auth.php';
$id=(int)($_GET['id']??0);$s=$pdo->prepare('DELETE FROM ordens_servico WHERE id=?');$s->execute([$id]);header('Location: index.php');exit;
