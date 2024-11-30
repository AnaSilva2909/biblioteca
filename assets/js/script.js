// Seleciona o botão de animação
const ul = document.getElementById('opcoes');

// Verifica se o botão foi encontrado
if (ul) {
    // Adiciona um evento de clique no botão
    ul.addEventListener('click', () => {
        // Altera a cor do botão de forma suave
        ul.style.backgroundColor = getRandomColor();
        ul.style.transition = 'background-color 0.5s ease';
    });

    // Função para gerar uma cor aleatória
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
} else {
    console.error('Botão de animação não encontrado!');
}
