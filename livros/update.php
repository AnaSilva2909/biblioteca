<?php
include '../includes/header.php';
include '../config/db.php';

// Verifica se o ID foi passado na URL e é válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Busca o livro pelo ID no banco de dados
    $stmt = $conn->prepare("SELECT * FROM livros WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Define como inteiro
    $stmt->execute();
    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Se o livro não for encontrado, exibe uma mensagem de erro
    if (!$livro) {
        echo "<p>Livro não encontrado.</p>";
        exit;
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $titulo = trim($_POST['titulo']);
        $autor = trim($_POST['autor']);
        $ano = trim($_POST['ano']);

        // Validação simples (pode expandir conforme necessário)
        if (empty($titulo) || empty($autor) || !is_numeric($ano)) {
            echo "<p>Preencha todos os campos corretamente!</p>";
        } else {
            // Atualiza o livro no banco de dados
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
                header('Location: read.php'); // Altere para o caminho correto
                exit;
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
