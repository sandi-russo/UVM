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
