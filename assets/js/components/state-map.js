/**
 * Drive - Interactive US State Map Component JavaScript
 * Handles hover tooltips, pin interactions, dynamic coordinate tracking,
 * and state page redirection.
 *
 * @package Drive
 */

(function () {
    'use strict';

    function initInteractiveMap() {
        const mapWrapper = document.querySelector('.state-map-wrapper');
        const mapSvg     = document.getElementById('us-interactive-map');
        const tooltip    = document.getElementById('state-map-tooltip');
        const nameEl     = document.getElementById('tooltip-state-name');
        const countEl    = document.getElementById('tooltip-active-count');
        const selectEl   = document.getElementById('state-quick-dropdown');
        const goBtn      = document.getElementById('btn-state-go');

        if (!mapWrapper || !mapSvg || !tooltip) {
            return;
        }

        const statePaths = mapSvg.querySelectorAll('.state-path');
        const mapPins    = mapSvg.querySelectorAll('.map-pin-node');

        let activeStateCode = null;

        function showTooltipFor(stateCode, targetEl) {
            const path = mapSvg.querySelector(`.state-path[data-state-code="${stateCode}"]`);
            const pin  = mapSvg.querySelector(`.map-pin-node[data-state-code="${stateCode}"]`);

            if (!path) {
                return;
            }

            activeStateCode = stateCode;

            // Activate visual hover classes
            path.classList.add('is-hovered');
            if (pin) {
                pin.classList.add('is-hovered');
            }

            // Update tooltip text content
            const stateName   = path.getAttribute('data-state-name') || '';
            const activeCount = path.getAttribute('data-active-count') || '0';

            if (nameEl) nameEl.textContent = stateName;
            if (countEl) countEl.textContent = activeCount;

            // Calculate precise tooltip coordinates relative to mapWrapper
            const wrapperRect = mapWrapper.getBoundingClientRect();
            let anchorRect;

            if (pin) {
                anchorRect = pin.getBoundingClientRect();
            } else if (targetEl) {
                anchorRect = targetEl.getBoundingClientRect();
            } else {
                anchorRect = path.getBoundingClientRect();
            }

            const posX = (anchorRect.left + anchorRect.width / 2) - wrapperRect.left;
            const posY = anchorRect.top - wrapperRect.top;

            tooltip.style.left = `${posX}px`;
            tooltip.style.top  = `${posY}px`;
            tooltip.classList.add('is-visible');
            tooltip.setAttribute('aria-hidden', 'false');
        }

        function hideTooltip() {
            if (activeStateCode) {
                const path = mapSvg.querySelector(`.state-path[data-state-code="${activeStateCode}"]`);
                const pin  = mapSvg.querySelector(`.map-pin-node[data-state-code="${activeStateCode}"]`);
                if (path) path.classList.remove('is-hovered');
                if (pin) pin.classList.remove('is-hovered');
                activeStateCode = null;
            }
            tooltip.classList.remove('is-visible');
            tooltip.setAttribute('aria-hidden', 'true');
        }

        // State Path Events
        statePaths.forEach(function (path) {
            const code = path.getAttribute('data-state-code');
            const url  = path.getAttribute('data-url');

            path.addEventListener('mouseenter', function () {
                showTooltipFor(code, path);
            });

            path.addEventListener('focus', function () {
                showTooltipFor(code, path);
            });

            path.addEventListener('mouseleave', function () {
                hideTooltip();
            });

            path.addEventListener('blur', function () {
                hideTooltip();
            });

            path.addEventListener('click', function () {
                if (url) {
                    window.location.href = url;
                }
            });

            path.addEventListener('keydown', function (e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    if (url) {
                        window.location.href = url;
                    }
                }
            });
        });

        // Pin Node Events
        mapPins.forEach(function (pin) {
            const code = pin.getAttribute('data-state-code');
            const url  = pin.getAttribute('data-url');

            pin.addEventListener('mouseenter', function () {
                showTooltipFor(code, pin);
            });

            pin.addEventListener('mouseleave', function () {
                hideTooltip();
            });

            pin.addEventListener('click', function (e) {
                e.stopPropagation();
                if (url) {
                    window.location.href = url;
                }
            });
        });

        // Quick Select Dropdown Handler
        if (selectEl && goBtn) {
            goBtn.addEventListener('click', function () {
                const url = selectEl.value;
                if (url) {
                    window.location.href = url;
                }
            });

            selectEl.addEventListener('change', function () {
                if (this.value) {
                    window.location.href = this.value;
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initInteractiveMap);
    } else {
        initInteractiveMap();
    }
})();
