<?php
/*
 Template Name: Case-Study Page
*/
get_header();
?>

<!-- Case Studies - Light Theme -->

<main class="flex-1 max-w-7xl mx-auto w-full px-6 md:px-20 py-12">
    <!-- Hero Header -->
    <div class="mb-12">
        <h1 class="text-5xl font-black tracking-tight mb-4 text-primary">Case Studies</h1>
        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">
            A deep dive into how we solve complex engineering challenges and deliver measurable business impact through
            innovative digital solutions.
        </p>
    </div>

    <?php
    // --------------------------------------------------------
    // RÉCUPÉRATION DES CATÉGORIES POUR LES BOUTONS FILTRES
    // --------------------------------------------------------
    // get_terms() récupère tous les termes d'une taxonomie.
    // Ici on récupère toutes les catégories de 'case_category'.
    // 'hide_empty' => false = afficher même les catégories vides
    $categories = get_terms( array(
        'taxonomy'   => 'case_category',
        'hide_empty' => false,
    ) );
    ?>

    <!-- Filters -->
    <div class="flex flex-wrap items-center gap-3 mb-10 pb-6 border-b border-primary/10">
        <button class="filter-btn px-6 py-2 rounded-full bg-primary text-white text-sm font-bold shadow-sm" data-filter="all">
            All Work
        </button>
        
        <?php
        // On affiche un bouton par catégorie
        if ( ! is_wp_error( $categories ) && ! empty( $categories ) ) :
            foreach ( $categories as $cat ) :
            // $cat->slug  = identifiant URL (ex: "web", "ai")
            // $cat->name  = nom affiché (ex: "Web", "AI")
        ?>
        
        <button
            class="filter-btn px-6 py-2 rounded-full bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-all"
            data-filter="<?php echo esc_attr( $cat->slug ); ?>">
            <?php echo esc_html( $cat->name ); ?>
        </button>
        <?php
            endforeach;
        endif;
        ?>
    </div>

    <!-- Case Study Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12" id="cases-grid">
        <?php
    // --------------------------------------------------------
    // RÉCUPÉRATION DE TOUS LES CASE STUDIES
    // --------------------------------------------------------
    $cases = new WP_Query( array(
        'post_type'      => 'case_studies',
        'posts_per_page' => -1,
        'orderby'        => 'meta_value_num',
        'meta_key'       => 'case_order',
        'order'          => 'ASC',
    ) );

    if ( $cases->have_posts() ) :
        while ( $cases->have_posts() ) : $cases->the_post();

            // Champs ACF
            $image     = get_field( 'case_image' );
            $image_alt = get_field( 'case_image_alt' ) ?: get_the_title();
            $problem   = get_field( 'case_problem' );
            $solution  = get_field( 'case_solution' );
            $stack     = get_field( 'case_stack' );
            $results   = get_field( 'case_results' );

            // Récupération des catégories de CE case study
            // wp_get_post_terms() retourne les termes d'un post précis
            $terms = wp_get_post_terms( get_the_ID(), 'case_category' );

            // On construit une string des slugs pour le filtre JS
            // Ex: "ai fintech" → permet de filtrer sur plusieurs catégories
            $term_slugs = '';
            $term_names = array();
            if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
                foreach ( $terms as $term ) {
                    $term_slugs  .= $term->slug . ' ';
                    $term_names[] = $term->name;
                }
                $term_slugs = trim( $term_slugs );
            }
    ?>  


        <!-- Case Study 1 -->
        <div class="flex flex-col gap-6 group case-item" data-category="<?php echo esc_attr( $term_slugs ); ?>">
            <div
                class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 border border-slate-200 relative shadow-sm">
                <?php if ( $image ) : ?>
                <img src="<?php echo esc_url( $image ); ?>"
                    alt="<?php echo esc_attr( $image_alt ); ?>"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                     />
                    <?php else : ?>
                        <!-- Placeholder si pas d'image -->
                <div class="w-full h-full bg-slate-200 flex items-center justify-center">
                    <span class="material-symbols-outlined text-slate-400 text-5xl">image</span>
                </div>
                <?php endif; ?>
            </div>

            <div class="flex flex-col gap-4">
                <div class="flex gap-2">
                    <?php foreach ( $term_names as $term_name ) : ?>
                    <span
                        class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded">
                        <?php echo esc_html( $term_name ); ?>
                    </span>
                    <?php endforeach; ?>
                    
                </div>
                <h3 class="text-2xl font-bold tracking-tight text-primary">
                     <?php the_title(); ?>
                </h3>
                <div class="space-y-4">
                     <!-- Problème -->
                    <?php if ( $problem ) : ?>
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Client Problem</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">
                            <?php echo esc_html( $problem ); ?>
                        </p>
                    </div>
                    <?php endif; ?>

                     <!-- Solution -->
                    <?php if ( $solution ) : ?>
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Strategic Solution</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">
                            <?php echo esc_html( $solution ); ?>
                        </p>
                    </div>
                    <?php endif; ?>


                    <div class="grid grid-cols-2 gap-4">

                    <?php if ( $stack ) : ?>
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Technical Stack</h4>
                            <p class="text-sm font-medium">
                                <?php echo esc_html( $stack ); ?>
                            </p>
                        </div>
                        <?php endif; ?>
                        <?php if ( $results ) : ?>
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Measurable Results</h4>
                            <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">
                                <?php echo esc_html( $results ); ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <button
                    class="mt-2 flex items-center gap-2 text-sm font-bold text-primary dark:text-emerald-400 group-hover:underline">
                    Read Full Story <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
        </div>
        <?php
        endwhile;
        wp_reset_postdata();
    else :
    ?>
    <p class="text-slate-400 col-span-2 text-center py-12">
            Aucun case study trouvé.
            <a href="<?php echo admin_url( 'post-new.php?post_type=case_studies' ); ?>" class="text-primary underline">
                Ajouter un case study →
            </a>
        </p>
        <?php endif; ?>
    </div>

    <!-- CTA Section -->
    <div
        class="mt-24 p-12 rounded-2xl bg-emerald-50 border border-emerald-100 text-center flex flex-col items-center shadow-sm">
        <h2 class="text-3xl font-bold text-primary mb-4">Ready to build your success story?</h2>
        <p class="text-slate-600 max-w-xl mb-8">
            Let's collaborate on your next technical challenge and achieve measurable results for your business.
        </p>
        <div class="flex gap-4">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
               class="px-8 py-3 bg-primary text-white rounded-lg font-bold hover:opacity-90 transition-opacity shadow-lg shadow-primary/20">
                Start a Project
            </a>
            <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>"
               class="px-8 py-3 bg-white border border-slate-200 text-primary rounded-lg font-bold hover:bg-slate-50 transition-colors">
                View All Services
            </a>
        </div>
    </div>
</main>

<?php get_footer(); ?>