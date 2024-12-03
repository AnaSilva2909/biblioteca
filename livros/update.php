<?php
include '../includes/header.php';
include '../config/db.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    
    $stmt = $conn->prepare("SELECT * FROM livros WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Define como inteiro
    $stmt->execute();
    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if (!$livro) {
        echo "<p>Livro não encontrado.</p>";
        exit;
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = trim($_POST['titulo']);
        $autor = trim($_POST['autor']);
        $ano = trim($_POST['ano']);

        
        if (empty($titulo) || empty($autor) || !is_numeric($ano)) {
            echo "<p>Preencha todos os campos corretamente!</p>";
        } else {
      
            $updateStmt = $conn->prepare("
                UPDATE livros 
                SET titulo = :titulo, autor = :autor, ano = :ano 
                WHERE id = :id
            ");
            $updateStmt->bindParam(':titulo', $titulo);
            $updateStmt->bindParam(':autor', $autor);
            $updateStmt->bindParam(':ano', $ano, PDO::PARAM_INT);
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($updateStmt->execute()) {
                echo "<p>Livro atualizado com sucesso!</p>";
                header('Location: livros\read.php'); 
            } else {
                echo "<p>Erro ao atualizar o livro.</p>";
            }
        }
    }
} else {
    echo "<p>ID inválido.</p>";
    exit;
}
?>

<div class="container">
    <h1>Editar Livro</h1>
    <?php if (isset($livro)): ?>
        <form method="POST">
            <label for="titulo">Título:</label><br>
            <input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($livro['titulo']); ?>" required><br>

            <label for="autor">Autor:</label><br>
            <input type="text" id="autor" name="autor" value="<?php echo htmlspecialchars($livro['autor']); ?>" required><br>

            <label for="ano">Ano:</label><br>
            <input type="number" id="ano" name="ano" value="<?php echo htmlspecialchars($livro['ano']); ?>" required><br><br>

            <button type="submit">Atualizar</button>
        </form>
    <?php else: ?>
        <p>Livro não encontrado.</p>
    <?php endif; ?>
</div>

<?php
include '../includes/footer.php';
?>
