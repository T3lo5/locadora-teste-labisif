<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_data = json_decode(file_get_contents('php://input'), true);

    if (isset($input_data['modelo']) && isset($input_data['marca']) && isset($input_data['descricao']) &&
        isset($input_data['preco_aluguel']) && isset($input_data['categoria'])) {

        $modelo = $input_data['modelo'];
        $marca = $input_data['marca'];
        $descricao = $input_data['descricao'];
        $preco_aluguel = $input_data['preco_aluguel'];
        $categoria = $input_data['categoria'];

        include_once(__DIR__ . '/../config/database.php'); 

        $database = new Database();
        $conn = $database->getConnection();
        // Configurar o charset para UTF-8
        $conn->set_charset("utf8mb4");

        $sql = "INSERT INTO carros (modelo, marca, descricao, preco_aluguel, categoria) 
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssss", $modelo, $marca, $descricao, $preco_aluguel, $categoria);

        if ($stmt->execute()) {
            $carro_id = $conn->insert_id;
            echo json_encode(array("message" => "Carro criado com sucesso!", "carro_id" => $carro_id));
        } else {
            http_response_code(500); 
            echo json_encode(array("message" => "Erro ao criar o carro: " . $stmt->error));
        }

        $stmt->close();
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
