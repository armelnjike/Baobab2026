<!DOCTYPE html>
<html class="light" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root">
<div class="layout-container flex h-full grow flex-col">

<!-- Navigation -->
<?php
$nav_links = array(
    'Home'         => home_url( '/' ),
    'Services'     => home_url( '/services/' ),
    'Case Studies' => home_url( '/case-studies/' ),
    'Insights'     => home_url( '/insights/' ),
    'About'        => home_url( '/about/' ),
    'Team'         => home_url( '/team/' ),
    'Contact'      => home_url( '/contact/' ),
);
?>
<!-- Barre d'accent mobile uniquement -->
<div class="md:hidden h-0.5 w-full bg-gradient-to-r from-primary via-emerald-400 to-primary sticky top-0 z-50"></div>

<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 px-6 md:px-10 py-4 md:py-5 bg-white sticky top-0.5 md:top-0 z-50 shadow-sm">

    <!-- Logo -->
    <div class="flex items-center gap-3 text-primary">
        <!-- Icône dans un badge sur mobile -->
        <div class="flex items-center justify-center size-9 md:size-7 rounded-xl md:rounded-none bg-primary/10 md:bg-transparent transition-all">
            <svg class="size-5 md:size-7" fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
            </svg>
        </div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex flex-col leading-none">
            <span class="text-base md:text-xl font-black tracking-tight text-slate-900 hover:text-primary transition-colors">Baobab Technology</span>
            <span class="md:hidden text-[10px] font-medium tracking-widest text-primary uppercase">Digital Solutions</span>
        </a>
    </div>

    <!-- Desktop nav -->
    <div class="hidden md:flex flex-1 justify-end gap-8 items-center">
        <nav class="flex items-center gap-9">
            <?php foreach ( $nav_links as $label => $url ) :
                $is_active = ( $label === 'Home' && is_front_page() )
                    || ( $label !== 'Home' && rtrim( $_SERVER['REQUEST_URI'], '/' ) === rtrim( parse_url( $url, PHP_URL_PATH ), '/' ) );
                $active_class = $is_active
                    ? 'text-primary text-sm font-bold border-b-2 border-primary pb-1'
                    : 'text-slate-800 text-sm font-medium hover:text-primary transition-colors';
                printf( '<a class="%s" href="%s">%s</a>', esc_attr( $active_class ), esc_url( $url ), esc_html( $label ) );
            endforeach; ?>
        </nav>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="flex min-w-[120px] cursor-pointer items-center justify-center rounded-lg h-10 px-5 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
            Partner with us
        </a>
    </div>

    <!-- Bouton hamburger (mobile uniquement) -->
    <button id="mobile-menu-btn"
            class="md:hidden flex flex-col justify-center items-center w-10 h-10 gap-1.5 rounded-xl bg-sky-950 hover:bg-primary transition-colors"
            aria-label="Menu">
        <span class="hamburger-bar block w-5 h-0.5 bg-white transition-all duration-300"></span>
        <span class="hamburger-bar block w-5 h-0.5 bg-white transition-all duration-300"></span>
        <span class="hamburger-bar block w-3 h-0.5 bg-emerald-400 transition-all duration-300"></span>
    </button>

</header>

<!-- Menu mobile (drawer) -->
<div id="mobile-menu"
     class="fixed inset-0 z-40 md:hidden pointer-events-none"
     aria-hidden="true">

    <!-- Overlay avec blur -->
    <div id="mobile-overlay"
         class="absolute inset-0 bg-sky-950/60 backdrop-blur-sm opacity-0 transition-opacity duration-300"></div>

    <!-- Panneau latéral dark -->
    <div id="mobile-panel"
         class="absolute right-0 top-0 h-full w-80 bg-sky-950 shadow-2xl translate-x-full transition-transform duration-300 flex flex-col overflow-hidden">

        <!-- Barre d'accent dégradée -->
        <div class="h-1 w-full bg-gradient-to-r from-primary via-emerald-400 to-primary flex-shrink-0"></div>

        <!-- En-tête : logo + close -->
        <div class="flex items-center justify-between px-6 py-5 flex-shrink-0">
            <div class="flex items-center gap-2">
                <div class="size-6 text-primary">
                    <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                    </svg>
                </div>
                <span class="font-bold text-white text-sm tracking-tight">Baobab Technology</span>
            </div>
            <button id="mobile-menu-close"
                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-white/5 hover:bg-white/10 transition-colors"
                    aria-label="Fermer">
                <span class="material-symbols-outlined text-white" style="font-size:20px">close</span>
            </button>
        </div>

        <!-- Liens de navigation -->
        <nav class="flex flex-col px-4 py-2 gap-1 flex-1 overflow-y-auto">
            <?php
            $nav_icons = array(
                'Home'         => 'home',
                'Services'     => 'build',
                'Case Studies' => 'folder_special',
                'Insights'     => 'lightbulb',
                'About'        => 'info',
                'Team'         => 'group',
                'Contact'      => 'mail',
            );
            foreach ( $nav_links as $label => $url ) :
                $is_active = ( $label === 'Home' && is_front_page() )
                    || ( $label !== 'Home' && rtrim( $_SERVER['REQUEST_URI'], '/' ) === rtrim( parse_url( $url, PHP_URL_PATH ), '/' ) );
                $icon = $nav_icons[ $label ] ?? 'chevron_right';
                if ( $is_active ) :
            ?>
            <a class="flex items-center gap-4 px-4 py-3.5 rounded-xl bg-primary/20 border border-primary/30 text-primary font-bold text-sm"
               href="<?php echo esc_url( $url ); ?>">
                <span class="material-symbols-outlined" style="font-size:20px"><?php echo esc_html( $icon ); ?></span>
                <?php echo esc_html( $label ); ?>
            </a>
            <?php else : ?>
            <a class="flex items-center gap-4 px-4 py-3.5 rounded-xl text-slate-300 font-medium text-sm hover:bg-white/5 hover:text-white transition-all group"
               href="<?php echo esc_url( $url ); ?>">
                <span class="material-symbols-outlined text-slate-500 group-hover:text-primary transition-colors" style="font-size:20px"><?php echo esc_html( $icon ); ?></span>
                <?php echo esc_html( $label ); ?>
            </a>
            <?php endif;
            endforeach; ?>
        </nav>

        <!-- Séparateur -->
        <div class="mx-6 border-t border-white/10 flex-shrink-0"></div>

        <!-- Carousel partenaires -->
        <?php
        $contact_page   = get_page_by_path( 'contact' );
        $drawer_clients = $contact_page ? get_field( 'clients', $contact_page->ID ) : array();
        if ( ! empty( $drawer_clients ) ) :
            $drawer_loop = array_merge( $drawer_clients, $drawer_clients );
        ?>
        <div class="flex-shrink-0 py-4 overflow-hidden">
            <p class="px-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-3">Trusted by</p>
            <div class="relative overflow-hidden"
                 style="mask-image: linear-gradient(to right, transparent 0%, black 15%, black 85%, transparent 100%);
                        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 15%, black 85%, transparent 100%);">
                <div class="flex gap-6 w-max"
                     style="animation: drawer-marquee 18s linear infinite;">
                    <?php foreach ( $drawer_loop as $client ) : ?>
                    <div class="flex-shrink-0 flex items-center justify-center h-8">
                        <?php if ( ! empty( $client['client_logo'] ) ) : ?>
                        <img src="<?php echo esc_url( $client['client_logo'] ); ?>"
                             alt="<?php echo esc_attr( $client['client_name'] ); ?>"
                             class="h-6 object-contain opacity-40 hover:opacity-80 transition-opacity grayscale invert" />
                        <?php else : ?>
                        <span class="text-xs font-black italic tracking-tight text-slate-400 hover:text-slate-200 transition-colors whitespace-nowrap">
                            <?php echo esc_html( $client['client_name'] ); ?>
                        </span>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <style>
        @keyframes drawer-marquee {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        </style>
        <?php endif; ?>

        <!-- CTA -->
        <div class="px-4 py-6 flex-shrink-0">
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
               class="flex items-center justify-center gap-2 w-full py-4 rounded-xl bg-primary text-white font-bold text-sm hover:brightness-110 hover:shadow-lg hover:shadow-primary/30 transition-all">
                <span class="material-symbols-outlined" style="font-size:18px">handshake</span>
                Partner with us
            </a>
        </div>

    </div>
</div>

<script>
(function () {
    var btn     = document.getElementById('mobile-menu-btn');
    var menu    = document.getElementById('mobile-menu');
    var overlay = document.getElementById('mobile-overlay');
    var panel   = document.getElementById('mobile-panel');
    var close   = document.getElementById('mobile-menu-close');
    var bars    = document.querySelectorAll('.hamburger-bar');

    function openMenu() {
        menu.classList.remove('pointer-events-none');
        menu.setAttribute('aria-hidden', 'false');
        overlay.classList.replace('opacity-0', 'opacity-100');
        panel.classList.replace('translate-x-full', 'translate-x-0');
        // Croix animée
        bars[0].style.transform = 'translateY(8px) rotate(45deg)';
        bars[1].style.opacity   = '0';
        bars[2].style.transform = 'translateY(-8px) rotate(-45deg)';
        document.body.style.overflow = 'hidden';
    }

    function closeMenu() {
        overlay.classList.replace('opacity-100', 'opacity-0');
        panel.classList.replace('translate-x-0', 'translate-x-full');
        bars[0].style.transform = '';
        bars[1].style.opacity   = '';
        bars[2].style.transform = '';
        document.body.style.overflow = '';
        setTimeout(function () {
            menu.classList.add('pointer-events-none');
            menu.setAttribute('aria-hidden', 'true');
        }, 300);
    }

    btn.addEventListener('click', openMenu);
    close.addEventListener('click', closeMenu);
    overlay.addEventListener('click', closeMenu);
}());
</script>
