/**
 * Interactive Take a Look Inside Carousel Script
 */
(function() {
    'use strict';

    function initLookCarousel() {
        var stage = document.getElementById('lookCarouselStage');
        if (!stage) return;

        var prevBtn = document.getElementById('lookPrevBtn');
        var nextBtn = document.getElementById('lookNextBtn');
        var titleElem = document.getElementById('lookCurrentTitle');
        var dots = document.querySelectorAll('.look-dot');
        var cards = stage.querySelectorAll('.look-page-card');

        var totalPages = cards.length;
        var currentIndex = 1; // Default middle (Q&A)

        function updateCarousel(newIndex) {
            if (newIndex < 0) newIndex = totalPages - 1;
            if (newIndex >= totalPages) newIndex = 0;

            currentIndex = newIndex;
            stage.setAttribute('data-current-index', currentIndex);

            // Update title
            var activeCard = stage.querySelector('.look-page-card[data-page-index="' + currentIndex + '"]');
            if (activeCard && titleElem) {
                var title = activeCard.getAttribute('data-page-title');
                if (title) titleElem.textContent = title;
            }

            // Update dots
            dots.forEach(function(dot) {
                var dotIdx = parseInt(dot.getAttribute('data-index'), 10);
                if (dotIdx === currentIndex) {
                    dot.classList.add('is-active');
                    dot.setAttribute('aria-selected', 'true');
                } else {
                    dot.classList.remove('is-active');
                    dot.setAttribute('aria-selected', 'false');
                }
            });
        }

        if (prevBtn) {
            prevBtn.addEventListener('click', function() {
                updateCarousel(currentIndex - 1);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', function() {
                updateCarousel(currentIndex + 1);
            });
        }

        dots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                var targetIdx = parseInt(this.getAttribute('data-index'), 10);
                updateCarousel(targetIdx);
            });
        });

        // Click side card to bring it to center
        cards.forEach(function(card) {
            card.addEventListener('click', function() {
                var cardIdx = parseInt(this.getAttribute('data-page-index'), 10);
                if (cardIdx !== currentIndex) {
                    updateCarousel(cardIdx);
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initLookCarousel);
    } else {
        initLookCarousel();
    }
})();

