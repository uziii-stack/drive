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

    /**
     * Interactive Cheat Sheet vs Handbook Toggle Script
     */
    function initCompareToggle() {
        var toggleBtns = document.querySelectorAll('.compare-toggle-btn');
        if (!toggleBtns.length) return;

        toggleBtns.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var targetId = this.getAttribute('data-target');
                if (!targetId) return;

                // Update tab states
                toggleBtns.forEach(function(b) {
                    b.classList.remove('is-active');
                    b.setAttribute('aria-selected', 'false');
                });
                this.classList.add('is-active');
                this.setAttribute('aria-selected', 'true');

                // Update panels
                var panels = document.querySelectorAll('.compare-panel');
                panels.forEach(function(panel) {
                    if (panel.id === targetId) {
                        panel.classList.add('is-active');
                        panel.removeAttribute('hidden');
                    } else {
                        panel.classList.remove('is-active');
                        panel.setAttribute('hidden', '');
                    }
                });
            });
        });
    }

    /**
     * Interactive FAQ Accordion Script
     */
    function initFaqAccordion() {
        var faqItems = document.querySelectorAll('.cs-faq-item');
        if (!faqItems.length) return;

        faqItems.forEach(function(item) {
            var btn = item.querySelector('.cs-faq-btn');
            var panel = item.querySelector('.cs-faq-panel');
            if (!btn || !panel) return;

            btn.addEventListener('click', function() {
                var isOpen = item.classList.contains('is-open');

                // Close all other open items
                faqItems.forEach(function(other) {
                    if (other !== item && other.classList.contains('is-open')) {
                        other.classList.remove('is-open');
                        var otherBtn = other.querySelector('.cs-faq-btn');
                        var otherPanel = other.querySelector('.cs-faq-panel');
                        if (otherBtn) otherBtn.setAttribute('aria-expanded', 'false');
                        if (otherPanel) otherPanel.setAttribute('hidden', '');
                    }
                });

                // Toggle current item
                if (isOpen) {
                    item.classList.remove('is-open');
                    btn.setAttribute('aria-expanded', 'false');
                    panel.setAttribute('hidden', '');
                } else {
                    item.classList.add('is-open');
                    btn.setAttribute('aria-expanded', 'true');
                    panel.removeAttribute('hidden');
                }
            });
        });
    }

    function initPageScripts() {
        initLookCarousel();
        initCompareToggle();
        initFaqAccordion();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPageScripts);
    } else {
        initPageScripts();
    }
})();

