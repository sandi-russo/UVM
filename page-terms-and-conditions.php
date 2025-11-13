<?php
/**
 * Il template per la visualizzazione della pagina Termini e Condizioni
 * (Versione 2: Contenuto hard-coded in PHP)
 */

get_header();
?>

<?php // Layout-full-width per rimuovere la sidebar ?>
	<div class="main-content-area container layout-full-width">
		<main class="main-content">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('static-page-container'); ?>>

					<header class="page-header">
						<?php // Il titolo viene ancora preso dalla pagina WP per flessibilità ?>
						<h1 class="page-title"><?php the_title(); ?></h1>
					</header>

					<div class="entry-content">

						<?php // --- INIZIO CONTENUTO HARD-CODED --- ?>

						<p><em>I termini e le condizioni sono stati aggiornati l'ultima volta il 29 Settembre 2024</em></p>

						<h2>1. Introduzione</h2>
						<p>Questi Termini e Condizioni si applicano a questo sito web e alle transazioni relative ai nostri prodotti e servizi. Può essere vincolato da ulteriori contratti relativi alla tua relazione con noi o a qualsiasi prodotto o servizio che ricevi da noi. Se qualsiasi disposizione dei contratti aggiuntivi è in conflitto con qualsiasi disposizione di questi Termini, le disposizioni di questi contratti aggiuntivi controlleranno e prevarranno.</p>

						<h2>2. Vincolo</h2>
						<p>Registrandosi, accedendo o utilizzando in altro modo questo sito web, l'utente accetta di essere vincolato da questi Termini e condizioni di seguito riportati. Il semplice uso di questo sito web implica la conoscenza e l'accettazione di questi termini e condizioni. In alcuni casi particolari, possiamo anche chiederle di acconsentire esplicitamente.</p>

						<h2>3. Proprietà intellettuale</h2>
						<p>Noi o i nostri licenziatari possediamo e controlliamo tutti i diritti d'autore e gli altri diritti di proprietà intellettuale del sito web e i dati, le informazioni e le altre risorse visualizzate o accessibili all'interno del sito web.</p>

						<h3>3.1 Tutti i diritti sono riservati</h3>
						<p>A meno che il contenuto specifico non imponga diversamente, all'utente non viene concessa una licenza o qualsiasi altro diritto in base a diritti d'autore, marchi, brevetti o altri diritti di proprietà intellettuale. Ciò significa che non potrete utilizzare, copiare, riprodurre, eseguire, mostrare, distribuire, incorporare in qualsiasi mezzo elettronico, alterare, decompilare, trasferire, scaricare, trasmettere, monetizzare, vendere o commercializzare qualsiasi risorsa di questo sito web in qualsiasi forma, senza il nostro previo permesso scritto, tranne e solo nella misura in cui sia diversamente stabilito in regolamenti di legge obbligatori (come il diritto di citazione).</p>

						<h2>4. Proprietà di terzi</h2>
						<p>Il nostro sito web può includere collegamenti ipertestuali o altri riferimenti a siti web di altre parti. Non controlliamo o rivediamo il contenuto dei siti web di altre parti che sono collegati a questo sito web. I prodotti o i servizi offerti da altri siti web sono soggetti ai Termini e Condizioni applicabili di queste terze parti. Le opinioni espresse o il materiale che appare su questi siti web non sono necessariamente condivise o approvate da noi.</p>
						<p>Non saremo responsabili delle pratiche di privacy o del contenuto di questi siti. Lei sopporta tutti i rischi associati all'uso di questi siti web e di qualsiasi servizio di terzi collegato. Non accetteremo alcuna responsabilità per eventuali perdite o danni in qualsiasi modo, comunque causati, derivanti dalla vostra divulgazione a terzi di informazioni personali.</p>

						<h2>5. Utilizzo responsabile</h2>
						<p>Visitando il nostro sito web, l'utente accetta di utilizzarlo solo per gli scopi previsti e come consentito da queste Condizioni, da qualsiasi contratto aggiuntivo con noi, e dalle leggi e dai regolamenti applicabili, nonché dalle pratiche online generalmente accettate e dalle linee guida del settore. Non può utilizzare il nostro sito web o i nostri servizi per utilizzare, pubblicare o distribuire qualsiasi materiale che consiste in (o è collegato a) software per computer dannosi; utilizzare i dati raccolti dal nostro sito web per qualsiasi attività di marketing diretto, o condurre qualsiasi attività di raccolta dati sistematica o automatizzata su o in relazione al nostro sito web.</p>
						<p>È severamente vietato intraprendere qualsiasi attività che causi, o possa causare, danni al sito web o che interferisca con le prestazioni, la disponibilità o l'accessibilità del sito web.</p>

						<h2>6. Presentazione di idee</h2>
						<p>Non presentare idee, invenzioni, opere d'autore o altre informazioni che possono essere considerate proprietà intellettuale propria che vorresti presentarci, a meno che non abbiamo prima firmato un accordo sulla proprietà intellettuale o un accordo di non divulgazione. Se ce lo riveli in assenza di tale accordo scritto, ci concedi una licenza mondiale, irrevocabile, non esclusiva, priva di royalty per utilizzare, riprodurre, memorizzare, adattare, pubblicare, tradurre e distribuire il tuo contenuto in qualsiasi media esistente o futuro.</p>

						<h2>7. Cessazione dell'uso</h2>
						<p>Possiamo, a nostra sola discrezione, in qualsiasi momento modificare o interrompere l'accesso, temporaneamente o permanentemente, al sito web o a qualsiasi servizio su di esso. Lei accetta che non saremo responsabili nei Suoi confronti o nei confronti di terzi per qualsiasi modifica, sospensione o interruzione del Suo accesso o uso del sito web o di qualsiasi contenuto che Lei possa aver condiviso sul sito web. Non avrà diritto ad alcun indennizzo o altro pagamento, anche se alcune caratteristiche, impostazioni, e/o qualsiasi Contenuto che lei ha contribuito o su cui ha fatto affidamento, sono permanentemente persi. Non può eludere o bypassare, o tentare di eludere o bypassare, qualsiasi misura di restrizione di accesso sul nostro sito web.</p>

						<h2>8. Garanzie e responsabilità</h2>
						<p>Niente in questa sezione limiterà o escluderà qualsiasi garanzia implicita per legge che sarebbe illegale limitare o escludere. Questo sito web e tutti i contenuti del sito web sono forniti su una base " così com'è " e " come disponibile " e possono includere imprecisioni o errori tipografici. Decliniamo espressamente tutte le garanzie di qualsiasi tipo, sia espresse che implicite, per quanto riguarda la disponibilità, l'accuratezza o la completezza del Contenuto. Non garantiamo che:</p>
						<ul>
							<li>questo sito web o i nostri contenuti soddisfino le vostre esigenze;</li>
							<li>questo sito web sarà disponibile in modo ininterrotto, tempestivo, sicuro o senza errori</li>
						</ul>
						<p>Nulla di questo sito web costituisce o è destinato a costituire una consulenza legale, finanziaria o medica di qualsiasi tipo. Se avete bisogno di consigli dovreste consultare un professionista appropriato.</p>
						<p>Le seguenti disposizioni di questa sezione si applicheranno nella misura massima consentita dalla legge applicabile e non limiteranno o escluderanno la nostra responsabilità in relazione a qualsiasi questione che sarebbe illegale o illegale per noi limitare o escludere la nostra responsabilità. In nessun caso saremo responsabili per qualsiasi danno diretto o indiretto (compresi i danni per la perdita di profitti o entrate, perdita o corruzione di dati, software o database, o perdita o danno alla proprietà o ai dati) sostenuti da voi o da qualsiasi terza parte, derivanti dal vostro accesso o uso del nostro sito web.</p>
						<p>Tranne nella misura in cui qualsiasi contratto aggiuntivo dichiara espressamente il contrario, la nostra massima responsabilità nei vostri confronti per tutti i danni derivanti da o relativi al sito web o a qualsiasi prodotto e servizio commercializzato o venduto attraverso il sito web, indipendentemente dalla forma di azione legale che impone la responsabilità (sia nel contratto, equità, negligenza, condotta intenzionale, torto o altro) sarà limitata al prezzo totale che avete pagato a noi per acquistare tali prodotti o servizi o utilizzare il sito web. Tale limite si applicherà nel complesso a tutti i vostri reclami, azioni e cause di azione di ogni tipo e natura.</p>

						<h2>9. Privacy</h2>
						<p>Per accedere al nostro sito web e/o ai nostri servizi, ti può essere richiesto di fornire alcune informazioni su di te come parte del processo di registrazione. L'utente accetta che qualsiasi informazione fornita sia sempre accurata, corretta e aggiornata.</p>
						<p>Abbiamo sviluppato una politica per affrontare qualsiasi preoccupazione sulla privacy che potresti avere. Per ulteriori informazioni, si prega di consultare la nostra <a href="<?php echo esc_url( home_url( '/cookie-policy-ue' ) ); ?>">Privacy Statement</a> e la nostra <a href="<?php echo esc_url( home_url( '/cookie-policy-ue' ) ); ?>">Cookie Policy</a>.</p>

						<h2>10. Restrizioni all'esportazione / Conformità legale</h2>
						<p>L'accesso al sito web da territori o paesi in cui il Contenuto o l'acquisto di prodotti o Servizi venduti sul sito web è illegale è proibito. Non può utilizzare questo sito web in violazione delle leggi e dei regolamenti sull'esportazione di Italia.</p>

						<h2>11. Assegnazione</h2>
						<p>Non può assegnare, trasferire o subappaltare nessuno dei Suoi diritti e/o obblighi ai sensi di questi Termini e condizioni, in tutto o in parte, a terzi senza il nostro previo consenso scritto. Qualsiasi presunta assegnazione in violazione di questa Sezione sarà nulla.</p>

						<h2>12. Violazioni di questi termini e condizioni</h2>
						<p>Senza pregiudicare gli altri nostri diritti ai sensi di questi Termini e Condizioni, se l'utente viola questi Termini e Condizioni in qualsiasi modo, possiamo intraprendere le azioni che riteniamo appropriate per affrontare la violazione, compresa la sospensione temporanea o permanente del suo accesso al sito web, contattando il suo provider di servizi Internet per richiedere che blocchi il suo accesso al sito web, e/o avviare un'azione legale contro l'utente.</p>

						<h2>13. Indennizzo</h2>
						<p>Lei accetta di indennizzare, difendere e manlevare noi, da e contro qualsiasi reclamo, responsabilità, danni, perdite e spese, relative alla sua violazione di questi termini e condizioni, e le leggi applicabili, compresi i diritti di proprietà intellettuale e diritti di privacy. Ci rimborserà prontamente per i nostri danni, perdite, costi e spese relativi a o o derivanti da tali reclami.</p>

						<h2>14. Rinuncia</h2>
						<p>La mancata applicazione di una qualsiasi delle disposizioni stabilite in questi Termini e Condizioni e in qualsiasi Accordo, o il mancato esercizio di qualsiasi opzione di rescissione, non deve essere interpretata come una rinuncia a tali disposizioni e non pregiudica la validità di questi Termini e Condizioni o di qualsiasi Accordo o parte di esso, o il diritto successivo di applicare ogni singola disposizione.</p>

						<h2>15. Lingua</h2>
						<p>Questi Termini e Condizioni saranno interpretati e intesi esclusivamente in Italiano. Tutti gli avvisi e la corrispondenza saranno scritti esclusivamente in quella lingua.</p>

						<h2>16. Accordo integrale</h2>
						<p>Questi Termini e condizioni, insieme alla nostra <a href="<?php echo esc_url( home_url( '/cookie-policy-ue' ) ); ?>">privacy statement</a> e <a href="<?php echo esc_url( home_url( '/cookie-policy-ue' ) ); ?>">cookie policy</a>, costituiscono l'intero accordo tra voi e Università degli Studi di Messina in relazione al vostro uso di questo sito web.</p>

						<h2>17. Aggiornamento di questi termini e condizioni</h2>
						<p>Possiamo aggiornare questi Termini e Condizioni di volta in volta. La data indicata all'inizio di questi Termini e Condizioni è l'ultima data di revisione. Vi daremo un avviso scritto di qualsiasi modifica o aggiornamento, e i Termini e Condizioni rivisti diventeranno effettivi dalla data in cui vi daremo tale avviso. L'uso continuato di questo sito web in seguito alla pubblicazione di modifiche o aggiornamenti sarà considerato come una notifica della vostra accettazione di rispettare e di essere vincolati da questi Termini e Condizioni. Per richiedere una versione precedente di questi termini e condizioni, contattateci.</p>

						<h2>18. Scelta della legge e della giurisdizione</h2>
						<p>Questi Termini e Condizioni sono regolati dalle leggi di Italia. Qualsiasi controversia relativa ai presenti Termini e Condizioni sarà soggetta alla giurisdizione dei tribunali di Italia. Se una qualsiasi parte o disposizione di questi Termini e Condizioni è ritenuta da un tribunale o da un'altra autorità non valida e/o inapplicabile ai sensi della legge applicabile, tale parte o disposizione sarà modificata, eliminata e/o applicata nella misura massima consentita in modo da dare effetto all'intento di questi Termini e Condizioni. Le altre disposizioni non saranno interessate.</p>

						<h2>19. Informazioni di contatto</h2>
						<p>Questo sito web è di proprietà e gestito da Università degli Studi di Messina.</p>

						<?php // --- FINE CONTENUTO HARD-CODED --- ?>

					</div>

				</article>

			<?php endwhile; // Fine del loop. ?>

		</main>
	</div>

<?php
get_footer();
?>