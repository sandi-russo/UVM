<?php
/**
 * RADIO
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package UNIVERSOME
 */

get_header();
?>


<?php
$programs = [
    [
        'title' => 'UniVersoGol',
        'image' => 'UNIVERSOGOL.jpg',
        'time' => 'Lunedì alle 15:30',
        'speakers' => 'Damiano La Fauci, Francesco Lui',
        'description' => 'Vuoi essere costantemente aggiornato sulla Serie A, Europa League, Champions League e sulle due squadre peloritane? Sei nel posto giusto, ascolta UniVersoGol che porta la firma di Damiano La Fauci e Francesco Lui!'
    ],
    [
        'title' => 'Musicassetta',
        'image' => 'MUSICASSETTA.jpg',
        'time' => 'Martedì alle 17:00',
        'speakers' => ' Alessio Caruso, Michelangelo Billè',
        'description' => 'Musicassetta è un programma radio dove i nostri Spreaker raccontano un/una cantante o una band ripercorrendo la carriera e ritrovando tracce dimenticate o tormentoni.'
    ],
    [
        'title' => 'Let Me Change',
        'image' => 'LET_ME_CHANGE.jpg',
        'time' => 'Mercoledì alle 17:00',
        'speakers' => 'Dalila Grimaldi',
        'description' => 'LetMe Change tratta del sociale, di notizie e problemi che ci toccano da vicino ma di cui si parla poco. Qui con ironia argomenti controversi trovano lo spazio che meritano.'
    ],
    [
        'title' => 'La Mente del Gaglioffo',
        'image' => 'LA_MENTE_DEL_GAGLIOFFO.jpg',
        'time' => 'Giovedì alle 15:30',
        'speakers' => 'Matteo Alfano, Francesco Lui',
        'description' => 'Podcast di Mr. FrankHe e Mr.Alfa, ironico ma serio, serio ma ironico, e soprattutto fa ridere ma fa anche riflettere. Ascolta le notizie più importanti in ambito politico, sociale, green, arte, musica e, perché no, pure sport!'
    ],
    [
        'title' => 'Troppo politico',
        'image' => 'TROPPO_POLITICO.jpg',
        'time' => 'Venerdì alle 19:00',
        'speakers' => 'Franz Moraci',
        'description' => 'Troppo Politico è il programma di attualità condotto da Franz Moraci. Tra buona musica e ospiti speciali, Troppo Politico sventra i fatti della settimana.'
    ]
];
?>


<div class="site_container min-h-screen py-8 px-4 sm:px-6 lg:px-8">
    <main id="primary" class="site-main mx-auto max-w-4xl">

        <header class="page-header mb-8">
            <div class="site_container">
                <div>
                    <div class="max-w-2xl mx-auto text-center">
                        <h2 class="titolo-pagina">RADIO UVM</h2>
                        <p class="descrizione-pagina">Inserire motto!</p>
                    </div>
                    <div>
                        <p class="text-p">Radio UniVersoMe è la radio ufficiale dell’Università degli Studi di Messina.
                            On Air per la
                            prima volta il 30 Marzo 2016, RadioUVM é uno dei due canali del progetto UniVersoMe, una
                            testata multiforme composta da un giornale ed una web radio. Quest’ultima è un mezzo di
                            comunicazione che affianca alla divulgazione informativa musica ed intrattenimento. RadioUVM
                            rappresenta l’interfaccia tra lo studente e il suo ateneo. Cosa stai aspettando? Ascolta
                            Radio UniVersoMe, la voce degli studenti UniMe.</p>
                    </div>
                </div>
            </div>
        </header><!-- .page-header -->

        <section class="radio-collection">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <?php foreach ($programs as $program): ?>
                        <div class="radio-content swiper-slide">
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/radio/<?php echo $program['image']; ?>"
                                alt="">
                            <div class="radio-text-content">
                                <h3><?php echo $program['title']; ?></h3>
                                <?php if (isset($program['time']) || isset($program['speakers'])): ?>
                                    <div class="radio-info">
                                        <?php if (isset($program['time'])): ?>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon">
                                                    <g fill="none">
                                                        <path
                                                            d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018m.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093q.019.005.029-.008l.004-.014l-.034-.614q-.005-.018-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01z" />
                                                        <path fill="currentColor"
                                                            d="M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12S6.477 2 12 2m0 2a8 8 0 1 0 0 16a8 8 0 0 0 0-16m0 2a1 1 0 0 1 .993.883L13 7v4.586l2.707 2.707a1 1 0 0 1-1.32 1.497l-.094-.083l-3-3a1 1 0 0 1-.284-.576L11 12V7a1 1 0 0 1 1-1" />
                                                    </g>
                                                </svg>
                                                <?php echo $program['time']; ?>
                                            </span>
                                        <?php endif; ?>
                                        <?php if (isset($program['speakers'])): ?>
                                            <span>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="icon">
                                                    <path fill="currentColor"
                                                        d="M17 18.25v3.25H7v-3.25c0-1.38 2.24-2.5 5-2.5s5 1.12 5 2.5M12 5.5a6.5 6.5 0 0 1 6.5 6.5c0 1.25-.35 2.42-.96 3.41L16 14.04c.32-.61.5-1.31.5-2.04c0-2.5-2-4.5-4.5-4.5s-4.5 2-4.5 4.5c0 .73.18 1.43.5 2.04l-1.54 1.37c-.61-.99-.96-2.16-.96-3.41A6.5 6.5 0 0 1 12 5.5m0-4A10.5 10.5 0 0 1 22.5 12c0 2.28-.73 4.39-1.96 6.11l-1.5-1.35c.92-1.36 1.46-3 1.46-4.76A8.5 8.5 0 0 0 12 3.5A8.5 8.5 0 0 0 3.5 12c0 1.76.54 3.4 1.46 4.76l-1.5 1.35A10.47 10.47 0 0 1 1.5 12A10.5 10.5 0 0 1 12 1.5m0 8a2.5 2.5 0 0 1 2.5 2.5a2.5 2.5 0 0 1-2.5 2.5A2.5 2.5 0 0 1 9.5 12A2.5 2.5 0 0 1 12 9.5" />
                                                </svg>
                                                <?php echo $program['speakers']; ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <p><?php echo $program['description']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <div class="radio-grid-container">
            <!-- YouTube iframe -->
            <div class="radio-youtube-container">
                <?php echo radio_youtube_embedded(); ?>
            </div>

            <div class="radio-divider"></div> <!-- Linea divisoria grigia chiara -->

            <!-- Spotify iframe -->
            <div class="radio-spotify-container">
                <iframe class="radio-video-frame"
                    src="https://open.spotify.com/embed/show/5J3Ai6sP7r89LG6d8HaAOe?utm_source=generator"
                    frameborder="0" allowfullscreen=""
                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                    loading="lazy"></iframe>
            </div>
        </div>


</div>

</main><!-- #main -->
</div>

<?php
get_sidebar();
get_footer();