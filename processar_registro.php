<?php

include 'conect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo e sanitizando os dados do formulário
    $usuario = $conn->real_escape_string($_POST['usuario']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);

    // Aplicando hash na senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    // Preparando a consulta SQL
    $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";

    // Preparando o statement
    $stmt = $conn->prepare($sql);

    // Vinculando parâmetros
  // Vinculando parâmetros
$stmt->bind_param("sss", $usuario, $email, $senhaHash);

    // Executando a consulta e verificando se foi bem-sucedida
    if ($stmt->execute()) {
        echo "Usuário registrado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    // Fechando o statement e a conexão
    $stmt->close();
    $conn->close();
} else {
    echo "Método não permitido.";
}
?>
