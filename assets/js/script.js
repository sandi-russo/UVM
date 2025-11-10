document.addEventListener('DOMContentLoaded', () => {

    // ===============================================
    // GESTIONE OVERLAYS (RICERCA E MENU MOBILE)
    // ===============================================
    const body = document.body;
    const initializeOverlay = (config) => {
        const { toggleSelector, overlaySelector, panelSelector, closeSelector, focusSelector } = config;
        const toggleButton = document.querySelector(toggleSelector);
        const overlayElement = document.querySelector(overlaySelector);
        const panelElement = document.querySelector(panelSelector);
        const closeButton = document.querySelector(closeSelector);
        const focusTarget = focusSelector ? document.querySelector(focusSelector) : null;

        if (!toggleButton || !overlayElement || !panelElement || !closeButton) {
            // Non blocca lo script, semplicemente non inizializza questo overlay
            // console.error(`Errore Overlay: uno o più elementi non trovati per "${overlaySelector}".`);
            return null;
        }

        const openOverlay = (event) => {
            event.preventDefault();
            body.style.overflow = 'hidden';
            overlayElement.classList.add('active');
        };
        const closeOverlay = () => {
            body.style.overflow = '';
            overlayElement.classList.remove('active');
        };
        const isActive = () => overlayElement.classList.contains('active');

        toggleButton.addEventListener('click', openOverlay);
        closeButton.addEventListener('click', closeOverlay);
        overlayElement.addEventListener('click', (e) => {
            if (e.target === overlayElement) closeOverlay();
        });
        if (focusTarget) {
            panelElement.addEventListener('transitionend', () => {
                if (isActive()) focusTarget.focus();
            });
        }
        return { close: closeOverlay, isActive };
    };

    const searchManager = initializeOverlay({
        toggleSelector: '.search-toggle',
        overlaySelector: '.search-overlay',
        panelSelector: '.search-container',
        closeSelector: '.search-close',
        focusSelector: '.search-form input[type="search"]'
    });

    const mobileNavManager = initializeOverlay({
        toggleSelector: '.mobile-toggle',
        overlaySelector: '.mobile-nav-overlay',
        panelSelector: '.mobile-nav-panel',
        closeSelector: '.mobile-nav-close'
    });

    // Gestore Eventi Globale per tasto ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            if (searchManager && searchManager.isActive()) {
                searchManager.close();
            }
            if (mobileNavManager && mobileNavManager.isActive()) {
                mobileNavManager.close();
            }
        }
    });

// ===============================================
    // INIZIALIZZAZIONE HERO SLIDER (SINGOLO, EFFETTO FADE)
    // ===============================================
    const heroSlider = document.querySelector('.hero-slider');
    if (heroSlider) {
        const swiper = new Swiper(heroSlider, {
            effect: 'fade', // Effetto dissolvenza
            fadeEffect: {
                crossFade: true
            },
            loop: true,
            centeredSlides: true,
            slidesPerView: 1, // Mostra solo 1 slide alla volta

            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            // Navigazione (frecce) disabilitata
            navigation: false,

            // Paginazione (pallini)
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }

    // ===============================================
    // ACCORDION PER SIDEBAR MOBILE
    // ===============================================
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebarContent = document.querySelector('.sidebar-content');
    if (sidebarToggle && sidebarContent) {
        sidebarToggle.addEventListener('click', () => {
            const isOpen = sidebarToggle.getAttribute('aria-expanded') === 'true';
            sidebarToggle.setAttribute('aria-expanded', !isOpen);
            sidebarContent.classList.toggle('is-open');
        });
    }

    // ===============================================
    // SOTTOMENU ACCORDION PER MENU MOBILE
    // ===============================================
    const mobileMenu = document.querySelector('.mobile-menu');
    if (mobileMenu) {
        const submenuToggles = mobileMenu.querySelectorAll('.submenu-toggle');
        submenuToggles.forEach(toggle => {
            toggle.addEventListener('click', (event) => {
                event.preventDefault(); // Impedisce al pulsante di fare altro
                const parentItem = toggle.closest('.menu-item-has-children');
                if (parentItem) {
                    parentItem.classList.toggle('submenu-is-open');
                    const isOpen = parentItem.classList.contains('submenu-is-open');
                    toggle.setAttribute('aria-expanded', isOpen);
                }
            });
        });
    }

});