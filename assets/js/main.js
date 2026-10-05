/**
 * Drive - Main JavaScript
 * Lightweight, Vanilla JavaScript, Performance-First
 */

(function () {
    'use strict';

    /**
     * Mobile / Tablet Menu Navigation Handler
     */
    function initNavigation() {
        const siteNavigation = document.getElementById('site-navigation');
        if (!siteNavigation) {
            return;
        }

        const button = siteNavigation.querySelector('.menu-toggle');
        const drawer = siteNavigation.querySelector('.primary-menu-drawer');
        if (!button || !drawer) {
            return;
        }

        function toggleMenu(open) {
            const isOpen = typeof open === 'boolean' ? open : button.getAttribute('aria-expanded') !== 'true';
            button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            drawer.classList.toggle('is-active', isOpen);
        }

        button.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleMenu();
        });

        // Close on click outside drawer
        document.addEventListener('click', function (e) {
            if (drawer.classList.contains('is-active') && !siteNavigation.contains(e.target)) {
                toggleMenu(false);
            }
        });

        // Close menu on Escape key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && drawer.classList.contains('is-active')) {
                toggleMenu(false);
                button.focus();
            }
        });

        // Handle dropdown triggers (State & Vehicle) for mobile/touch
        const dropdownTriggers = siteNavigation.querySelectorAll('.nav-dropdown-trigger');
        dropdownTriggers.forEach(function (trigger) {
            trigger.addEventListener('click', function (e) {
                if (window.innerWidth < 1200) {
                    e.preventDefault();
                    e.stopPropagation();
                    const parentLi = trigger.closest('.menu-item-has-children');
                    if (parentLi) {
                        const isOpen = parentLi.classList.contains('is-open');
                        // Close other sibling dropdowns in drawer
                        siteNavigation.querySelectorAll('.menu-item-has-children').forEach(function (li) {
                            li.classList.remove('is-open');
                        });
                        if (!isOpen) {
                            parentLi.classList.add('is-open');
                            trigger.setAttribute('aria-expanded', 'true');
                        } else {
                            trigger.setAttribute('aria-expanded', 'false');
                        }
                    }
                }
            });
        });

        // Auto-close drawer on standard link click (excluding dropdown triggers)
        const navLinks = drawer.querySelectorAll('a:not(.nav-dropdown-trigger)');
        navLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth < 1200) {
                    toggleMenu(false);
                }
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
            initNavigation();
            initSkipLinkFocus();
        });
    } else {
        initNavigation();
        initSkipLinkFocus();
    }
})();

