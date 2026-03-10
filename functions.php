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
            'param'    => 'post',
            'operator' => '==',
            'value'    => 15,
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
                'param'    => 'post',
                'operator' => '==',
                'value'    => 11, // ID de la page Home
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




    