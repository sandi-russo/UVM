<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.

 *
 * @package UNIVERSOME
 */

?>


 
<footer id="colophon" class="site-footer bg-white rounded-lg shadow dark:bg-gray-900 m-4">
    <div class="mx-auto w-full max-w-screen-xl p-4 py-6 lg:py-8">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="https://universome.unime.it/" class="flex items-center">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/UVM_LOGO.png" alt="Logo UVM" style="width: 20%;">
                </a>
            </div>
      <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
          <div class="sm:flex sm:items-center sm:justify-between">
        <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© <?php echo date("Y"); ?> <a href="https://universome.unime.it/" class="hover:underline">UniVersoMe™</a>. Tutti i diritti sono riservati.
    </span>
    <div class="flex mt-4 sm:justify-center sm:mt-0">
        <!--Icone Social-->
        <a href="https://www.facebook.com/UniVersoMessina" class="icon-link">
            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor" d="M8 6a6 6 0 0 1 6-6h5v6.5h-4v2h4.247L17.802 15H15v9H8v-9H4.25V8.5H8zm6-4a4 4 0 0 0-4 4v4.5H6.25V13H10v9h3v-9h3.198l.555-2.5H13v-4a2 2 0 0 1 2-2h2V2z" />
            </svg>
        </a>
        <a href="https://www.instagram.com/uvm_universome" class="icon-link ms-5">
            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path fill="currentColor" d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4a5.8 5.8 0 0 1-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8A5.8 5.8 0 0 1 7.8 2m-.2 2A3.6 3.6 0 0 0 4 7.6v8.8C4 18.39 5.61 20 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6C20 5.61 18.39 4 16.4 4zm9.65 1.5a1.25 1.25 0 0 1 1.25 1.25A1.25 1.25 0 0 1 17.25 8A1.25 1.25 0 0 1 16 6.75a1.25 1.25 0 0 1 1.25-1.25M12 7a5 5 0 0 1 5 5a5 5 0 0 1-5 5a5 5 0 0 1-5-5a5 5 0 0 1 5-5m0 2a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3" />
            </svg>
        </a>
        <a href="https://twitter.com/universomessina" class="icon-link ms-5">
            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                <path fill="currentColor" d="M9.294 6.928L14.357 1h-1.2L8.762 6.147L5.25 1H1.2l5.31 7.784L1.2 15h1.2l4.642-5.436L10.751 15h4.05zM7.651 8.852l-.538-.775L2.832 1.91h1.843l3.454 4.977l.538.775l4.491 6.47h-1.843z" />
            </svg>
        </a>
        <a href="https://open.spotify.com/show/1J8nrLau2QtjbMjFodeotT" class="icon-link ms-5">
            <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5">
                    <path d="M7 15s4.5-1 9 1m-9.5-4s6-1.5 11 1.5M6 9c3-.5 8-1 13 2" />
                    <path d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10s-4.477 10-10 10" />
                </g>
            </svg>
        </a>

          </div>
      </div>
    </div>
</footer>



</div><!-- #page -->
<?php wp_footer(); ?>

</body>

</html>