/**
 * Drive - Main JavaScript
 * Lightweight, Vanilla JavaScript, Performance-First
 */

(function () {
    'use strict';

    /**
     * Desktop Header State Dropdown Handler
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
     * Mobile State & Vehicle Modal Picker Handler (Replaces Hamburger)
     */
    function initMobileMenu() {
        const chipBtn = document.getElementById('mobileStateVehChip');
        const modal = document.getElementById('mobileStateVehModal');
        const closeBtn = document.getElementById('mobileModalClose');
        const backdrop = document.getElementById('mobileModalBackdrop');
        const searchInput = document.getElementById('mobileStateSearchInput');
        const stateLinks = modal ? modal.querySelectorAll('.mobile-modal-state-link') : [];
        const chipState = document.getElementById('headerChipState');

        if (!chipBtn || !modal) {
            return;
        }

        function toggleModal(open) {
            const isOpen = typeof open === 'boolean' ? open : !modal.classList.contains('is-open');
            chipBtn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            modal.setAttribute('aria-hidden', isOpen ? 'false' : 'true');
            modal.classList.toggle('is-open', isOpen);
            if (isOpen) {
                document.body.style.overflow = 'hidden';
                if (searchInput) {
                    setTimeout(function () { searchInput.focus(); }, 150);
                }
            } else {
                document.body.style.overflow = '';
            }
        }

        chipBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            toggleModal();
        });

        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                toggleModal(false);
            });
        }

        if (backdrop) {
            backdrop.addEventListener('click', function () {
                toggleModal(false);
            });
        }

        // Close on Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) {
                toggleModal(false);
                chipBtn.focus();
            }
        });

        // Filter states in real-time
        if (searchInput && stateLinks.length) {
            searchInput.addEventListener('input', function () {
                const term = searchInput.value.trim().toLowerCase();
                stateLinks.forEach(function (link) {
                    const stName = (link.getAttribute('data-state-name') || '').toLowerCase();
                    const stCode = (link.getAttribute('data-state-code') || '').toLowerCase();
                    if (!term || stName.includes(term) || stCode.includes(term)) {
                        link.style.display = 'flex';
                    } else {
                        link.style.display = 'none';
                    }
                });
            });
        }

        // Update chip & save to localStorage on state link click
        stateLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                const stCode = link.getAttribute('data-state-code');
                const stSlug = link.getAttribute('data-state-slug');
                if (stCode && chipState) {
                    chipState.textContent = stCode;
                }
                if (stSlug) {
                    try {
                        localStorage.setItem('drive_selected_state', stSlug);
                    } catch (err) {}
                }
                toggleModal(false);
            });
        });

        // Save selected vehicle to localStorage
        const vehPills = modal.querySelectorAll('.mobile-modal-veh-btn');
        vehPills.forEach(function (pill) {
            pill.addEventListener('click', function () {
                const veh = pill.getAttribute('data-veh');
                if (veh) {
                    try {
                        localStorage.setItem('drive_selected_vehicle', veh);
                    } catch (err) {}
                }
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
     * How It Works Interactive Step Switcher
     */
    function initHowItWorks() {
        const stepCards = document.querySelectorAll('.how-step-card');
        const mockupPill = document.getElementById('how-mockup-step-pill');
        const segments = document.querySelectorAll('.timeline-segment');

        if (!stepCards.length) {
            return;
        }

        stepCards.forEach(function (card) {
            card.addEventListener('click', function () {
                const stepNum = card.getAttribute('data-step');
                const stepTitle = card.getAttribute('data-step-title');

                // Update active state on step cards
                stepCards.forEach(function (c) {
                    c.classList.remove('is-active');
                    c.setAttribute('aria-selected', 'false');
                });
                card.classList.add('is-active');
                card.setAttribute('aria-selected', 'true');

                // Update mockup pill tag
                if (mockupPill && stepTitle) {
                    mockupPill.textContent = stepTitle;
                }

                // Update bottom timeline segments
                if (segments.length && stepNum) {
                    segments.forEach(function (seg) {
                        const segNum = seg.getAttribute('data-step-seg');
                        if (parseInt(segNum, 10) <= parseInt(stepNum, 10)) {
                            seg.classList.add('is-active');
                        } else {
                            seg.classList.remove('is-active');
                        }
                    });
                }
            });
        });

        // Video Pause/Play Control
        const video = document.getElementById('howWalkthroughVideo');
        const toggleBtn = document.getElementById('btn-how-video-toggle');

        if (video && toggleBtn) {
            const pauseIcon = toggleBtn.querySelector('.icon-pause');
            const playIcon = toggleBtn.querySelector('.icon-play');

            toggleBtn.addEventListener('click', function () {
                if (video.paused) {
                    video.play();
                    if (pauseIcon) pauseIcon.style.display = 'block';
                    if (playIcon) playIcon.style.display = 'none';
                    toggleBtn.setAttribute('aria-label', 'Pause video walkthrough loop');
                } else {
                    video.pause();
                    if (pauseIcon) pauseIcon.style.display = 'none';
                    if (playIcon) playIcon.style.display = 'block';
                    toggleBtn.setAttribute('aria-label', 'Play video walkthrough loop');
                }
            });
        }
    }

    /**
     * Testimonials View More Expand Handler
     */
    function initTestimonials() {
        const viewMoreBtn = document.getElementById('btn-view-more-testimonials');
        const gridWrapper = document.getElementById('testimonials-grid-wrapper');

        if (!viewMoreBtn || !gridWrapper) {
            return;
        }

        viewMoreBtn.addEventListener('click', function () {
            const isExpanded = gridWrapper.classList.toggle('is-expanded');
            const labelSpan = viewMoreBtn.querySelector('.btn-label');
            if (labelSpan) {
                labelSpan.textContent = isExpanded ? 'VIEW LESS' : 'VIEW MORE';
            }
        });
    }

    /**
     * FAQ Accordion Handler (Single Active Item)
     */
    function initFaqAccordion() {
        const accordionItems = document.querySelectorAll('.faq-accordion-item');
        if (!accordionItems.length) {
            return;
        }

        accordionItems.forEach(function (item) {
            const btn = item.querySelector('.faq-question-btn');
            if (!btn) {
                return;
            }

            btn.addEventListener('click', function () {
                const isCurrentlyActive = item.classList.contains('is-active');

                // If clicking an active card, toggle it closed
                if (isCurrentlyActive) {
                    item.classList.remove('is-active');
                    btn.setAttribute('aria-expanded', 'false');
                } else {
                    // Gracefully close all other open FAQ cards
                    accordionItems.forEach(function (otherItem) {
                        if (otherItem !== item && otherItem.classList.contains('is-active')) {
                            otherItem.classList.remove('is-active');
                            const otherBtn = otherItem.querySelector('.faq-question-btn');
                            if (otherBtn) {
                                otherBtn.setAttribute('aria-expanded', 'false');
                            }
                        }
                    });

                    // Open clicked card
                    item.classList.add('is-active');
                    btn.setAttribute('aria-expanded', 'true');
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

    /**
     * Sticky Header Handler (Activates when user scrolls past the Hero section)
     */
    function initStickyHeader() {
        const header = document.getElementById('masthead') || document.querySelector('.site-header');
        if (!header) {
            return;
        }

        const hero = document.getElementById('hero');

        function checkScroll() {
            let triggerPoint = 300; // Fallback threshold if no hero element
            if (hero) {
                // Activate right as user reaches the end of the Hero section
                triggerPoint = hero.offsetTop + hero.offsetHeight - 60;
            }

            const currentScroll = window.scrollY || window.pageYOffset;
            if (currentScroll > triggerPoint) {
                if (!header.classList.contains('is-sticky')) {
                    header.classList.add('is-sticky');
                }
            } else {
                if (header.classList.contains('is-sticky')) {
                    header.classList.remove('is-sticky');
                }
            }
        }

        // Optimized scroll listener
        let ticking = false;
        window.addEventListener('scroll', function () {
            if (!ticking) {
                window.requestAnimationFrame(function () {
                    checkScroll();
                    ticking = false;
                });
                ticking = true;
            }
        }, { passive: true });

        // Initial check on load
        checkScroll();
    }

    // Initialize once DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function () {
            initHeaderControls();
            initMobileMenu();
            initStickyHeader();
            initHeroMockup();
            initHowItWorks();
            initTestimonials();
            initFaqAccordion();
            initSkipLinkFocus();
        });
    } else {
        initHeaderControls();
        initMobileMenu();
        initStickyHeader();
        initHeroMockup();
        initHowItWorks();
        initTestimonials();
        initFaqAccordion();
        initSkipLinkFocus();
    }
})();
