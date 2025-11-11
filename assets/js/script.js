document.addEventListener('DOMContentLoaded', () => {

    // ===============================================
    // GESTIONE OVERLAYS (RICERCA E MENU MOBILE)
    // ===============================================
    const body = document.body;
    const initializeOverlay = (config) => {
        const {toggleSelector, overlaySelector, panelSelector, closeSelector, focusSelector} = config;
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
        return {close: closeOverlay, isActive};
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
// HERO SLIDER
// ===============================================
    const heroSlider = document.querySelector('.hero-slider');
    if (heroSlider) {
        // NOTA: Assicurati di aver caricato la libreria Swiper
        if (typeof Swiper !== 'undefined') {
            const swiper = new Swiper(heroSlider, {
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                loop: true,

                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },

                navigation: false,

                // Paginazione (pallini)
                pagination: false,
            });
        } else {
            console.warn('Libreria Swiper non trovata. Lo slider non funzionerà.');
        }
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
    // ALLINEAMENTO DINAMICO SIDEBAR
    // ===============================================

    // 1. Definiamo la funzione di allineamento
    function alignDynamicSidebar() {
        const sidebar = document.querySelector('.layout-with-sidebar > .sidebar');
        const playerCard = document.querySelector('.sidebar .spotify-player-card');

        // Resetta tutti gli stili dinamici prima di qualsiasi calcolo
        if (sidebar) {
            sidebar.style.marginTop = '';
        }
        if (playerCard) {
            playerCard.style.marginTop = '';
            playerCard.style.paddingTop = ''; // Resetta il padding-top dinamico
        }

        // Esegui solo su desktop (come da tuo CSS @media min-width: 1025px)
        if (window.innerWidth < 1025 || !sidebar) {
            return; // Esce se siamo su mobile/tablet
        }

        // Selettori comuni per desktop
        const mainContent = document.querySelector('.layout-with-sidebar > .main-content');

        if (document.body.classList.contains('home')) {
            // *** CASO HOME ***
            // Allinea l'INTERA sidebar alla prima card
            const targetElement = document.querySelector('.posts-section:first-of-type .card-post--hero');

            if (targetElement && mainContent) {
                const mainContentRect = mainContent.getBoundingClientRect();
                const targetRect = targetElement.getBoundingClientRect();
                const offset = Math.max(0, targetRect.top - mainContentRect.top);

                // Sposta l'intera sidebar
                sidebar.style.marginTop = offset + 'px';
            }

        } else if (document.body.classList.contains('single-post')) {
            // *** CASO ARTICOLO (LA TUA RICHIESTA) ***
            // Goal 1: Sidebar si allinea con main-content (già fatto resettando il margin)
            // Goal 2: Il *contenuto* del player si allinea con l'immagine.

            const heroImage = document.querySelector('.single-post-hero');

            if (playerCard && heroImage) {
                // Posizione Y (verticale) dell'inizio della sidebar (dove la card è attaccata)
                const sidebarRect = sidebar.getBoundingClientRect();
                // Posizione Y (verticale) dell'inizio dell'immagine nell'articolo
                const heroRect = heroImage.getBoundingClientRect();

                // Calcola la differenza
                // Questo è lo spazio vuoto che dobbiamo aggiungere *dentro* la card
                const offset = Math.max(0, heroRect.top - sidebarRect.top);

                // Applica questo spazio come PADDING-TOP alla card
                // Questo spinge in giù .spotify-player__header e .spotify-player__controls
                playerCard.style.paddingTop = offset + 'px';
            }
        }
        // Nelle altre pagine (es. archivi), non facciamo nulla,
        // la sidebar e la card restano allineate in alto.
    }

    // 2. Esegui la funzione una volta al caricamento del DOM
    alignDynamicSidebar();

    // 3. Esegui di nuovo se la finestra viene ridimensionata (con debounce)
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(alignDynamicSidebar, 100);
    });


    const mobileMenuToggles = document.querySelectorAll('.mobile-menu .submenu-toggle');
    mobileMenuToggles.forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            e.preventDefault(); // Impedisce al link genitore di scattare

            // Trova il <li> genitore
            const parentLi = toggle.closest('.menu-item-has-children');

            // Attiva/disattiva la classe che il tuo CSS già usa
            parentLi.classList.toggle('submenu-is-open');

            // Aggiorna l'attributo ARIA per l'accessibilità
            const isExpanded = parentLi.classList.contains('submenu-is-open');
            toggle.setAttribute('aria-expanded', isExpanded);
        });
    });
});