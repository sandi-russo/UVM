document.addEventListener("DOMContentLoaded", function () {
    function updateTime() {
        const currentTimeElement = document.getElementById('current-time');
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        currentTimeElement.textContent = `${hours}:${minutes}`;
    }

    function updateDate() {
        const currentDateElement = document.getElementById('current-date-time');
        const now = new Date();
        const day = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-based
        const year = now.getFullYear();
        currentDateElement.textContent = `${day}/${month}/${year}`;
    }

    // Aggiorna l'ora immediatamente al caricamento della pagina
    updateTime();

    // Aggiorna l'ora ogni 30 secondi (30000 millisecondi)
    setInterval(updateTime, 30000);

    // Aggiorna la data immediatamente al caricamento della pagina
    updateDate();

    // Aggiorna la data ogni 30 secondi (30000 millisecondi)
    setInterval(updateDate, 30000);
});


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




// Funzione per aggiornare data e ora
function updateDateTime() {
    const now = new Date();
    const dateTimeString = now.toLocaleString('it-IT', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
    document.getElementById('current-date-time').textContent = dateTimeString;
}

// Aggiorna data e ora ogni minuto
updateDateTime();
setInterval(updateDateTime, 60000);

// Hambuger Menu
document.addEventListener('DOMContentLoaded', function () {
    // Toggle del menu mobile
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const closeMenu = document.getElementById('close-menu');
    const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');

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

// Ricerca mobile
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

/* CONDIVISIONE ARTICOLO */
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

/* Pulsante per condividere un articolo */
document.addEventListener('scroll', function () {
    const shareButton = document.querySelector('.fixed-share-button');
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

/* Pulsante per tornare in cima alla pagina */
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

/* Calcolo automatico padding da lasciare sotto la sticky header */
document.addEventListener("DOMContentLoaded", function() {
    var header = document.querySelector('.header');
    var content = document.querySelector('main, .content, .primary-content .primary .site_container');

    function adjustContentPadding() {
        var headerHeight = header.offsetHeight;

        if (window.innerWidth < 980) {
            content.style.paddingTop = headerHeight + 'px';
        } else {
            content.style.paddingTop = ''; // Rimuove il padding se la larghezza è >= 768px
        }
    }

    // Regola il padding al caricamento della pagina
    adjustContentPadding();

    // Ricalcola il padding se la finestra viene ridimensionata (utile per design responsivi)
    window.addEventListener('resize', adjustContentPadding);
});


/* Ricerca AJAX */
document.addEventListener("DOMContentLoaded", function() {
    var searchInput = document.getElementById('live-search');
    var resultsContainer = document.getElementById('search-results');
    var searchForm = searchInput.closest('form');

    searchInput.addEventListener('input', function() {
        var query = searchInput.value;

        if (query.length > 2) { // Avvia la ricerca solo se ci sono almeno 3 caratteri
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/wp-admin/admin-ajax.php?action=live_search&query=' + encodeURIComponent(query), true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    resultsContainer.innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        } else {
            resultsContainer.innerHTML = '';
        }
    });

    // Gestisce il submit del form per la ricerca normale
    searchForm.addEventListener('submit', function(event) {
        if (searchInput.value.length > 2) {
            // Esegui la ricerca normale se il campo di ricerca non è vuoto
            return true;
        } else {
            event.preventDefault(); // Blocca la ricerca se il campo è vuoto o non ha abbastanza caratteri
        }
    });
});

/* Sticky Header*/

window.onscroll = function () {
    var stickyHeader = document.getElementById("sticky-header");
    if (window.pageYOffset > 100) {
        stickyHeader.classList.add("show");
    } else {
        stickyHeader.classList.remove("show");
    }
};






















document.addEventListener('DOMContentLoaded', function() {
    const categoryItems = document.querySelectorAll('.category-item');

    categoryItems.forEach(item => {
        const link = item.querySelector('a');
        const submenu = item.querySelector('.subcategory-menu');

        if (submenu) {
            // Mostra il sottomenu al passaggio del mouse
            item.addEventListener('mouseenter', () => {
                submenu.classList.add('visible');
            });

            // Nasconde il sottomenu quando il mouse esce dall'elemento
            item.addEventListener('mouseleave', () => {
                // Usa un timeout per gestire il ritardo del nascondimento
                setTimeout(() => {
                    if (!submenu.matches(':hover') && !item.matches(':hover')) {
                        submenu.classList.remove('visible');
                    }
                }, 200); // Aggiungi un breve ritardo per evitare che scompaia subito
            });

            // Rimuovi il gestore dell'evento click, per permettere la navigazione
            // link.addEventListener('click', (e) => {
            //     if (window.innerWidth > 768) { // Solo per desktop
            //         e.preventDefault(); // Impedisce la navigazione solo su desktop
            //         submenu.classList.toggle('visible');
            //     }
            // });
        }
    });
});


