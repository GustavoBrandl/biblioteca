<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password != $confirm_password) {
        echo "As senhas não coincidem!";
    } else {
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Nome de usuário já existe. Escolha outro.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (username, password) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $username, $hashed_password);
            
            if ($stmt->execute()) {
                echo "Usuário registrado com sucesso! Faça o login.";
                header("Location: login.php"); 
                exit();
            } else {
                echo "Erro ao registrar usuário. Tente novamente.";
            }
        }
    }
}
?>

<h2>Registro de Usuário</h2>
<form method="POST" action="register.php">
    <label>Usuário: <input type="text" name="username" required></label><br>
    <label>Senha: <input type="password" name="password" required></label><br>
    <label>Confirmar Senha: <input type="password" name="confirm_password" required></label><br>
    <button type="submit">Registrar</button>
</form>
<a href="login.php">Já tem uma conta? Faça login</a>
