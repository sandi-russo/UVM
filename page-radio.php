<?php
/**
 * RADIO
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package UNIVERSOME
 */

get_header();

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

<main class="custom-background">
    <div class="other_site_container">

        <header class="page-header">
            <div class="site_container">
                <div>
                    <h2 class="titolo-pagina">RADIO UVM</h2>
                    <p class="descrizione-pagina">Radio ufficiale degli Studenti Unime!</p>
                    <div>
                        <p class="text-p">Radio UniVersoMe è la radio ufficiale dell’Università degli Studi di Messina.
                            On Air per la
                            prima volta il 30 Marzo 2016, RadioUVM è uno dei due canali del progetto UniVersoMe, una
                            testata multiforme composta da un giornale ed una web radio. Quest’ultima è un mezzo di
                            comunicazione che affianca alla divulgazione informativa musica ed intrattenimento. RadioUVM
                            rappresenta l’interfaccia tra lo studente e il suo ateneo. Cosa stai aspettando? Ascolta
                            Radio UniVersoMe, la voce degli studenti UniMe.</p>
                    </div>
                </div>
            </div>
        </header><!-- .page-header -->
        <iframe class="radiouvm" src="https://radiouvm.unime.it/public/universome/embed?theme=dark"
            frameborder="0"></iframe>
    </div>



</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>