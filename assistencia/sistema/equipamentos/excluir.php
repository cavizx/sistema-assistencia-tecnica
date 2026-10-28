<?php
require_once __DIR__ . '/../config/conexao.php';require_once __DIR__ . '/../includes/auth.php';
$id=(int)($_GET['id']??0);try{$s=$pdo->prepare('DELETE FROM equipamentos WHERE id=?');$s->execute([$id]);header('Location: index.php');exit;}catch(PDOException $e){exit('Não é possível excluir: existem ordens de serviço para este equipamento.');}
