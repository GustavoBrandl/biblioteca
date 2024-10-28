<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM livros";
$result = $conn->query($sql);
?>

<h1>Lista de Livros</h1>
<a href="add_livro.php">Adicionar Novo Livro</a> | <a href="logout.php">Logout</a>

<table border="1">
    <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Autor</th>
        <th>Editora</th>
        <th>Ano</th>
        <th>Ações</th>
    </tr>
    <?php while ($livro = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $livro['codigo']; ?></td>
            <td><?php echo $livro['nome']; ?></td>
            <td><?php echo $livro['autor']; ?></td>
            <td><?php echo $livro['editora']; ?></td>
            <td><?php echo $livro['ano']; ?></td>
            <td>
                <a href="edit_livro.php?codigo=<?php echo $livro['codigo']; ?>">Editar</a> | 
                <a href="delete_livro.php?codigo=<?php echo $livro['codigo']; ?>" onclick="return confirm('Confirma a exclusão?');">Excluir</a>
            </td>
        </tr>
    <?php } ?>
</table>
