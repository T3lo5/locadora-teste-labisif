<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $url_parts = explode('/', $_SERVER['REQUEST_URI']);
    $carro_id = intval(end($url_parts)); 

    if ($carro_id) {
        include_once(__DIR__ . '/../config/database.php');

        $database = new Database();
        $conn = $database->getConnection();
        // Configurar o charset para UTF-8
        $conn->set_charset("utf8mb4");

        $sql = "SELECT * FROM carros WHERE id = $carro_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $carro = $result->fetch_assoc();

            echo json_encode($carro);
        } else {
            http_response_code(404); 
            echo json_encode(array("message" => "Carro não encontrado."));
        }

        $conn->close();
    } else {
        http_response_code(400); 
        echo json_encode(array("message" => "ID do carro não fornecido."));
    }
} else {
    http_response_code(405); 
    echo json_encode(array("message" => "Método não permitido."));
}

?>
