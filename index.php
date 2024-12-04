<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livros</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>Biblioteca Virtual</h1>
    </header>

    <nav>
        <ul id="opcoes">
            <li class="button cadastrar"><a href="livros/create.php">Cadastrar Livro</a></li>
            <li class="button listar"><a href="livros/read.php">Listar Livros</a></li>
            <li class="button editar"><a href="livros/update.php">Atualizar Livros</a></li></li>
            <li class="button excluir"><a href="livros/delete.php">Excluir Livro</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Cadastrar Livro</h1>
        <form method="POST">
            <input type="text" name="titulo" placeholder="Título" required><br>
            <input type="text" name="autor" placeholder="Autor" required><br>
            <input type="number" name="ano" placeholder="Ano" required><br>
            <button type="submit">Cadastrar</button>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Biblioteca Virtual. Todos os direitos reservados.</p>
    </footer>

    <script src="assets/js/script.js"></script>
</body>
</html>
