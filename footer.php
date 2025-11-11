<?php
/**
 * The template for displaying the footer (Final Optimized Version)
 */
?>

</main></div><footer class="site-footer" role="contentinfo">

    <?php /* --- ONDA SVG RIMOSSA --- */ ?>

    <div class="footer-content container">

        <div class="footer-column footer-column-main">
            <h3 class="footer-title">UniVersoMe</h3>
            <p class="footer-description">
                UniVersoMe è una testata giornalistica registrata presso il Tribunale di Messina n.11 del 2015.
            </p>
            <div class="footer-socials" aria-label="Social media">
                <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Seguici su Facebook"><?php echo uvm_get_svg_icon('facebook'); ?></a>
                <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Iscriviti al nostro YouTube"><?php echo uvm_get_svg_icon('youtube'); ?></a>
                <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Seguici su Instagram"><?php echo uvm_get_svg_icon('instagram'); ?></a>
                <a href="#" target="_blank" rel="noopener noreferrer" aria-label="Ascoltaci su Spotify"><?php echo uvm_get_svg_icon('spotify'); ?></a>
            </div>
        </div>

        <div class="footer-column">
            <h3 class="footer-title">Link Utili</h3>
            <ul class="footer-links">
                <li><a href="<?php echo esc_url(home_url('/chi-siamo')); ?>">Chi Siamo</a></li>
                <li><a href="<?php echo esc_url(home_url('/cookie-policy-ue')); ?>">Cookie Policy (UE)</a></li>
                <li><a href="<?php echo esc_url(home_url('/terms-and-conditions')); ?>">Terms & Conditions</a></li>
                <?php // Aggiungi qui altri link se necessario ?>
            </ul>
        </div>

        <div class="footer-column">
            <h3 class="footer-title">Contatti</h3>
            <div class="footer-contact-list">
                <div class="contact-item">
                    <?php echo uvm_get_svg_icon('pin'); ?>
                    <span><b>Piazza Pugliatti, 1</b><br>98122 Messina ME</span>
                </div>
                <div class="contact-item">
                    <?php echo uvm_get_svg_icon('user'); ?>
                    <span>
                        <strong>Dir. Resp. Antonio Tavilla</strong><br>
                        <a href="mailto:atavilla@unime.it">atavilla@unime.it</a>
                    </span>
                </div>
                <div class="contact-item">
                    <?php echo uvm_get_svg_icon('user'); ?>
                    <span>
                        <strong>Coord. Progetto Gaetano Aspa</strong><br>
                        <a href="mailto:gaspa@unime.it">gaspa@unime.it</a>
                    </span>
                </div>
            </div>
        </div>

    </div>
</footer>

<div class="footer-bottom-bar">
    <div class="container">
        <span class="footer-text">
            Fatta con <span class="heart-icon"><?php echo uvm_get_svg_icon('heart'); ?></span> dalla UNIT Informatica © <?php echo date('Y'); ?>
        </span>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>