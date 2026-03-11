<?php
// Charger les styles du thème parent et enfant
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
    // Google Fonts - Inter
    wp_enqueue_style(
        'google-fonts-inter',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap',
        array(),
        null
    );

    // Google Fonts - Manrope
    wp_enqueue_style(
        'google-fonts-manrope',
        'https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap',
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
                        "primary": "#013220",
                        "background-light": "#f5f8f7",
                        "background-dark": "#0f231c",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "sans": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "0.75rem",
                        "xl": "1rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <?php
}

// Ajouter les classes communes sur tous les <body>
add_filter( 'body_class', 'baobab_body_classes' );
function baobab_body_classes( $classes ) {
    $classes[] = 'baobab-site';
    $classes[] = 'bg-background-light';
    $classes[] = 'dark:bg-background-dark';
    $classes[] = 'text-slate-900';
    $classes[] = 'antialiased';
    $classes[] = 'overflow-x-hidden';
    return $classes;
}

// CUSTOM POST TYPE : SERVICES - PAGES DE SERVICES
// ========================================
//  créer un nouveau type de contenu dans WordPress. Par défaut WordPress a "Articles"
// et "Pages". On crée ici notre propre type : "Services".

// add_action() dit à WordPress : "quand tu initialises (init),
// exécute ma fonction baobab_register_cpt_services"
add_action( 'init', 'baobab_register_cpt_services' );
function baobab_register_cpt_services() {

    // register_post_type() est la fonction WordPress qui crée
    // officiellement notre nouveau type de contenu.
    register_post_type( 'services', array(

        // 'services' est le slug de notre CPT, c'est lui qui sera utilisé dans l'URL (ex: /services/mon-service/)
        // 'labels' contient tous les textes qui seront affichés dans l'admin WordPress pour ce CPT
        'labels' => array(
            'name'               => 'Services',
            'singular_name'      => 'Service',
            'add_new'            => 'Ajouter un service',
            'add_new_item'       => 'Ajouter un nouveau service',
            'edit_item'          => 'Modifier le service',
            'all_items'          => 'Tous les services',
            'menu_name'          => 'Services',
        ),
        'public'        => true, // Ce CPT est public (il peut être vu sur le site)
        'has_archive'   => false,  // Pas de page d'archive pour ce CPT on gere avec notre propre template
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-hammer',
        'supports'      => array( 'title' ), // Le titre = nom du service
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
// CHAMPS ACF PRO : SECTION "WHY CHOOSE BAOBAB" — PAGE SERVICES
// ============================================================
// Ces champs représentent les PILIERS de Baobab Technology.
// Chaque pilier a une icône, un titre et une description.
// ============================================================
add_action( 'acf/init', 'baobab_acf_pillars' );

function baobab_acf_pillars() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_pillars',
        'title' => 'Page Services — Piliers de Baobab',

        // ✅ Nouvelle méthode — par titre de page
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
            // SECTION 1 : HERO
            // ================================================

            // Séparateur visuel dans l'admin
            array(
                'key'     => 'field_home_sep_hero',
                'label'   => '🦸 SECTION — Hero',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),

            // Badge texte (ex: "Innovation Driven Consulting")
            array(
                'key'           => 'field_hero_badge',
                'label'         => 'Badge',
                'name'          => 'hero_badge',
                'type'          => 'text',
                'default_value' => 'Innovation Driven Consulting',
            ),

            // Titre principal (la partie avant le span coloré)
            array(
                'key'           => 'field_hero_title',
                'label'         => 'Titre (partie 1)',
                'name'          => 'hero_title',
                'type'          => 'text',
                'instructions'  => 'Ex: La technologie au service de',
                'default_value' => 'La technologie au service de',
            ),

            // Titre coloré (la partie en vert)
            array(
                'key'           => 'field_hero_title_colored',
                'label'         => 'Titre (partie colorée)',
                'name'          => 'hero_title_colored',
                'type'          => 'text',
                'instructions'  => 'Ex: votre croissance.',
                'default_value' => 'votre croissance.',
            ),

            // Sous-titre
            array(
                'key'           => 'field_hero_subtitle',
                'label'         => 'Sous-titre',
                'name'          => 'hero_subtitle',
                'type'          => 'textarea',
                'rows'          => 2,
                'default_value' => 'We build solutions that bring your dreams to reality.',
            ),

            // Bouton principal
            array(
                'key'           => 'field_hero_btn1_text',
                'label'         => 'Bouton principal — Texte',
                'name'          => 'hero_btn1_text',
                'type'          => 'text',
                'default_value' => 'Our Solutions',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_hero_btn1_url',
                'label'         => 'Bouton principal — Lien',
                'name'          => 'hero_btn1_url',
                'type'          => 'page_link', // Sélecteur de page WordPress
                'wrapper'       => array( 'width' => '50' ),
            ),

            // Bouton secondaire
            array(
                'key'           => 'field_hero_btn2_text',
                'label'         => 'Bouton secondaire — Texte',
                'name'          => 'hero_btn2_text',
                'type'          => 'text',
                'default_value' => 'View Portfolio',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_hero_btn2_url',
                'label'         => 'Bouton secondaire — Lien',
                'name'          => 'hero_btn2_url',
                'type'          => 'page_link',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // Image ou vidéo de fond
            // On propose les deux : si vidéo remplie elle prime,
            // sinon on utilise l'image
            array(
                'key'          => 'field_hero_bg_image',
                'label'        => 'Image de fond',
                'name'         => 'hero_bg_image',
                'type'         => 'image',         // Sélecteur média WordPress
                'return_format'=> 'url',            // On veut l'URL directement
                'preview_size' => 'medium',
                'instructions' => 'Image de fond du Hero. Ignorée si une vidéo est renseignée.',
            ),
            array(
                'key'          => 'field_hero_bg_video',
                'label'        => 'Vidéo de fond (optionnel)',
                'name'         => 'hero_bg_video',
                'type'         => 'file',           // Sélecteur de fichier
                'return_format'=> 'url',
                'mime_types'   => 'mp4,webm',       // Formats acceptés
                'instructions' => 'Vidéo en autoplay (mp4 ou webm). Prioritaire sur l\'image.',
            ),

            // ================================================
            // SECTION 2 : STRATEGIC POSITIONING
            // ================================================

            array(
                'key'     => 'field_home_sep_strategic',
                'label'   => '🎯 SECTION — Strategic Positioning',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),

            array(
                'key'           => 'field_strategic_label',
                'label'         => 'Label (petit texte vert)',
                'name'          => 'strategic_label',
                'type'          => 'text',
                'default_value' => 'Strategic Positioning',
            ),

            array(
                'key'           => 'field_strategic_title',
                'label'         => 'Titre',
                'name'          => 'strategic_title',
                'type'          => 'text',
                'default_value' => 'Empowering Global Enterprises',
            ),

            array(
                'key'           => 'field_strategic_text',
                'label'         => 'Texte',
                'name'          => 'strategic_text',
                'type'          => 'textarea',
                'rows'          => 3,
            ),

            // ================================================
            // SECTION 3 : CORE SERVICES
            // ================================================
            // Les 3 cartes viennent du CPT Services (déjà créé).
            // On gère seulement le titre et le texte intro ici.

            array(
                'key'     => 'field_home_sep_services',
                'label'   => '⚙️ SECTION — Core Services Preview',
                'name'    => '',
                'type'    => 'message',
                'message' => 'Les 3 cartes sont automatiquement tirées du CPT Services.',
            ),

            array(
                'key'           => 'field_services_title',
                'label'         => 'Titre',
                'name'          => 'home_services_title',
                'type'          => 'text',
                'default_value' => 'Core Expertise',
            ),

            array(
                'key'           => 'field_services_text',
                'label'         => 'Texte',
                'name'          => 'home_services_text',
                'type'          => 'textarea',
                'rows'          => 2,
            ),

            // ================================================
            // SECTION 4 : CASE STUDIES PREVIEW
            // ================================================
            // Les cartes viendront du CPT Case Studies (à créer).
            // On gère seulement le titre ici.

            array(
                'key'     => 'field_home_sep_cases',
                'label'   => '📁 SECTION — Case Studies Preview',
                'name'    => '',
                'type'    => 'message',
                'message' => 'Les 2 projets seront tirés du CPT Case Studies (à configurer).',
            ),

            array(
                'key'           => 'field_cases_title',
                'label'         => 'Titre',
                'name'          => 'home_cases_title',
                'type'          => 'text',
                'default_value' => 'Selected Impact Stories',
            ),

            // ================================================
            // SECTION 5 : LEADERSHIP PREVIEW
            // ================================================

            array(
                'key'     => 'field_home_sep_leadership',
                'label'   => '👥 SECTION — Leadership Preview',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),

            array(
                'key'           => 'field_leadership_title',
                'label'         => 'Titre',
                'name'          => 'home_leadership_title',
                'type'          => 'text',
                'default_value' => 'Led by Innovation',
            ),

            array(
                'key'           => 'field_leadership_text',
                'label'         => 'Texte',
                'name'          => 'home_leadership_text',
                'type'          => 'textarea',
                'rows'          => 3,
            ),

            // Repeater pour les 2 membres
            array(
                'key'          => 'field_leadership_members',
                'label'        => 'Membres',
                'name'         => 'home_leadership_members',
                'type'         => 'repeater',
                'button_label' => 'Ajouter un membre',
                'min'          => 0,
                'max'          => 2,
                'layout'       => 'block',
                'sub_fields'   => array(

                    array(
                        'key'           => 'field_member_photo',
                        'label'         => 'Photo',
                        'name'          => 'member_photo',
                        'type'          => 'image',
                        'return_format' => 'url',
                        'preview_size'  => 'thumbnail',
                        'wrapper'       => array( 'width' => '20' ),
                    ),

                    array(
                        'key'     => 'field_member_name',
                        'label'   => 'Nom',
                        'name'    => 'member_name',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '40' ),
                    ),

                    array(
                        'key'     => 'field_member_role',
                        'label'   => 'Poste',
                        'name'    => 'member_role',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '40' ),
                    ),

                ),
            ),

        ), // fin fields
    ) ); // fin acf_add_local_field_group
}

// ============================================================
// CUSTOM POST TYPE : CASE STUDIES
// ============================================================
// Un Case Study = un projet réalisé par Baobab.
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
        'has_archive'   => false,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-portfolio',
        'supports'      => array( 'title' ), // Titre = nom du projet
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
                'label'        => 'Description de l\'image',
                'name'         => 'case_image_alt',
                'type'         => 'text',
                'instructions' => 'Ex: Modern dark fintech dashboard with data visualizations',
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
    if ( is_page_template( 'page-insights.php' ) || is_page( 'insights' ) ) {
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
            // SECTION 1 : HERO
            // ================================================
            array(
                'key'     => 'field_about_sep_hero',
                'label'   => '🌍 SECTION — Hero',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_about_label',
                'label'         => 'Label (petit texte vert)',
                'name'          => 'about_label',
                'type'          => 'text',
                'default_value' => 'Our Story',
            ),
            array(
                'key'           => 'field_about_title',
                'label'         => 'Titre',
                'name'          => 'about_title',
                'type'          => 'text',
                'default_value' => 'Rooted in Africa, Reaching the World',
            ),
            array(
                'key'   => 'field_about_text1',
                'label' => 'Texte paragraphe 1',
                'name'  => 'about_text1',
                'type'  => 'textarea',
                'rows'  => 4,
            ),
            array(
                'key'   => 'field_about_text2',
                'label' => 'Texte paragraphe 2',
                'name'  => 'about_text2',
                'type'  => 'textarea',
                'rows'  => 3,
            ),
            array(
                'key'           => 'field_about_hero_image',
                'label'         => 'Image Hero',
                'name'          => 'about_hero_image',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
            ),

            // ================================================
            // SECTION 2 : VISION & MISSION
            // ================================================
            array(
                'key'     => 'field_about_sep_vm',
                'label'   => '🎯 SECTION — Vision & Mission',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),

            // Vision
            array(
                'key'           => 'field_vision_icon',
                'label'         => 'Vision — Icône',
                'name'          => 'vision_icon',
                'type'          => 'text',
                'default_value' => 'visibility',
                'wrapper'       => array( 'width' => '30' ),
            ),
            array(
                'key'           => 'field_vision_title',
                'label'         => 'Vision — Titre',
                'name'          => 'vision_title',
                'type'          => 'text',
                'default_value' => 'Our Vision',
                'wrapper'       => array( 'width' => '70' ),
            ),
            array(
                'key'   => 'field_vision_text',
                'label' => 'Vision — Texte',
                'name'  => 'vision_text',
                'type'  => 'textarea',
                'rows'  => 3,
            ),

            // Mission
            array(
                'key'           => 'field_mission_icon',
                'label'         => 'Mission — Icône',
                'name'          => 'mission_icon',
                'type'          => 'text',
                'default_value' => 'rocket_launch',
                'wrapper'       => array( 'width' => '30' ),
            ),
            array(
                'key'           => 'field_mission_title',
                'label'         => 'Mission — Titre',
                'name'          => 'mission_title',
                'type'          => 'text',
                'default_value' => 'Our Mission',
                'wrapper'       => array( 'width' => '70' ),
            ),
            array(
                'key'   => 'field_mission_text',
                'label' => 'Mission — Texte',
                'name'  => 'mission_text',
                'type'  => 'textarea',
                'rows'  => 3,
            ),

            // ================================================
            // SECTION 3 : VALEURS
            // ================================================
            array(
                'key'     => 'field_about_sep_values',
                'label'   => '⭐ SECTION — Valeurs (Baobab Standards)',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_values_title',
                'label'         => 'Titre de la section',
                'name'          => 'values_title',
                'type'          => 'text',
                'default_value' => 'The Baobab Standards',
            ),
            array(
                'key'   => 'field_values_subtitle',
                'label' => 'Sous-titre',
                'name'  => 'values_subtitle',
                'type'  => 'textarea',
                'rows'  => 2,
            ),
            // Repeater pour les valeurs
            array(
                'key'          => 'field_values',
                'label'        => 'Valeurs',
                'name'         => 'values',
                'type'         => 'repeater',
                'button_label' => 'Ajouter une valeur',
                'min'          => 0,
                'max'          => 10,
                'layout'       => 'block',
                'sub_fields'   => array(
                    array(
                        'key'           => 'field_value_icon',
                        'label'         => 'Icône',
                        'name'          => 'value_icon',
                        'type'          => 'text',
                        'default_value' => 'verified',
                        'wrapper'       => array( 'width' => '20' ),
                    ),
                    array(
                        'key'     => 'field_value_title',
                        'label'   => 'Titre',
                        'name'    => 'value_title',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '30' ),
                    ),
                    array(
                        'key'     => 'field_value_desc',
                        'label'   => 'Description',
                        'name'    => 'value_desc',
                        'type'    => 'textarea',
                        'rows'    => 2,
                        'wrapper' => array( 'width' => '50' ),
                    ),
                ),
            ),

            // ================================================
            // SECTION 4 : WHY BAOBAB
            // ================================================
            array(
                'key'     => 'field_about_sep_why',
                'label'   => '💡 SECTION — Why Baobab',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_why_title',
                'label'         => 'Titre',
                'name'          => 'why_title',
                'type'          => 'text',
                'default_value' => 'Why Baobab?',
            ),
            array(
                'key'   => 'field_why_text',
                'label' => 'Texte intro',
                'name'  => 'why_text',
                'type'  => 'textarea',
                'rows'  => 3,
            ),
            // Repeater pour les 3 points forts
            array(
                'key'          => 'field_why_points',
                'label'        => 'Points forts',
                'name'         => 'why_points',
                'type'         => 'repeater',
                'button_label' => 'Ajouter un point',
                'min'          => 0,
                'max'          => 6,
                'layout'       => 'block',
                'sub_fields'   => array(
                    array(
                        'key'     => 'field_why_point_title',
                        'label'   => 'Titre',
                        'name'    => 'point_title',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '40' ),
                    ),
                    array(
                        'key'     => 'field_why_point_desc',
                        'label'   => 'Description',
                        'name'    => 'point_desc',
                        'type'    => 'textarea',
                        'rows'    => 2,
                        'wrapper' => array( 'width' => '60' ),
                    ),
                ),
            ),
            // Repeater pour les lignes du tableau comparatif
            array(
                'key'          => 'field_comparison_rows',
                'label'        => 'Tableau comparatif — Lignes',
                'name'         => 'comparison_rows',
                'type'         => 'repeater',
                'button_label' => 'Ajouter une ligne',
                'min'          => 0,
                'max'          => 8,
                'layout'       => 'table',
                'sub_fields'   => array(
                    array(
                        'key'     => 'field_row_feature',
                        'label'   => 'Fonctionnalité',
                        'name'    => 'row_feature',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '34' ),
                    ),
                    array(
                        'key'     => 'field_row_baobab',
                        'label'   => 'Baobab',
                        'name'    => 'row_baobab',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '33' ),
                    ),
                    array(
                        'key'     => 'field_row_competitors',
                        'label'   => 'Competitors',
                        'name'    => 'row_competitors',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '33' ),
                    ),
                ),
            ),

            // ================================================
            // SECTION 5 : TIMELINE
            // ================================================
            array(
                'key'     => 'field_about_sep_timeline',
                'label'   => '🕐 SECTION — Timeline',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_timeline_title',
                'label'         => 'Titre',
                'name'          => 'timeline_title',
                'type'          => 'text',
                'default_value' => 'Our Journey & Roadmap',
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
                        'default_value'=> 'home',
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

// ============================================================
// CUSTOM POST TYPE : TEAM MEMBERS
// ============================================================
add_action( 'init', 'baobab_register_cpt_team' );

function baobab_register_cpt_team() {
    register_post_type( 'team_member', array(
        'labels' => array(
            'name'          => 'Équipe',
            'singular_name' => 'Membre',
            'add_new_item'  => 'Ajouter un membre',
            'edit_item'     => 'Modifier le membre',
            'all_items'     => 'Tous les membres',
            'menu_name'     => 'Équipe',
        ),
        'public'        => true,
        'has_archive'   => false,
        'show_in_menu'  => true,
        'menu_icon'     => 'dashicons-groups',
        'supports'      => array( 'title' ), // Titre = nom du membre
        'menu_position' => 7,
    ) );
}

// ============================================================
// CHAMPS ACF : TEAM MEMBERS (CPT)
// ============================================================
add_action( 'acf/init', 'baobab_acf_team_member' );

function baobab_acf_team_member() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_team_member',
        'title' => 'Détails du Membre',

        'location' => array( array( array(
            'param'    => 'post_type',
            'operator' => '==',
            'value'    => 'team_member',
        ) ) ),

        'fields' => array(

            // Photo
            array(
                'key'           => 'field_member_photo_cpt',
                'label'         => 'Photo',
                'name'          => 'member_photo',
                'type'          => 'image',
                'return_format' => 'url',
                'preview_size'  => 'medium',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // Poste
            array(
                'key'     => 'field_member_role_cpt',
                'label'   => 'Poste / Titre',
                'name'    => 'member_role',
                'type'    => 'text',
                'wrapper' => array( 'width' => '50' ),
            ),

            // Citation
            array(
                'key'          => 'field_member_quote',
                'label'        => 'Citation personnelle',
                'name'         => 'member_quote',
                'type'         => 'textarea',
                'rows'         => 2,
                'instructions' => 'Ex: "Our goal isn\'t just to build systems..."',
            ),

            // Lien LinkedIn ou portfolio
            array(
                'key'          => 'field_member_link',
                'label'        => 'Lien (LinkedIn / GitHub / Portfolio)',
                'name'         => 'member_link',
                'type'         => 'url',
                'wrapper'      => array( 'width' => '50' ),
            ),

            // Icône du lien (Material Symbols)
            array(
                'key'           => 'field_member_link_icon',
                'label'         => 'Icône du lien',
                'name'          => 'member_link_icon',
                'type'          => 'text',
                'default_value' => 'link',
                'instructions'  => 'Ex: link, terminal, business_center',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // Ordre d'affichage
            array(
                'key'     => 'field_member_order',
                'label'   => 'Ordre d\'affichage',
                'name'    => 'member_order',
                'type'    => 'number',
                'wrapper' => array( 'width' => '50' ),
            ),

            // Expertise (tags/badges)
            array(
                'key'          => 'field_member_expertise',
                'label'        => 'Expertises (badges)',
                'name'         => 'member_expertise',
                'type'         => 'repeater',
                'button_label' => 'Ajouter une expertise',
                'min'          => 0,
                'max'          => 6,
                'layout'       => 'table',
                'sub_fields'   => array(
                    array(
                        'key'   => 'field_expertise_item',
                        'label' => 'Expertise',
                        'name'  => 'expertise_item',
                        'type'  => 'text',
                    ),
                ),
            ),

            // Réalisations clés (2 blocs)
            array(
                'key'          => 'field_member_achievements',
                'label'        => 'Réalisations clés',
                'name'         => 'member_achievements',
                'type'         => 'repeater',
                'button_label' => 'Ajouter une réalisation',
                'min'          => 0,
                'max'          => 2,
                'layout'       => 'table',
                'sub_fields'   => array(
                    array(
                        'key'     => 'field_achievement_label',
                        'label'   => 'Label',
                        'name'    => 'achievement_label',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '30' ),
                    ),
                    array(
                        'key'     => 'field_achievement_text',
                        'label'   => 'Texte',
                        'name'    => 'achievement_text',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '70' ),
                    ),
                ),
            ),

            // Bio complète (portfolio)
            array(
                'key'   => 'field_member_bio',
                'label' => 'Bio complète (section dépliable)',
                'name'  => 'member_bio',
                'type'  => 'textarea',
                'rows'  => 5,
            ),

        ),
    ) );
}

// ============================================================
// CHAMPS ACF : PAGE TEAM (ID = 17)
// ============================================================
add_action( 'acf/init', 'baobab_acf_team_page' );

function baobab_acf_team_page() {

    if ( ! function_exists( 'acf_add_local_field_group' ) ) return;

    acf_add_local_field_group( array(
        'key'   => 'group_team_page',
        'title' => 'Page Team — Sections',

        'location' => array( array(
            array(
                'param'    => 'post_type',
                'operator' => '==',
                'value'    => 'page',
            ),
            array(
                'param'    => 'page_template',
                'operator' => '==',
                'value'    => 'page-team.php',
            ),
        ) ),

        'fields' => array(

            // ── HERO ──
            array(
                'key'     => 'field_team_sep_hero',
                'label'   => '👥 SECTION — Hero',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_team_label',
                'label'         => 'Label (petit texte vert)',
                'name'          => 'team_label',
                'type'          => 'text',
                'default_value' => 'Our Leadership',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_team_title',
                'label'         => 'Titre',
                'name'          => 'team_title',
                'type'          => 'text',
                'default_value' => 'Executive Vision',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'   => 'field_team_subtitle',
                'label' => 'Sous-titre',
                'name'  => 'team_subtitle',
                'type'  => 'textarea',
                'rows'  => 2,
            ),

            // ── OPEN POSITIONS ──
            array(
                'key'     => 'field_team_sep_jobs',
                'label'   => '💼 SECTION — Rejoindre l\'équipe',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_jobs_title',
                'label'         => 'Titre',
                'name'          => 'jobs_title',
                'type'          => 'text',
                'default_value' => 'Join the Baobab Team',
            ),
            array(
                'key'   => 'field_jobs_text',
                'label' => 'Texte intro',
                'name'  => 'jobs_text',
                'type'  => 'textarea',
                'rows'  => 2,
            ),
            array(
                'key'          => 'field_open_positions',
                'label'        => 'Postes ouverts',
                'name'         => 'open_positions',
                'type'         => 'repeater',
                'button_label' => 'Ajouter un poste',
                'min'          => 0,
                'max'          => 10,
                'layout'       => 'block',
                'sub_fields'   => array(
                    array(
                        'key'     => 'field_job_title',
                        'label'   => 'Titre du poste',
                        'name'    => 'job_title',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '40' ),
                    ),
                    array(
                        'key'     => 'field_job_location',
                        'label'   => 'Lieu (ex: Douala / Remote)',
                        'name'    => 'job_location',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '30' ),
                    ),
                    array(
                        'key'     => 'field_job_type',
                        'label'   => 'Type (ex: Full-time)',
                        'name'    => 'job_type',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '30' ),
                    ),
                    array(
                        'key'          => 'field_job_desc',
                        'label'        => 'Description du poste',
                        'name'         => 'job_desc',
                        'type'         => 'wysiwyg',
                        'tabs'         => 'all',
                        'toolbar'      => 'basic',
                        'media_upload' => 0,
                    ),
                    array(
                        'key'           => 'field_job_link',
                        'label'         => 'Lien candidature',
                        'name'          => 'job_link',
                        'type'          => 'url',
                        'instructions'  => 'URL vers le formulaire ou email mailto:',
                    ),
                ),
            ),

        ),
    ) );
}

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

            // ── HERO ──
            array(
                'key'     => 'field_contact_sep_hero',
                'label'   => '📡 SECTION — Hero',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_contact_label',
                'label'         => 'Label (petit texte vert)',
                'name'          => 'contact_label',
                'type'          => 'text',
                'default_value' => 'Reach Out',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_contact_title',
                'label'         => 'Titre (partie 1)',
                'name'          => 'contact_title',
                'type'          => 'text',
                'default_value' => 'Connect with our',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_contact_title_colored',
                'label'         => 'Titre (partie colorée)',
                'name'          => 'contact_title_colored',
                'type'          => 'text',
                'default_value' => 'Global Infrastructure Experts',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_contact_subtitle',
                'label'         => 'Sous-titre',
                'name'          => 'contact_subtitle',
                'type'          => 'textarea',
                'rows'          => 2,
                'wrapper'       => array( 'width' => '50' ),
            ),

            // ── INFOS BUREAU ──
            array(
                'key'     => 'field_contact_sep_info',
                'label'   => '🏢 SECTION — Infos Bureau',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_contact_address',
                'label'         => 'Adresse',
                'name'          => 'contact_address',
                'type'          => 'textarea',
                'rows'          => 2,
                'default_value' => "42 Innovation Way, Tech Park\nDouala, Cameroun",
            ),
            array(
                'key'           => 'field_contact_email',
                'label'         => 'Email',
                'name'          => 'contact_email',
                'type'          => 'text',
                'default_value' => 'solutions@baobab.tech',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_contact_phone',
                'label'         => 'Téléphone',
                'name'          => 'contact_phone',
                'type'          => 'text',
                'default_value' => '+237 6XX XXX XXX',
                'wrapper'       => array( 'width' => '50' ),
            ),

            // ── EMAIL DE RÉCEPTION ──
            array(
                'key'          => 'field_contact_sep_form',
                'label'        => '✉️ SECTION — Formulaire',
                'name'         => '',
                'type'         => 'message',
                'message'      => 'Les messages du formulaire seront envoyés à l\'adresse ci-dessous.',
            ),
            array(
                'key'           => 'field_contact_form_title',
                'label'         => 'Titre du formulaire',
                'name'          => 'contact_form_title',
                'type'          => 'text',
                'default_value' => 'Send us a Message',
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

            // ── LOGOS CLIENTS ──
            array(
                'key'     => 'field_contact_sep_clients',
                'label'   => '🏆 SECTION — Logos Clients',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_clients_label',
                'label'         => 'Label',
                'name'          => 'clients_label',
                'type'          => 'text',
                'default_value' => 'Trusted Worldwide By',
            ),
            array(
                'key'          => 'field_clients',
                'label'        => 'Clients / Partenaires',
                'name'         => 'clients',
                'type'         => 'repeater',
                'button_label' => 'Ajouter un client',
                'min'          => 0,
                'max'          => 8,
                'layout'       => 'table',
                'sub_fields'   => array(
                    array(
                        'key'          => 'field_client_logo',
                        'label'        => 'Logo (optionnel)',
                        'name'         => 'client_logo',
                        'type'         => 'image',
                        'return_format'=> 'url',
                        'preview_size' => 'thumbnail',
                        'wrapper'      => array( 'width' => '30' ),
                    ),
                    array(
                        'key'     => 'field_client_name',
                        'label'   => 'Nom (si pas de logo)',
                        'name'    => 'client_name',
                        'type'    => 'text',
                        'wrapper' => array( 'width' => '70' ),
                    ),
                ),
            ),

            // ── CTA FINALE ──
            array(
                'key'     => 'field_contact_sep_cta',
                'label'   => '🚀 SECTION — CTA Finale',
                'name'    => '',
                'type'    => 'message',
                'message' => '',
            ),
            array(
                'key'           => 'field_cta_title',
                'label'         => 'Titre',
                'name'          => 'cta_title',
                'type'          => 'text',
                'default_value' => "Let's Build the Future Together.",
            ),
            array(
                'key'   => 'field_cta_text',
                'label' => 'Texte',
                'name'  => 'cta_text',
                'type'  => 'textarea',
                'rows'  => 2,
            ),
            array(
                'key'           => 'field_cta_btn1_text',
                'label'         => 'Bouton 1 — Texte',
                'name'          => 'cta_btn1_text',
                'type'          => 'text',
                'default_value' => 'Schedule a Strategy Session',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_cta_btn1_url',
                'label'         => 'Bouton 1 — Lien',
                'name'          => 'cta_btn1_url',
                'type'          => 'page_link',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_cta_btn2_text',
                'label'         => 'Bouton 2 — Texte',
                'name'          => 'cta_btn2_text',
                'type'          => 'text',
                'default_value' => 'View Ecosystem',
                'wrapper'       => array( 'width' => '50' ),
            ),
            array(
                'key'           => 'field_cta_btn2_url',
                'label'         => 'Bouton 2 — Lien',
                'name'          => 'cta_btn2_url',
                'type'          => 'page_link',
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
    $message = sanitize_textarea_field( $_POST['contact_message'] ?? '' );

    // Validation minimale
    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_redirect( add_query_arg( 'contact', 'error', $contact_url ) );
        exit;
    }

    // Destinataire = champ ACF, fallback = email admin
    $recipient = ( $contact_page_id ? get_field( 'contact_recipient', $contact_page_id ) : '' ) ?: get_option( 'admin_email' );

    // Construction de l'email
    $subject = "[Baobab] Nouveau message de $name ($company)";
    $body    = "Nom : $name\n";
    $body   .= "Email : $email\n";
    $body   .= "Société : $company\n\n";
    $body   .= "Message :\n$message";
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        "Reply-To: $name <$email>",
    );

    $sent = wp_mail( $recipient, $subject, $body, $headers );

    // Redirection avec statut
    $status = $sent ? 'success' : 'error';
    wp_redirect( add_query_arg( 'contact', $status, $contact_url ) );
    exit;
}
