<?php
$host = 'localhost';
$banco = 'saep_db';
$usuario = 'root';
$senha = '';
$porta = 3307; // Se o seu MySQL do XAMPP usa 3307, altere para 3307.
$chaveCriptografia = 'TROQUE-ESTA-CHAVE-DE-DEMONSTRACAO-ANTES-DE-USAR';

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$porta;dbname=$banco;charset=utf8mb4",
        $usuario,
        $senha,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    exit('Não foi possível conectar ao banco de dados. Confira a configuração.');
}

function e($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, 'UTF-8');
}
function cpfCriptografar($cpf, $chave) {
    $iv = random_bytes(16);
    $chaveReal = hash('sha256', $chave, true);
    $cifrado = openssl_encrypt($cpf, 'AES-256-CBC', $chaveReal, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $cifrado);
}
function cpfDescriptografar($texto, $chave) {
    $dados = base64_decode($texto, true);
    if ($dados === false || strlen($dados) <= 16) return '';
    $iv = substr($dados, 0, 16);
    $cifrado = substr($dados, 16);
    $resultado = openssl_decrypt($cifrado, 'AES-256-CBC', hash('sha256', $chave, true), OPENSSL_RAW_DATA, $iv);
    return $resultado === false ? '' : $resultado;
}
