<?php
/*
 Template Name: Insight Page (Soulful Brutalism BA)
*/
get_header();
?>

<main class="flex-1 w-full bg-[#0b0c10] text-slate-100 overflow-x-hidden">

    <!-- ================================================
         1. HERO SECTION : INSIGHTS
         ================================================ -->
    <section class="w-full py-16 md:py-24 border-b-2 border-[#262936] bg-[#0b0c10] nsibidi-bg">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">

            <div class="max-w-3xl space-y-4">
                <div class="font-mono-code text-xs text-[#1abc9c] font-bold tracking-widest uppercase">
                    <?php baobab_e( '[INSIGHTS // ANALYSES_MÉTIER]', '[INSIGHTS // BUSINESS_ANALYSES]' ); ?>
                </div>

                <h1 class="font-grotesk font-black text-4xl sm:text-6xl lg:text-7xl text-white uppercase tracking-tight leading-none">
                    <?php echo esc_html( get_field( 'ins_title1' ) ?: 'INSIGHTS &' ); ?><br/>
                    <span class="text-[#1abc9c]"><?php echo esc_html( get_field( 'ins_title2' ) ?: 'PERSPECTIVES' ); ?></span>
                </h1>

                <p class="font-sans text-slate-300 text-lg leading-relaxed pt-4">
                    <?php echo esc_html( get_field( 'ins_subtitle' ) ?: baobab_t(
                        'Analyse stratégique sur la Cybersécurité, l\'Intelligence des données et l\'écosystème Tech africain.',
                        'Strategic analysis on Cybersecurity, Data Intelligence and the African tech ecosystem.'
                    ) ); ?>
                </p>
            </div>

        </div>
    </section>

    <!-- ================================================
         2. ARTICLES
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">

            <!-- Category Tabs — DYNAMIQUE -->
            <?php $insight_cats = get_categories( array( 'hide_empty' => false ) ); ?>
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 border-b-2 border-[#262936] pb-4 mb-12">
                <h2 class="font-grotesk font-black text-2xl sm:text-3xl text-white uppercase">
                    <?php baobab_e( 'DERNIÈRES', 'LATEST' ); ?><br/><span class="text-[#6c3483]"><?php baobab_e( 'ANALYSES.', 'ANALYSES.' ); ?></span>
                </h2>
                <div class="flex flex-wrap gap-x-8 gap-y-2 font-mono-code text-xs overflow-x-auto pb-px">

                    <a class="insight-tab border-b-2 border-[#1abc9c] text-white font-bold cursor-pointer pb-3"
                       data-cat="all">
                        <?php echo esc_html( get_field( 'ins_tab_all' ) ?: baobab_t( 'Tous les articles', 'All articles' ) ); ?>
                    </a>

                    <?php foreach ( $insight_cats as $cat ) : ?>
                    <a class="insight-tab border-b-2 border-transparent text-slate-400 hover:text-[#00ffc4] cursor-pointer pb-3 transition-colors"
                       data-cat="<?php echo esc_attr( $cat->slug ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                    </a>
                    <?php endforeach; ?>

                </div>
            </div>

            <!-- Featured Post — DYNAMIQUE -->
            <?php
            $featured_query = new WP_Query( array(
                'post_type'      => 'post',
                'posts_per_page' => 1,
                'lang'           => function_exists('pll_current_language') ? pll_current_language() : '',
                'meta_query'     => array(
                    array(
                        'key'     => 'insight_featured',
                        'value'   => '1',
                        'compare' => '=',
                    ),
                ),
            ) );
            ?>

            <?php if ( $featured_query->have_posts() ) :
                $featured_query->the_post();

                $gallery   = get_field( 'insight_gallery' );
                $main_img  = ! empty( $gallery ) ? $gallery[0] : '';
                $read_time = get_field( 'insight_read_time' ) ?: '5 MIN READ';
                $cats      = get_the_category();
                $cat_name  = ! empty( $cats ) ? $cats[0]->name : 'RESEARCH';
            ?>
            <div class="featured-post group relative grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-16 bg-[#12141a] border-2 border-[#6c3483] p-6 sm:p-10"
                 data-cat="<?php echo ! empty( $cats ) ? esc_attr( $cats[0]->slug ) : ''; ?>">

                <div class="lg:col-span-7 overflow-hidden border border-[#262936] bg-[#0b0c10]">
                    <?php if ( $main_img ) : ?>
                    <div class="aspect-[16/9] w-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                         style="background-image: url('<?php echo esc_url( $main_img ); ?>')"></div>
                    <?php else : ?>
                    <div class="aspect-[16/9] w-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-6xl text-[#262936]">article</span>
                    </div>
                    <?php endif; ?>
                </div>

                <div class="lg:col-span-5 flex flex-col justify-center space-y-4">
                    <div class="flex flex-wrap items-center gap-3 font-mono-code text-xs font-bold uppercase tracking-widest text-[#1abc9c]">
                        <span class="px-2 py-0.5 bg-[#6c3483] text-white"><?php echo esc_html( get_field( 'ins_featured_label' ) ?: baobab_t( 'À LA UNE', 'FEATURED' ) ); ?></span>
                        <span class="h-px w-8 bg-[#262936]"></span>
                        <span class="text-slate-400"><?php echo esc_html( $read_time ); ?></span>
                    </div>
                    <h2 class="font-grotesk font-black text-3xl md:text-4xl text-white uppercase leading-tight">
                        <?php the_title(); ?>
                    </h2>
                    <p class="font-sans text-slate-300 text-lg leading-relaxed">
                        <?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?>
                    </p>
                    <div class="pt-2">
                        <a href="<?php the_permalink(); ?>"
                           class="inline-flex items-center gap-2 font-mono-code text-xs font-bold text-[#1abc9c] group-hover:gap-4 transition-all">
                            <?php echo esc_html( get_field( 'ins_read_cta' ) ?: baobab_t( 'LIRE L\'ANALYSE COMPLÈTE', 'READ FULL ANALYSIS' ) ); ?>
                            <span class="material-symbols-outlined text-base">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php
                wp_reset_postdata();
            endif;
            ?>

            <!-- Latest Insights Grid — DYNAMIQUE -->
            <div>
                <div class="flex items-center justify-between mb-10 font-mono-code text-xs">
                    <h3 class="font-grotesk font-black text-xl text-white uppercase">
                        <?php echo esc_html( get_field( 'ins_grid_title' ) ?: baobab_t( 'Derniers Insights', 'Latest Insights' ) ); ?>
                    </h3>
                    <span class="text-[#1abc9c] font-bold">[ARCHIVE]</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="insights-grid">

                <?php
                $insights_query = new WP_Query( array(
                    'post_type'      => 'post',
                    'posts_per_page' => 9,
                    'lang'           => function_exists('pll_current_language') ? pll_current_language() : '',
                    'meta_query'     => array(
                        'relation' => 'OR',
                        array(
                            'key'     => 'insight_featured',
                            'value'   => '1',
                            'compare' => '!=',
                        ),
                        array(
                            'key'     => 'insight_featured',
                            'compare' => 'NOT EXISTS',
                        ),
                    ),
                ) );

                if ( $insights_query->have_posts() ) :
                    while ( $insights_query->have_posts() ) : $insights_query->the_post();

                        $gallery   = get_field( 'insight_gallery' );
                        $main_img  = ! empty( $gallery ) ? $gallery[0] : '';
                        $read_time = get_field( 'insight_read_time' ) ?: '5 MIN READ';
                        $cats      = get_the_category();
                        $cat_slug  = ! empty( $cats ) ? $cats[0]->slug : '';
                        $cat_name  = ! empty( $cats ) ? $cats[0]->name : '';
                ?>

                    <article class="flex flex-col space-y-4 group insight-card bg-[#12141a] border-2 border-[#262936] p-5 hover:border-[#1abc9c] transition-all"
                             data-cat="<?php echo esc_attr( $cat_slug ); ?>">

                        <a href="<?php the_permalink(); ?>">
                            <div class="aspect-[4/3] overflow-hidden border border-[#262936] bg-[#0b0c10]">
                                <?php if ( $main_img ) : ?>
                                <div class="h-full w-full bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                                     style="background-image: url('<?php echo esc_url( $main_img ); ?>')"></div>
                                <?php else : ?>
                                <div class="h-full w-full flex items-center justify-center">
                                    <span class="material-symbols-outlined text-5xl text-[#262936]">image</span>
                                </div>
                                <?php endif; ?>
                            </div>
                        </a>

                        <div class="space-y-2">
                            <div class="flex flex-wrap items-center gap-2 font-mono-code text-[11px] font-bold uppercase">
                                <span class="text-[#1abc9c]"><?php echo esc_html( $cat_name ); ?></span>
                                <span class="text-slate-500">•</span>
                                <span class="text-slate-400"><?php echo get_the_date( 'Y.m.d' ); ?></span>
                            </div>

                            <h4 class="font-grotesk font-black text-xl text-white uppercase leading-snug group-hover:text-[#00ffc4] transition-colors">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>

                            <p class="font-sans text-slate-300 text-sm leading-relaxed line-clamp-3">
                                <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                            </p>
                        </div>
                    </article>

                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <p class="font-sans text-slate-400 col-span-3 text-center py-12 border border-[#262936]">
                        <?php baobab_e( 'Aucun article trouvé.', 'No articles found.' ); ?>
                        <a href="<?php echo admin_url( 'post-new.php' ); ?>" class="text-[#1abc9c] underline"><?php baobab_e( 'Ajouter un article →', 'Add an article →' ); ?></a>
                    </p>
                <?php endif; ?>

                </div>

                <div class="mt-16 flex justify-center">
                    <button id="load-more-btn" class="px-8 py-3 border-2 border-[#6c3483] text-white font-mono-code text-xs font-bold uppercase hover:bg-[#6c3483] transition-all">
                        <?php echo esc_html( get_field( 'ins_load_more' ) ?: baobab_t( 'Charger plus d\'articles', 'Load more articles' ) ); ?>
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- ================================================
         3. NEWSLETTER
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#12141a] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            <div class="max-w-2xl mx-auto space-y-6 text-center">

                <div class="font-mono-code text-xs text-[#6c3483] font-bold uppercase tracking-widest">
                    <?php baobab_e( '[NEWSLETTER // BRIEFING_MENSUEL]', '[NEWSLETTER // MONTHLY_BRIEFING]' ); ?>
                </div>

                <h2 class="font-grotesk font-black text-3xl sm:text-4xl text-white uppercase">
                    <?php echo esc_html( get_field( 'ins_nl_title' ) ?: baobab_t( 'RESTEZ CONNECTÉ.', 'STAY CONNECTED.' ) ); ?>
                </h2>

                <p class="font-sans text-slate-300 text-sm leading-relaxed">
                    <?php echo esc_html( get_field( 'ins_nl_text' ) ?: baobab_t(
                        'Rejoignez les leaders tech qui reçoivent mon briefing mensuel sur la tech et la sécurité africaine.',
                        'Join tech leaders who receive my monthly briefing on African tech and security.'
                    ) ); ?>
                </p>

                <?php if ( isset( $_GET['newsletter'] ) && $_GET['newsletter'] === 'success' ) : ?>
                <div class="bg-[#0b0c10] border-2 border-[#1abc9c] text-[#00ffc4] font-mono-code text-xs font-bold rounded-none px-6 py-4">
                    ✓ <?php baobab_e( 'INSCRIPTION RÉUSSIE. MERCI !', 'SUBSCRIPTION SUCCESSFUL. THANK YOU!' ); ?>
                </div>
                <?php elseif ( isset( $_GET['newsletter'] ) && $_GET['newsletter'] === 'config' ) : ?>
                <div class="bg-[#0b0c10] border-2 border-[#6c3483] text-slate-200 font-mono-code text-xs font-bold rounded-none px-6 py-4">
                    ✗ <?php baobab_e( 'SERVICE D\'INSCRIPTION TEMPORAIREMENT INDISPONIBLE. RÉESSAYEZ PLUS TARD.', 'SUBSCRIPTION SERVICE TEMPORARILY UNAVAILABLE. PLEASE TRY AGAIN LATER.' ); ?>
                </div>
                <?php elseif ( isset( $_GET['newsletter'] ) && $_GET['newsletter'] === 'error' ) : ?>
                <div class="bg-[#0b0c10] border-2 border-[#6c3483] text-slate-200 font-mono-code text-xs font-bold rounded-none px-6 py-4">
                    ✗ <?php baobab_e( "ERREUR LORS DE L'INSCRIPTION. RÉESSAYEZ.", 'SUBSCRIPTION ERROR. PLEASE TRY AGAIN.' ); ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="" class="flex flex-col sm:flex-row gap-3 mt-8">
                    <?php wp_nonce_field( 'baobab_newsletter_submit', 'baobab_newsletter_nonce' ); ?>
                    <input
                        name="newsletter_email"
                        class="flex-1 bg-[#0b0c10] border-2 border-[#262936] px-4 py-3 text-white font-sans text-sm focus:border-[#1abc9c] focus:outline-none transition-colors"
                        placeholder="<?php echo esc_attr( get_field( 'ins_nl_placeholder' ) ?: baobab_t( 'Votre adresse email', 'Your email address' ) ); ?>"
                        type="email"
                        required />
                    <button class="bg-[#1abc9c] text-black font-mono-code text-xs font-bold uppercase px-8 py-3 hover:bg-[#00ffc4] border-2 border-[#1abc9c] transition-all" type="submit">
                        <?php echo esc_html( get_field( 'ins_nl_btn' ) ?: baobab_t( "S'abonner", 'Subscribe' ) ); ?>
                    </button>
                </form>

                <p class="font-mono-code text-[10px] text-slate-500"><?php echo esc_html( get_field( 'ins_nl_disclaimer' ) ?: baobab_t(
                        'Pas de spam. Seulement des insights de qualité. Désinscription à tout moment.',
                        'No spam. Only quality insights. Unsubscribe anytime.'
                    ) ); ?></p>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>