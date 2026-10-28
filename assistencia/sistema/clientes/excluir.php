<?php
require_once __DIR__ . '/../config/conexao.php';
require_once __DIR__ . '/../includes/auth.php';
$id=(int)($_GET['id']??0);
try {
    $stmt=$pdo->prepare('DELETE FROM clientes WHERE id=?'); $stmt->execute([$id]);
    header('Location: index.php'); exit;
} catch (PDOException $e) {
    exit('Não é possível excluir este cliente porque há equipamentos associados.');
}
