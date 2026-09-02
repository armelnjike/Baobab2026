<!DOCTYPE html>
<html class="dark" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="relative flex h-auto min-h-screen w-full flex-col bg-[#0b0c10] text-slate-100 font-sans">
<div class="layout-container flex h-full grow flex-col">

<?php
$nav_items = array(
    array( 'fr' => '01_ACCUEIL',       'en' => '01_HOME',          'url' => home_url( '/' ), 'home' => true ),
    array( 'fr' => '02_À_PROPOS',      'en' => '02_ABOUT',         'url' => baobab_get_page_url( 'about' ) ),
    array( 'fr' => '03_SERVICES',      'en' => '03_SERVICES',      'url' => baobab_get_page_url( 'services' ) ),
    array( 'fr' => '04_ÉTUDES_DE_CAS', 'en' => '04_CASE_STUDIES',  'url' => baobab_get_page_url( 'case-studies' ) ),
    array( 'fr' => '05_MÉTHODE',       'en' => '05_PROCESS',        'url' => baobab_get_page_url( 'process' ) ),
    array( 'fr' => '06_BLOG',         'en' => '06_BLOG',         'url' => baobab_get_page_url( 'blog' ) ),
);
?>

<!-- System Status Top Bar -->
<div class="w-full bg-[#12141a] border-b border-[#262936] text-[11px] font-mono-code px-4 py-1.5 flex items-center justify-between z-50 text-slate-400">
    <div class="flex items-center gap-3">
        <span class="text-[#1abc9c] font-bold"><?php baobab_e( '[BUSINESS_ANALYST // CBAP® CERTIFIÉ]', '[BUSINESS_ANALYST // CBAP® CERTIFIED]' ); ?></span>
        <span class="hidden sm:inline text-slate-500">|</span>
        <span class="hidden sm:inline"><?php baobab_e( 'YAOUNDÉ / DOUALA, CAMEROUN', 'YAOUNDÉ / DOUALA, CAMEROON' ); ?></span>
    </div>
    <div class="flex items-center gap-3">
        <span class="flex items-center gap-1.5 text-xs text-[#00ffc4]">
            <span class="w-2 h-2 rounded-full bg-[#00ffc4] animate-ping"></span>
            <?php baobab_e( 'DISPONIBLE EN PRÉSENTIEL & REMOTE', 'AVAILABLE ON-SITE & REMOTE' ); ?>
        </span>
    </div>
</div>

<!-- Header Navigation -->
<header class="sticky top-0 z-50 bg-[#0b0c10]/95 backdrop-blur-md border-b-2 border-[#262936]">
    <div class="max-w-[1300px] mx-auto px-4 sm:px-6 py-3 flex items-center justify-between">
        
        <!-- Logo : SVG monogramme avec fallback ACF -->
        <?php
        $site_logo_url = '';
        foreach ( get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'front-page.php', 'lang' => '' ) ) as $hp ) {
            $cand = get_field( 'site_logo', $hp->ID );
            if ( $cand ) { $site_logo_url = $cand; break; }
        }
        ?>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-3 group">
            <?php if ( $site_logo_url ) : ?>
                <img src="<?php echo esc_url( $site_logo_url ); ?>" alt="NYA NJIKE ARMEL" class="h-10 w-auto object-contain" />
            <?php else : ?>
                <svg width="44" height="36" viewBox="0 0 44 36" fill="none" xmlns="http://www.w3.org/2000/svg" class="shrink-0">
                    <rect x="1" y="1" width="42" height="34" rx="0" fill="#6c3483" stroke="#1abc9c" stroke-width="2"/>
                    <text x="22" y="24" text-anchor="middle" font-family="'Space Grotesk', sans-serif" font-weight="900" font-size="18" fill="#ffffff" letter-spacing="2">ANJ</text>
                </svg>
            <?php endif; ?>
            <div class="flex flex-col">
                <span class="font-grotesk font-black tracking-tight text-white text-lg leading-tight uppercase group-hover:text-[#1abc9c] transition-colors">
                    NYA NJIKE ARMEL
                </span>
                <span class="font-mono-code text-[10px] text-[#1abc9c] tracking-widest uppercase">
                    BUSINESS ANALYST · CBAP®
                </span>
            </div>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden lg:flex items-center gap-2 font-mono-code text-xs">
            <?php foreach ( $nav_items as $nav ) :
                $nav_label = baobab_t( $nav['fr'], $nav['en'] );
                $is_active = ( ! empty( $nav['home'] ) && is_front_page() )
                    || ( empty( $nav['home'] ) && rtrim( $_SERVER['REQUEST_URI'], '/' ) === rtrim( parse_url( $nav['url'], PHP_URL_PATH ), '/' ) );
                if ( $is_active ) : ?>
                <a href="<?php echo esc_url( $nav['url'] ); ?>" 
                   class="px-3.5 py-2 border-2 border-[#1abc9c] bg-[#1abc9c]/20 text-[#00ffc4] font-bold tracking-wider">
                    <?php echo esc_html( $nav_label ); ?>
                </a>
                <?php else : ?>
                <a href="<?php echo esc_url( $nav['url'] ); ?>" 
                   class="px-3.5 py-2 border border-[#262936] text-slate-300 hover:border-[#6c3483] hover:text-white hover:bg-[#6c3483]/20 tracking-wider transition-all">
                    <?php echo esc_html( $nav_label ); ?>
                </a>
                <?php endif;
            endforeach; ?>

            <?php baobab_language_switcher( 'desktop' ); ?>

            <!-- Contact CTA -->
            <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" 
               class="ml-2 px-4 py-2 border-2 border-[#6c3483] bg-[#6c3483] text-white font-bold tracking-wider hover:bg-[#1abc9c] hover:border-[#1abc9c] hover:text-black transition-all uppercase">
                <?php baobab_e( 'PRENDRE CONTACT', 'GET IN TOUCH' ); ?>
            </a>
        </nav>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="lg:hidden p-2 border-2 border-[#1abc9c] bg-[#12141a] text-[#1abc9c] font-mono-code font-bold text-xs" aria-label="Toggle Menu">
            [MENU]
        </button>

    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu" class="hidden lg:hidden border-t-2 border-[#262936] bg-[#0b0c10] p-4 font-mono-code space-y-2">
        <?php foreach ( $nav_items as $nav ) : ?>
        <a href="<?php echo esc_url( $nav['url'] ); ?>" class="block px-4 py-3 border border-[#262936] text-[#1abc9c] hover:bg-[#6c3483]/30 text-sm font-bold">
            <?php echo esc_html( baobab_t( $nav['fr'], $nav['en'] ) ); ?>
        </a>
        <?php endforeach; ?>
        <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" class="block px-4 py-3 bg-[#6c3483] text-white text-center font-bold text-sm uppercase border border-[#1abc9c]">
            <?php baobab_e( 'PRENDRE CONTACT', 'GET IN TOUCH' ); ?>
        </a>
        <?php baobab_language_switcher( 'mobile' ); ?>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var btn = document.getElementById('mobile-menu-btn');
    var menu = document.getElementById('mobile-menu');
    if (btn && menu) {
        btn.addEventListener('click', function() {
            menu.classList.toggle('hidden');
        });
    }
});
</script>