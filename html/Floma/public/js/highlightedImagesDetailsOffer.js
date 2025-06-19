document.addEventListener('DOMContentLoaded', function () {
    const list = document.querySelector('.horizontal-slider');
    const cards = document.querySelectorAll('.slider-item');
    const leftArrow = document.getElementById('highlighted-arrow-left-detail');
    const rightArrow = document.getElementById('highlighted-arrow-right-detail');

    if (!list || cards.length === 0 || !leftArrow || !rightArrow) return;
    
    let currentIndex = 0;

    function scrollToCard(index) {
        if (index < 0 || index >= cards.length) return;

        cards[index].scrollIntoView({
            behavior: 'smooth',
            block: 'nearest',
            inline: 'center'
        });

        currentIndex = index;
        updateArrows();
    }

    function updateArrows() {
        leftArrow.style.visibility = currentIndex === 0 ? 'hidden' : 'visible';
        rightArrow.style.visibility = currentIndex === cards.length - 1 ? 'hidden' : 'visible';
    }

    leftArrow.addEventListener('click', function () {
        if (currentIndex > 0) {
            scrollToCard(currentIndex - 1);
        }
    });

    rightArrow.addEventListener('click', function () {
        if (currentIndex < cards.length - 1) {
            scrollToCard(currentIndex + 1);
        }
    });

    scrollToCard(0);
});
