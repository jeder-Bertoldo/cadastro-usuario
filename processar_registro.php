<?php
// Configuração da conexão com o banco de dados
$host = "localhost"; // ou o endereço do seu servidor de banco de dados
$dbname = "cadastro-user"; // nome do banco de dados
$username = "root"; // usuário do banco de dados
$password = ""; // senha do banco de dados

// Criar conexão
$conn = new mysqli($host, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

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
    $stmt->bind_param("sss", $nome, $email, $senhaHash);

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
