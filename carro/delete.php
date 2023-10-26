<?php
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    parse_str(file_get_contents("php://input"), $delete_data);
    $carro_id = $delete_data['carro_id'];

    include_once(__DIR__ . '/../config/database.php'); 


    $database = new Database();
    $conn = $database->getConnection();
    // Configurar o charset para UTF-8
    $conn->set_charset("utf8mb4");

    $verificar_existencia = "SELECT * FROM carros WHERE id = $carro_id";
    $verificar_resultado = $conn->query($verificar_existencia);

    if ($verificar_resultado->num_rows > 0) {
        $excluir_carro = "DELETE FROM carros WHERE id = $carro_id";

        if ($conn->query($excluir_carro) === TRUE) {
            echo json_encode(array("message" => "Carro excluído com sucesso!"));
        } else {
            http_response_code(500); 
            echo json_encode(array("message" => "Erro ao excluir o carro: " . $conn->error));
        }
    } else {
        http_response_code(404); 
        echo json_encode(array("message" => "Carro não encontrado."));
    }

    $conn->close();
} else {
    http_response_code(405); 
    echo json_encode(array("message" => "Método não permitido."));
}
?>
