<?php
/**
 * Template 404 — Page introuvable (Soulful Brutalism BA)
 */
get_header();
?>

<main class="flex-1 w-full bg-[#0b0c10] text-slate-100 overflow-x-hidden">

    <section class="w-full py-24 md:py-36 nsibidi-bg border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">

            <div class="max-w-3xl space-y-8">

                <div class="font-mono-code text-xs text-[#1abc9c] font-bold tracking-widest uppercase">
                    <?php baobab_e( '[ERREUR_404 // PAGE_INTROUVABLE]', '[ERROR_404 // PAGE_NOT_FOUND]' ); ?>
                </div>

                <p class="font-mono-code text-7xl sm:text-9xl font-black text-[#6c3483] leading-none select-none">
                    404
                </p>

                <h1 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase tracking-tight leading-tight">
                    <?php baobab_e( "CETTE PAGE N'EXISTE PAS.", "THIS PAGE DOESN'T EXIST." ); ?>
                </h1>

                <p class="font-sans text-slate-300 text-lg max-w-2xl leading-relaxed">
                    <?php baobab_e(
                        'La page que vous cherchez a peut-être été déplacée, renommée ou n\'existe plus.',
                        'The page you are looking for may have been moved, renamed or no longer exists.'
                    ); ?>
                </p>

                <div class="flex flex-wrap gap-4 font-mono-code text-xs pt-2">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                       class="inline-flex items-center gap-2 px-6 py-3.5 bg-[#6c3483] text-white font-bold uppercase hover:bg-[#1abc9c] hover:text-black transition-all">
                        <span class="material-symbols-outlined text-base">home</span>
                        <?php baobab_e( "RETOUR À L'ACCUEIL", 'BACK TO HOME' ); ?>
                    </a>
                    <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>"
                       class="inline-flex items-center gap-2 px-6 py-3.5 border-2 border-[#262936] text-slate-200 font-bold uppercase hover:border-[#1abc9c] hover:text-[#00ffc4] transition-all">
                        <span class="material-symbols-outlined text-base">mail</span>
                        <?php baobab_e( 'NOUS CONTACTER', 'CONTACT US' ); ?>
                    </a>
                </div>

                <div class="border-t-2 border-[#262936] pt-6">
                    <p class="font-mono-code text-xs text-[#1abc9c] font-bold uppercase tracking-widest mb-3">
                        [INDEX_PAGES]
                    </p>
                    <div class="flex flex-wrap gap-x-6 gap-y-2 font-mono-code text-xs text-slate-300">
                        <a href="<?php echo esc_url( baobab_get_page_url( 'services' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">&gt; SERVICES</a>
                        <a href="<?php echo esc_url( baobab_get_page_url( 'case-studies' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">&gt; PORTFOLIO</a>
                        <a href="<?php echo esc_url( baobab_get_page_url( 'blog' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">&gt; BLOG</a>
                        <a href="<?php echo esc_url( baobab_get_page_url( 'about' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">&gt; <?php baobab_e( 'À PROPOS', 'ABOUT' ); ?></a>
                        <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" class="hover:text-[#00ffc4] transition-colors">&gt; <?php baobab_e( 'CONTACT', 'CONTACT' ); ?></a>
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>