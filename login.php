<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Usuário ou senha inválidos.";
    }
}
?>

<form method="POST">
    <label>Usuário: <input type="text" name="username" required></label><br>
    <label>Senha: <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
</form>

<a href="register.php">Não tem uma conta? Registre-se</a>
