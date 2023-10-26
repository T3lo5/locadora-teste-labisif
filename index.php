<?php
header('Content-Type: text/html; charset=utf-8');
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

if (strpos($path, '?') !== false) {
    $path = substr($path, 0, strpos($path, '?'));
}

// Roteamento de Endpoints
if ($path === '/carros' && $method === 'POST') {
    include(__DIR__ . './carro/create.php');
} elseif (preg_match('/\/carros\/\d+/', $path) && $method === 'GET') {
    include(__DIR__ . './carro/read.php');
} elseif ($path === '/carros' && $method === 'GET') {
    include(__DIR__ . './carro/list.php');
} elseif (preg_match('/\/carros\/\d+/', $path) && $method === 'PUT') {
    include('./carro/update.php');
} elseif (preg_match('/\/carros\/\d+/', $path) && $method === 'DELETE') {
    include(__DIR__ . './carro/delete.php');
} elseif ($path === '/carros/alugar' && $method === 'POST') {
    include(__DIR__ . './carro/alugar.php');
} elseif ($path === '/carros/disponiveis' && $method === 'GET') {
    include(__DIR__ . './carro/disponiveis.php');
} elseif ($path === '/carros/alugados' && $method === 'GET') {
    include(__DIR__ . './carro/alugados.php');
} else {
    http_response_code(404); 
    echo json_encode(array("message" => "Endpoint não encontrado."));
}
?>
