<?php

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $current_time = time();
    $start_time = $_SESSION['start_time'];
    $expire_time = $_SESSION['expire_time'];
    $time_left = $expire_time - ($current_time - $start_time);

    echo "Tempo restante da sessão: " . gmdate("H:i:s", $time_left);
} else {
    echo "Usuário não logado.";
    // Redirecione para a página de login
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Bem-Vindo</h3>
</body>
</html>



