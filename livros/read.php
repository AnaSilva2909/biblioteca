<?php

include '../includes/header.php';
include '../config/db.php';


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
    <h1>Lista de Livros</h1>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Ano</th>
                <th>Ações</th>
            </tr>
        </thead>
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

<?php
// Inclui o rodapé
include '../includes/footer.php';
?>
