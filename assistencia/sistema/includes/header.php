<?php
require_once __DIR__ . '/auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($titulo ?? 'Assistência Técnica') ?></title>
<link rel="stylesheet" href="/assistencia/sistema/style.css">
</head>
<body>
<header>
  <strong>Assistência Técnica</strong>
  <nav>
    <a href="/assistencia/sistema/dashboard.php">Início</a>
    <a href="/assistencia/sistema/clientes/index.php">Clientes</a>
    <a href="/assistencia/sistema/equipamentos/index.php">Equipamentos</a>
    <a href="/assistencia/sistema/os/index.php">Ordens de serviço</a>
    <a href="/assistencia/sistema/logout.php">Sair</a>
  </nav>
</header>
<main>
