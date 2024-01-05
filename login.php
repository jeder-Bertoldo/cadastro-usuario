<?php
// Arquivo da conexão
include 'conect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se os campos 'email' e 'senha' foram definidos
    if (isset($_POST['email']) && isset($_POST['senha'])) {
        $email = $conn->real_escape_string($_POST['email']);
        $senha = $conn->real_escape_string($_POST['senha']);

        // Consulta para verificar a existência do usuário
        $sql = "SELECT id, senha FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        // Executar a consulta
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $linha = $resultado->fetch_assoc();
            if (password_verify($senha, $linha['senha'])) {
                // Senha correta
                header("Location: header.html");
                exit;
            } else {
                // Senha incorreta
                echo "Senha incorreta!";
            }
        } else { 
            // Usuário não encontrado
            echo "Usuário não encontrado!";
        }
        $stmt->close();
    } else {
        echo "Os campos de e-mail e senha são obrigatórios.";
    }
} else {
    echo "Método de requisição inválido.";
}
$conn->close();
?>
