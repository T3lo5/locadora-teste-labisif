<?php
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    if (isset($_GET['id'])) {
        $carro_id = $_GET['id'];

        $input_data = json_decode(file_get_contents('php://input'), true);

        if (isset($input_data['modelo']) || isset($input_data['marca']) || isset($input_data['descricao']) ||
            isset($input_data['preco_aluguel']) || isset($input_data['categoria'])) {

            include_once(__DIR__ . '/../config/database.php'); 

            $database = new Database();
            $conn = $database->getConnection();
            // Configurar o charset para UTF-8
            $conn->set_charset("utf8mb4");
    

            $sql = "UPDATE carros SET ";

            $sets = array();
            foreach ($input_data as $key => $value) {
                $sets[] = "$key = '$value'";
            }
            $sql .= implode(", ", $sets);
            $sql .= " WHERE id = $carro_id";

            if ($conn->query($sql) === TRUE) {
                echo json_encode(array("message" => "Carro atualizado com sucesso!"));
            } else {
                http_response_code(500); 
                echo json_encode(array("message" => "Erro ao atualizar o carro: " . $conn->error));
            }

            $conn->close();
        } else {
            http_response_code(400); 
            echo json_encode(array("message" => "Campos obrigatórios ausentes."));
        }
    } else {
        http_response_code(400); 
        echo json_encode(array("message" => "ID do carro não fornecido."));
    }
} else {
    http_response_code(405); 
    echo json_encode(array("message" => "Método não permitido."));
}
?>
