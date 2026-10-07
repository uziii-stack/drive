/**
 * Drive - Interactive US State Map Component JavaScript
 * Handles hover tooltips, region filter pills, state click redirection,
 * and bottom dropdown continue button.
 *
 * @package Drive
 */

(function () {
    'use strict';

    function initInteractiveMap() {
        const mapWrapper  = document.querySelector('.state-map-wrapper');
        const mapSvg      = document.getElementById('us-interactive-map');
        const tooltip     = document.getElementById('state-map-tooltip');
        const nameEl      = document.getElementById('tooltip-state-name');
        const selectEl    = document.getElementById('state-map-dropdown');
        const continueBtn = document.getElementById('btnMapContinue');
        const regionPills = document.querySelectorAll('.region-pill-btn');

        if (!mapWrapper || !mapSvg || !tooltip) {
            return;
        }

        const statePaths = mapSvg.querySelectorAll('.state-path');
        let activeStateCode = null;
        let activeRegion = null;

        // Tooltip display
        function showTooltipFor(stateCode, targetEl) {
            const path = mapSvg.querySelector(`.state-path[data-state-code="${stateCode}"]`);
            if (!path) return;

            // Remove previous hover from other paths
            if (activeStateCode && activeStateCode !== stateCode) {
                const prevPath = mapSvg.querySelector(`.state-path[data-state-code="${activeStateCode}"]`);
                if (prevPath) prevPath.classList.remove('is-hovered');
            }

            activeStateCode = stateCode;
            path.classList.add('is-hovered');

            const stateName = path.getAttribute('data-state-name') || '';
            if (nameEl) nameEl.textContent = stateName;

            // Calculate precise tooltip coordinates relative to mapWrapper
            const wrapperRect = mapWrapper.getBoundingClientRect();
            const anchorRect  = targetEl ? targetEl.getBoundingClientRect() : path.getBoundingClientRect();

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
                if (path) path.classList.remove('is-hovered');
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

        // Region Filter Pills
        regionPills.forEach(function (pill) {
            pill.addEventListener('click', function () {
                const region = pill.getAttribute('data-region');

                if (activeRegion === region) {
                    // Reset
                    activeRegion = null;
                    regionPills.forEach(function (p) {
                        p.classList.remove('is-active');
                        p.setAttribute('aria-selected', 'false');
                    });
                    statePaths.forEach(function (p) {
                        p.classList.remove('is-dimmed');
                        p.classList.remove('is-highlighted');
                    });
                } else {
                    activeRegion = region;
                    regionPills.forEach(function (p) {
                        const isCurrent = p.getAttribute('data-region') === region;
                        p.classList.toggle('is-active', isCurrent);
                        p.setAttribute('aria-selected', isCurrent ? 'true' : 'false');
                    });

                    statePaths.forEach(function (p) {
                        const stateRegion = p.getAttribute('data-region');
                        if (stateRegion === region) {
                            p.classList.remove('is-dimmed');
                            p.classList.add('is-highlighted');
                        } else {
                            p.classList.add('is-dimmed');
                            p.classList.remove('is-highlighted');
                        }
                    });
                }
            });
        });

        // Bottom Select & Continue Button
        if (continueBtn && selectEl) {
            continueBtn.addEventListener('click', function () {
                const selectedUrl = selectEl.value;
                if (selectedUrl) {
                    window.location.href = selectedUrl;
                } else {
                    selectEl.focus();
                }
            });

            selectEl.addEventListener('change', function () {
                if (selectEl.value) {
                    // Update state preview on map if matching
                    const selectedText = selectEl.options[selectEl.selectedIndex].text;
                    statePaths.forEach(function (p) {
                        if (p.getAttribute('data-state-name') === selectedText) {
                            statePaths.forEach(function (sp) { sp.classList.remove('is-selected'); });
                            p.classList.add('is-selected');
                            showTooltipFor(p.getAttribute('data-state-code'), p);
                        }
                    });
                }
            });
        }

        // Show default tooltip on California on initial load
        const defaultPath = mapSvg.querySelector('.state-path[data-state-code="CA"]');
        if (defaultPath) {
            showTooltipFor('CA', defaultPath);
        }
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initInteractiveMap);
    } else {
        initInteractiveMap();
    }
})();
