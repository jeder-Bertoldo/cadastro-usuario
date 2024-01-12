<?php


// Configuração da conexão com o banco de dados
$host = "localhost"; // ou o endereço do seu servidor de banco de dados
$dbname = "cadastro-user"; // nome do banco de dados
$username = "root"; // usuário do banco de dados
$password = ""; // senha do banco de dados

$conn = new mysqli($host, $username, $password, $dbname);

// Checar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>