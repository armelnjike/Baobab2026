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
<header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-slate-200 px-10 py-5 bg-white sticky top-0 z-50 shadow-sm">
    <div class="flex items-center gap-3 text-primary">
        <div class="size-7">
            <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
            </svg>
        </div>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="text-xl font-bold leading-tight tracking-tight text-slate-900 hover:text-primary transition-colors">
            Baobab Technology
        </a>
    </div>
    <div class="flex flex-1 justify-end gap-8 items-center">
        <nav class="hidden md:flex items-center gap-9">
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
            foreach ( $nav_links as $label => $url ) {
                $is_active = ( $label === 'Home' && is_front_page() )
                    || ( $label !== 'Home' && rtrim( $_SERVER['REQUEST_URI'], '/' ) === rtrim( parse_url( $url, PHP_URL_PATH ), '/' ) );
                $active_class = $is_active
                    ? 'text-primary text-sm font-bold border-b-2 border-primary pb-1'
                    : 'text-slate-800 text-sm font-medium hover:text-primary transition-colors';
                printf(
                    '<a class="%s" href="%s">%s</a>',
                    esc_attr( $active_class ),
                    esc_url( $url ),
                    esc_html( $label )
                );
            }
            ?>
        </nav>
        <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="flex min-w-[120px] cursor-pointer items-center justify-center rounded-lg h-10 px-5 bg-primary text-white text-sm font-bold hover:opacity-90 transition-opacity">
            Partner with us
        </a>
    </div>
</header>
