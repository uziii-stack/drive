/**
 * State Hero Interactive JavaScript
 *
 * Controls interactive vehicle switching tabs on state pages:
 * - Updates active tab pill styling
 * - Updates primary CTA button text and destination URL
 * - Highlights active cheat sheet card in the 3D fanned stack
 * - Syncs with header vehicle picker if present
 */

(function () {
    'use strict';

    function initStateHero() {
        var hero = document.getElementById('state-hero');
        if (!hero) {
            return;
        }

        var tabs = hero.querySelectorAll('.state-veh-tab');
        var ctaBtn = document.getElementById('stateHeroCtaBtn');
        var ctaText = document.getElementById('stateCtaBtnText');
        var mockupStack = document.getElementById('stateMockupStack');
        var cards = hero.querySelectorAll('.cheat-sheet-card');

        if (!tabs.length || !ctaBtn) {
            return;
        }

        function setVehicle(vehType, ctaLabel) {
            // Update tabs
            tabs.forEach(function (tab) {
                var isMatch = tab.getAttribute('data-vehicle') === vehType;
                tab.classList.toggle('is-active', isMatch);
                tab.setAttribute('aria-selected', isMatch ? 'true' : 'false');
            });

            // Update CTA button label
            if (ctaText && ctaLabel) {
                ctaText.textContent = ctaLabel;
            }

            // Update CTA destination URL if current href exists
            var currentHref = ctaBtn.getAttribute('href');
            if (currentHref) {
                var targetSlug = 'car-cheatsheet';
                if (vehType === 'cdl') {
                    targetSlug = 'cdl-cheatsheet';
                } else if (vehType === 'motorcycle') {
                    targetSlug = 'motorcycle-cheatsheet';
                }
                var updatedHref = currentHref.replace(/(car|cdl|motorcycle)-cheatsheet/i, targetSlug);
                ctaBtn.setAttribute('href', updatedHref);
            }

            // Update mockup fanned stack highlight
            if (mockupStack) {
                mockupStack.setAttribute('data-active-veh', vehType);
            }

            // Also synchronize with desktop header vehicle switcher if available
            var headerVehBtns = document.querySelectorAll('.header-vehicle-switcher .vehicle-switch-btn');
            if (headerVehBtns.length) {
                headerVehBtns.forEach(function (btn) {
                    var isVehMatch = btn.getAttribute('data-vehicle') === vehType;
                    btn.classList.toggle('is-active', isVehMatch);
                    btn.setAttribute('aria-selected', isVehMatch ? 'true' : 'false');
                });
            }
        }

        // Tab click handlers
        tabs.forEach(function (tab) {
            tab.addEventListener('click', function (e) {
                e.preventDefault();
                var vehType = tab.getAttribute('data-vehicle');
                var ctaLabel = tab.getAttribute('data-cta-label');
                setVehicle(vehType, ctaLabel);
            });
        });

        // Direct click on cards to switch tabs
        cards.forEach(function (card) {
            card.addEventListener('click', function () {
                var cardVeh = card.getAttribute('data-card-veh');
                if (cardVeh) {
                    var matchingTab = hero.querySelector('.state-veh-tab[data-vehicle="' + cardVeh + '"]');
                    var ctaLabel = matchingTab ? matchingTab.getAttribute('data-cta-label') : '';
                    setVehicle(cardVeh, ctaLabel);
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initStateHero);
    } else {
        initStateHero();
    }
})();
