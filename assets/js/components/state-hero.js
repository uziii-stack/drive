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
                var targetSlug = 'car-cheat-sheet';
                if (vehType === 'cdl') {
                    targetSlug = 'cdl-cheat-sheet';
                } else if (vehType === 'motorcycle') {
                    targetSlug = 'motorcycle-cheat-sheet';
                }
                var updatedHref = currentHref.replace(/(car|cdl|motorcycle)-cheat-?sheet/i, targetSlug);
                ctaBtn.setAttribute('href', updatedHref);
            }

            // Update mockup fanned stack highlight
            if (mockupStack) {
                mockupStack.setAttribute('data-active-veh', vehType);
            }

            // Update What's Inside section dynamically
            var insideTitle = document.querySelector('.inside-title-text');
            var insideCount = document.getElementById('insideQuestionCount');
            if (insideTitle) {
                var vName = vehType === 'motorcycle' ? 'Motorcycle' : (vehType === 'cdl' ? 'CDL' : 'Car');
                insideTitle.textContent = 'Everything in your ' + vName + ' cheat sheet';
            }
            if (insideCount) {
                insideCount.textContent = vehType === 'cdl' ? '250' : '150';
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

    /**
     * Interactive Custom State Switcher Dropdown (Theme Design)
     */
    function initCustomStateSwitcher() {
        var wrapper = document.getElementById('customStateSwitcher');
        if (!wrapper) {
            return;
        }

        var trigger = document.getElementById('customSwitcherTrigger');
        var triggerText = document.getElementById('customTriggerText');
        var menu = document.getElementById('customSwitcherMenu');
        var searchInput = document.getElementById('customSwitcherSearch');
        var nativeSelect = document.getElementById('stateSwitcherSelect');
        var options = wrapper.querySelectorAll('.custom-state-option');

        if (!trigger || !menu) {
            return;
        }

        function toggleMenu(open) {
            var isOpen = typeof open === 'boolean' ? open : !wrapper.classList.contains('is-open');
            wrapper.classList.toggle('is-open', isOpen);
            trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            if (isOpen && searchInput) {
                setTimeout(function () {
                    searchInput.focus();
                }, 50);
            }
        }

        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMenu();
        });

        // Filter search input
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                var q = searchInput.value.toLowerCase().trim();
                options.forEach(function (opt) {
                    var name = opt.getAttribute('data-name') || '';
                    if (!q || name.indexOf(q) !== -1) {
                        opt.style.display = 'flex';
                    } else {
                        opt.style.display = 'none';
                    }
                });
            });

            searchInput.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }

        // Option click handlers
        options.forEach(function (opt) {
            opt.addEventListener('click', function (e) {
                e.stopPropagation();
                var val = opt.getAttribute('data-value');
                var name = opt.querySelector('.custom-state-name') ? opt.querySelector('.custom-state-name').textContent.trim() : '';

                options.forEach(function (o) {
                    o.classList.remove('is-selected');
                });
                opt.classList.add('is-selected');

                if (triggerText) {
                    triggerText.textContent = name;
                }

                if (nativeSelect) {
                    nativeSelect.value = val;
                }

                toggleMenu(false);

                // Instantly navigate on selection like modern state pickers
                if (val) {
                    window.location.href = val;
                }
            });
        });

        // Close on click outside
        document.addEventListener('click', function (e) {
            if (wrapper.classList.contains('is-open') && !wrapper.contains(e.target)) {
                toggleMenu(false);
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && wrapper.classList.contains('is-open')) {
                toggleMenu(false);
                trigger.focus();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initStateHero();
            initCustomStateSwitcher();
        });
    } else {
        initStateHero();
        initCustomStateSwitcher();
    }
})();
