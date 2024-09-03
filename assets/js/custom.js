/* LOGO NAVBAR */
window.addEventListener('DOMContentLoaded', () => {
    // Funzione per aggiornare la larghezza dello sfondo della navbar
    const updateNavbarBgWidth = () => {
        const logo = document.getElementById('logo');
        const navbarBg = document.querySelector('.navbar-bg');
        const windowWidth = window.innerWidth;

        if (windowWidth >= 1024) {
            if (logo && navbarBg) {
                // Calcola la larghezza del logo e la sua posizione
                const logoRect = logo.getBoundingClientRect();
                navbarBg.style.width = `${logoRect.right}px`;
            }
        } else {
            if (navbarBg) {
                // Ripristina la larghezza automatica quando lo schermo è <= 1024px
                navbarBg.style.width = 'auto';
            }
        }
        // console.log(`windowWidth: ${windowWidth}, navbarBg width: ${navbarBg.style.width}`);
    };

    // Esegui l'aggiornamento all'avvio
    updateNavbarBgWidth();

    // Aggiungi l'evento di resize per adattarsi ai cambiamenti di dimensione
    window.addEventListener('resize', updateNavbarBgWidth);
});

/* PADDING MOBILE NAVBAR */
document.addEventListener("DOMContentLoaded", function () {
    var header = document.querySelector('.navbar-top');
    var mobileLastModified = document.querySelector('.mobile-last-modified');
    var content = document.querySelector('main, .content, .primary-content .primary .site_container');

    function adjustContentPadding() {
        var headerHeight = header.offsetHeight;
        var mobileLastModifiedHeight = mobileLastModified ? mobileLastModified.offsetHeight : 0;
        var totalHeight = headerHeight + mobileLastModifiedHeight;

        if (window.innerWidth <= 1024) {
            content.style.paddingTop = totalHeight + 'px';
        } else {
            content.style.paddingTop = ''; // Rimuove il padding se la larghezza è > 1024px
        }
    }

    // Regola il padding al caricamento della pagina
    adjustContentPadding();

    // Ricalcola il padding se la finestra viene ridimensionata (utile per design responsivi)
    window.addEventListener('resize', adjustContentPadding);
});

/* CALCOLO AUTOMATICO PADDING DA LASCIARE PER LA STICKY HEADER */
document.addEventListener("DOMContentLoaded", function () {
    var header = document.querySelector('.sticky-header');
    var content = document.querySelector('main') || document.querySelector('.content') || document.querySelector('.primary-content .primary .site_container');

    function adjustContentPadding() {
        if (header && content) {
            var headerHeight = header.offsetHeight;

            if (window.innerWidth <= 1024) {
                content.style.paddingTop = headerHeight + 'px';
            } else {
                content.style.paddingTop = ''; // Rimuove il padding se la larghezza è >= 1024px
            }
        }
    }

    // Regola il padding al caricamento della pagina
    adjustContentPadding();

    // Ricalcola il padding se la finestra viene ridimensionata
    window.addEventListener('resize', adjustContentPadding);
});

/* SWIPER RADIO */
document.addEventListener('DOMContentLoaded', function () {
    // Controlla se esiste l'elemento Swiper
    if (document.querySelector('.mySwiper')) {
        var swiper = new Swiper(".mySwiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: window.innerWidth <= 768 ? 1.5 : 3,
            loop: true,
            coverflowEffect: {
                rotate: 0,
                stretch: 0,
                depth: 100,
                modifier: 2,
                slideShadows: true,
            },
            pagination: {
                el: ".swiper-pagination",
            },
        });

        // Riassegna il numero di slides visibili quando la finestra viene ridimensionata
        window.addEventListener('resize', function () {
            swiper.params.slidesPerView = window.innerWidth <= 768 ? 1.5 : 3;
            swiper.update();
        });

        // Funzione per impostare l'altezza delle card
        function adjustCardHeights() {
            const cards = document.querySelectorAll('.radio-text-content');
            let maxHeight = 0;

            // Calcola l'altezza massima tra tutte le card
            cards.forEach(card => {
                // Include il padding e i margini
                const computedStyle = window.getComputedStyle(card);
                const height = card.offsetHeight
                    + parseFloat(computedStyle.marginTop)
                    + parseFloat(computedStyle.marginBottom)
                maxHeight = Math.max(maxHeight, height);
            });

            // Imposta l'altezza massima a tutte le card
            cards.forEach(card => {
                card.style.height = `${maxHeight}px`;
            });
        }

        // Applica l'altezza dopo che il DOM è stato completamente caricato
        adjustCardHeights();

        // Ricalcola l'altezza quando la finestra viene ridimensionata
        window.addEventListener('resize', adjustCardHeights);
    }
});





/* LOGO NAVBAR MOBILE */
function checkScreenSize() {
    // Ottieni la larghezza della finestra del browser
    const screenWidth = window.innerWidth;

    // Seleziona l'elemento con la classe "navbar-logo"
    const logoElement = document.querySelector(".navbar-logo");

    if (screenWidth <= 1024) {
        // Rimuovi l'attributo "id" se la larghezza è minore o uguale a 1024px
        if (logoElement && logoElement.id === "logo") {
            logoElement.removeAttribute("id");
        }
    } else if (screenWidth > 1024) {
        // Aggiungi l'attributo "id" se la larghezza è maggiore di 1024px
        if (logoElement && !logoElement.id) {
            logoElement.id = "logo";
        }
    }
}

// Esegui la funzione al caricamento della pagina
window.addEventListener('load', checkScreenSize);

// Esegui la funzione al ridimensionamento della finestra
window.addEventListener('resize', checkScreenSize);





/* DATA E ORA NAVBAR */
function updateDateTime() {
    const now = new Date();

    // Ottieni il giorno della settimana in italiano
    const options = { weekday: 'long' };
    const weekday = now.toLocaleDateString('it-IT', options);

    // Ottieni la data nel formato "dd/mm/yyyy"
    const date = now.toLocaleDateString('it-IT');

    // Ottieni l'ora nel formato "hh:mm"
    const time = now.toLocaleTimeString('it-IT', {
        hour: '2-digit',
        minute: '2-digit'
    });

    // Utilizzo Unicode \u2022 (•)
    const dateTimeString = `${date} \u2022 ${time}`;

    // Aggiorna il contenuto dell'elemento con id "current-date-time"
    document.getElementById('current-date-time').textContent = dateTimeString;
}

// Aggiorna data e ora all'avvio e poi ogni minuto
updateDateTime();
setInterval(updateDateTime, 60000);


/* CATEGORIE NAVBAR */
document.addEventListener('DOMContentLoaded', function () {
    const categoryItems = document.querySelectorAll('.category-item');

    categoryItems.forEach(item => {
        const link = item.querySelector('a');
        const subMenu = item.querySelector('.subcategory-menu');
        let hideTimeout;

        // Funzione per mostrare il subMenu
        function showSubMenu() {
            clearTimeout(hideTimeout);
            if (subMenu) {
                subMenu.style.display = 'block';
                subMenu.classList.add('visible');
            }
        }

        // Funzione per nascondere il subMenu
        function hideSubMenu() {
            hideTimeout = setTimeout(function () {
                if (subMenu) {
                    subMenu.classList.remove('visible');
                    setTimeout(() => {
                        subMenu.style.display = 'none';
                    }, 300); // Attende la fine della transizione prima di nascondere il menu
                }
            }, 500); // Ritardo di 500ms
        }

        // Gestisce il click sul link principale
        link.addEventListener('click', function (e) {
            if (subMenu) {
                e.preventDefault(); // Previene il comportamento predefinito
                window.location.href = this.href; // Naviga alla pagina della categoria padre
            }
        });

        // Gestisce l'hover sull'elemento principale
        item.addEventListener('mouseenter', function () {
            clearTimeout(hideTimeout); // Cancella eventuali timeout precedenti
            showSubMenu(); // Mostra il subMenu
        });

        item.addEventListener('mouseleave', function () {
            hideSubMenu(); // Nasconde il subMenu dopo un ritardo
        });

        // Gestisce l'hover sul subMenu
        if (subMenu) {
            subMenu.addEventListener('mouseenter', function () {
                clearTimeout(hideTimeout); // Cancella il timeout per evitare che il menu si chiuda
                showSubMenu(); // Mantiene il subMenu visibile
            });

            subMenu.addEventListener('mouseleave', function () {
                hideSubMenu(); // Nasconde il subMenu dopo un ritardo
            });
        }
    });
});


/* MOBILE MENU*/
document.addEventListener('DOMContentLoaded', function () {
    // Toggle del menu mobile
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMenu = document.getElementById('close-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

    mobileMenuButton.addEventListener('click', function () {
        mobileMenu.classList.remove('hidden');
        mobileMenu.classList.add('active');
        mobileMenuOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    function closeMenuFunc() {
        mobileMenu.classList.remove('active');
        mobileMenu.classList.add('hidden');
        mobileMenuOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    closeMenu.addEventListener('click', closeMenuFunc);
    mobileMenuOverlay.addEventListener('click', closeMenuFunc);
});


/* RICERCA MOBILE */
document.addEventListener('DOMContentLoaded', function () {
    // Toggle del menu mobile
    const mobileMenuButton = document.getElementById('mobile-search-button');
    const mobileMenu = document.getElementById('mobile-search');
    const closeMenu = document.getElementById('close-search');
    const mobileMenuOverlay = document.getElementById('mobile-search-overlay');

    mobileMenuButton.addEventListener('click', function () {
        mobileMenu.classList.remove('hidden', 'md:hidden');
        mobileMenu.classList.add('active');
        mobileMenuOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    function closeMenuFunc() {
        mobileMenu.classList.remove('active');
        mobileMenu.classList.add('hidden', 'md:hidden');
        mobileMenuOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    closeMenu.addEventListener('click', closeMenuFunc);
    mobileMenuOverlay.addEventListener('click', closeMenuFunc);
});



// Toggle della ricerca mobile
const mobileSearchButton = document.getElementById('mobile-search-button');
const mobileSearch = document.getElementById('mobile-search');

mobileSearchButton.addEventListener('click', () => {
    mobileSearch.classList.toggle('hidden');
});



/* RICERCA AJAX */
document.addEventListener("DOMContentLoaded", function () {
    var searchInput = document.getElementById('live-search');
    var resultsContainer = document.getElementById('search-results');
    var searchForm = searchInput.closest('form');

    searchInput.addEventListener('input', function () {
        var query = searchInput.value;

        if (query.length > 2) { // Avvia la ricerca solo se ci sono almeno 3 caratteri
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/wp-json/custom/v1/search/?query=' + encodeURIComponent(query), true); // Usa l'endpoint REST API personalizzato
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var results = JSON.parse(xhr.responseText);
                    resultsContainer.innerHTML = '';

                    if (results.length > 0) {
                        results.forEach(function (result) {
                            if (result.message) {
                                resultsContainer.innerHTML += '<p>' + result.message + '</p>';
                            } else {
                                var resultHTML = '<div class="search-card">';
                                if (result.image) {
                                    resultHTML += '<a href="' + result.link + '"><img src="' + result.image + '" class="search-card-image" /></a>';
                                }
                                resultHTML += '<h3 class="search-card-title"><a href="' + result.link + '">' + result.title + '</a></h3>';
                                resultHTML += '</div>';
                                resultsContainer.innerHTML += resultHTML;
                            }
                        });
                    } else {
                        resultsContainer.innerHTML = '<p>Nessun risultato trovato.</p>';
                    }
                } else {
                    resultsContainer.innerHTML = '<p>Errore nella ricerca. Riprova più tardi.</p>';
                }
            };
            xhr.onerror = function () {
                resultsContainer.innerHTML = '<p>Errore di connessione. Controlla la tua connessione internet.</p>';
            };
            xhr.send();
        } else {
            resultsContainer.innerHTML = '';
        }
    });

    // Gestisce il submit del form per la ricerca normale
    searchForm.addEventListener('submit', function (event) {
        if (searchInput.value.length > 2) {
            // Esegui la ricerca normale se il campo di ricerca non è vuoto
            return true;
        } else {
            event.preventDefault(); // Blocca la ricerca se il campo è vuoto o non ha abbastanza caratteri
        }
    });
});




/* RICERCA DESKTOP */
document.addEventListener('DOMContentLoaded', function () {
    const searchButton = document.getElementById('search-button');
    const mobileSearch = document.getElementById('mobile-search');
    const closeSearch = document.getElementById('close-search');
    const mobileSearchOverlay = document.getElementById('mobile-search-overlay');

    // Mostra la ricerca mobile quando l'icona di ricerca viene cliccata
    searchButton.addEventListener('click', function () {
        mobileSearch.classList.remove('hidden', 'md:hidden');
        mobileSearch.classList.add('active');
        mobileSearchOverlay.classList.add('active');
        document.body.style.overflow = 'hidden';
    });

    // Funzione per chiudere la ricerca mobile
    function closeSearchFunc() {
        mobileSearch.classList.remove('active');
        mobileSearch.classList.add('hidden', 'md:hidden');
        mobileSearchOverlay.classList.remove('active');
        document.body.style.overflow = '';
    }

    closeSearch.addEventListener('click', closeSearchFunc);
    mobileSearchOverlay.addEventListener('click', closeSearchFunc);
});









/* METEO MESSINA - OPENWEATHER*/
function fetchWeather() {
    const apiKey = 'b5f3e22f769ca30fcc07da47f31ea391';
    const url = `https://api.openweathermap.org/data/2.5/weather?lat=38.1938&lon=15.554&units=metric&lang=it&appid=${apiKey}`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Estrai la temperatura dalla proprietà main.temp
            const temp = Math.round(data.main.temp);

            // Estrai la descrizione dalla prima voce dell'array weather
            const description = data.weather[0].description;

            const weatherInfo = document.getElementById('weather-info');
            weatherInfo.textContent = `${temp}°C \u2022 ${description}`;
        })
        .catch(error => {
            console.error('Errore nel recupero dei dati meteo:', error);
            const weatherInfo = document.getElementById('weather-info');
            weatherInfo.textContent = 'Dati meteo non disponibili';
        });
}

// Esegui immediatamente e poi ogni 30 minuti
fetchWeather();
setInterval(fetchWeather, 30 * 60 * 1000);

/* CATEGORIE MOBILE */
document.addEventListener('DOMContentLoaded', function () {
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        const arrowIcon = item.querySelector('.arrow-icon');
        const submenu = item.querySelector('.submenu');
        const menuLink = item.querySelector('.menu-link');

        // Gestisci clic sulla freccia per aprire/chiudere il sottomenu
        if (arrowIcon && submenu) {
            arrowIcon.addEventListener('click', function (event) {
                // Impedisci la propagazione dell'evento al link principale
                event.stopPropagation();

                // Mostra o nascondi il sottomenu
                const isVisible = submenu.classList.contains('visible');

                // Nascondi tutti i sottomenu
                document.querySelectorAll('.submenu').forEach(menu => {
                    menu.classList.remove('visible');
                    menu.classList.add('hidden');
                    const otherArrowIcon = menu.previousElementSibling.querySelector('.arrow-icon');
                    if (otherArrowIcon) {
                        otherArrowIcon.style.transform = 'rotate(0deg)';
                    }
                });

                // Solo se il sottomenu era nascosto, mostra il corrente
                if (!isVisible) {
                    submenu.classList.remove('hidden');
                    submenu.classList.add('visible');
                    this.style.transform = 'rotate(180deg)';
                } else {
                    submenu.classList.add('hidden');
                    submenu.classList.remove('visible');
                    this.style.transform = 'rotate(0deg)';
                }
            });
        }

        // Gestisci clic sul link della categoria
        if (menuLink) {
            menuLink.addEventListener('click', function (event) {
                // Trova il sottomenu associato
                const submenu = this.nextElementSibling;

                // Solo se non ci sono sottocategorie (sottomenu) gestisce la navigazione
                if (!submenu || !submenu.classList.contains('submenu')) {
                    // Naviga al link della categoria principale
                    return;
                }

                // Se ci sono sottocategorie, previeni la navigazione
                event.preventDefault();
            });
        }
    });
});


/* SWIPER */
document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.news-carousel', {
        slidesPerView: 1,
        spaceBetween: 0,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
});


/* PULSANTE CONDIVISIONE ARTICOLO */
function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: window.location.href
        }).then(() => {
            console.log('Articolo condiviso con successo.');
        }).catch((error) => {
            console.error('Errore nella condivisione:', error);
        });
    } else {
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link copiato negli appunti.');
        }).catch((error) => {
            console.error('Errore nella copia del link:', error);
        });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('scroll', function () {
        const shareButton = document.querySelector('.fixed-share-button');
        if (!shareButton) {
            return; // Esci dalla funzione se l'elemento non è trovato
        }

        const scrollPosition = window.scrollY;
        const documentHeight = document.body.scrollHeight - window.innerHeight;
        const scrollPercentage = (scrollPosition / documentHeight) * 100;

        // Mostra il pulsante dopo aver scrolled oltre il 5% della pagina
        if (scrollPercentage > 5 && scrollPercentage < 95) {
            shareButton.classList.add('visible');
        } else {
            shareButton.classList.remove('visible');
        }
    });
});

/* PULSANTE PER TORNARE IN CIMA ALLA PAGINA */
document.addEventListener('scroll', function () {
    const backToTopButton = document.querySelector('.fixed-back-to-top');
    const scrollPosition = window.scrollY;
    const documentHeight = document.body.scrollHeight - window.innerHeight;
    const scrollPercentage = (scrollPosition / documentHeight) * 100;

    // Mostra il pulsante dopo aver scrolled oltre il 5% della pagina
    if (scrollPercentage > 5 && scrollPercentage < 95) {
        backToTopButton.classList.add('visible');
    } else {
        backToTopButton.classList.remove('visible');
    }
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}






/* STICKY NAVBAR */
document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("navbar-bottom");
    if (!navbar) {
        console.error('Elemento navbar non trovato');
        return; // Esci se l'elemento navbar non è trovato
    }

    const stickyLogo = navbar.querySelector('.sticky-logo');
    const sidebar = document.querySelector('.sidebar');
    const sticky = navbar.offsetTop;
    const placeholder = document.createElement('div');
    placeholder.style.height = `${navbar.offsetHeight}px`;

    function adjustSidebarTop() {
        if (navbar.classList.contains('fixed-navbar')) {
            const navbarHeight = navbar.offsetHeight;
            sidebar.style.top = navbarHeight + 'px';
        } else {
            sidebar.style.top = '0';
        }
    }

    function checkSticky() {
        if (window.pageYOffset >= sticky) {
            if (!navbar.classList.contains("fixed-navbar")) {
                navbar.classList.add("fixed-navbar");
                stickyLogo.style.display = 'block';
                navbar.parentNode.insertBefore(placeholder, navbar.nextSibling);
                adjustSidebarTop();
            }
        } else {
            if (navbar.classList.contains("fixed-navbar")) {
                navbar.classList.remove("fixed-navbar");
                stickyLogo.style.display = 'none';
                if (placeholder.parentNode) {
                    placeholder.parentNode.removeChild(placeholder);
                }
                adjustSidebarTop();
            }
        }
    }

    window.addEventListener('scroll', checkSticky);
    window.addEventListener('resize', function () {
        adjustSidebarTop();
        placeholder.style.height = `${navbar.offsetHeight}px`;
    });

    // Inizializza la posizione della sidebar e il controllo sticky
    checkSticky();
    adjustSidebarTop();
});


/* MESSAGGIO CONTACT FORM */
document.getElementById('contact-form').addEventListener('submit', function (e) {
    e.preventDefault();

    var formData = new FormData(this);
    var messageDiv = document.getElementById('form-message');

    fetch('send_email.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            messageDiv.style.display = 'block';
            if (data.success) {
                messageDiv.style.color = 'green';
                messageDiv.innerHTML = data.message;
                document.getElementById('contact-form').reset();
            } else {
                messageDiv.style.color = 'red';
                messageDiv.innerHTML = data.message || 'Si è verificato un errore durante l\'invio dell\'email.';
            }
        })
        .catch(error => {
            messageDiv.style.display = 'block';
            messageDiv.style.color = 'red';
            messageDiv.innerHTML = 'Si è verificato un errore durante l\'invio del messaggio.';
            console.error('Error:', error);
        });
});



