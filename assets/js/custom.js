/* SPOTIFY */
const clientId = 'badf08cb27534405ae65a9c5feffb686';
const clientSecret = 'dd0dfa1d8be64b6983b5e8edbde5581b';

let isPlaying = false;
let audio = new Audio();

async function getAccessToken() {
    const result = await fetch('https://accounts.spotify.com/api/token', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Authorization': 'Basic ' + btoa(clientId + ':' + clientSecret)
        },
        body: 'grant_type=client_credentials'
    });
    const data = await result.json();
    return data.access_token;
}

async function getLatestEpisode(showId) {
    const token = await getAccessToken();
    const result = await fetch(`https://api.spotify.com/v1/shows/${showId}/episodes?limit=1&market=IT`, {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token
        }
    });
    const episodeData = await result.json();
    return episodeData.items[0];
}

async function getPodcastInfo(showId) {
    const token = await getAccessToken();
    const result = await fetch(`https://api.spotify.com/v1/shows/${showId}`, {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token
        }
    });
    const podcastData = await result.json();
    return podcastData;
}

async function displayLatestEpisode() {
    const episode = await getLatestEpisode('5J3Ai6sP7r89LG6d8HaAOe');
    const podcast = await getPodcastInfo('5J3Ai6sP7r89LG6d8HaAOe');

    document.getElementById('episode-cover').src = episode.images[0].url;
    document.getElementById('episode-title').textContent = episode.name;
    // document.getElementById('podcast-name').textContent = podcast.name;
    document.getElementById('episode-date').textContent = new Date(episode.release_date).toLocaleDateString('it-IT');

    // Aggiungiamo un pulsante per aprire l'episodio completo su Spotify
    const openInSpotifyBtn = document.createElement('a');
    openInSpotifyBtn.href = episode.external_urls.spotify;
    openInSpotifyBtn.target = '_blank';
    openInSpotifyBtn.textContent = 'Ascolta su Spotify';
    openInSpotifyBtn.className = 'spotify-button';
    document.querySelector('.info').appendChild(openInSpotifyBtn);

    // Continuiamo a usare l'anteprima per la riproduzione in-page
    audio.src = episode.audio_preview_url;

    setupAudioControls();
    checkOverflow();
}

function setupAudioControls() {
    const progressSlider = document.getElementById('progress-slider');
    const currentTimeDisplay = document.getElementById('current-time');
    const durationDisplay = document.getElementById('duration');

    audio.addEventListener('loadedmetadata', () => {
        progressSlider.max = audio.duration;
        durationDisplay.textContent = formatTime(audio.duration);
    });

    audio.addEventListener('timeupdate', () => {
        progressSlider.value = audio.currentTime;
        currentTimeDisplay.textContent = formatTime(audio.currentTime);
    });

    progressSlider.addEventListener('input', () => {
        audio.currentTime = progressSlider.value;
    });
}

function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}`;
}

function togglePlayPause() {
    const playPauseBtn = document.getElementById('play-pause-btn');

    if (isPlaying) {
        playPauseBtn.innerHTML = `
            <svg class="play-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path fill="currentColor" d="M18.54 9L8.88 3.46a3.42 3.42 0 0 0-5.13 3v11.12A3.42 3.42 0 0 0 7.17 21a3.43 3.43 0 0 0 1.71-.46L18.54 15a3.42 3.42 0 0 0 0-5.92Zm-1 4.19l-9.66 5.62a1.44 1.44 0 0 1-1.42 0a1.42 1.42 0 0 1-.71-1.23V6.42a1.42 1.42 0 0 1 .71-1.23A1.5 1.5 0 0 1 7.17 5a1.54 1.54 0 0 1 .71.19l9.66 5.58a1.42 1.42 0 0 1 0 2.46Z"/>
            </svg>
        `;
        audio.pause();
    } else {
        playPauseBtn.innerHTML = `
            <svg class="play-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                    <rect width="4" height="14" x="6" y="5" rx="1"/>
                    <rect width="4" height="14" x="14" y="5" rx="1"/>
                </g>
            </svg>
        `;
        audio.play();
    }

    isPlaying = !isPlaying;
}

function checkOverflow() {
    const title = document.getElementById('episode-title');
    const container = document.querySelector('.scroll-container');

    if (title.offsetWidth > container.offsetWidth) {
        // Calcola la quantità di scrolling necessaria
        const scrollAmount = title.offsetWidth - container.offsetWidth;

        // Assicura che scrollAmount sia un valore positivo
        if (scrollAmount > 0) {
            // Imposta la variabile CSS con il valore calcolato
            container.style.setProperty('--scroll-width', `${scrollAmount}px`);

            // Aggiungi la classe per abilitare lo scorrimento
            title.classList.add('scroll');
        }
    } else {
        // Rimuovi la classe di scorrimento se non necessario
        title.classList.remove('scroll');
    }
}

// Chiama la funzione al caricamento e al resize
displayLatestEpisode();
window.addEventListener('resize', checkOverflow);

// Ricalcola ogni 15 secondi
setInterval(checkOverflow, 15000);

/* CALCOLO AUTOMATICO PADDING PER STICKY HEADER O NAVBAR MOBILE */
document.addEventListener("DOMContentLoaded", function () {
    var stickyHeader = document.querySelector('.navbar-top');
    var mobileLastModified = document.querySelector('.mobile-last-modified');
    var content = document.querySelector('.main');

    function adjustContentPadding() {
        var totalHeight = 0;

        // Verifica se siamo su uno schermo mobile (max 1024px)
        if (window.innerWidth <= 1024) {
            if (stickyHeader) {
                totalHeight += stickyHeader.offsetHeight; // Calcola l'altezza totale del sticky-header
            }
            if (mobileLastModified) {
                totalHeight += mobileLastModified.offsetHeight; // Aggiungi l'altezza di mobile-last-modified
            }

            // Applica il padding calcolato
            content.style.paddingTop = totalHeight + 'px';
        } else {
            // Rimuove il padding se la larghezza è > 1024px
            content.style.paddingTop = '';
        }
    }

    // Regola il padding al caricamento della pagina
    adjustContentPadding();

    // Ricalcola il padding se la finestra viene ridimensionata
    window.addEventListener('resize', adjustContentPadding);

    // Ricalcola il padding ogni 30 secondi
    setInterval(adjustContentPadding, 30000);
});


/* AZURACAST DESKTOP E MOBILE */
const apiUrl = 'https://radiouvm.unime.it/api/nowplaying';
const defaultImage = 'default_image.jpg';
const audioUrl = 'https://radiouvm.unime.it:8000/radio.mp3';
let audio_radio = new Audio(audioUrl);
let isPlaying_radio = false;

async function getNowPlaying() {
    try {
        const response = await fetch(apiUrl);
        if (!response.ok) {
            throw new Error('Errore di rete');
        }
        const data = await response.json();

        if (data.length > 0) {
            const nowPlaying = data[0].now_playing;
            const song = nowPlaying.song;

            // Aggiorna i metadati per entrambi i set di elementi
            updateElements('episode-title-azuracast', 'artist-name', 'album-art', song);
            updateElements('episode-title-azuracast_mobile', 'artist-name_mobile', 'album-art_mobile', song);
        } else {
            console.error('Impossibile collegarsi alla radio.');
        }
    } catch (error) {
        console.error('Errore nell\'estrazione dei dati:', error);
    }
}

function updateElements(titleId, artistId, artId, song) {
    document.getElementById(titleId).textContent = song.title || 'Titolo sconosciuto';
    document.getElementById(artistId).textContent = song.artist || 'Artista sconosciuto';
    document.getElementById(artId).src = song.art || defaultImage;
}

function togglePlay() {
    const desktopPlayButton = document.getElementById('play-button');
    const mobilePlayButton = document.getElementById('play-button-mobile');

    if (isPlaying_radio) {
        audio_radio.pause();
        updatePlayButtonState(desktopPlayButton, false);
        updatePlayButtonState(mobilePlayButton, false);
        isPlaying_radio = false;
    } else {
        audio_radio.play().catch(error => {
            console.error('Errore nella riproduzione:', error);
        });
        updatePlayButtonState(desktopPlayButton, true);
        updatePlayButtonState(mobilePlayButton, true);
        isPlaying_radio = true;
    }
}

function updatePlayButtonState(button, isPlaying) {
    if (!button) return;
    
    button.setAttribute('title', isPlaying ? 'Pause' : 'Play');
    button.innerHTML = isPlaying 
        ? `<svg class="play-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-width="2">
                    <rect width="4" height="14" x="6" y="5" rx="1"/>
                    <rect width="4" height="14" x="14" y="5" rx="1"/>
                </g>
            </svg>`
        : `<svg class="play-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path fill="currentColor" d="M18.54 9L8.88 3.46a3.42 3.42 0 0 0-5.13 3v11.12A3.42 3.42 0 0 0 7.17 21a3.43 3.43 0 0 0 1.71-.46L18.54 15a3.42 3.42 0 0 0 0-5.92Zm-1 4.19l-9.66 5.62a1.44 1.44 0 0 1-1.42 0a1.42 1.42 0 0 1-.71-1.23V6.42a1.42 1.42 0 0 1 .71-1.23A1.5 1.5 0 0 1 7.17 5a1.54 1.54 0 0 1 .71.19l9.66 5.58a1.42 1.42 0 0 1 0 2.46Z"/>
            </svg>`;
}

document.addEventListener('DOMContentLoaded', () => {
    // Aggiungi listener per entrambi i pulsanti
    const desktopPlayButton = document.getElementById('play-button');
    const mobilePlayButton = document.getElementById('play-button-mobile');

    if (desktopPlayButton) {
        desktopPlayButton.addEventListener('click', togglePlay);
    }

    if (mobilePlayButton) {
        mobilePlayButton.addEventListener('click', togglePlay);
    }

    getNowPlaying();
    setInterval(getNowPlaying, 5000);
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
                                var resultHTML = '<div class="card-home-other">';
                                if (result.image) {
                                    resultHTML += '<a href="' + result.link + '"><img src="' + result.image + '" class="card_img" /></a>';
                                }
                                resultHTML += '<div class="card_background">';
                                resultHTML += '<h3 class="card_title"><a href="' + result.link + '">' + result.title + '</a></h3>';
                                resultHTML += '</div>';
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

    new Swiper('.radio-sidebar', {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.radio-sidebar-next',
            prevEl: '.radio-sidebar-prev',
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


document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('scroll', function () {
        const shareButton = document.querySelector('.radio-uvm-button-container');
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
    const sidebar = document.querySelector('.sidebar');
    const sidebarSidebar = document.querySelector('.single_sidebar');
    const sticky = navbar.offsetTop;
    const placeholder = document.createElement('div');
    placeholder.style.height = `${navbar.offsetHeight}px`;

    function adjustSidebarTop() {
        const navbarHeight = navbar.offsetHeight;
        if (navbar.classList.contains('fixed-navbar')) {
            if (sidebar) {
                sidebar.style.top = (navbarHeight + 'px');
            }
            if (sidebarSidebar) {
                sidebarSidebar.style.top = (navbarHeight + 'px');
            }
        } else {
            if (sidebar) {
                sidebar.style.top = '0';
            }
            if (sidebarSidebar) {
                sidebarSidebar.style.top = '0';
            }
        }
    }

    function checkSticky() {
        if (window.innerWidth > 1024) { // Applica lo sticky solo se la larghezza della finestra è maggiore di 1024px
            if (window.pageYOffset >= sticky) {
                if (!navbar.classList.contains("fixed-navbar")) {
                    navbar.classList.add("fixed-navbar");
                    navbar.parentNode.insertBefore(placeholder, navbar.nextSibling);
                    adjustSidebarTop();
                }
            } else {
                if (navbar.classList.contains("fixed-navbar")) {
                    navbar.classList.remove("fixed-navbar");
                    if (placeholder.parentNode) {
                        placeholder.parentNode.removeChild(placeholder);
                    }
                    adjustSidebarTop();
                }
            }
        } else {
            // Rimuovi la classe sticky e il placeholder
            if (navbar.classList.contains("fixed-navbar")) {
                navbar.classList.remove("fixed-navbar");
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
