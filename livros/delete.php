<?php
include '../includes/header.php';
include '../config/db.php';

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Livros</title>
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head>
<body>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $stmt = $conn->prepare("DELETE FROM livros WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "Livro excluído com sucesso!";
    } else {
        echo "Erro ao excluir o livro.";
    }
}
?>
 
      

<div class="container">
    <h1>Livro Excluído com Sucesso!</h1>
    <li><a href="../index.php">Home Page</a></li>
    <a href="read.php">Voltar à lista de livros</a>
</div>

<?php
include '../includes/footer.php';
?>
