<?php
/*
 Template Name: Insight Page
*/
get_header();
?>

<main class="flex-1 w-full max-w-7xl mx-auto px-6 lg:px-20 py-12">

    <!-- Hero Section -->
    <div class="mb-16">
        <div class="max-w-3xl space-y-4">
            <h1 class="text-5xl md:text-6xl font-black tracking-tighter leading-none">
                Insights &amp;<br />
                <span class="text-slate-900">Perspectives</span>
            </h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl">
                Strategic analysis on Cybersecurity, Data Intelligence,
                and the evolving African Tech Ecosystem.
            </p>
        </div>

        <!-- Category Tabs — DYNAMIQUE -->
        <?php
        // get_categories() récupère toutes les catégories WordPress natives
        // 'hide_empty' => false = afficher même les catégories sans articles
        $insight_cats = get_categories( array( 'hide_empty' => false ) );
        ?>
        <div class="mt-12 flex flex-wrap border-b border-slate-200 gap-x-8 gap-y-2 overflow-x-auto pb-px">

            <!-- Onglet "All Posts" — actif par défaut -->
            <a class="insight-tab border-b-2 border-primary pb-4 text-sm font-bold cursor-pointer"
               data-cat="all">
                All Posts
            </a>

            <?php foreach ( $insight_cats as $cat ) : ?>
            <a class="insight-tab border-b-2 border-transparent pb-4 text-sm font-medium text-slate-500 hover:text-primary transition-colors cursor-pointer"
               data-cat="<?php echo esc_attr( $cat->slug ); ?>">
                <?php echo esc_html( $cat->name ); ?>
            </a>
            <?php endforeach; ?>

        </div>
    </div>

    <!-- Featured Post — DYNAMIQUE -->
    <?php
    // On cherche l'article avec insight_featured = 1
    // meta_query permet de filtrer par champ ACF
    $featured_query = new WP_Query( array(
        'post_type'      => 'post',
        'posts_per_page' => 1,
        'meta_query'     => array(
            array(
                'key'     => 'insight_featured', // Nom du champ ACF
                'value'   => '1',                // true = 1 en base de données
                'compare' => '=',
            ),
        ),
    ) );

    if ( $featured_query->have_posts() ) :
        $featured_query->the_post();

        // Récupère la galerie — premier élément = image principale
        $gallery   = get_field( 'insight_gallery' );
        $main_img  = ! empty( $gallery ) ? $gallery[0] : '';
        $read_time = get_field( 'insight_read_time' ) ?: '5 min read';

        // Récupère la première catégorie de l'article
        $cats     = get_the_category();
        $cat_name = ! empty( $cats ) ? $cats[0]->name : '';
    ?>
    <div class="group relative grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-32 featured-post"
         data-cat="<?php echo ! empty( $cats ) ? esc_attr( $cats[0]->slug ) : ''; ?>">

        <!-- Image -->
        <div class="lg:col-span-7 overflow-hidden rounded-xl bg-slate-200 bg-slate-50">
            <div class="aspect-[16/9] w-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                 style="background-image: url('<?php echo esc_url( $main_img ); ?>')">
            </div>
        </div>

        <!-- Contenu -->
        <div class="lg:col-span-5 flex flex-col justify-center space-y-4">
            <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-primary">
                <span>Featured Article</span>
                <span class="h-px w-8 bg-primary/30"></span>
                <span class="text-slate-500 dark:text-slate-400 uppercase">
                    <?php echo esc_html( $read_time ); ?>
                </span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold leading-tight">
                <?php the_title(); ?>
            </h2>
            <p class="text-slate-600 text-lg leading-relaxed text-slate-700">
                <?php echo wp_trim_words( get_the_excerpt(), 30, '...' ); ?>
                <!--
                    wp_trim_words() coupe le texte à 30 mots
                    et ajoute "..." à la fin
                    get_the_excerpt() = extrait de l'article
                -->
            </p>
            <div class="pt-4">
                <a href="<?php the_permalink(); ?>"
                   class="flex items-center gap-2 font-bold text-primary group-hover:gap-4 transition-all">
                    Read Full Analysis
                    <span class="material-symbols-outlined">arrow_forward</span>
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
        <div class="flex items-center justify-between mb-10">
            <h3 class="text-2xl font-bold text-slate-900">Latest Insights</h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="insights-grid">

        <?php
        // Récupère tous les articles sauf le featured
        // On exclut les articles avec insight_featured = 1
        $insights_query = new WP_Query( array(
            'post_type'      => 'post',
            'posts_per_page' => 9, // 9 articles max (3 lignes de 3)
            'meta_query'     => array(
                'relation' => 'OR', // OU logique : featured absent OU featured = 0
                array(
                    'key'     => 'insight_featured',
                    'value'   => '1',
                    'compare' => '!=',
                ),
                array(
                    'key'     => 'insight_featured',
                    'compare' => 'NOT EXISTS', // Champ pas encore rempli
                ),
            ),
        ) );

        if ( $insights_query->have_posts() ) :
            while ( $insights_query->have_posts() ) : $insights_query->the_post();

                $gallery   = get_field( 'insight_gallery' );
                $main_img  = ! empty( $gallery ) ? $gallery[0] : '';
                $read_time = get_field( 'insight_read_time' ) ?: '5 min read';
                $cats      = get_the_category();
                $cat_name  = ! empty( $cats ) ? $cats[0]->name : '';
                $cat_slug  = ! empty( $cats ) ? $cats[0]->slug : '';
        ?>

            <!-- Carte article -->
            <!-- data-cat = slug catégorie pour le filtre JS -->
            <article class="flex flex-col space-y-4 group insight-card"
                     data-cat="<?php echo esc_attr( $cat_slug ); ?>">

                <!-- Image principale (premier élément de la galerie) -->
                <a href="<?php the_permalink(); ?>">
                    <div class="aspect-[4/3] overflow-hidden rounded-xl bg-slate-200 dark:bg-primary/10">
                        <?php if ( $main_img ) : ?>
                        <div class="h-full w-full bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                             style="background-image: url('<?php echo esc_url( $main_img ); ?>')">
                        </div>
                        <?php else : ?>
                        <!-- Placeholder si pas d'image -->
                        <div class="h-full w-full flex items-center justify-center bg-slate-100">
                            <span class="material-symbols-outlined text-slate-300 text-5xl">image</span>
                        </div>
                        <?php endif; ?>
                    </div>
                </a>

                <div class="space-y-2">
                    <!-- Catégorie + Date -->
                    <div class="flex items-center gap-2 text-xs font-bold text-primary uppercase">
                        <span><?php echo esc_html( $cat_name ); ?></span>
                        <span class="text-slate-400">•</span>
                        <!-- the_date() affiche la date de publication formatée -->
                        <span class="text-slate-500">
                            <?php echo get_the_date( 'F j, Y' ); ?>
                        </span>
                    </div>

                    <!-- Titre -->
                    <h4 class="text-xl font-bold leading-snug group-hover:text-primary transition-colors text-slate-900">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h4>

                    <!-- Extrait -->
                    <p class="text-slate-600 text-sm line-clamp-3">
                        <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                    </p>
                </div>
            </article>

        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <p class="text-slate-400 col-span-3 text-center py-12">
                Aucun article trouvé.
                <a href="<?php echo admin_url( 'post-new.php' ); ?>" class="text-primary underline">
                    Ajouter un article →
                </a>
            </p>
        <?php endif; ?>

        </div>

        <!-- Load More -->
        <div class="mt-16 flex justify-center">
            <button id="load-more-btn" class="px-8 py-3 border-2 border-primary text-primary font-bold rounded-lg hover:bg-primary hover:text-white transition-all">
                Load More Articles
            </button>
        </div>
    </div>

</main>

<!-- Newsletter -->
<section class="bg-primary/5 py-20 mt-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-20 text-center">
        <div class="max-w-2xl mx-auto space-y-6">
            <h2 class="text-3xl font-bold">Subscribe to our Newsletter</h2>
            <p class="text-slate-600 dark:text-slate-400">
                Join 10,000+ technology leaders receiving our monthly briefing on African tech and security.
            </p>
            <form class="flex flex-col sm:flex-row gap-3 mt-8">
                <input
                    class="flex-1 rounded-lg border-slate-300 dark:border-primary/20 dark:bg-background-dark py-3 px-4 focus:ring-primary focus:border-primary bg-slate-50"
                    placeholder="Enter your email address"
                    type="email" />
                <button class="bg-primary text-white font-bold px-8 py-3 rounded-lg hover:opacity-90" type="submit">
                    Subscribe
                </button>
            </form>
            <p class="text-xs text-slate-500">No spam. Only high-signal insights. Unsubscribe at any time.</p>
        </div>
    </div>
</section>

<?php get_footer(); ?>