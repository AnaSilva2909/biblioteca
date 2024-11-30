const ul = document.getElementById('opcoes');

if (ul) {
    ul.addEventListener('click', () => {
        console.log("Botão de animação clicado!");
        ul.style.backgroundColor = getRandomColor();
        ul.style.transition = 'background-color 0.5s ease';
    });

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
