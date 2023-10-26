<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_data = json_decode(file_get_contents('php://input'), true);

    if (isset($input_data['carro_id']) && isset($input_data['data_inicio']) && isset($input_data['data_fim'])) {
        $carro_id = $input_data['carro_id'];
        $data_inicio = $input_data['data_inicio'];
        $data_fim = $input_data['data_fim'];
        
        include_once(__DIR__ . '/../config/database.php'); 

        $database = new Database();
        $conn = $database->getConnection();
        // Configurar o charset para UTF-8
        $conn->set_charset("utf8mb4");

        $verificar_disponibilidade = "SELECT * FROM carros WHERE id = $carro_id AND id NOT IN (SELECT carro_id FROM alugueis WHERE (data_inicio <= '$data_fim' AND data_fim >= '$data_inicio'))";
        $verificar_resultado = $conn->query($verificar_disponibilidade);

        if ($verificar_resultado->num_rows > 0) {
            $inserir_aluguel = "INSERT INTO alugueis (carro_id, data_inicio, data_fim) VALUES ('$carro_id', '$data_inicio', '$data_fim')";

            if ($conn->query($inserir_aluguel) === TRUE) {
                echo json_encode(array("message" => "Carro alugado com sucesso!"));
            } else {
                http_response_code(500); 
                echo json_encode(array("message" => "Erro ao alugar o carro: " . $conn->error));
            }
        } else {
            http_response_code(400); 
            echo json_encode(array("message" => "Carro não disponível para o período solicitado."));
        }

        $conn->close();
    } else {
        http_response_code(400); 
        echo json_encode(array("message" => "Campos obrigatórios ausentes."));
    }
} else {
    http_response_code(405); 
    echo json_encode(array("message" => "Método não permitido."));
}
?>
