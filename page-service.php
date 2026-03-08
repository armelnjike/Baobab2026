<?php
/*
 Template Name: Services Page
*/
get_header();
?>

<!-- Services - Light Theme -->

<!-- Hero Section -->
<section class="relative py-20 lg:py-32 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-b from-primary/10 to-transparent pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
        <span
            class="inline-block py-1 px-4 rounded-full bg-emerald-500/10 text-emerald-400 text-xs font-bold uppercase tracking-widest mb-6">Innovative
            Technology Partner</span>
        <h1 class="text-5xl lg:text-7xl font-black mb-8 leading-tight">Our Strategic <span
                class="text-emerald-500">Services</span></h1>
        <p class="text-lg lg:text-xl max-w-2xl mx-auto mb-12 text-slate-600">Driving exponential growth through custom
            software innovation and digital transformation tailored for the African market landscape.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <button
                class="bg-primary text-white px-8 py-4 rounded-xl font-bold text-lg hover:shadow-2xl hover:shadow-emerald-900/20 transition-all">Explore
                Solutions</button>
            <button
                class="bg-slate-100 border border-slate-200 text-slate-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-slate-200 transition-all">View
                Our Work</button>
        </div>
    </div>
</section>
<!-- Services Grid -->
 <!-- 
    SECTION SERVICES GRID — VERSION DYNAMIQUE
     ============================================================
     On remplace le HTML statique par une "boucle WordPress"
     qui va chercher automatiquement tous nos services
     dans la base de données  -->

<section class="py-20 bg-background-light dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Service A: Custom Web & Software Development -->
             <?php
                // WP_QUERY : La classe qui interroge la base de données
                // dans WordPress. On lui passe un tableau de paramètres
                // pour filtrer exactement ce qu'on veut.
                $services = new WP_Query( array(
                    // on veut les post de type services (notre CPT)
                    'post_type' => 'services',
                    //recuperer tout les services sans limite de nombre
                    'posts_per_page' => -1,
                    // on veut les services les plus récents en premier
                    'orderby' => 'date',
                ));
            //Boucle WordPress : tant qu'il y a des services à afficher, on les affiche
            if ( $services->have_posts() ) :
                while ( $services->have_posts() ) : $services->the_post();
                    // A l'intérieur de cette boucle, les fonctions WordPress
                    // comme the_title() ou the_content() vont automatiquement
                    // afficher les données du service courant. 
                    $icon = get_field('service_icon'); // ACF : récupérer le champ personnalisé "service_icon"
                    $problem = get_field('service_problem'); // ACF : récupérer le champ personnalisé "
                    $solution = get_field('service_solution'); // ACF : récupérer le champ personnalisé "service_solution"
                    $features = get_field('service_features'); // ACF : récupérer le champ personnalisé "service_features"
                    $tech_stacks = get_field('service_stack');
                    $cta      = get_field( 'service_cta' ) ?: 'Start Your Project';

                    ?>
            <div class="rounded-2xl p-8 flex flex-col hover:border-emerald-500/30 transition-all group service-card">
                <div
                    class="size-14 bg-emerald-500/10 rounded-xl flex items-center justify-center text-emerald-500 mb-6 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl"><?php echo esc_html( $icon ); ?></span>
                </div>
                <h3 class="text-2xl font-bold mb-4"><?php the_title(); ?></h3>
                
                <?php if ( $problem ) : ?>

                <div class="mb-6">
                    <p class="text-emerald-500 font-bold text-xs uppercase tracking-wider mb-2">Business Problem</p>
                    <p class="text-slate-600"><?php echo esc_html( $problem ); ?></p>
                </div>
                <?php endif; ?>
                <?php if ( $solution ) : ?>
                <div class="mb-6">
                    <p class="text-emerald-500 font-bold text-xs uppercase tracking-wider mb-2">Strategic Solution</p>
                    <p class="text-slate-600"><?php echo esc_html( $solution ); ?></p>
                </div>
                <?php endif; ?>
                <?php if ( $features ) : ?>
                <ul class="space-y-3 mb-8">
                    <?php foreach ( $features as $feature ) :
                        $feature_text = is_array( $feature ) ? ( $feature['feature_item'] ?? reset( $feature ) ) : $feature;
                    ?>
                    <li class="flex items-center gap-2 text-sm text-slate-600"><span
                            class="material-symbols-outlined text-emerald-500 text-lg">check_circle</span> <?php echo esc_html( $feature_text ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php if ( $tech_stacks ) : ?>
                <div class="flex flex-wrap gap-2 mb-8 mt-auto">
                    <?php foreach ( $tech_stacks as $stack ) :
                        $stack_text = is_array( $stack ) ? ( $stack['stack_item'] ?? reset( $stack ) ) : $stack;
                    ?>
                    <span class="px-3 py-1 rounded-full text-xs font-medium"><?php echo esc_html( $stack_text ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
                <button
                    class="w-full bg-primary text-white py-4 rounded-xl font-bold hover:bg-emerald-900 transition-colors"><?php echo esc_html( $cta ); ?></button>
            </div>
                <?php
                endwhile;
                wp_reset_postdata(); // Toujours réinitialiser après une boucle personnalisée
            else :
                echo '<p>No services found.</p>';
            endif;
            ?>
            
        </div>
    </div>
</section>


<!-- Why Choose Baobab? -->
<section class="py-24 relative">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black mb-4">Why Choose Baobab?</h2>
            <p class="max-w-xl mx-auto text-slate-600">Rooted in excellence, branched out for global success. Our
                pillars define our commitment to your growth.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        <?php
            $pillars = get_field("pillars");
            if ( $pillars ) :
                foreach ( $pillars as $pillar ) :
        ?>
            <div class="text-center p-6">
                <div class="size-16 mx-auto mb-6 rounded-2xl flex items-center justify-center bg-emerald-50">
                    <span class="material-symbols-outlined text-3xl text-primary"><?php echo esc_html( $pillar['pillar_icon']?:'star' ); ?></span>
                </div>
                <h4 class="text-lg font-bold mb-2"><?php echo esc_html( $pillar['pillar_title'] ); ?></h4>
                <p class="text-sm text-slate-600"><?php echo esc_html( $pillar['pillar_desc'] ); ?></p>
            </div>
            <?php
                endforeach;
            else :
                echo '<p>No pillars found.</p>';
            endif;
            ?>
        
        </div>
    </div>
</section>

<?php get_footer(); ?>