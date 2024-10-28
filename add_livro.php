<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $ano = $_POST['ano'];

    $sql = "INSERT INTO livros (nome, autor, editora, ano) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nome, $autor, $editora, $ano);
    $stmt->execute();
    header("Location: index.php");
    exit();
}
?>

<form method="POST">
    <label>Nome: <input type="text" name="nome" required></label><br>
    <label>Autor: <input type="text" name="autor" required></label><br>
    <label>Editora: <input type="text" name="editora"></label><br>
    <label>Ano: <input type="number" name="ano"></label><br>
    <button type="submit">Adicionar Livro</button>
</form>
