<?php
include 'config/db.php';
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Biblioteca Virtual</h1>
        </header>
        <main>
            <h2>Gerenciar Livros</h2>
            <nav>
                <ul id="opcoes">
                    <li class="button cadastrar"><a color="red" href="livros/create.php">Cadastrar Livro</a></li>
                    <li class="button listar"><a href="livros/read.php">Listar Livros</a></li>
                    <li class="button editar"><a href="livros/update.php">Editar Livro</a></li>
                    <li class="button excluir"><a href="livros/delete.php">Excluir Livro</a></li>
                </ul>
            </nav>
            
        </main>
        <footer>
            <p>&copy; 2024 Biblioteca Virtual. Todos os direitos reservados.</p>
        </footer>
    </div>

    <!-- Inclusão do script JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>

<?php
include 'includes/footer.php';
?>
