<?php
session_start();
require 'config.php';

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    $sql = "SELECT * FROM livros WHERE codigo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $livro = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $ano = $_POST['ano'];

    $sql = "UPDATE livros SET nome = ?, autor = ?, editora = ?, ano = ? WHERE codigo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $nome, $autor, $editora, $ano, $codigo);
    $stmt->execute();
    header("Location: index.php");
    exit();
}
?>

<form method="POST">
    <input type="hidden" name="codigo" value="<?php echo $livro['codigo']; ?>">
    <label>Nome: <input type="text" name="nome" value="<?php echo $livro['nome']; ?>" required></label><br>
    <label>Autor: <input type="text" name="autor" value="<?php echo $livro['autor']; ?>" required></label><br>
    <label>Editora: <input type="text" name="editora" value="<?php echo $livro['editora']; ?>"></label><br>
    <label>Ano: <input type="number" name="ano" value="<?php echo $livro['ano']; ?>"></label><br>
    <button type="submit">Salvar Alterações</button>
</form>
