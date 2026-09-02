<?php
// Fix local dev : désactiver la vérification SSL pour les domaines .local
// (nécessaire pour WPML REST API check avec Local by Flywheel)
if ( isset( $_SERVER['SERVER_NAME'] ) && str_ends_with( $_SERVER['SERVER_NAME'], '.local' ) ) {
    add_filter( 'https_ssl_verify',   '__return_false' );
    add_filter( 'https_local_ssl_verify', '__return_false' );
}

// Charger les styles du thème parent et enfant
add_action( 'after_setup_theme', 'baobab_theme_setup' );
function baobab_theme_setup() {
    // Charger le domaine de texte pour les traductions
    load_child_theme_textdomain( 'baobabtech', get_stylesheet_directory() . '/languages' );
    // SEO : laisser WP gérer le <title>
    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
}

add_action( 'wp_enqueue_scripts', 'astra_child_enqueue_styles' );
function astra_child_enqueue_styles() {
    wp_enqueue_style(
        'astra-parent-style',
        get_template_directory_uri() . '/style.css'
    );
    wp_enqueue_style(
        'astra-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'astra-parent-style' )
    );
}

// Charger les fonts via wp_enqueue_styles
add_action( 'wp_enqueue_scripts', 'baobab_enqueue_fonts' );
function baobab_enqueue_fonts() {
    // Google Fonts - Space Grotesk & Space Mono
    wp_enqueue_style(
        'google-fonts-space-grotesk',
        'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap',
        array(),
        null
    );

    // Material Symbols
    wp_enqueue_style(
        'material-symbols',
        'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
        array(),
        null
    );
}

// Injecter Tailwind CDN + config dans le bon ordre via wp_head
add_action( 'wp_head', 'baobab_tailwind_cdn', 1 );
function baobab_tailwind_cdn() {
    ?>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#1abc9c",
                        "teal-accent": "#1abc9c",
                        "teal-bright": "#00ffc4",
                        "violet-accent": "#6c3483",
                        "violet-bright": "#b366ff",
                        "bg-dark": "#0b0c10",
                        "bg-card": "#12141a",
                        "bg-card-light": "#191c26",
                        "background-light": "#0b0c10",
                        "background-dark": "#0b0c10",
                    },
                    fontFamily: {
                        "display": ["Space Grotesk", "sans-serif"],
                        "mono": ["Space Mono", "monospace"],
                        "sans": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0px",
                        "lg": "0px",
                        "xl": "0px",
                        "2xl": "0px",
                        "full": "9999px"
                    }
                },
            },
        }
    </script>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <style>
        body {
            background-color: #0b0c10;
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
            background-image: 
                radial-gradient(rgba(108, 52, 131, 0.15) 1px, transparent 1px),
                radial-gradient(rgba(26, 188, 156, 0.12) 1px, transparent 1px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
        }
        .font-grotesk { font-family: 'Space Grotesk', sans-serif; }
        .font-mono-code { font-family: 'Space Mono', monospace; }
        .brutal-border-teal { border: 2px solid #1abc9c; }
        .brutal-border-violet { border: 2px solid #6c3483; }
        .brutal-border-white { border: 2px solid #ffffff; }
        .brutal-border-dark { border: 2px solid #262936; }
        .nsibidi-bg {
            background-image: linear-gradient(to bottom, rgba(11,12,16,0.85), rgba(11,12,16,0.95)), url('<?php echo get_stylesheet_directory_uri(); ?>/images/nsibidi_texture.jpg');
            background-size: cover;
            background-position: center;
        }
        .nsibidi-overlay {
            background: linear-gradient(135deg, rgba(108,52,131,0.2) 0%, rgba(26,188,156,0.15) 100%);
        }
    </style>
    <?php
}

// Ajouter les classes communes sur tous les <body>
add_filter( 'body_class', 'baobab_body_classes' );
function baobab_body_classes( $classes ) {
    $classes[] = 'baobab-site';
    $classes[] = 'bg-[#0b0c10]';
    $classes[] = 'text-slate-100';
    $classes[] = 'antialiased';
    $classes[] = 'overflow-x-hidden';
    $classes[] = 'selection:bg-[#1abc9c]';
    $classes[] = 'selection:text-black';
    return $classes;
}

// CUSTOM POST TYPE : SERVICES - PAGES DE SERVICES
// ========================================
//  créer un nouveau type de contenu dans WordPress. Par défaut WordPress a "Articles"
// et "Pages". On crée ici notre propre type : "Services".

// Polylang : désactiver complètement la traduction des médias
add_filter( 'pll_is_translated_post_type', function( $bool, $post_type ) {
    if ( 'attachment' === $post_type ) return false;
    return $bool;
}, 10, 2 );

// Polylang : médiathèque admin — toutes les images sans filtre de langue
add_filter( 'ajax_query_attachments_args', function( $query ) {
    unset( $query['lang'] );
    return $query;
} );
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() ) return;
    if ( $query->get( 'post_type' ) !== 'attachment' ) return;
    $query->set( 'lang', '' );
}, 999 );
add_action( 'parse_tax_query', function( $query ) {
    if ( empty( $query->tax_query->queries ) ) return;
    if ( $query->get( 'post_type' ) !== 'attachment' ) return;
    foreach ( $query->tax_query->queries as $k => $tq ) {
        if ( isset( $tq['taxonomy'] ) && $tq['taxonomy'] === 'language' ) {
            unset( $query->tax_query->queries[ $k ] );
        }
    }
}, PHP_INT_MAX );

// Fallback si Polylang est désactivé
if ( ! function_exists( 'pll__' ) ) {
    function pll__( $string ) { return $string; }
}

// Enregistrement des chaînes de navigation pour Polylang
add_action( 'init', 'baobab_register_nav_strings' );
function baobab_register_nav_strings() {
    if ( ! function_exists( 'pll_register_string' ) ) return;
    pll_register_string( 'nav_accueil',      'Accueil',       'Navigation' );
    pll_register_string( 'nav_services',     'Services',      'Navigation' );
    pll_register_string( 'nav_case_studies', 'Études de cas', 'Navigation' );
    pll_register_string( 'nav_insights',     'Insights',      'Navigation' );
    pll_register_string( 'nav_about',        'À propos',      'Navigation' );
    pll_register_string( 'nav_contact',      'Contact',       'Navigation' );
    pll_register_string( 'footer_nav',       'Navigation',           'Footer' );
    pll_register_string( 'footer_expertise', 'Expertise',            'Footer' );
    pll_register_string( 'footer_work',      'Travaillez avec nous', 'Footer' );
}

// add_action() dit à WordPress : "quand tu initialises (init),
// exécute ma fonction baobab_register_cpt_services"
add_action( 'init', 'baobab_register_cpt_services' );
function baobab_register_cpt_services() {

    register_post_type( 'services', array(
        'labels' => array(
            'name'               => 'Services',
            'singular_name'      => 'Service',
            'add_new'            => 'Ajouter un service',
            'add_new_item'       => 'Ajouter un nouveau service',
            'edit_item'          => 'Modifier le service',
            'all_items'          => 'Tous les services',
            'menu_name'          => 'Services',
        ),
        'public'        => true,
        'has_archive'   => false,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-hammer',
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'menu_position' => 5,
    ) );
}


// CRÉATION DES CHAMPS ACF POUR LES SERVICES
// ============================================================
// ACF permet d'ajouter des champs
// personnalisés à nos Services. Sans ACF, un Service aurait
// seulement un Titre. Avec ACF, on peut ajouter : icône,
// description du problème, solution, stack technique, etc.
//
// On utilise acf_add_local_field_group() qui est la façon
// de créer des champs ACF directement en PHP (dans le code)
// plutôt que via l'interface admin d'ACF.
// AVANTAGE : le code est portable, pas stocké en base de données
// ============================================================
add_action( 'acf/init', 'baobab_acf_fields_services' );
function baobab_acf_fields_services() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;


    // acf_add_local_field_group() crée un groupe de champs.
    // Un "groupe" = un bloc de champs qui apparaît ensemble
    // dans la page d'édition d'un Service dans l'admin.
    acf_add_local_field_group( array(
        'key'      => 'group_services',
        'title'    => 'Détails du Service',
        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'services',
        ) ) ),
        'fields' => array(

            // Icône Material Symbols
            array(
                'key'           => 'field_service_icon',
                'label'         => 'Icône (Material Symbols)',
                'name'          => 'service_icon',
                'type'          => 'text',
                'instructions'  => 'Ex: developer_mode, smartphone, shield, insights...',
                'placeholder'   => 'developer_mode',
            ),

            // Problème business
            array(
                'key'           => 'field_service_problem',
                'label'         => 'Problème Business',
                'name'          => 'service_problem',
                'type'          => 'textarea',
                'rows'          => 3,
            ),

            // Solution stratégique
            array(
                'key'           => 'field_service_solution',
                'label'         => 'Solution Stratégique',
                'name'          => 'service_solution',
                'type'          => 'textarea',
                'rows'          => 3,
            ),

            // Points forts (repeater)
            array(
                'key'        => 'field_service_features',
                'label'      => 'Points forts',
                'name'       => 'service_features',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 4,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_service_feature_item',
                        'label' => 'Point fort',
                        'name'  => 'feature_item',
                        'type'  => 'text',
                    ),
                ),
            ),

            // Stack technique (repeater)
            array(
                'key'        => 'field_service_stack',
                'label'      => 'Stack Technique',
                'name'       => 'service_stack',
                'type'       => 'repeater',
                'min'        => 1,
                'max'        => 6,
                'layout'     => 'table',
                'sub_fields' => array(
                    array(
                        'key'   => 'field_service_stack_item',
                        'label' => 'Technologie',
                        'name'  => 'stack_item',
                        'type'  => 'text',
                    ),
                ),
            ),

            // Texte du bouton CTA
            array(
                'key'           => 'field_service_cta',
                'label'         => 'Texte du bouton',
                'name'          => 'service_cta',
                'type'          => 'text',
                'default_value' => 'Start Your Project',
            ),

            // Ordre d'affichage
            array(
                'key'   => 'field_service_order',
                'label' => 'Ordre d\'affichage',
                'name'  => 'service_order',
                'type'  => 'number',
            ),

        ),
    ) );
}


// ============================================================
// CHAMPS ACF PRO : SECTION "PILIERS" — PAGE SERVICES
// ============================================================
// Chaque pilier a une icône, un titre et une description.
// ============================================================
add_action( 'acf/init', 'baobab_acf_pillars' );

function baobab_acf_pillars() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_pillars',
        'title' => 'Page Services — Piliers',

        // Nouvelle methode — par titre de page
        'location' => array(
             array( 
                array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'page',
            ) ,
            array(
            'param'    => 'page_template',
            'operator' => '==',
            'value'    => 'page-service.php',
        ),
        )
         ),

        'fields' => array(

            array(
                'key'          => 'field_pillars',
                'label'        => 'Piliers',
                'name'         => 'pillars',        // get_field('pillars')
                'type'         => 'repeater',
                'button_label' => 'Ajouter un pilier',
                'min'          => 0,
                'max'          => 8,
                'layout'       => 'block',

                'sub_fields' => array(

                    array(
                        'key'           => 'field_pillar_icon',
                        'label'         => 'Icône',
                        'name'          => 'pillar_icon',
                        'type'          => 'text',
                        'instructions'  => 'Nom Material Symbols. Ex: auto_fix_high',
                        'default_value' => 'star',
                        'wrapper'       => array( 'width' => '20' ),
                    ),

                    array(
                        'key'     => 'field_pillar_title',
                        'label'   => 'Titre du pilier',
                        'name'    => 'pillar_title',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '30' ),
                    ),

                    array(
                        'key'     => 'field_pillar_desc',
                        'label'   => 'Description',
                        'name'    => 'pillar_desc',
                        'type'    => 'textarea',
                        'rows'    => 2,
                        'wrapper' => array( 'width' => '50' ),
                    ),

                ),
            ),

        ),
    ) );
}


// ============================================================
// CHAMPS ACF : PAGE SERVICES — HERO
// ============================================================
add_action( 'acf/init', 'baobab_acf_services_hero' );

function baobab_acf_services_hero() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_services_hero',
        'title' => 'Page Services — Hero',
        'location' => array( array(
            array( 'param' => 'post_type',      'operator' => '==', 'value' => 'page' ),
            array( 'param' => 'page_template',  'operator' => '==', 'value' => 'page-service.php' ),
        ) ),
        'fields' => array(

            array(
                'key'     => 'field_srv_sep_hero',
                'label'   => 'SECTION — Hero',
                'name'    => '',
                'type'    => 'message',
                'message' => 'Textes et cartes flottantes du hero de la page Services.',
            ),

            array(
                'key'           => 'field_srv_hero_badge',
                'label'         => 'Badge (petit texte vert)',
                'name'          => 'srv_hero_badge',
                'type'          => 'text',
                'default_value' => 'Innovative Technology Partner',
            ),

            array(
                'key'           => 'field_srv_hero_title',
                'label'         => 'Titre — ligne 1',
                'name'          => 'srv_hero_title',
                'type'          => 'text',
                'default_value' => 'Our Strategic',
                'wrapper'       => array( 'width' => '50' ),
            ),

            array(
                'key'           => 'field_srv_hero_title_colored',
                'label'         => 'Titre — ligne 2 (dégradé vert)',
                'name'          => 'srv_hero_title_colored',
                'type'          => 'text',
                'default_value' => 'Services',
                'wrapper'       => array( 'width' => '50' ),
            ),

            array(
                'key'           => 'field_srv_hero_text',
                'label'         => 'Description',
                'name'          => 'srv_hero_text',
                'type'          => 'textarea',
                'rows'          => 3,
                'default_value' => 'Driving exponential growth through custom software innovation and digital transformation tailored for the African market landscape.',
            ),

            array(
                'key'           => 'field_srv_btn1_text',
                'label'         => 'Bouton 1 — Texte',
                'name'          => 'srv_btn1_text',
                'type'          => 'text',
                'default_value' => 'Explore Solutions',
                'wrapper'       => array( 'width' => '50' ),
            ),

            array(
                'key'           => 'field_srv_btn2_text',
                'label'         => 'Bouton 2 — Texte',
                'name'          => 'srv_btn2_text',
                'type'          => 'text',
                'default_value' => 'View Our Work',
                'wrapper'       => array( 'width' => '50' ),
            ),

            array(
                'key'          => 'field_srv_tech_cards',
                'label'        => 'Cartes tech flottantes (9 recommandées)',
                'name'         => 'srv_tech_cards',
                'type'         => 'repeater',
                'button_label' => 'Ajouter une carte',
                'min'          => 1,
                'max'          => 12,
                'layout'       => 'table',
                'sub_fields'   => array(
                    array(
                        'key'           => 'field_srv_card_icon',
                        'label'         => 'Icône Material Symbols',
                        'name'          => 'card_icon',
                        'type'          => 'text',
                        'default_value' => 'code',
                        'wrapper'       => array( 'width' => '40' ),
                    ),
                    array(
                        'key'           => 'field_srv_card_label',
                        'label'         => 'Label',
                        'name'          => 'card_label',
                        'type'          => 'text',
                        'default_value' => 'Dev & APIs',
                        'wrapper'       => array( 'width' => '60' ),
                    ),
                ),
            ),

        ),
    ) );
}


// ============================================================
// CHAMPS ACF : PAGE HOME (ID = 11)
// ============================================================
// On regroupe tous les champs de la home dans un seul groupe.
// La localisation cible directement l'ID 11 (page Home)
// combinée avec post_type = page pour plus de fiabilité.
// ============================================================
add_action( 'acf/init', 'baobab_acf_home' );

function baobab_acf_home() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_home',
        'title' => 'Page Home — Toutes les sections',

        // Même combinaison qui a fonctionné pour Services
        'location' => array( array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'page',
            ),
            array(
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'front-page.php',
            ),
        ) ),

        'fields' => array(

            // ================================================
            // BANDEAU / NAVIGATION : LOGO SITE (optionnel)
            // ================================================

            array(
                'key'          => 'field_site_logo',
                'label'        => 'Logo du site (header)',
                'name'         => 'site_logo',
                'type'         => 'image',
                'return_format'=> 'url',
                'preview_size' => 'medium',
                'instructions' => 'Image affichée dans le header. Laissez vide pour le monogramme SVG par défaut.',
            ),

            // Portrait photo du Hero (right column)
            array(
                'key'          => 'field_home_portrait',
                'label'        => 'Portrait / photo de couverture (Hero)',
                'name'         => 'home_portrait',
                'type'         => 'image',
                'return_format'=> 'url',
                'preview_size' => 'large',
                'instructions' => 'Photo affichée en grand dans le Hero de l\'accueil (format portrait 4/5 recommandé). Laissez vide pour garder l\'image par défaut.',
            ),

            // ================================================
            // STATISTIQUES CLÉS
            // ================================================

            array(
                'key'     => 'field_home_sep_stats',
                'label'   => '📊 Statistiques clés',
                'name'    => '',
                'type'    => 'message',
                'message' => 'Chiffres affichés sous le hero.',
            ),
            array(
                'key'           => 'field_stat1_value',
                'label'         => 'Stat 1 — Valeur',
                'name'          => 'stat1_value',
                'type'          => 'text',
                'default_value' => '5',
                'wrapper'       => array( 'width' => '25' ),
            ),
            array(
                'key'           => 'field_stat1_suffix',
                'label'         => 'Stat 1 — Suffixe',
                'name'          => 'stat1_suffix',
                'type'          => 'text',
                'default_value' => '+',
                'wrapper'       => array( 'width' => '25' ),
            ),
            array(
                'key'           => 'field_stat1_label',
                'label'         => 'Stat 1 — Label',
                'name'          => 'stat1_label',
                'type'          => 'text',
                'default_value' => 'Années Expérience',
                'wrapper'       => array( 'width' => '50' ),
            ),

            array(
                'key'           => 'field_stat2_value',
                'label'         => 'Stat 2 — Valeur',
                'name'          => 'stat2_value',
                'type'          => 'text',
                'default_value' => '50',
                'wrapper'       => array( 'width' => '25' ),
            ),
            array(
                'key'           => 'field_stat2_suffix',
                'label'         => 'Stat 2 — Suffixe',
                'name'          => 'stat2_suffix',
                'type'          => 'text',
                'default_value' => '+',
                'wrapper'       => array( 'width' => '25' ),
            ),
            array(
                'key'           => 'field_stat2_label',
                'label'         => 'Stat 2 — Label',
                'name'          => 'stat2_label',
                'type'          => 'text',
                'default_value' => 'Projets Livrés',
                'wrapper'       => array( 'width' => '50' ),
            ),

            array(
                'key'           => 'field_stat3_value',
                'label'         => 'Stat 3 — Valeur',
                'name'          => 'stat3_value',
                'type'          => 'text',
                'default_value' => '8',
                'wrapper'       => array( 'width' => '25' ),
            ),
            array(
                'key'           => 'field_stat3_suffix',
                'label'         => 'Stat 3 — Suffixe',
                'name'          => 'stat3_suffix',
                'type'          => 'text',
                'default_value' => '',
                'wrapper'       => array( 'width' => '25' ),
            ),
            array(
                'key'           => 'field_stat3_label',
                'label'         => 'Stat 3 — Label',
                'name'          => 'stat3_label',
                'type'          => 'text',
                'default_value' => 'Pays Couverts',
                'wrapper'       => array( 'width' => '50' ),
            ),

            array(
                'key'           => 'field_stat4_value',
                'label'         => 'Stat 4 — Valeur',
                'name'          => 'stat4_value',
                'type'          => 'text',
                'default_value' => '30',
                'wrapper'       => array( 'width' => '25' ),
            ),
            array(
                'key'           => 'field_stat4_suffix',
                'label'         => 'Stat 4 — Suffixe',
                'name'          => 'stat4_suffix',
                'type'          => 'text',
                'default_value' => '+',
                'wrapper'       => array( 'width' => '25' ),
            ),
            array(
                'key'           => 'field_stat4_label',
                'label'         => 'Stat 4 — Label',
                'name'          => 'stat4_label',
                'type'          => 'text',
                'default_value' => 'Clients Total',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // ================================================
            // SECTION : CORE SERVICES PREVIEW
            // ================================================

            array(
                'key'           => 'field_services_title',
                'label'         => 'Titre services',
                'name'          => 'home_services_title',
                'type'          => 'text',
                'default_value' => 'Core Expertise',
            ),

            array(
                'key'           => 'field_services_text',
                'label'         => 'Texte services',
                'name'          => 'home_services_text',
                'type'          => 'textarea',
                'rows'          => 2,
            ),

            // ================================================
            // SECTION : CASE STUDIES PREVIEW
            // ================================================

            array(
                'key'           => 'field_cases_title',
                'label'         => 'Titre études de cas',
                'name'          => 'home_cases_title',
                'type'          => 'text',
                'default_value' => 'Selected Impact Stories',
            ),

        ), // fin fields
    ) ); // fin acf_add_local_field_group
}

// ============================================================
// CUSTOM POST TYPE : CASE STUDIES
// ============================================================
// Un Case Study = un projet livré pour un client.
// On crée aussi une Taxonomie pour les catégories (Web, AI...)
// Une Taxonomie c'est comme les "catégories" des articles WordPress
// mais personnalisée pour notre CPT.
// ============================================================
add_action( 'init', 'baobab_register_cpt_case_studies' );

function baobab_register_cpt_case_studies() {

    // --- CPT CASE STUDIES ---
    register_post_type( 'case_studies', array(
        'labels' => array(
            'name'          => 'Case Studies',
            'singular_name' => 'Case Study',
            'add_new_item'  => 'Ajouter un Case Study',
            'edit_item'     => 'Modifier le Case Study',
            'all_items'     => 'Tous les Case Studies',
            'menu_name'     => 'Case Studies',
        ),
        'public'        => true,
        'has_archive'   => true,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-portfolio',
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
        'menu_position' => 6,
    ) );

    // --- TAXONOMIE : CATÉGORIE DE SERVICE ---
    // register_taxonomy() crée un système de catégories
    // pour notre CPT case_studies.
    // 1er argument : slug de la taxonomie
    // 2ème argument : à quel CPT elle est rattachée
    // 3ème argument : options
    register_taxonomy( 'case_category', 'case_studies', array(
        'labels' => array(
            'name'          => 'Catégories',
            'singular_name' => 'Catégorie',
            'add_new_item'  => 'Ajouter une catégorie',
            'edit_item'     => 'Modifier la catégorie',
            'all_items'     => 'Toutes les catégories',
        ),

        // hierarchical = true → fonctionne comme des catégories (parent/enfant)
        // hierarchical = false → fonctionne comme des tags (plat)
        // On met true car on veut des catégories fixes
        'hierarchical' => true,

        'show_in_menu'  => true,
        'show_ui'       => true, // Visible dans l'admin
        'rewrite'       => array( 'slug' => 'case-category' ),
    ) );
}

// ============================================================
// CHAMPS ACF : CASE STUDIES
// ============================================================
add_action( 'acf/init', 'baobab_acf_case_studies' );

function baobab_acf_case_studies() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_case_studies',
        'title' => 'Détails du Case Study',

        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'case_studies',
        ) ) ),

        'fields' => array(

            // Image principale du projet
            array(
                'key'           => 'field_case_image',
                'label'         => 'Image du projet',
                'name'          => 'case_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
            ),

            // Texte alternatif de l'image (accessibilité)
            array(
                'key'          => 'field_case_image_alt',
                'label'        => 'Description de l\'image (alt)',
                'name'         => 'case_image_alt',
                'type'         => 'text',
                'instructions' => 'Ex: Tableau de bord fintech avec visualisations de données. Laissez vide pour utiliser le titre.',
            ),

            // Problème client
            array(
                'key'   => 'field_case_problem',
                'label' => 'Problème Client',
                'name'  => 'case_problem',
                'type'  => 'textarea',
                'rows'  => 3,
            ),

            // Solution stratégique
            array(
                'key'   => 'field_case_solution',
                'label' => 'Solution Stratégique',
                'name'  => 'case_solution',
                'type'  => 'textarea',
                'rows'  => 3,
            ),

            // Stack technique (textarea : une techno par ligne)
            array(
                'key'          => 'field_case_stack',
                'label'        => 'Stack Technique',
                'name'         => 'case_stack',
                'type'         => 'text',
                'instructions' => 'Ex: Python, TensorFlow, AWS SageMaker',
            ),

            // Résultats mesurables
            array(
                'key'          => 'field_case_results',
                'label'        => 'Résultats Mesurables',
                'name'         => 'case_results',
                'type'         => 'text',
                'instructions' => 'Ex: 40% reduction in false positives',
            ),

            // Ordre d'affichage
            array(
                'key'   => 'field_case_order',
                'label' => 'Ordre d\'affichage',
                'name'  => 'case_order',
                'type'  => 'number',
            ),

            // Client / secteur
            array(
                'key'     => 'field_case_client',
                'label'   => 'Client / Secteur',
                'name'    => 'case_client',
                'type'    => 'text',
                'wrapper' => array( 'width' => '50' ),
            ),

            // Badge secondaire (ex: MTN CAMEROON // AUDIT)
            array(
                'key'     => 'field_case_meta',
                'label'   => 'Badge secondaire',
                'name'    => 'case_meta',
                'type'    => 'text',
                'wrapper' => array( 'width' => '50' ),
                'instructions' => 'Ex: MTN CAMEROON // INSIDER AUDIT',
            ),

            // Contexte / problème détaillé
            array(
                'key'   => 'field_case_context',
                'label' => 'Contexte / Problème détaillé',
                'name'  => 'case_context',
                'type'  => 'textarea',
                'rows'  => 4,
            ),

            // Démarche (étapes)
            array(
                'key'          => 'field_case_approach',
                'label'        => 'Démarche (étapes)',
                'name'         => 'case_approach',
                'type'         => 'repeater',
                'button_label' => 'Ajouter une étape',
                'min'          => 0,
                'max'          => 8,
                'layout'       => 'table',
                'sub_fields'   => array(
                    array(
                        'key'   => 'field_case_approach_step',
                        'label' => 'Étape',
                        'name'  => 'approach_step',
                        'type'  => 'text',
                    ),
                ),
            ),

            // Points clés / vulnérabilités
            array(
                'key'          => 'field_case_findings',
                'label'        => 'Points clés / Vulnérabilités',
                'name'         => 'case_findings',
                'type'         => 'repeater',
                'button_label' => 'Ajouter un point',
                'min'          => 0,
                'max'          => 4,
                'layout'       => 'table',
                'sub_fields'   => array(
                    array(
                        'key'     => 'field_case_finding_label',
                        'label'   => 'Label',
                        'name'    => 'finding_label',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '30' ),
                    ),
                    array(
                        'key'     => 'field_case_finding_text',
                        'label'   => 'Texte',
                        'name'    => 'finding_text',
                        'type'    => 'textarea',
                        'rows'    => 2,
                        'wrapper' => array( 'width' => '70' ),
                    ),
                ),
            ),

            // Impact & solutions proposées
            array(
                'key'   => 'field_case_impact',
                'label' => 'Impact / Solutions proposées',
                'name'  => 'case_impact',
                'type'  => 'textarea',
                'rows'  => 4,
            ),

            // Case study à la une
            array(
                'key'           => 'field_case_featured',
                'label'         => 'Case Study à la une',
                'name'          => 'case_featured',
                'type'          => 'true_false',
                'default_value' => 0,
                'ui'            => 1,
            ),

        ),
    ) );
}

// ============================================================
// CHARGEMENT DES SCRIPTS JS PERSONNALISÉS
// ============================================================
add_action( 'wp_enqueue_scripts', 'baobab_enqueue_scripts' );

function baobab_enqueue_scripts() {

    // On charge le filtre JS UNIQUEMENT sur la page case studies
    // is_page() vérifie si on est sur une page spécifique
    // On lui passe le slug de la page
    if ( is_page( 'case-studies' ) ) {

        // wp_enqueue_script() charge un fichier JS
        // Argument 1 : nom unique du script (handle)
        // Argument 2 : chemin vers le fichier
        //   get_stylesheet_directory_uri() = URL du thème enfant
        // Argument 3 : dépendances (scripts à charger avant)
        //   array('jquery') = jQuery doit être chargé avant
        //   array() = pas de dépendances
        // Argument 4 : version (pour éviter le cache navigateur)
        // Argument 5 : true = charger en bas de page (avant </body>)
        //              false = charger dans le <head>
        wp_enqueue_script(
            'baobab-case-filter',
            get_stylesheet_directory_uri() . '/js/case-studies-filter.js',
            array(),   // Pas besoin de jQuery, on utilise le JS natif
            '1.0.2',
            true       // Chargé en bas de page = meilleures performances
        );

    }

    // Filtre insights — sur la page liste
    if ( is_page_template( 'page-insights.php' ) || is_page( 'blog' ) ) {
        wp_enqueue_script(
            'baobab-insights-filter',
            get_stylesheet_directory_uri() . '/js/insights-filter.js',
            array(),
            '1.0.0',
            true
        );
    }
}

// ============================================================
// ============================================================
// CHAMPS ACF : PAGE CASE STUDIES (template page-case-study.php)
// ============================================================
add_action( 'acf/init', 'baobab_acf_case_study_page' );

function baobab_acf_case_study_page() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_case_study_page',
        'title' => 'Page Case Studies — Hero',

        'location' => array( array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'page',
            ),
            array(
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'page-case-study.php',
            ),
        ) ),

        'fields' => array(
            array(
                'key'           => 'field_cs_hero_title',
                'label'         => 'Titre',
                'name'          => 'cs_hero_title',
                'type'          => 'text',
                'default_value' => 'Case Studies',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'   => 'field_cs_hero_desc',
                'label' => 'Description',
                'name'  => 'cs_hero_desc',
                'type'  => 'textarea',
                'rows'  => 3,
                'wrapper' => array( 'width' => '50' ),
            ),

            // ── CTA ──
            array(
                'key'     => 'field_cs_sep_cta',
                'label'   => 'SECTION — CTA',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_cs_cta_badge',
                'label'         => 'Badge',
                'name'          => 'cs_cta_badge',
                'type'          => 'text',
                'default_value' => 'Nouveaux projets ouverts',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_cs_cta_title1',
                'label'         => 'Titre ligne 1',
                'name'          => 'cs_cta_title1',
                'type'          => 'text',
                'default_value' => 'Prêt à construire votre',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_cs_cta_title2',
                'label'         => 'Titre ligne 2 (dégradé)',
                'name'          => 'cs_cta_title2',
                'type'          => 'text',
                'default_value' => 'histoire de succès ?',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'   => 'field_cs_cta_text',
                'label' => 'Texte',
                'name'  => 'cs_cta_text',
                'type'  => 'textarea',
                'rows'  => 2,
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_cs_cta_btn1',
                'label'         => 'Bouton 1',
                'name'          => 'cs_cta_btn1',
                'type'          => 'text',
                'default_value' => 'Démarrer un projet',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_cs_cta_btn2',
                'label'         => 'Bouton 2',
                'name'          => 'cs_cta_btn2',
                'type'          => 'text',
                'default_value' => 'Voir nos services',
                'wrapper'       => array( 'width' => '50' ),
            ),
        ),
    ) );
}

// ============================================================
// CHAMPS ACF : PAGE INSIGHTS (template page-insights.php)
// ============================================================
add_action( 'acf/init', 'baobab_acf_insights_page' );

function baobab_acf_insights_page() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_insights_page',
        'title' => 'Page Insights — Sections',

        'location' => array( array(
            array( 'param' => 'post_type',     'operator' => '==', 'value' => 'page' ),
            array( 'param' => 'page_template', 'operator' => '==', 'value' => 'page-insights.php' ),
        ) ),

        'fields' => array(

            // ── HERO ──
            array( 'key' => 'field_ins_sep_hero', 'label' => '📰 SECTION — Hero', 'name' => '', 'type' => 'message', 'message' => '' ),
            array(
                'key'           => 'field_ins_title1',
                'label'         => 'Titre ligne 1',
                'name'          => 'ins_title1',
                'type'          => 'text',
                'default_value' => 'Insights &',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_ins_title2',
                'label'         => 'Titre ligne 2',
                'name'          => 'ins_title2',
                'type'          => 'text',
                'default_value' => 'Perspectives',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'  => 'field_ins_subtitle',
                'label' => 'Sous-titre',
                'name'  => 'ins_subtitle',
                'type'  => 'textarea',
                'rows'  => 2,
            ),
            array(
                'key'           => 'field_ins_tab_all',
                'label'         => 'Label onglet "Tous"',
                'name'          => 'ins_tab_all',
                'type'          => 'text',
                'default_value' => 'Tous les articles',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // ── FEATURED ──
            array( 'key' => 'field_ins_sep_featured', 'label' => 'SECTION — Article featured', 'name' => '', 'type' => 'message', 'message' => '' ),
            array(
                'key'           => 'field_ins_featured_label',
                'label'         => 'Label "Featured Article"',
                'name'          => 'ins_featured_label',
                'type'          => 'text',
                'default_value' => 'Article à la une',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_ins_read_cta',
                'label'         => 'Bouton "Lire l\'article"',
                'name'          => 'ins_read_cta',
                'type'          => 'text',
                'default_value' => 'Lire l\'analyse complète',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // ── GRILLE ──
            array( 'key' => 'field_ins_sep_grid', 'label' => '🗂️ SECTION — Grille articles', 'name' => '', 'type' => 'message', 'message' => '' ),
            array(
                'key'           => 'field_ins_grid_title',
                'label'         => 'Titre section grille',
                'name'          => 'ins_grid_title',
                'type'          => 'text',
                'default_value' => 'Derniers Insights',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_ins_load_more',
                'label'         => 'Bouton "Charger plus"',
                'name'          => 'ins_load_more',
                'type'          => 'text',
                'default_value' => 'Charger plus d\'articles',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // ── NEWSLETTER ──
            array( 'key' => 'field_ins_sep_nl', 'label' => '📧 SECTION — Newsletter', 'name' => '', 'type' => 'message', 'message' => '' ),
            array(
                'key'           => 'field_ins_nl_title',
                'label'         => 'Titre',
                'name'          => 'ins_nl_title',
                'type'          => 'text',
                'default_value' => 'Abonnez-vous à notre Newsletter',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'  => 'field_ins_nl_text',
                'label' => 'Texte',
                'name'  => 'ins_nl_text',
                'type'  => 'textarea',
                'rows'  => 2,
                'wrapper' => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_ins_nl_placeholder',
                'label'         => 'Placeholder email',
                'name'          => 'ins_nl_placeholder',
                'type'          => 'text',
                'default_value' => 'Votre adresse email',
                'wrapper'       => array( 'width' => '34' ),
            ),
            array(
                'key'           => 'field_ins_nl_btn',
                'label'         => 'Texte bouton',
                'name'          => 'ins_nl_btn',
                'type'          => 'text',
                'default_value' => "S'abonner",
                'wrapper'       => array( 'width' => '33' ),
            ),
            array(
                'key'           => 'field_ins_nl_disclaimer',
                'label'         => 'Disclaimer',
                'name'          => 'ins_nl_disclaimer',
                'type'          => 'text',
                'default_value' => 'Pas de spam. Seulement des insights de qualité. Désinscription à tout moment.',
                'wrapper'       => array( 'width' => '33' ),
            ),
        ),
    ) );
}

// CHAMPS ACF : INSIGHTS (Articles WordPress natifs)
// ============================================================
// On ajoute des champs personnalisés aux articles WordPress.
// WordPress gère déjà : titre, contenu, catégorie, date, auteur.
// ACF ajoute : galerie d'images, temps de lecture, featured.
// ============================================================
add_action( 'acf/init', 'baobab_acf_insights' );

function baobab_acf_insights() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_insights',
        'title' => 'Détails de l\'Insight',

        // S'affiche sur tous les Articles WordPress natifs
        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'post', // 'post' = Articles natifs WordPress
        ) ) ),

        'fields' => array(

            // Temps de lecture (affiché dans les cartes et la page détail)
            array(
                'key'           => 'field_insight_read_time',
                'label'         => 'Temps de lecture',
                'name'          => 'insight_read_time',
                'type'          => 'text',
                'instructions'  => 'Ex: 8 min read',
                'default_value' => '5 min read',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // Article mis en avant (Featured)
            // true = cet article apparaît en grande section Featured
            // false = apparaît dans la grille normale
            array(
                'key'           => 'field_insight_featured',
                'label'         => 'Article mis en avant (Featured)',
                'name'          => 'insight_featured',
                'type'          => 'true_false',  // Case à cocher on/off
                'ui'            => 1,             // Afficher comme un toggle switch
                'default_value' => 0,             // Par défaut : non featured
                'wrapper'       => array( 'width' => '50' ),
            ),

            // Galerie d'images
            // ACF Pro : 'gallery' = champ galerie avec plusieurs images
            // Retourne un tableau d'URLs d'images
            array(
                'key'           => 'field_insight_gallery',
                'label'         => 'Galerie d\'images',
                'name'          => 'insight_gallery',
                'type'          => 'gallery',      // Type galerie ACF Pro
                'return_format' => 'url',           // On veut les URLs
                'preview_size'  => 'medium',
                'instructions'  => 'La première image sera utilisée comme image principale dans la liste.',
                'min'           => 1,
                'max'           => 10,
            ),

        ),
    ) );
}
// ============================================================
// CHAMPS ACF : PAGE ABOUT (ID = 13)
// ============================================================
add_action( 'acf/init', 'baobab_acf_about' );

function baobab_acf_about() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_about',
        'title' => 'Page About — Toutes les sections',

        'location' => array( array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'page',
            ),
            array(
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'page-about.php',
            ),
        ) ),

        'fields' => array(

            // ================================================
            // IMAGE HERO
            // ================================================
            array(
                'key'           => 'field_about_hero_image',
                'label'         => 'Image Hero',
                'name'          => 'about_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
            ),

            // ================================================
            // SECTION : TIMELINE
            // ================================================
            array(
                'key'           => 'field_timeline_title',
                'label'         => 'Titre timeline',
                'name'          => 'timeline_title',
                'type'          => 'text',
                'default_value' => 'Mon Parcours',
            ),
            // Repeater pour les étapes de la timeline
            array(
                'key'          => 'field_timeline_items',
                'label'        => 'Étapes',
                'name'         => 'timeline_items',
                'type'         => 'repeater',
                'button_label' => 'Ajouter une étape',
                'min'          => 0,
                'max'          => 10,
                'layout'       => 'block',
                'sub_fields'   => array(
                    array(
                        'key'          => 'field_timeline_icon',
                        'label'        => 'Icône',
                        'name'         => 'timeline_icon',
                        'type'         => 'text',
                        'default_value'=> 'work',
                        'wrapper'      => array( 'width' => '20' ),
                    ),
                    array(
                        'key'     => 'field_timeline_item_title',
                        'label'   => 'Titre (ex: 2020: The Foundation)',
                        'name'    => 'timeline_item_title',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '40' ),
                    ),
                    array(
                        'key'     => 'field_timeline_desc',
                        'label'   => 'Description',
                        'name'    => 'timeline_item_desc',
                        'type'    => 'textarea',
                        'rows'    => 2,
                        'wrapper' => array( 'width' => '40' ),
                    ),
                    // Future = affichage en opacité réduite + bordure pointillée
                    array(
                        'key'     => 'field_timeline_future',
                        'label'   => 'Étape future ?',
                        'name'    => 'timeline_future',
                        'type'    => 'true_false',
                        'ui'      => 1,
                        'wrapper' => array( 'width' => '20' ),
                    ),
                ),
            ),

        ), // fin fields
    ) ); // fin acf_add_local_field_group
}

// (CPT team_member + group_team_member + group_team_page supprimés — obsolètes)

// ============================================================

// ============================================================
// CHAMPS ACF : PAGE CONTACT (ID = 23)
// ============================================================
add_action( 'acf/init', 'baobab_acf_contact' );

function baobab_acf_contact() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_contact',
        'title' => 'Page Contact — Toutes les sections',

        'location' => array( array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'page',
            ),
            array(
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'page-contact.php',
            ),
        ) ),

        'fields' => array(

            // ── INFOS CONTACT ──
            array(
                'key'           => 'field_contact_address',
                'label'         => 'Adresse',
                'name'          => 'contact_address',
                'type'          => 'textarea',
                'rows'          => 2,
                'default_value' => 'Yaoundé, Cameroun',
            ),
            array(
                'key'           => 'field_contact_email',
                'label'         => 'Email',
                'name'          => 'contact_email',
                'type'          => 'text',
                'default_value' => 'armel.njike@yahoo.com',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_contact_phone',
                'label'         => 'Téléphone',
                'name'          => 'contact_phone',
                'type'          => 'text',
                'default_value' => '+237 676 398 049',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // ── FORMULAIRE ──
            array(
                'key'           => 'field_contact_form_title',
                'label'         => 'Titre du formulaire',
                'name'          => 'contact_form_title',
                'type'          => 'text',
                'default_value' => 'Envoyez-moi un message',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_contact_recipient',
                'label'         => 'Email de réception des messages',
                'name'          => 'contact_recipient',
                'type'          => 'text',
                'default_value' => get_option( 'admin_email' ),
                'instructions'  => 'Les soumissions du formulaire seront envoyées ici.',
                'wrapper'       => array( 'width' => '50' ),
            ),

        ),
    ) );
}

// ============================================================
// CHAMPS ACF : PAGE PROCESS (template page-process.php)
// ============================================================
add_action( 'acf/init', 'baobab_acf_process' );

function baobab_acf_process() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_process',
        'title' => 'Page Process — Méthodologie',

        'location' => array( array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'page',
            ),
            array(
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'page-process.php',
            ),
        ) ),

        'fields' => array(

            // ── HERO ──
            array(
                'key'           => 'field_process_hero_badge',
                'label'         => 'Badge Hero',
                'name'          => 'process_hero_badge',
                'type'          => 'text',
                'default_value' => 'MÉTHODOLOGIE // APPROCHE',
            ),
            array(
                'key'           => 'field_process_hero_title',
                'label'         => 'Titre Hero (ligne 1)',
                'name'          => 'process_hero_title',
                'type'          => 'text',
                'default_value' => 'COMMENT JE',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_process_hero_title_colored',
                'label'         => 'Titre Hero (ligne 2 — couleur)',
                'name'          => 'process_hero_title_colored',
                'type'          => 'text',
                'default_value' => 'TRAVAILLE.',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_process_hero_text',
                'label'         => 'Description Hero',
                'name'          => 'process_hero_text',
                'type'          => 'textarea',
                'rows'          => 3,
                'default_value' => 'Du cadrage initial à la livraison finale, chaque étape est pensée pour réduire les risques, clarifier les attentes et garantir une solution qui répond exactement à votre besoin métier.',
            ),

            // ── STEPS REPEATER ──
            array(
                'key'   => 'field_process_steps',
                'label' => 'Étapes du processus',
                'name'  => 'process_steps',
                'type'  => 'repeater',
                'min'   => 1,
                'max'   => 8,
                'button_label' => 'Ajouter une étape',
                'sub_fields' => array(
                    array(
                        'key'           => 'field_step_icon',
                        'label'         => 'Icone (Material Symbols)',
                        'name'          => 'step_icon',
                        'type'          => 'text',
                        'default_value' => 'arrow_forward',
                        'wrapper'       => array( 'width' => '25' ),
                    ),
                    array(
                        'key'           => 'field_step_title',
                        'label'         => 'Titre de l\'étape',
                        'name'          => 'step_title',
                        'type'          => 'text',
                        'wrapper'       => array( 'width' => '75' ),
                    ),
                    array(
                        'key'           => 'field_step_desc',
                        'label'         => 'Description',
                        'name'          => 'step_desc',
                        'type'          => 'textarea',
                        'rows'          => 3,
                    ),
                    array(
                        'key'   => 'field_step_details',
                        'label' => 'Sous-points',
                        'name'  => 'step_details',
                        'type'  => 'repeater',
                        'min'   => 1,
                        'max'   => 6,
                        'button_label' => 'Ajouter un point',
                        'sub_fields' => array(
                            array(
                                'key'   => 'field_detail_item',
                                'label' => 'Point',
                                'name'  => 'detail_item',
                                'type'  => 'text',
                            ),
                        ),
                    ),
                ),
            ),

            // ── CTA ──
            array(
                'key'           => 'field_process_cta_badge',
                'label'         => 'Badge CTA',
                'name'          => 'process_cta_badge',
                'type'          => 'text',
                'default_value' => '[PRÊT À DÉMARRER?]',
            ),
            array(
                'key'           => 'field_process_cta_title1',
                'label'         => 'Titre CTA (ligne 1)',
                'name'          => 'process_cta_title1',
                'type'          => 'text',
                'default_value' => 'UN PROJET EN TÊTE?',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_process_cta_title2',
                'label'         => 'Titre CTA (ligne 2)',
                'name'          => 'process_cta_title2',
                'type'          => 'text',
                'default_value' => 'PARLONS-EN.',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_process_cta_text',
                'label'         => 'Texte CTA',
                'name'          => 'process_cta_text',
                'type'          => 'textarea',
                'rows'          => 2,
                'default_value' => 'Chaque projet commence par une conversation. Décrivez votre besoin, je vous propose une approche concrète et adaptée.',
            ),
            array(
                'key'           => 'field_process_cta_btn1',
                'label'         => 'Bouton 1 CTA',
                'name'          => 'process_cta_btn1',
                'type'          => 'text',
                'default_value' => 'PRENDRE CONTACT',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_process_cta_btn2',
                'label'         => 'Bouton 2 CTA',
                'name'          => 'process_cta_btn2',
                'type'          => 'text',
                'default_value' => 'VOIR MES RÉALISATIONS',
                'wrapper'       => array( 'width' => '50' ),
            ),

        ),
    ) );
}

// ============================================================
// TRAITEMENT DU FORMULAIRE DE CONTACT (wp_mail natif)
// ============================================================
add_action( 'template_redirect', 'baobab_handle_contact_form' );

function baobab_handle_contact_form() {

    // On ne traite que si le formulaire a été soumis
    if ( ! isset( $_POST['baobab_contact_nonce'] ) ) return;

    // Vérification nonce (sécurité)
    if ( ! wp_verify_nonce( $_POST['baobab_contact_nonce'], 'baobab_contact_submit' ) ) {
        wp_die( 'Erreur de sécurité.' );
    }

    // Résolution dynamique : slug 'contact' → ID réel (résistant aux migrations)
    $contact_page    = get_page_by_path( 'contact' );
    $contact_page_id = $contact_page ? $contact_page->ID : 0;
    $contact_url     = $contact_page_id ? get_permalink( $contact_page_id ) : home_url( '/contact/' );

    // Récupération et nettoyage des champs
    $name    = sanitize_text_field( $_POST['contact_name'] ?? '' );
    $email   = sanitize_email( $_POST['contact_email_input'] ?? '' );
    $company = sanitize_text_field( $_POST['contact_company'] ?? '' );
    $mission = sanitize_text_field( $_POST['contact_mission'] ?? '' );
    $message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

    // Validation minimale
    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_redirect( add_query_arg( 'contact', 'error', $contact_url ) );
        exit;
    }

    // Destinataire = champ ACF, fallback = email admin
    $recipient = ( $contact_page_id ? get_field( 'contact_recipient', $contact_page_id ) : '' ) ?: get_option( 'admin_email' );

    // Construction de l'email
    $subject = "[Portfolio NNA] Nouveau message de $name";
    $body    = "Nom : $name\n";
    $body   .= "Email : $email\n";
    if ( $company ) {
        $body   .= "Société : $company\n";
    }
    if ( $mission ) {
        $body   .= "Type de mission : $mission\n";
    }
    $body   .= "\nMessage :\n$message";
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: $name <$email>",
    );

    $sent = wp_mail( $recipient, $subject, $body, $headers );
    if ( ! $sent ) {
        error_log( 'baobab_contact_mail_fail: to=' . $recipient . ' subject=' . $subject );
    }

    // Redirection avec statut
    $status = $sent ? 'success' : 'error';
    wp_redirect( add_query_arg( 'contact', $status, $contact_url ) );
    exit;
}

// ============================================================
// NEWSLETTER — Inscription via Brevo API
// ============================================================
add_action( 'template_redirect', 'baobab_handle_newsletter' );

function baobab_handle_newsletter() {
    if ( ! isset( $_POST['baobab_newsletter_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['baobab_newsletter_nonce'], 'baobab_newsletter_submit' ) ) {
        wp_die( 'Erreur de sécurité.' );
    }

    $email       = sanitize_email( $_POST['newsletter_email'] ?? '' );
    $redirect_to = wp_get_referer() ?: home_url();

    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_redirect( add_query_arg( 'newsletter', 'error', $redirect_to ) );
        exit;
    }

    $api_key = defined( 'BREVO_API_KEY' ) ? BREVO_API_KEY : '';

    if ( empty( $api_key ) ) {
        wp_redirect( add_query_arg( 'newsletter', 'error', $redirect_to ) );
        exit;
    }

    $response = wp_remote_post( 'https://api.brevo.com/v3/contacts', array(
        'headers' => array(
            'api-key'      => $api_key,
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
        ),
        'body' => wp_json_encode( array(
            'email'          => $email,
            'updateEnabled'  => true,
        ) ),
        'timeout' => 15,
    ) );

    $code   = wp_remote_retrieve_response_code( $response );

    if ( is_wp_error( $response ) ) {
        error_log( 'baobab_newsletter_curl_fail: ' . $response->get_error_message() );
        $status = 'error';
    } elseif ( $code === 401 ) {
        error_log( 'baobab_newsletter_api_key_invalid: HTTP ' . $code . ' — vérifier BREVO_API_KEY' );
        $status = 'config';
    } elseif ( $code === 201 || $code === 204 ) {
        $status = 'success';
    } else {
        error_log( 'baobab_newsletter_api_error: HTTP ' . $code . ' ' . wp_remote_retrieve_body( $response ) );
        $status = 'error';
    }

    wp_redirect( add_query_arg( 'newsletter', $status, $redirect_to ) );
    exit;
}

// ============================================================
// Polylang — Intégration multilingue
// ============================================================

/**
 * Active la gestion multilingue Polylang sur nos CPT.
 */
add_filter( 'pll_get_post_types', 'baobab_pll_post_types', 10, 2 );
function baobab_pll_post_types( $types, $is_settings ) {
    $types['case_studies'] = 'case_studies';
    $types['services']     = 'services';
    return $types;
}

/**
 * Retourne les arguments de requête avec le filtre de langue Polylang
 * (Polylang ne filtre automatiquement que la requête principale).
 */
function baobab_lang_args( array $args = array() ): array {
    if ( function_exists( 'pll_current_language' ) ) {
        $args['lang'] = pll_current_language();
    }
    return $args;
}

/**
 * Retourne l'URL Polylang-aware d'une page par son slug.
 * Si Polylang est inactif, repli sur home_url().
 */
function baobab_get_page_url( string $slug ): string {
    // Mapping slug → template de page
    static $template_map = array(
        'services'      => 'page-service.php',
        'case-studies'  => 'page-case-study.php',
        'blog'          => 'page-insights.php',
        'process'       => 'page-process.php',
        'about'         => 'page-about.php',
        'contact'       => 'page-contact.php',
    );

    if ( function_exists( 'pll_get_post' ) && isset( $template_map[ $slug ] ) ) {
        // Cherche la page par template dans toutes les langues
        $pages = get_posts( array(
            'post_type'      => 'page',
            'posts_per_page' => 1,
            'meta_key'       => '_wp_page_template',
            'meta_value'     => $template_map[ $slug ],
            'lang'           => '',
            'post_status'    => 'publish',
        ) );

        if ( ! empty( $pages ) ) {
            $translated_id = pll_get_post( $pages[0]->ID );
            $target_id     = $translated_id ?: $pages[0]->ID;
            $url           = get_permalink( $target_id );
            if ( $url ) {
                return $url;
            }
        }
    }

    // Fallback : cherche par slug dans toutes les langues
    if ( function_exists( 'pll_get_post' ) ) {
        $query = new WP_Query( array(
            'post_type'      => 'page',
            'name'           => $slug,
            'posts_per_page' => 1,
            'lang'           => '',
        ) );
        if ( $query->have_posts() ) {
            $page          = $query->posts[0];
            $translated_id = pll_get_post( $page->ID );
            $target_id     = $translated_id ?: $page->ID;
            $url           = get_permalink( $target_id );
            if ( $url ) { return $url; }
        }
    }

    return home_url( '/' . $slug . '/' );
}

/**
 * Affiche le sélecteur de langues Polylang.
 *
 * @param string $context  'desktop' ou 'mobile'
 */
/**
 * Traduit un couple FR/EN selon la langue Polylang courante.
 */
function baobab_t( string $fr, string $en ): string {
    if ( function_exists( 'pll_current_language' ) && 'en' === pll_current_language( 'slug' ) ) {
        return $en;
    }
    return $fr;
}

/**
 * Affiche (échappé) le couple FR/EN selon la langue courante.
 */
function baobab_e( string $fr, string $en ): void {
    echo esc_html( baobab_t( $fr, $en ) );
}

/**
 * Affiche (html échappé) le couple FR/EN selon la langue courante.
 */
function baobab_et( string $fr, string $en ): void {
    echo wp_kses_post( baobab_t( $fr, $en ) );
}

function baobab_language_switcher( string $context = 'desktop' ): void {
    if ( ! function_exists( 'pll_the_languages' ) ) {
        return;
    }

    $languages = pll_the_languages( array( 'raw' => 1, 'hide_if_no_translation' => 0 ) );

    if ( empty( $languages ) ) {
        return;
    }

    $langs = array_values( $languages );

    $select_id    = ( 'desktop' === $context ) ? 'lang-switcher-desktop' : 'lang-switcher-mobile';
    $wrapper_class = ( 'desktop' === $context ) ? 'relative inline-flex items-center ml-4' : 'relative px-4 pb-2';
    $select_class  = ( 'desktop' === $context )
        ? 'font-mono-code text-xs font-bold text-slate-300 bg-[#12141a] border-2 border-[#262936] pl-2 pr-6 py-1.5 cursor-pointer hover:border-[#6c3483] transition-colors focus:outline-none focus:border-[#1abc9c] appearance-none'
        : 'w-full font-mono-code text-sm font-bold text-slate-200 bg-[#12141a] border-2 border-[#262936] px-3 py-2.5 cursor-pointer hover:border-[#6c3483] transition-colors focus:outline-none focus:border-[#1abc9c] appearance-none';

    echo '<div class="' . esc_attr( $wrapper_class ) . '">';
    echo '<select id="' . esc_attr( $select_id ) . '" class="' . esc_attr( $select_class ) . '" onchange="window.location=this.value">';
    foreach ( $langs as $lang ) {
        printf(
            '<option value="%s"%s>%s – %s</option>',
            esc_attr( $lang['url'] ),
            $lang['current_lang'] ? ' selected' : '',
            strtoupper( esc_html( $lang['slug'] ) ),
            esc_html( $lang['name'] )
        );
    }
    echo '</select>';
    echo '<span class="pointer-events-none absolute right-2 top-1/2 -translate-y-1/2 text-slate-400 text-[10px]">&#9660;</span>';
    echo '</div>';
}

// =====================================================
// SEO : META DESCRIPTION + OPEN GRAPH + TWITTER CARDS
// =====================================================

// Filtrer le <title> pour ajouter le nom du site
add_filter( 'document_title_parts', 'baobab_seo_title_parts' );
function baobab_seo_title_parts( $title ) {
    if ( is_front_page() ) {
        $title['title'] = 'NYA NJIKE ARMEL — Business Analyst & CBAP® | Portfolio';
    }
    return $title;
}

// Meta description + OG + Twitter
add_action( 'wp_head', 'baobab_seo_meta_tags', 5 );
function baobab_seo_meta_tags() {
    $url         = get_permalink();
    $site_name   = 'NYA NJIKE ARMEL — Business Analyst & CBAP®';
    $default_img = get_stylesheet_directory_uri() . '/images/armel_portrait.jpg';

    // Déterminer titre + description selon le contexte
    if ( is_front_page() || is_home() ) {
        $title       = 'NYA NJIKE ARMEL — Business Analyst, Ingénieur Logiciel & Architecte Système';
        $description = 'Expert de l\'écosystème fintech et telecom en Afrique centrale. CBAP® certified. Analyse métier, développement logiciel, cybersécurité et data science.';
    } elseif ( is_page() ) {
        $pid         = get_the_ID();
        $title       = get_the_title() . ' — ' . $site_name;
        $acf_desc    = get_field( 'seo_description', $pid );
        $description = $acf_desc ?: wp_trim_words( get_the_excerpt(), 30, '...' );
        if ( empty( $description ) ) {
            $description = wp_trim_words( get_the_content(), 30, '...' );
        }
    } elseif ( is_single() ) {
        $title       = get_the_title() . ' — ' . $site_name;
        $description = wp_trim_words( get_the_excerpt(), 30, '...' );
        if ( empty( $description ) ) {
            $description = wp_trim_words( get_the_content(), 30, '...' );
        }
    } elseif ( is_archive() ) {
        $title       = get_the_archive_title() . ' — ' . $site_name;
        $description = 'Articles et analyses de ' . $site_name;
    } else {
        $title       = $site_name;
        $description = 'Portfolio de NYA NJIKE ARMEL — Business Analyst CBAP®, expert en transformation digitale en Afrique.';
    }

    $description = wp_strip_all_tags( $description );
    if ( mb_strlen( $description ) > 160 ) {
        $description = mb_substr( $description, 0, 157 ) . '...';
    }

    // Image pour OG
    if ( is_page() && has_post_thumbnail() ) {
        $og_img = get_the_post_thumbnail_url( get_the_ID(), 'large' );
    } else {
        $og_img = $default_img;
    }

    $lang     = function_exists( 'pll_current_language' ) ? pll_current_language() : 'fr';
    $og_locale = ( 'fr' === $lang ) ? 'fr_FR' : 'en_US';

    echo "\n<!-- SEO META -->\n";
    echo '<meta name="description" content="' . esc_attr( $description ) . "\" />\n";
    echo '<meta name="robots" content="index, follow" />' . "\n";
    echo '<link rel="canonical" href="' . esc_url( $url ) . "\" />\n";

    // Open Graph
    echo '<meta property="og:type" content="' . ( is_single() ? 'article' : 'website' ) . "\" />\n";
    echo '<meta property="og:title" content="' . esc_attr( $title ) . "\" />\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . "\" />\n";
    echo '<meta property="og:url" content="' . esc_url( $url ) . "\" />\n";
    echo '<meta property="og:site_name" content="' . esc_attr( $site_name ) . "\" />\n";
    echo '<meta property="og:locale" content="' . esc_attr( $og_locale ) . "\" />\n";
    if ( ! empty( $og_img ) ) {
        echo '<meta property="og:image" content="' . esc_url( $og_img ) . "\" />\n";
    }

    // Twitter Card
    echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr( $title ) . "\" />\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $description ) . "\" />\n";
    if ( ! empty( $og_img ) ) {
        echo '<meta name="twitter:image" content="' . esc_url( $og_img ) . "\" />\n";
    }

    echo "<!-- /SEO META -->\n";
}
