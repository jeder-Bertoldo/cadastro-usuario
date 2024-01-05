<?php
include 'conect.php'; // Inclua seu script de conexão ao banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter dados do formulário
    $email = $conn->real_escape_string($_POST['email']);
    $senha_atual = $conn->real_escape_string($_POST['senha_atual']);
    $nova_senha = $conn->real_escape_string($_POST['nova_senha']);
    $confirma_senha = $conn->real_escape_string($_POST['confirma_senha']);

    if ($nova_senha == $confirma_senha) {
        // Verificar se a senha atual está correta
        $sql = "SELECT senha FROM usuario WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $linha = $resultado->fetch_assoc();
            if (password_verify($senha_atual, $linha['senha'])) {
                // Atualizar a senha
                $nova_senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
                $sql_update = "UPDATE usuario SET senha = ? WHERE email = ?";
                $stmt_update = $conn->prepare($sql_update);
                $stmt_update->bind_param("ss", $nova_senha_hash, $email);
                if ($stmt_update->execute()) {
                    echo "Senha alterada com sucesso!";
                } else {
                    echo "Erro ao alterar a senha!";
                }
                $stmt_update->close();
            } else {
                echo "Senha atual incorreta!";
            }
        } else {
            echo "Usuário não encontrado!";
        }
        $stmt->close();
    } else {
        echo "As novas senhas não coincidem!";
    }
} else {
    echo "Método de requisição inválido.";
}

$conn->close();
?>
