<?php
include '../includes/header.php';  
include '../config/db.php';        
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Livro</title>
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head>
<body>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];

    try {
        $stmt = $conn->prepare("INSERT INTO livros (titulo, autor, ano) VALUES (:titulo, :autor, :ano)");
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':ano', $ano);

        if ($stmt->execute()) {
            echo "Livro cadastrado com sucesso!";
        } else {
            echo "Erro ao cadastrar o livro.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>

<div class="container">
    <h1>Cadastrar Livro</h1>
    <li><a href="../index.php">Home Page</a></li>
    <form method="POST">
        <input type="text" name="titulo" placeholder="Título" required><br>
        <input type="text" name="autor" placeholder="Autor" required><br>
        <input type="number" name="ano" placeholder="Ano" required><br>
        <button type="submit">Cadastrar</button>
    </form>
</div>

<?php include '../includes/footer.php';  ?>

</body>
</html>
