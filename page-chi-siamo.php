<?php
/**
 * Il template per la visualizzazione della pagina "Chi Siamo"
 * (v5 - Query modificata per includere TUTTI i ruoli utente)
 */

get_header();
?>

<?php // Layout-full-width per rimuovere la sidebar ?>
	<div class="main-content-area container layout-full-width">
		<main class="main-content">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class('static-page-container'); ?>>

					<header class="page-header">
						<h1 class="page-title"><?php the_title(); ?></h1>
					</header>

					<?php // 1. CONTENUTO EDITABILE (per la tua introduzione/mission) ?>
					<div class="entry-content">
						<?php the_content(); ?>
					</div>

				</article>

			<?php endwhile; // Fine del loop. ?>


			<?php // 2. SEZIONE TEAM DINAMICA RAGGRUPPATA ?>
			<section class="team-section">

				<?php
				// 1. Definiamo l'ordine e i nomi delle unit
				$units_order = [
					'giornale'        => 'Giornale',
					'radio'           => 'Radio',
					'creativa_grafica' => 'Creativa / Grafica',
					'social'          => 'Social',
					'informatica'     => 'Informatica',
					'membro'          => 'Membri' // Gruppo di fallback
				];

				// 2. Pre-popoliamo l'array dei gruppi per mantenere l'ordine
				$grouped_users = array_fill_keys(array_keys($units_order), []);

				// 3. Facciamo una singola query per TUTTI gli utenti
				$user_query = new WP_User_Query([
					// --- MODIFICA: Rimuovendo 'role__in', li prende tutti ---
					'orderby'  => 'display_name',
					'number'   => -1 // Carica TUTTI gli utenti
				]);

				// 4. Ordiniamo gli utenti nei rispettivi gruppi
				if ( ! empty( $user_query->get_results() ) ) {
					foreach ( $user_query->get_results() as $user ) {
						$unit = get_user_meta( $user->ID, 'unit', true );

						// Logica di smistamento "TUTTI O NIENTE"
						// Controlliamo se ha una unit VALIDA e RICONOSCIUTA
						if ( !empty($unit) && array_key_exists( $unit, $grouped_users ) && $unit != 'membro' ) {
							// Se la unit è valida (es. 'giornale', 'radio')...
							$grouped_users[$unit][] = $user;
						} else {
							// Altrimenti (se è vuota, se è 'membro', o se è un valore non riconosciuto)
							// finisce nel gruppo di fallback 'membro'.
							$grouped_users['membro'][] = $user;
						}
					}
				}

				// 5. Avviamo il loop per mostrare i gruppi (SEGUENDO L'ORDINE DI $units_order)
				$has_members = false;
				foreach ( $units_order as $unit_key => $unit_name ) :

					$users_in_unit = $grouped_users[$unit_key];

					// Saltiamo la sezione se non ci sono utenti in questa unit
					if ( empty( $users_in_unit ) ) {
						continue;
					}
					$has_members = true; // Abbiamo trovato almeno un membro
					?>

					<?php // Titolo della Unit (es. "Giornale", "Membri") ?>
					<h2 class="team-section-subtitle"><?php echo esc_html( $unit_name ); ?></h2>

					<div class="team-grid">
						<?php
						// Inizia il loop degli utenti per QUESTA unit
						foreach ( $users_in_unit as $user ) :
							$author_id = $user->ID;
							$ruolo_key = get_user_meta( $author_id, 'ruolo_uvm', true );
							// Usiamo la funzione helper per avere il nome "bello"
							$ruolo_nome = uvm_format_role_name( $ruolo_key );
							?>
							<div class="team-member-card">

								<div class="team-member-avatar">
									<?php echo get_avatar( $author_id, 120 ); ?>
								</div>

								<h3 class="team-member-name"><?php echo esc_html( $user->display_name ); ?></h3>

								<?php // Mostra il ruolo come richiesto ?>
								<span class="team-member-role"><?php echo esc_html( $ruolo_nome ); ?></span>

							</div>
						<?php endforeach; // Fine loop utenti ?>
					</div>

				<?php endforeach; // Fine loop unit ?>

				<?php if (!$has_members) : // Fallback se la query non trova nessuno ?>
					<p>Informazioni sul team non ancora disponibili.</p>
				<?php endif; ?>

			</section>

		</main>
	</div>

<?php
get_footer();
?>