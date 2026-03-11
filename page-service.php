<?php
/*
 Template Name: Services Page
*/
get_header();
?>

<!-- Hero Section — Split Screen -->
<section class="relative min-h-screen flex items-center overflow-hidden bg-sky-950">

    <!-- Orbe gauche -->
    <div class="absolute -top-32 -left-32 w-[500px] h-[500px] rounded-full bg-primary/20 blur-[120px] pointer-events-none"></div>
    <!-- Orbe droite bas -->
    <div class="absolute -bottom-32 right-0 w-[400px] h-[400px] rounded-full bg-emerald-400/10 blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center py-28">

        <!-- Colonne gauche — Texte -->
        <div class="flex flex-col items-start">

            <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white/5 border border-white/10 text-emerald-400 text-xs font-bold uppercase tracking-widest mb-8">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-400"></span>
                </span>
                Innovative Technology Partner
            </span>

            <h1 class="text-5xl lg:text-6xl font-black leading-tight text-white mb-6">
                Our Strategic<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-primary">Services</span>
            </h1>

            <p class="text-lg text-slate-400 leading-relaxed mb-10 max-w-lg">
                Driving exponential growth through custom software innovation and digital transformation tailored for the African market landscape.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="#services-grid"
                   class="bg-primary text-white px-8 py-4 rounded-xl font-bold text-base hover:brightness-110 hover:shadow-xl hover:shadow-primary/30 transition-all">
                    Explore Solutions
                </a>
                <a href="<?php echo esc_url( home_url( '/case-studies/' ) ); ?>"
                   class="bg-white/5 border border-white/15 text-white px-8 py-4 rounded-xl font-bold text-base hover:bg-white/10 hover:border-white/30 transition-all">
                    View Our Work
                </a>
            </div>

            <!-- Stats rapides -->
            <div class="mt-14 flex gap-10 border-t border-white/10 pt-8 w-full">
                <div>
                    <p class="text-3xl font-black text-white">12+</p>
                    <p class="text-xs text-slate-500 uppercase tracking-wider mt-1">Years Experience</p>
                </div>
                <div>
                    <p class="text-3xl font-black text-white">50+</p>
                    <p class="text-xs text-slate-500 uppercase tracking-wider mt-1">Projects Delivered</p>
                </div>
                <div>
                    <p class="text-3xl font-black text-white">8</p>
                    <p class="text-xs text-slate-500 uppercase tracking-wider mt-1">African Countries</p>
                </div>
            </div>

        </div>

        <!-- Colonne droite — Grille de cartes tech flottantes -->
        <div class="hidden lg:grid grid-cols-3 gap-4 relative">

            <?php
            $tech_cards = array(
                array( 'icon' => 'security',        'label' => 'Cybersecurity',   'delay' => '0s'    ),
                array( 'icon' => 'database',         'label' => 'Data Intelligence','delay' => '0.4s'  ),
                array( 'icon' => 'cloud',            'label' => 'Cloud Infra',     'delay' => '0.8s'  ),
                array( 'icon' => 'smartphone',       'label' => 'Mobile Apps',     'delay' => '1.2s'  ),
                array( 'icon' => 'hub',              'label' => 'Networking',      'delay' => '0.6s'  ),
                array( 'icon' => 'monitoring',       'label' => 'Analytics',       'delay' => '1.0s'  ),
                array( 'icon' => 'code',             'label' => 'Dev & APIs',      'delay' => '0.2s'  ),
                array( 'icon' => 'psychology',       'label' => 'AI & ML',         'delay' => '1.4s'  ),
                array( 'icon' => 'shield_lock',      'label' => 'Compliance',      'delay' => '0.9s'  ),
            );
            foreach ( $tech_cards as $card ) :
            ?>
            <div class="tech-card flex flex-col items-center gap-2 p-5 rounded-2xl bg-white/4 border border-white/8 hover:bg-white/8 hover:border-primary/40 transition-all cursor-default"
                 style="animation: card-float 5s ease-in-out infinite; animation-delay: <?php echo $card['delay']; ?>;">
                <span class="material-symbols-outlined text-3xl text-emerald-400"><?php echo $card['icon']; ?></span>
                <span class="text-xs font-semibold text-slate-300 text-center leading-tight"><?php echo $card['label']; ?></span>
            </div>
            <?php endforeach; ?>

        </div>

    </div>

    <!-- Fondu interne bas du hero → couleur section suivante -->
    <div class="absolute bottom-0 left-0 right-0 h-40 bg-gradient-to-b from-transparent to-sky-50 pointer-events-none"></div>

</section>

<style>
@keyframes card-float {
    0%, 100% { transform: translateY(0px);    }
    50%       { transform: translateY(-10px);  }
}
</style>

<!-- Services Grid -->
<section id="services-grid" class="py-20 bg-sky-50 dark:bg-background-dark">
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
            <div class="rounded-2xl p-8 flex flex-col border border-slate-100 hover:border-emerald-500/40 hover:shadow-xl hover:shadow-emerald-500/5 transition-all group service-card">
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
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                   class="w-full bg-primary text-slate-500 py-4 rounded-xl font-bold hover:brightness-110 hover:shadow-lg hover:shadow-primary/20 transition-all text-center mt-auto border border-primary/30">
                    <?php echo esc_html( $cta ); ?>
                </a>
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
<section class="py-24 relative overflow-hidden bg-gradient-to-b from-sky-50 to-sky-950">

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-black mb-4 text-sky-950">Why Choose Baobab?</h2>
            <p class="max-w-xl mx-auto text-sky-800">Rooted in excellence, branched out for global success. Our pillars define our commitment to your growth.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <?php
            $pillars = get_field("pillars");
            if ( $pillars ) :
                foreach ( $pillars as $pillar ) :
        ?>
            <div class="group text-center p-8 rounded-2xl border border-sky-200/40 bg-white/20 hover:bg-white/30 hover:border-primary/40 backdrop-blur-sm transition-all">
                <div class="size-16 mx-auto mb-6 rounded-2xl flex items-center justify-center bg-primary/20 group-hover:bg-primary/30 transition-colors">
                    <span class="material-symbols-outlined text-3xl text-primary"><?php echo esc_html( $pillar['pillar_icon'] ?: 'star' ); ?></span>
                </div>
                <h4 class="text-lg font-bold mb-2 text-sky-950"><?php echo esc_html( $pillar['pillar_title'] ); ?></h4>
                <p class="text-sm text-sky-900 leading-relaxed"><?php echo esc_html( $pillar['pillar_desc'] ); ?></p>
            </div>
            <?php
                endforeach;
            else :
                echo '<p class="text-slate-400">No pillars found.</p>';
            endif;
        ?>

        </div>
    </div>
</section>

<?php get_footer(); ?>