/**
 * Drive - Smooth Scroll Component JavaScript
 * Handles smooth scrolling for all internal anchor links with sticky header offset
 * compensation, focus management, and reduced-motion accessibility support.
 *
 * @package Drive
 */

(function () {
    'use strict';

    function initSmoothScroll() {
        // Respect user's reduced-motion preference
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        // Find all anchor links targeting IDs
        const anchorLinks = document.querySelectorAll('a[href*="#"]:not([href="#"]):not([href="#0"])');

        anchorLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                const href = link.getAttribute('href');
                if (!href) return;

                // Check if the link points to the current page
                const isCurrentPage = link.pathname === window.location.pathname || link.pathname === '/' || href.startsWith('#');
                if (!isCurrentPage) return;

                const hashIndex = href.indexOf('#');
                if (hashIndex === -1) return;

                const targetId = href.substring(hashIndex + 1);
                if (!targetId) return;

                const targetElement = document.getElementById(targetId);
                if (!targetElement) return;

                event.preventDefault();

                // Calculate sticky header height offset
                const header = document.getElementById('masthead');
                const headerOffset = header ? header.offsetHeight + 24 : 80;

                const elementPosition = targetElement.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                // Perform smooth scroll
                if (prefersReducedMotion) {
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'auto'
                    });
                } else {
                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }

                // Update URL hash smoothly without jump
                if (history.pushState) {
                    history.pushState(null, null, '#' + targetId);
                } else {
                    window.location.hash = targetId;
                }

                // Accessibility: Set focus to the target element
                targetElement.setAttribute('tabindex', '-1');
                targetElement.focus({ preventScroll: true });
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSmoothScroll);
    } else {
        initSmoothScroll();
    }
})();
