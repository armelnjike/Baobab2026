<?php
if ( PHP_SAPI !== 'cli' ) {
    exit( "Ce script doit être exécuté en CLI.\n" );
}

$public_dir = dirname( __DIR__, 4 );
require $public_dir . '/wp-load.php';

if ( ! post_type_exists( 'case_studies' ) ) {
    exit( "ERREUR: le CPT case_studies n'est pas enregistré (thème inactif ?).\n" );
}
if ( ! function_exists( 'update_field' ) ) {
    exit( "ERREUR: ACF n'est pas actif.\n" );
}

function ba_tool_case_exists( $title ) {
    $found = get_posts( array(
        'post_type'      => 'case_studies',
        'post_status'    => 'any',
        'title'          => $title,
        'posts_per_page' => 1,
    ) );
    return ! empty( $found );
}

function ba_tool_ensure_term( $taxonomy, $name ) {
    $term = term_exists( $name, $taxonomy );
    if ( $term ) { return (int) $term['term_id']; }
    $created = wp_insert_term( $name, $taxonomy );
    return is_wp_error( $created ) ? 0 : (int) $created['term_id'];
}

function ba_tool_cli_lang( $post_id ) {
    if ( function_exists( 'pll_set_post_language' ) && function_exists( 'pll_default_language' ) ) {
        pll_set_post_language( $post_id, pll_default_language() );
    }
}

$categories = array(
    'Fintech & Mobile Money',
    'Gestion de Projet & BA',
    'Développement',
    'Data & BI',
);
foreach ( $categories as $cat_name ) {
    ba_tool_ensure_term( 'case_category', $cat_name );
}

$case_studies = array(
    array(
        'title'    => 'MOMO RISK & FRAUD ASSESSMENT',
        'excerpt'  => '« J\'ai trouvé deux failles critiques dans un système de mobile money utilisé par des millions de personnes. »',
        'category' => 'Fintech & Mobile Money',
        'fields'   => array(
            'case_client'    => 'MTN Cameroun',
            'case_meta'      => 'MTN CAMEROON // INSIDER AUDIT',
            'case_order'     => 10,
            'case_featured'  => 1,
            'case_problem'   => 'Pattern inhabituel de blocages de comptes MoMo ne correspondant pas à des erreurs utilisateur classiques, jamais documenté.',
            'case_context'   => 'En 2025, dans le cadre de mon poste de Business Customer Care Specialist chez MTN Cameroun, j\'ai remarqué un pattern inhabituel dans les incidents clients : des blocages de comptes MoMo qui ne correspondaient pas à des erreurs utilisateur classiques. Personne n\'avait formellement documenté le mécanisme. J\'ai conduit une investigation méthodique ayant permis d\'identifier et de documenter 2 failles critiques (blocage de compte par MSISDN et SIM Swap par ingénierie sociale), déclenchant une revue cross-fonctionnelle avec le Senior Management.',
            'case_approach'  => array(
                array( 'approach_step' => 'Tests manuels systématiques du comportement de l\'app' ),
                array( 'approach_step' => 'Documentation des scénarios d\'attaque possibles' ),
                array( 'approach_step' => 'Analyse des patterns d\'incidents clients sur ma période' ),
                array( 'approach_step' => 'Cartographie des vecteurs de fraude identifiés' ),
            ),
            'case_findings'  => array(
                array(
                    'finding_label' => 'VULNÉRABILITÉ #1 — BLOCAGE MSISDN',
                    'finding_text'  => 'N\'importe qui connaissant le numéro de téléphone d\'un client pouvait bloquer son compte MoMo en 3 tentatives de PIN incorrectes sans aucune authentification préalable.',
                ),
                array(
                    'finding_label' => 'VULNÉRABILITÉ #2 — SIM SWAP FRAUDULEUX',
                    'finding_text'  => 'La saisie manuelle du code OTP permettait à un attaquant d\'accéder au compte d\'une victime via ingénierie sociale sans avoir physiquement la SIM.',
                ),
            ),
            'case_impact'    => 'OTP auto-rempli lié à la présence physique de la SIM dans l\'appareil et MSISDN alternatif comme second facteur. Le rapport a déclenché une revue cross-fonctionnelle impliquant le Senior Manager Customer Experience et le Senior Manager Information Security & IT Governance de MTN Cameroun.',
            'case_results'   => 'Revue cross-fonctionnelle Senior Mgmt // 2 failles documentées',
            'case_stack'     => 'Mobile Money · OTP · MSISDN · API',
        ),
    ),
    array(
        'title'    => 'DIGITALISATION CONTACTURER INVESTMENT HOLDING',
        'excerpt'  => 'Digitalisation complète des processus d\'une société de gestion d\'actifs financiers.',
        'category' => 'Gestion de Projet & BA',
        'fields'   => array(
            'case_client'   => 'Contacturer Investment Holding (Monytech Group)',
            'case_meta'     => 'LEAD PM & BUSINESS ANALYST',
            'case_order'    => 20,
            'case_problem'  => 'Une société de gestion d\'actifs financiers fonctionnant sur des processus manuels (tableurs, papier), sans visibilité temps réel pour la direction.',
            'case_context'  => 'Contacturer Investment Holding (filiale Monytech Group) gérait l\'ensemble de ses actifs financiers sur des processus manuels. J\'ai piloté l\'analyse métier et la conduite de projet de A à Z : entretiens, cartographie des processus, rédaction du BRD, specs fonctionnelles, User Stories et recette (UAT).',
            'case_approach' => array(
                array( 'approach_step' => 'Entretiens & cartographie des processus' ),
                array( 'approach_step' => 'Rédaction du BRD et specs fonctionnelles' ),
                array( 'approach_step' => 'Définition des User Stories & critères d\'acceptation' ),
                array( 'approach_step' => 'Tableaux de bord exécutifs & UAT' ),
            ),
            'case_findings' => array(
                array(
                    'finding_label' => 'MON RÔLE & LIVRABLES',
                    'finding_text'  => 'BRD, specs fonctionnelles, User Stories, tableaux de bord exécutifs, scénarios UAT.',
                ),
                array(
                    'finding_label' => 'RÉSULTAT',
                    'finding_text'  => 'Adoption confirmée par les utilisateurs finaux. Visibilité en temps réel pour la direction sur les actifs gérés.',
                ),
            ),
            'case_impact'   => 'Adoption confirmée par les utilisateurs finaux. Visibilité en temps réel pour la direction sur les actifs gérés.',
            'case_results'  => '100% digitalisé // adoption confirmée',
            'case_stack'    => 'Laravel · SQL · Power BI',
        ),
    ),
    array(
        'title'    => 'GAOTELE · PLATEFORME FINTECH',
        'excerpt'  => 'Analyse fonctionnelle et tests d\'une plateforme de paiement digital.',
        'category' => 'Fintech & Mobile Money',
        'fields'   => array(
            'case_client'  => 'Monytech Group',
            'case_meta'    => 'FINTECH // MOBILE PAYMENT',
            'case_order'   => 30,
            'case_problem' => 'Structurer les besoins fonctionnels d\'une plateforme de paiement digital (flux & wallet) en cours de validation COBAC/ANTIC.',
            'case_context' => 'Recueil des besoins flux & wallet, rédaction des spécifications et des scénarios de test pour une plateforme de paiement digital portée par Monytech Group (Gaotele), en attente de validation COBAC/ANTIC.',
            'case_solution' => 'Spécifications fonctionnelles exploitables et scénarios de test couvrant les flux monétaires et le wallet.',
            'case_impact'  => 'Besoins flux & wallet cadrés, tests préparés avant la mise en production réglementaire.',
            'case_results' => 'Specs flux & wallet // scénarios UAT',
            'case_stack'   => 'Laravel · Flutter · REST API',
        ),
    ),
    array(
        'title'    => 'SCHOOLIFE · GESTION SCOLAIRE',
        'excerpt'  => 'Digitalisation d\'un établissement scolaire : élèves, frais, plannings, zéro papier.',
        'category' => 'Développement',
        'fields'   => array(
            'case_client'  => 'Établissement scolaire partenaire',
            'case_meta'    => 'EDTECH // GESTION SCOLAIRE',
            'case_order'   => 40,
            'case_problem' => 'Un établissement fonctionnant encore 100% papier (élèves, frais, plannings) sans aucun outil numérique.',
            'case_solution' => 'Conception et développement d\'un système numérique complet de gestion scolaire : élèves, frais, plannings.',
            'case_impact'  => 'Établissement entièrement digitalisé, zéro papier.',
            'case_results' => '100% Digitalisé',
            'case_stack'   => 'Laravel · React JS',
        ),
    ),
    array(
        'title'    => 'SELLAM CRM · OPTIMISATION SQL',
        'excerpt'  => 'Diagnostic et réindexation SQL d\'un CRM ralenti.',
        'category' => 'Data & BI',
        'fields'   => array(
            'case_client'  => 'Sellam',
            'case_meta'    => 'DATA // PERFORMANCE SQL',
            'case_order'   => 50,
            'case_problem' => 'Un CRM devenu lent à cause de requêtes non indexées et de full table scans.',
            'case_solution' => 'Diagnostic des requêtes, réindexation SQL et suppression des full table scans.',
            'case_impact'  => 'Temps de réponse significativement réduits sur les écrans critiques du CRM.',
            'case_results' => 'Temps de réponse fortement réduits',
            'case_stack'   => 'SQL · MySQL · Indexation',
        ),
    ),
);

foreach ( $case_studies as $cs ) {
    if ( ba_tool_case_exists( $cs['title'] ) ) {
        echo "SKIP  : {$cs['title']} (déjà présent)\n";
        continue;
    }

    $post_id = wp_insert_post( array(
        'post_type'    => 'case_studies',
        'post_status'  => 'publish',
        'post_title'   => $cs['title'],
        'post_excerpt' => $cs['excerpt'],
    ) );

    if ( is_wp_error( $post_id ) || ! $post_id ) {
        echo "ERREUR: {$cs['title']} -> " . ( is_wp_error( $post_id ) ? $post_id->get_error_message() : 'insertion échouée' ) . "\n";
        continue;
    }

    if ( ! empty( $cs['category'] ) ) {
        $term_id = ba_tool_ensure_term( 'case_category', $cs['category'] );
        if ( $term_id ) {
            wp_set_object_terms( $post_id, array( $term_id ), 'case_category' );
        }
    }

    foreach ( $cs['fields'] as $key => $value ) {
        update_field( $key, $value, $post_id );
    }

    ba_tool_cli_lang( $post_id );
    echo "OK    : {$cs['title']} (ID {$post_id})\n";
}

echo "\nTerminé.\n";