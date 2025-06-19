document.addEventListener('DOMContentLoaded', function () {
  const list = document.querySelector('.highlighted-offers-list');
  const cards = document.querySelectorAll('.highlighted-card');
  const leftArrow = document.getElementById('highlighted-arrow-left');
  const rightArrow = document.getElementById('highlighted-arrow-right');

  if (!list || cards.length === 0 || !leftArrow || !rightArrow) return;

  let currentIndex = 0;

  function getCurrentVisibleIndex() {
    let closestIndex = 0;
    let minDiff = Infinity;
    const listRect = list.getBoundingClientRect();
    cards.forEach((card, i) => {
      const cardRect = card.getBoundingClientRect();
      const diff = Math.abs(
        cardRect.left +
          cardRect.width / 2 -
          (listRect.left + listRect.width / 2)
      );
      if (diff < minDiff) {
        minDiff = diff;
        closestIndex = i;
      }
    });
    return closestIndex;
  }

  function scrollToCard(index) {
    if (index < 0 || index >= cards.length) return;
    cards[index].scrollIntoView({
      behavior: 'smooth',
      inline: 'center',
      block: 'nearest',
    });

    setTimeout(() => {
      currentIndex = getCurrentVisibleIndex();
      updateArrows();
    }, 300);
  }

  function updateArrows() {
    const isAtStart = list.scrollLeft <= 5;

    const isAtEnd = list.scrollLeft >= list.scrollWidth - list.clientWidth - 5;

    leftArrow.style.visibility = isAtStart ? 'hidden' : 'visible';
    rightArrow.style.visibility = isAtEnd ? 'hidden' : 'visible';
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

  list.addEventListener('scroll', function () {
    currentIndex = getCurrentVisibleIndex();
    updateArrows();
  });

  currentIndex = getCurrentVisibleIndex();
  updateArrows();
});
