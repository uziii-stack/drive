/**
 * Drive - Main JavaScript
 * Lightweight, Vanilla JavaScript, Performance-First
 */

(function () {
    'use strict';

    /**
     * Header State Dropdown & Vehicle Switcher Handler
     */
    function initHeaderControls() {
        const stateSelector = document.getElementById('header-state-selector');
        if (!stateSelector) {
            return;
        }

        const trigger = stateSelector.querySelector('.header-state-trigger');
        const stateLinks = stateSelector.querySelectorAll('.state-mega-link');
        const selectedLabel = document.getElementById('selectedStateLabel');

        function toggleStateDropdown(open) {
            const isOpen = typeof open === 'boolean' ? open : !stateSelector.classList.contains('is-open');
            stateSelector.classList.toggle('is-open', isOpen);
            if (trigger) {
                trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            }
        }

        if (trigger) {
            trigger.addEventListener('click', function (e) {
                e.stopPropagation();
                toggleStateDropdown();
            });
        }

        // Close on click outside
        document.addEventListener('click', function (e) {
            if (stateSelector.classList.contains('is-open') && !stateSelector.contains(e.target)) {
                toggleStateDropdown(false);
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && stateSelector.classList.contains('is-open')) {
                toggleStateDropdown(false);
                if (trigger) {
                    trigger.focus();
                }
            }
        });

        // Update state selection if dynamically navigating
        stateLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                const stateName = link.getAttribute('data-state-name');
                if (stateName && selectedLabel) {
                    selectedLabel.textContent = stateName;
                }
                toggleStateDropdown(false);
            });
        });
    }

    /**
     * Mobile Menu Toggle & Drawer Handler
     */
    function initMobileMenu() {
        const toggleBtn = document.getElementById('headerMenuToggle');
        const drawer = document.getElementById('mobileMenuDrawer');

        if (!toggleBtn || !drawer) {
            return;
        }

        function toggleDrawer(open) {
            const isOpen = typeof open === 'boolean' ? open : toggleBtn.getAttribute('aria-expanded') !== 'true';
            toggleBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            drawer.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            drawer.classList.toggle('is-active', isOpen);
        }

        toggleBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleDrawer();
        });

        // Close drawer when clicking outside
        document.addEventListener('click', function (e) {
            if (drawer.classList.contains('is-active') && !drawer.contains(e.target) && !toggleBtn.contains(e.target)) {
                toggleDrawer(false);
            }
        });

        // Close drawer on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && drawer.classList.contains('is-active')) {
                toggleDrawer(false);
                toggleBtn.focus();
            }
        });

        // Auto close on navigation link clicks
        const links = drawer.querySelectorAll('a');
        links.forEach(function (link) {
            link.addEventListener('click', function () {
                toggleDrawer(false);
            });
        });
    }

    /**
     * Hero Interactive Demo Card Options Handler
     */
    function initHeroMockup() {
        const mockupCard = document.querySelector('.hero-question-card');
        if (!mockupCard) {
            return;
        }

        const optionButtons = mockupCard.querySelectorAll('.card-option-btn');
        optionButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                optionButtons.forEach(function (b) {
                    b.classList.remove('is-active');
                });
                btn.classList.add('is-active');
            });
        });
    }

    /**
     * Skip link focus fix for keyboard accessibility
     */
    function initSkipLinkFocus() {
        const isIe = /(trident|msie)/i.test(navigator.userAgent);

        if (isIe && document.getElementById && window.addEventListener) {
            window.addEventListener(
                'hashchange',
                function () {
                    const id = location.hash.substring(1);
                    if (!/^[A-z0-9_-]+$/.test(id)) {
                        return;
                    }
                    const element = document.getElementById(id);
                    if (element) {
                        if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
                            element.tabIndex = -1;
                        }
                        element.focus();
                    }
                },
                false
            );
        }
    }

    // Initialize once DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initHeaderControls();
            initMobileMenu();
            initHeroMockup();
            initSkipLinkFocus();
        });
    } else {
        initHeaderControls();
        initMobileMenu();
        initHeroMockup();
        initSkipLinkFocus();
    }
})();
