<?php
session_start();
require 'config.php';

if (isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];
    $sql = "DELETE FROM livros WHERE codigo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
}

header("Location: index.php");
exit();
?>
