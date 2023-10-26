<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once(__DIR__ . '/../config/database.php'); 

    $database = new Database();
    $conn = $database->getConnection();
    // Configurar o charset para UTF-8
    $conn->set_charset("utf8mb4");

    $sql = "SELECT * FROM carros WHERE id NOT IN (SELECT carro_id FROM alugueis WHERE data_fim > NOW())";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $carros_disponiveis = array();

        while ($row = $result->fetch_assoc()) {
            $carros_disponiveis[] = $row;
        }

        echo json_encode($carros_disponiveis);
    } else {
        echo json_encode(array());
    }

    $conn->close();
} else {
    http_response_code(405); 
    echo json_encode(array("message" => "Método não permitido."));
}
?>
