<?php
/*
 Template Name: Home Page
*/
get_header();

$hero_badge         = get_field( 'hero_badge' );
$hero_title         = get_field( 'hero_title' );
$hero_title_colored = get_field( 'hero_title_colored' );
$hero_subtitle      = get_field( 'hero_subtitle' );
$hero_btn1_text     = get_field( 'hero_btn1_text' );
$hero_btn1_url      = get_field( 'hero_btn1_url' )  ?: home_url( '/services/' );
$hero_btn2_text     = get_field( 'hero_btn2_text' );
$hero_btn2_url      = get_field( 'hero_btn2_url' )  ?: home_url( '/case-studies/' );
$hero_bg_image      = get_field( 'hero_bg_image' );
$hero_bg_video      = get_field( 'hero_bg_video' );
?>

<!-- Hero Section -->
<section id="hero-section"
         class="relative min-h-screen flex items-center justify-center pt-20 overflow-hidden bg-emerald-50"
         <?php if ( $hero_bg_image && ! $hero_bg_video ) : ?>
         style="background-image: url('<?php echo esc_url( $hero_bg_image ); ?>'); background-size: cover; background-position: center 50%;"
         <?php endif; ?>>

    <?php if ( $hero_bg_video ) : ?>
        <video class="absolute inset-0 w-full h-full object-cover -z-20" autoplay muted loop playsinline>
            <source src="<?php echo esc_url( $hero_bg_video ); ?>" type="video/mp4">
        </video>
        <div class="absolute inset-0 bg-black/50 -z-10"></div>
    <?php elseif ( $hero_bg_image ) : ?>
        <div class="absolute inset-0 bg-black/40 -z-10"></div>
    <?php else : ?>
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 via-white to-emerald-50/50 -z-10"></div>
        <div class="absolute inset-0 opacity-30 -z-10 bg-[radial-gradient(#013220_1px,transparent_1px)] [background-size:40px_40px]"></div>
    <?php endif; ?>
    <div class="max-w-5xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-primary dark:text-slate-300 text-xs font-semibold mb-8">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 bg-primary"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
            </span>
            <?php echo esc_html( $hero_badge ?: 'Innovation Driven Consulting' ); ?>
        </div>
        <h1 class="text-5xl md:text-7xl font-extrabold leading-[1.1] mb-8 tracking-tight">
            <?php echo esc_html( $hero_title ?: 'La technologie au service de' ); ?> <br/>
            <span class="text-primary"><?php echo esc_html( $hero_title_colored ?: 'votre croissance.' ); ?></span>
        </h1>
        <p class="text-primary text-sm font-medium mb-8">
            <?php echo esc_html( $hero_subtitle ?: 'We build solutions that bring your dreams to reality. High-end digital transformation for modern enterprises.' ); ?>
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="<?php echo esc_url( $hero_btn1_url ); ?>" class="w-full sm:w-auto bg-primary  px-8 py-4 rounded-xl text-lg font-bold shadow-xl shadow-primary/20 hover:opacity-90 transition-opacity">
                <?php echo esc_html( $hero_btn1_text ?: 'Our Solutions' ); ?>
            </a>
            <a href="<?php echo esc_url( $hero_btn2_url ); ?>" class="w-full sm:w-auto bg-sky/4 border border-slate-400 dark:border-white/10 px-8 py-4 rounded-xl text-lg font-bold hover:bg-white/10 transition-all">
                <?php echo esc_html( $hero_btn2_text ?: 'View Portfolio' ); ?>
            </a>
        </div>
    </div>
</section>

<script>
(function () {
    var section = document.getElementById('hero-section');
    // Si pas d'image de fond (video ou gradient), on sort
    if (!section || !section.style.backgroundImage) return;

    var ticking = false;

    window.addEventListener('scroll', function () {
        if (!ticking) {
            requestAnimationFrame(function () {
                // On décale la position Y du fond : 50% au départ, +0.3px par px scrollé
                // L'image bouge moins vite que la page → effet parallax
                section.style.backgroundPositionY = 'calc(50% + ' + (window.scrollY * 0.3) + 'px)';
                ticking = false;
            });
            ticking = true;
        }
    }, { passive: true });
}());
</script>

<!-- Strategic Positioning -->
<section class="py-24 bg-white border-y border-primary/10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <span class="text-primary font-bold tracking-widest uppercase text-xs"><?php echo esc_html( get_field( 'strategic_label' ) ?: 'Strategic Positioning' ); ?>
        </span></span>
        <h2 class="text-3xl md:text-4xl font-bold mt-4 mb-8"> <?php echo esc_html( get_field( 'strategic_title' ) ?: 'Empowering Global Enterprises' ); ?></h2>
        <p class="text-primary text-sm font-medium max-w-2xl mx-auto">
            <?php echo esc_html( get_field( 'strategic_text' ) ?: 'Baobab Technology serves as a bridge between visionary goals and technical execution. We combine African resilience with global engineering standards to provide bespoke consultancy and digital infrastructure.' ); ?>
        </p>
    </div>
</section>

<!-- Core Services Preview -->
<section class="py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6">
            <div class="max-w-xl">
                <h2 class="text-4xl font-bold mb-4"><?php echo esc_html( get_field( 'home_services_title' ) ?: 'Core Expertise' ); ?></h2>
                <p class="text-slate-600 dark:text-slate-400"><?php echo esc_html( get_field( 'home_services_text' ) ?: 'Tailored digital services designed for high-impact performance and scalability.' ); ?></p>
            </div>
            <a class="flex items-center gap-2 text-primary font-bold hover:underline" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">
                View all services <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

<?php
        $services_preview = new WP_Query( array(
            'post_type'      => 'services',
            'posts_per_page' => 3,
            'orderby'        => 'meta_value_num',
            'meta_key'       => 'service_order',
            'order'          => 'ASC',
        ) );

        if ( $services_preview->have_posts() ) :
            while ( $services_preview->have_posts() ) : $services_preview->the_post();
                $icon     = get_field( 'service_icon' )     ?: 'build';
                $solution = get_field( 'service_solution' ) ?: '';
        ?>

            <div class="group bg-white dark:bg-white/5 p-10 rounded-2xl border border-primary/10 hover:border-primary/40 transition-all">
                <div class="size-14 rounded-xl bg-primary/10 flex items-center justify-center mb-8 text-primary group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-3xl"> <?php echo esc_html( $icon ); ?></span>
                </div>
                <h3 class="text-2xl font-bold mb-4"><?php the_title(); ?></h3>
                <p class="text-slate-600 dark:text-slate-400 mb-8"><?php echo esc_html( $solution ); ?></p>
                <a href="<?php echo esc_url( home_url( '/services/' ) ); ?>" class="text-sm font-bold flex items-center gap-2 group-hover:gap-4 transition-all">
                    Learn more <span class="material-symbols-outlined text-lg">east</span>
                </a>
            </div>

            <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
            
        </div>
    </div>
</section>

<!-- Case Studies Preview -->
<section class="py-24 bg-primary/5">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-4xl font-bold mb-16 text-center"> <?php echo esc_html( get_field( 'home_cases_title' ) ?: 'Selected Impact Stories' ); ?></h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
    <?php
        $cases_preview = new WP_Query( array(
            'post_type'      => 'case_studies',
            'posts_per_page' => 2,
            'order'          => 'DESC',
        ) );

        if ( $cases_preview->have_posts() ) :
            while ( $cases_preview->have_posts() ) : $cases_preview->the_post();
                // Champs ACF à brancher quand le CPT sera créé
            endwhile;
            wp_reset_postdata();
        else :
        ?>
            <div class="relative group overflow-hidden rounded-2xl aspect-video bg-slate-200 dark:bg-white/10">
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-700 group-hover:scale-105" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCIw-xRksXuSp04tzaoIyQfMGP6QfOMU-KC4KqHLCDBuKuSPSGfOcliX6c8TZwEeF3FOxHzw20okOzcaecoCjJ02wDME_o9aTw-MIXGtQfajd-UWUGJ0-KLR-ORBsuxmx-ZWal5Ph6RYXpvL-GKR4IVvcwfruKImAFHohfL2jDDQ9Mmlmb-5mkYRJmhowrhsXUI96ezD9WA1gZRtlOQLA6Ds_fpobbfHWdOywumemwMCmtQ5C779aY_Q3Z9r68TeoqjGW5mOcUexh0');"></div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8">
                    <span class="text-xs font-bold tracking-widest uppercase mb-2 block text-emerald-400">Fintech</span>
                    <h4 class="text-white text-2xl font-bold">Pan-African Payment Gateway</h4>
                </div>
            </div>
        <?php endif; ?>  
        </div>
    </div>
</section>

<!-- Leadership Preview -->
<section class="py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
            <div>
                <h2 class="text-4xl font-bold mb-6"><?php echo esc_html( get_field( 'home_leadership_title' ) ?: 'Led by Innovation' ); ?>
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-lg mb-10 leading-relaxed">
                    <?php echo esc_html( get_field( 'home_leadership_text' ) ?: 'Our leadership team combines decades of experience in international tech hubs with a deep understanding of local market dynamics.' ); ?>
                </p>
                <a href="<?php echo esc_url( home_url( '/team/' ) ); ?>" class="inline-block bg-primary/10 border-2 border-primary text-primary px-6 py-3 rounded-lg font-bold hover:bg-primary hover:text-sky-500 transition-all">
                    Meet the leadership
                </a>
            </div>
            <div class="grid grid-cols-2 gap-6">

            <?php
            $members = get_field( 'home_leadership_members' );

            if ( $members ) :
                foreach ( $members as $member ) :
            ?>

                <div class="text-center">
                    <div class="aspect-[3/4] rounded-2xl bg-cover bg-center mb-4 grayscale hover:grayscale-0 transition-all" style="background-image: url('<?php echo esc_url( $member['member_photo'] ); ?>');"></div>
                    <h4 class="font-bold text-lg"><?php echo esc_html( $member['member_name'] ); ?></h4>
                    <p class="text-primary text-sm font-medium"><?php echo esc_html( $member['member_role'] ); ?></p>
                </div>
                <?php
                endforeach;
            else :
            ?>
                <p>No leadership members found.</p>

             <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
