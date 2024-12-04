<?php
include '../includes/header.php';
include '../config/db.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Livro</title>
    <link rel="stylesheet" href="../assets/css/style.css"> 
</head>

<?php


if (!$conn) {
    die("Erro de conexão com o banco de dados: " . mysqli_connect_error());
}


try {
    $stmt = $conn->query("SELECT * FROM livros");
    $livros = $stmt->fetchAll();
} catch (Exception $e) {
    echo "Erro ao buscar os livros: " . $e->getMessage();
}

?>

<div class="container">
    <h1>Atualização Livros</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano</th>
                <th>Ações</th>
            </tr>
        </thead>
        <li><a href="../index.php">Home Page</a></li>
        <tbody>
            <?php if (!empty($livros)): ?>
                <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($livro['titulo']); ?></td>
                        <td><?php echo htmlspecialchars($livro['autor']); ?></td>
                        <td><?php echo htmlspecialchars($livro['ano']); ?></td>
                        <td>
                            <a href="update.php?id=<?php echo htmlspecialchars($livro['id']); ?>">Editar</a> | 
                            <a href="delete.php?id=<?php echo htmlspecialchars($livro['id']); ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Nenhum livro encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<body>

<?php




if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Consulta o livro com o ID fornecido
    $stmt = $conn->prepare("SELECT * FROM livros WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if (!$livro) {
        echo "<p>Livro não encontrado.</p>";
        exit;
    }

 
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])) {
        $titulo = trim($_POST['titulo']);
        $autor = trim($_POST['autor']);
        $ano = trim($_POST['ano']);

       
        if (empty($titulo) || empty($autor) || !is_numeric($ano)) {
            echo "<p>Preencha todos os campos corretamente!</p>";
        } else {
      
            $updateStmt = $conn->prepare("UPDATE livros SET titulo = :titulo, autor = :autor, ano = :ano WHERE id = :id");
            $updateStmt->bindParam(':titulo', $titulo);
            $updateStmt->bindParam(':autor', $autor);
            $updateStmt->bindParam(':ano', $ano, PDO::PARAM_INT);
            $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

            
            if ($updateStmt->execute()) {
                echo "<p>Livro atualizado com sucesso!</p>";
                header('Location: read.php'); 
                exit;
            } else {
                echo "<p>Erro ao atualizar o livro.</p>";
            }
        }
    }

    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir'])) {
        
        $deleteStmt = $conn->prepare("DELETE FROM livros WHERE id = :id");
        $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($deleteStmt->execute()) {
            echo "<p>Livro excluído com sucesso!</p>";
            header('Location: read.php'); 
            exit;
        } else {
            echo "<p>Erro ao excluir o livro.</p>";
        }
    }
} else {
    
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

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

                <button type="submit" name="atualizar">Atualizar</button>
            </form>

            <!-- Formulário de exclusão -->
            <form method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                <button type="submit" name="excluir">Excluir</button>
            </form>
        <?php else: ?>
            <p>Livro não encontrado.</p>
        <?php endif; ?>
    </div>

</body>
</html>

<?php
include '../includes/footer.php';
?>
