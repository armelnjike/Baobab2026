<footer class="mt-auto border-t-2 border-[#262936] bg-[#0b0c10] text-slate-300 font-mono-code text-xs">
    
    <!-- Top Footer Section -->
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 py-12 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
        
        <!-- Brand Info -->
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="px-2.5 py-1 bg-[#6c3483] border-2 border-[#1abc9c] font-bold text-white text-base">
                    ANJ
                </div>
                <span class="font-grotesk font-black text-white text-xl tracking-tight uppercase">
                    NYA NJIKE ARMEL
                </span>
            </div>
            <p class="text-slate-400 text-sm font-sans leading-relaxed">
                <?php baobab_e(
                    'Business Analyst Confirmé & Certifié CBAP® · L\'analyste qui comprend le client, le code et l\'architecture système technologique.',
                    'Certified Business Analyst & CBAP® · The analyst who understands the client, the code and the system architecture.'
                ); ?>
            </p>
        </div>

        <!-- Quick Nav -->
        <div class="space-y-3">
            <h4 class="text-[#1abc9c] font-bold tracking-widest uppercase mb-2">[INDEX_PAGES]</h4>
            <div class="grid grid-cols-2 gap-2 text-slate-300">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">> <?php baobab_e( 'ACCUEIL', 'HOME' ); ?></a>
                <a href="<?php echo esc_url( baobab_get_page_url( 'about' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">> <?php baobab_e( 'À PROPOS', 'ABOUT' ); ?></a>
                <a href="<?php echo esc_url( baobab_get_page_url( 'services' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">> <?php baobab_e( 'SERVICES', 'SERVICES' ); ?></a>
                <a href="<?php echo esc_url( baobab_get_page_url( 'case-studies' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">> <?php baobab_e( 'ÉTUDES DE CAS', 'CASE STUDIES' ); ?></a>
                <a href="<?php echo esc_url( baobab_get_page_url( 'process' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">> <?php baobab_e( 'MÉTHODE', 'PROCESS' ); ?></a>
                <a href="<?php echo esc_url( baobab_get_page_url( 'blog' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">> <?php baobab_e( 'BLOG', 'BLOG' ); ?></a>
                <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">> <?php baobab_e( 'CONTACT', 'CONTACT' ); ?></a>
            </div>
        </div>

        <!-- Direct Channels -->
        <div class="space-y-3">
            <h4 class="text-[#6c3483] font-bold tracking-widest uppercase mb-2"><?php baobab_e( '[CANAUX_DIRECTS]', '[DIRECT_CHANNELS]' ); ?></h4>
            <div class="space-y-1.5 text-xs text-slate-300">
                <p class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#1abc9c] text-sm">call</span>
                    <a href="tel:+237676398049" class="hover:text-[#00ffc4] font-bold">+237 676 398 049</a>
                </p>
                <p class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#1abc9c] text-sm">mail</span>
                    <a href="mailto:armel.njike@yahoo.com" class="hover:text-[#00ffc4] font-bold underline">armel.njike@yahoo.com</a>
                </p>
                <p class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#1abc9c] text-sm">location_on</span>
                    <span><?php baobab_e( 'Yaoundé, Cameroun — dispo Douala', 'Yaoundé, Cameroon — based in Douala' ); ?></span>
                </p>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="space-y-3">
            <h4 class="text-[#1abc9c] font-bold tracking-widest uppercase mb-2"><?php baobab_e( '[NEWSLETTER]', '[NEWSLETTER]' ); ?></h4>
            <p class="text-slate-400 font-sans text-xs leading-relaxed">
                <?php baobab_e(
                    'Briefing mensuel — tech & sécurité africaine. Direct dans votre boîte mail.',
                    'Monthly briefing — African tech & security. Straight to your inbox.'
                ); ?>
            </p>

            <?php if ( isset( $_GET['newsletter'] ) && $_GET['newsletter'] === 'success' ) : ?>
            <p class="text-[#00ffc4] font-sans text-xs font-bold">✓ <?php baobab_e( 'INSCRIPTION RÉUSSIE. MERCI !', 'SUBSCRIPTION SUCCESSFUL. THANK YOU!' ); ?></p>
            <?php elseif ( isset( $_GET['newsletter'] ) && ( $_GET['newsletter'] === 'error' || $_GET['newsletter'] === 'config' ) ) : ?>
            <p class="text-slate-200 font-sans text-xs">✗ <?php baobab_e( "ERREUR LORS DE L'INSCRIPTION. RÉESSAYEZ.", 'SUBSCRIPTION ERROR. PLEASE TRY AGAIN.' ); ?></p>
            <?php endif; ?>

            <form method="POST" action="" class="flex flex-col sm:flex-row gap-2">
                <?php wp_nonce_field( 'baobab_newsletter_submit', 'baobab_newsletter_nonce' ); ?>
                <input
                    name="newsletter_email"
                    type="email"
                    required
                    placeholder="<?php echo esc_attr( baobab_t( 'Votre email', 'Your email' ) ); ?>"
                    class="flex-1 min-w-0 bg-[#0b0c10] border-2 border-[#262936] px-3 py-2 text-white font-sans text-xs focus:border-[#1abc9c] focus:outline-none transition-colors" />
                <button type="submit" class="bg-[#1abc9c] text-black font-bold uppercase px-5 py-2 text-xs hover:bg-[#00ffc4] border-2 border-[#1abc9c] transition-all shrink-0">
                    <?php echo esc_html( baobab_t( "S'ABONNER", 'SUBSCRIBE' ) ); ?>
                </button>
            </form>
            <p class="text-slate-500 font-mono-code text-[10px]"><?php baobab_e(
                'Pas de spam. Désinscription à tout moment.',
                'No spam. Unsubscribe anytime.'
            ); ?></p>
        </div>

    </div>

    <!-- Brutalist Bottom Bar -->
    <div class="bg-[#1abc9c] text-slate-950 font-bold px-4 py-3 border-t-2 border-[#1abc9c]">
        <div class="max-w-[1300px] mx-auto flex flex-col md:flex-row items-center justify-between gap-2 text-center md:text-left text-xs uppercase">
            <div>
                <?php baobab_e(
                    '© 2026 NYA NJIKE ARMEL // BUSINESS ANALYST CERTIFIÉ CBAP®',
                    '© 2026 NYA NJIKE ARMEL // CERTIFIED BUSINESS ANALYST CBAP®'
                ); ?>
            </div>
            <div class="flex items-center gap-4 text-[11px]">
                <span><?php baobab_e( 'LOC: YAOUNDÉ / DOUALA', 'LOC: YAOUNDÉ / DOUALA' ); ?></span>
                <span>|</span>
                <span><?php baobab_e( 'STATUT: DISPONIBLE', 'STATUS: AVAILABLE' ); ?></span>
            </div>
        </div>
    </div>

</footer>

</div><!-- /layout-container -->
</div><!-- /relative -->

<?php wp_footer(); ?>
</body>
</html>