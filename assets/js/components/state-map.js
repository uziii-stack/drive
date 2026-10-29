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

        // Bottom Select & Continue Button + Custom Dropdown Integration
        const customWrapper = document.getElementById('customMapStateWrapper');
        const customTrigger = document.getElementById('customMapTrigger');
        const customTriggerText = document.getElementById('customMapTriggerText');
        const customMenu = document.getElementById('customMapMenu');
        const customSearch = document.getElementById('customMapSearch');
        const customOptions = customWrapper ? customWrapper.querySelectorAll('.custom-map-option') : [];

        function toggleCustomMapMenu(open) {
            if (!customWrapper || !customTrigger) return;
            const isOpen = typeof open === 'boolean' ? open : !customWrapper.classList.contains('is-open');
            customWrapper.classList.toggle('is-open', isOpen);
            customTrigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            if (isOpen && customSearch) {
                setTimeout(function () { customSearch.focus(); }, 50);
            }
        }

        if (customTrigger) {
            customTrigger.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();
                toggleCustomMapMenu();
            });
        }

        if (customSearch) {
            customSearch.addEventListener('input', function () {
                const q = customSearch.value.toLowerCase().trim();
                customOptions.forEach(function (opt) {
                    const name = opt.getAttribute('data-name') || '';
                    if (!q || name.indexOf(q) !== -1) {
                        opt.style.display = 'flex';
                    } else {
                        opt.style.display = 'none';
                    }
                });
            });

            customSearch.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }

        customOptions.forEach(function (opt) {
            opt.addEventListener('click', function (e) {
                e.stopPropagation();
                const val = opt.getAttribute('data-value');
                const name = opt.querySelector('.custom-map-option-name') ? opt.querySelector('.custom-map-option-name').textContent.trim() : '';

                customOptions.forEach(function (o) { o.classList.remove('is-selected'); });
                opt.classList.add('is-selected');

                if (customTriggerText) {
                    customTriggerText.textContent = name;
                }

                if (selectEl) {
                    selectEl.value = val;
                    // Trigger state preview on map
                    statePaths.forEach(function (p) {
                        if (p.getAttribute('data-state-name') === name) {
                            statePaths.forEach(function (sp) { sp.classList.remove('is-selected'); });
                            p.classList.add('is-selected');
                            showTooltipFor(p.getAttribute('data-state-code'), p);
                        }
                    });
                }

                toggleCustomMapMenu(false);
            });
        });

        document.addEventListener('click', function (e) {
            if (customWrapper && customWrapper.classList.contains('is-open') && !customWrapper.contains(e.target)) {
                toggleCustomMapMenu(false);
            }
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && customWrapper && customWrapper.classList.contains('is-open')) {
                toggleCustomMapMenu(false);
                if (customTrigger) customTrigger.focus();
            }
        });

        if (continueBtn && selectEl) {
            continueBtn.addEventListener('click', function () {
                const selectedUrl = selectEl.value;
                if (selectedUrl) {
                    window.location.href = selectedUrl;
                } else if (customTrigger) {
                    toggleCustomMapMenu(true);
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
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initInteractiveMap);
    } else {
        initInteractiveMap();
    }
})();
