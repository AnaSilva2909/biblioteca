<?php
include '../includes/header.php';
include '../config/db.php';

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
    <a href="read.php">Voltar à lista de livros</a>
</div>

<?php
include '../includes/footer.php';
?>
