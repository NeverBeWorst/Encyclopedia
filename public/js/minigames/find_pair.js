document.addEventListener('DOMContentLoaded', function () {
    const cardsGrid = document.getElementById('cards-grid');

    const creatures = get_creature();

    let flippedCards = [];
    let matchedCards = [];

    // Создание карточек
    function createCards() {
        let allCards = creatures.concat(creatures);
        allCards = shuffleArray(allCards);

        allCards.forEach((creature, index) => {
            const card = document.createElement('div');
            card.classList.add('card');
            card.dataset.index = index;
            card.innerHTML = `<img src="../../img/carts/${creature}" alt="creature">`;
            card.addEventListener('click', flipCard);
            cardsGrid.appendChild(card);
        });
    }

    // Открытие карточек
    function flipCard() {
        if (flippedCards.length < 2 && !flippedCards.includes(this) && !matchedCards.includes(this)) {
            this.classList.add('flipped');
            flippedCards.push(this);

            if (flippedCards.length === 2) {
                setTimeout(checkMatch, 1000);
            }
        }
    }

    // Проверка правильности
    function checkMatch() {
        const [card1, card2] = flippedCards;
        const img1 = card1.querySelector('img').getAttribute('src');
        const img2 = card2.querySelector('img').getAttribute('src');

        if (img1 === img2) {
            matchedCards.push(card1, card2);
            if (matchedCards.length === creatures.length * 2) {
                endGame();
            }
        } else {
            card1.classList.remove('flipped');
            card2.classList.remove('flipped');
        }

        flippedCards = [];
    }

    // Конец игры
    function endGame() {
        // Здесь можно отправить результаты игры на сервер
        console.log(flippedCards.length);
        console.log(matchedCards.length);
        console.log('Игра завершена!');
    }

    // Перемешивание
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    createCards();
});