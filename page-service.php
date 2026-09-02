<?php
/*
 Template Name: Services Page (Soulful Brutalism BA)
*/
get_header();

// ------------------------------------------------------------------
// Hero : valeurs ACF de la page (srv_*) avec repli sur les textes FR/EN
// ------------------------------------------------------------------
$srv_badge  = get_field( 'srv_hero_badge' );
$srv_t1     = get_field( 'srv_hero_title' );
$srv_t2     = get_field( 'srv_hero_title_colored' );
$srv_text   = get_field( 'srv_hero_text' );
$srv_btn1   = get_field( 'srv_btn1_text' );
$srv_btn2   = get_field( 'srv_btn2_text' );
$srv_cards  = get_field( 'srv_tech_cards' );

if ( empty( $srv_badge ) ) {
    $srv_badge = baobab_t( '[MES_OFFRES_DE_SERVICES // CATALOGUE_DE_VALEUR]', '[MY_SERVICE_OFFERINGS // VALUE_CATALOG]' );
}
if ( empty( $srv_t1 ) && empty( $srv_t2 ) ) {
    $srv_t1 = baobab_t( 'QUATRE FAÇONS DONT JE CRÉE DE LA', 'FOUR WAYS I CREATE' );
    $srv_t2 = baobab_t( 'VALEUR.', 'VALUE.' );
}
if ( empty( $srv_text ) ) {
    $srv_text = baobab_t(
        'De la cadrage stratégique des besoins métier jusqu\'au suivi d\'exécution technique, voici comment j\'accompagne les entreprises et projets digitaux.',
        'From the strategic scoping of business needs to technical execution follow-up, here is how I support companies and digital projects.'
    );
}
if ( empty( $srv_btn1 ) ) {
    $srv_btn1 = baobab_t( 'VOIR MES RÉALISATIONS', 'VIEW MY WORK' );
}
if ( empty( $srv_btn2 ) ) {
    $srv_btn2 = baobab_t( 'ME CONTACTER', 'CONTACT ME' );
}

// ------------------------------------------------------------------
// Catalogue : CPT "services" de la langue courante (champ group_services)
// ------------------------------------------------------------------
$svc_lang  = ( function_exists( 'pll_current_language' ) ) ? pll_current_language( 'slug' ) : '';
$svc_query = array(
    'post_type'      => 'services',
    'posts_per_page' => -1,
    'meta_key'       => 'service_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'suppress_filters'=> false,
);
if ( $svc_lang ) { $svc_query['lang'] = $svc_lang; }
$services = get_posts( $svc_query );

// Piliers (page ACF : group_pillars)
$pillars = get_field( 'pillars' );

$theme_uri = get_stylesheet_directory_uri();
?>

<main class="flex-1 w-full bg-[#0b0c10] text-slate-100 overflow-x-hidden">

    <!-- ================================================
         1. HERO SECTION : SERVICES (ACF srv_*)
         ================================================ -->
    <section class="w-full py-16 md:py-24 border-b-2 border-[#262936] bg-[#0b0c10] nsibidi-bg">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            
            <div class="max-w-3xl space-y-4">
                <div class="font-mono-code text-xs text-[#1abc9c] font-bold tracking-widest uppercase">
                    <?php echo esc_html( $srv_badge ); ?>
                </div>

                <h1 class="font-grotesk font-black text-4xl sm:text-6xl lg:text-7xl text-white uppercase tracking-tight leading-none">
                    <?php echo esc_html( $srv_t1 ); ?> <span class="text-[#6c3483]"><?php echo esc_html( $srv_t2 ); ?></span>
                </h1>

                <p class="font-sans text-slate-300 text-lg leading-relaxed pt-4">
                    <?php echo esc_html( $srv_text ); ?>
                </p>

                <?php if ( ! empty( $srv_btn1 ) || ! empty( $srv_btn2 ) ) : ?>
                <div class="flex flex-wrap gap-4 pt-6 font-mono-code text-xs">
                    <?php if ( ! empty( $srv_btn1 ) ) : ?>
                    <a href="<?php echo esc_url( baobab_get_page_url( 'case-studies' ) ); ?>" 
                       class="px-6 py-3 bg-[#1abc9c] text-black font-bold uppercase tracking-wider hover:bg-[#00ffc4] transition-all">
                        <?php echo esc_html( $srv_btn1 ); ?>
                    </a>
                    <?php endif; ?>
                    <?php if ( ! empty( $srv_btn2 ) ) : ?>
                    <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" 
                       class="px-6 py-3 border-2 border-[#6c3483] text-white font-bold uppercase tracking-wider hover:bg-[#6c3483] transition-all">
                        <?php echo esc_html( $srv_btn2 ); ?>
                    </a>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ( ! empty( $srv_cards ) && is_array( $srv_cards ) ) : ?>
            <div class="mt-12 flex flex-wrap gap-3 font-mono-code text-xs">
                <?php foreach ( $srv_cards as $card ) :
                    $ci = ! empty( $card['card_icon'] )  ? $card['card_icon']  : 'code';
                    $cl = ! empty( $card['card_label'] ) ? $card['card_label'] : '';
                ?>
                <span class="inline-flex items-center gap-2 px-3 py-2 bg-[#12141a] border border-[#262936] text-[#1abc9c]">
                    <span class="material-symbols-outlined text-base"><?php echo esc_html( $ci ); ?></span>
                    <?php if ( $cl ) : ?><span class="text-slate-200"><?php echo esc_html( $cl ); ?></span><?php endif; ?>
                </span>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>

    <!-- ================================================
         2. DETAILED SERVICES CATALOG (CPT "services")
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6 space-y-12">

            <div class="flex flex-wrap items-end justify-between gap-4 border-b-4 border-[#1abc9c] pb-4">
                <div>
                    <h2 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase tracking-tighter">
                        <?php baobab_e( 'MES OFFRES DE SERVICES', 'MY SERVICE OFFERINGS' ); ?>
                    </h2>
                    <p class="font-mono-code text-xs text-slate-400 mt-1">
                        <?php baobab_e( 'DÉTAILS ET LIVRABLES PAR OFFRE', 'DETAILS AND DELIVERABLES PER OFFERING' ); ?>
                    </p>
                </div>
                <span class="font-mono-code text-xs font-bold text-[#1abc9c] tracking-widest bg-[#12141a] px-4 py-2 border border-[#262936]">[INDEX_SERVICES]</span>
            </div>

            <?php if ( ! empty( $services ) ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <?php foreach ( $services as $idx => $svc ) :
                    $border  = ( $idx % 2 === 0 ) ? 'border-[#1abc9c]' : 'border-[#6c3483]';
                    $hover   = ( $idx % 2 === 0 ) ? 'hover:border-[#00ffc4]' : 'hover:border-[#b366ff]';
                    $icon    = get_field( 'service_icon', $svc->ID ) ?: 'code';
                    $problem = get_field( 'service_problem', $svc->ID );
                    $sol     = get_field( 'service_solution', $svc->ID );
                    $feats   = get_field( 'service_features', $svc->ID );
                    $stack   = get_field( 'service_stack', $svc->ID );
                    $cta     = get_field( 'service_cta', $svc->ID );
                    $num     = str_pad( (string)( $idx + 1 ), 2, '0', STR_PAD_LEFT );
                ?>
                <div class="bg-[#12141a] border-2 <?php echo esc_attr( $border ); ?> p-8 space-y-6 flex flex-col justify-between <?php echo esc_attr( $hover ); ?> transition-all">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center font-mono-code text-xs">
                            <span class="px-3 py-1 <?php echo ( $idx % 2 === 0 ) ? 'bg-[#1abc9c] text-black' : 'bg-[#6c3483] text-white'; ?> font-bold">SERVICE_<?php echo esc_html( $num ); ?></span>
                            <span class="<?php echo ( $idx % 2 === 0 ) ? 'text-[#1abc9c]' : 'text-[#b366ff]'; ?>">
                                <span class="material-symbols-outlined align-middle text-base"><?php echo esc_html( $icon ); ?></span>
                            </span>
                        </div>

                        <h3 class="font-grotesk font-black text-2xl sm:text-3xl text-white uppercase leading-tight">
                            <?php echo esc_html( get_the_title( $svc->ID ) ); ?>
                        </h3>

                        <?php if ( ! empty( $problem ) ) : ?>
                        <p class="font-sans text-slate-300 text-sm leading-relaxed">
                            <?php echo esc_html( $problem ); ?>
                        </p>
                        <?php endif; ?>

                        <?php if ( ! empty( $sol ) ) : ?>
                        <div class="bg-[#0b0c10] border border-[#262936] p-4 font-sans text-xs text-slate-200 leading-relaxed">
                            <strong class="text-white block font-mono-code uppercase mb-1">> <?php baobab_e( 'MA SOLUTION :', 'MY APPROACH:' ); ?></strong>
                            <?php echo esc_html( $sol ); ?>
                        </div>
                        <?php endif; ?>

                        <?php if ( ! empty( $feats ) && is_array( $feats ) ) : ?>
                        <div class="font-mono-code text-xs space-y-1.5">
                            <span class="<?php echo ( $idx % 2 === 0 ) ? 'text-[#1abc9c]' : 'text-[#b366ff]'; ?> font-bold block mb-1"><?php baobab_e( 'CE QUE VOUS OBTENEZ :', 'WHAT YOU GET:' ); ?></span>
                            <ul class="space-y-1 text-slate-300">
                                <?php foreach ( $feats as $f ) : if ( empty( $f['feature_item'] ) ) { continue; } ?>
                                <li class="flex items-start gap-2"><span class="text-[#00ffc4]">></span><span><?php echo esc_html( $f['feature_item'] ); ?></span></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="pt-4 border-t border-[#262936]">
                        <?php if ( ! empty( $stack ) && is_array( $stack ) ) : ?>
                        <div class="flex flex-wrap gap-2 mb-4">
                            <?php foreach ( $stack as $t ) : if ( empty( $t['stack_item'] ) ) { continue; } ?>
                            <span class="px-2.5 py-1 bg-[#0b0c10] border border-[#262936] text-slate-300 font-mono-code text-xs"><?php echo esc_html( $t['stack_item'] ); ?></span>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" 
                           class="inline-block px-5 py-2.5 <?php echo ( $idx % 2 === 0 ) ? 'bg-[#1abc9c] text-black hover:bg-[#00ffc4]' : 'bg-[#6c3483] text-white hover:bg-[#b366ff]'; ?> font-mono-code font-bold text-xs uppercase tracking-wider transition-all">
                            <?php echo esc_html( $cta ?: baobab_t( 'ME CONTACTER', 'CONTACT ME' ) ); ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>

            <?php else : ?>

            <!-- Repli : catalogue statique si aucun service publié dans la langue -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <!-- Service 1 — Analyse Métier -->
                <div class="bg-[#12141a] border-2 border-[#1abc9c] p-8 space-y-6 flex flex-col justify-between hover:border-[#00ffc4] transition-all">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center font-mono-code text-xs">
                            <span class="px-3 py-1 bg-[#1abc9c] text-black font-bold">SERVICE_01</span>
                            <span class="text-[#1abc9c]"><?php baobab_e( '[ANALYSE_MÉTIER]', '[BUSINESS_ANALYSIS]' ); ?></span>
                        </div>
                        <h3 class="font-grotesk font-black text-2xl sm:text-3xl text-white uppercase leading-tight">
                            <?php baobab_e( 'JE TRANSFORME VOS BESOINS EN SPÉCIFICATIONS ACTIONNABLES.', 'I TRANSFORM YOUR NEEDS INTO ACTIONABLE SPECIFICATIONS.' ); ?>
                        </h3>
                        <p class="font-sans text-slate-300 text-sm leading-relaxed">
                            <?php baobab_e(
                                'Vous avez une idée, un problème ou un processus à améliorer. Je mène les entretiens, anime les ateliers, documente les exigences et produis les livrables (BRD, FRD, User Stories, Use Cases) que votre équipe technique peut immédiatement utiliser.',
                                'You have an idea, a problem or a process to improve. I run the interviews, facilitate the workshops, document the requirements and produce the deliverables (BRD, FRD, User Stories, Use Cases) your technical team can immediately use.'
                            ); ?>
                        </p>
                        <div class="bg-[#0b0c10] border border-[#262936] p-4 font-sans text-xs text-[#00ffc4]">
                            <strong class="text-white block font-mono-code uppercase mb-1">> <?php baobab_e( 'CE QUE VOUS OBTENEZ :', 'WHAT YOU GET:' ); ?></strong>
                            <?php baobab_e(
                                'Des spécifications claires, testables et traçables — du besoin initial jusqu\'à la recette finale.',
                                'Clear, testable and traceable specifications — from the initial need to the final UAT.'
                            ); ?>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-[#262936] font-mono-code text-xs text-slate-400">
                        <span class="text-[#1abc9c] font-bold block mb-1"><?php baobab_e( 'OUTILS & MÉTHODES :', 'TOOLS & METHODS:' ); ?></span>
                        BABOK · BPMN · CBAP® · MoSCoW · User Story Mapping · UAT
                    </div>
                </div>

                <!-- Service 2 — Coordination de Projets Digitaux -->
                <div class="bg-[#12141a] border-2 border-[#6c3483] p-8 space-y-6 flex flex-col justify-between hover:border-[#b366ff] transition-all">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center font-mono-code text-xs">
                            <span class="px-3 py-1 bg-[#6c3483] text-white font-bold">SERVICE_02</span>
                            <span class="text-[#b366ff]"><?php baobab_e( '[COORDINATION_PROJET]', '[PROJECT_COORDINATION]' ); ?></span>
                        </div>
                        <h3 class="font-grotesk font-black text-2xl sm:text-3xl text-white uppercase leading-tight">
                            <?php baobab_e( 'JE FAIS LE LIEN ENTRE VOTRE ÉQUIPE MÉTIER ET VOS DÉVELOPPEURS.', 'I BRIDGE YOUR BUSINESS TEAM AND YOUR DEVELOPERS.' ); ?>
                        </h3>
                        <p class="font-sans text-slate-300 text-sm leading-relaxed">
                            <?php baobab_e(
                                'Je coordonne les équipes, suis les milestones, gère les risques et communique l\'avancement aux parties prenantes. Je m\'assure que ce qui est livré correspond à ce qui était attendu — et que les utilisateurs savent s\'en servir.',
                                'I coordinate teams, track milestones, manage risks and communicate progress to stakeholders. I make sure what is delivered matches what was expected — and that users know how to use it.'
                            ); ?>
                        </p>
                        <div class="bg-[#0b0c10] border border-[#262936] p-4 font-sans text-xs text-[#b366ff]">
                            <strong class="text-white block font-mono-code uppercase mb-1">> <?php baobab_e( 'CE QUE VOUS OBTENEZ :', 'WHAT YOU GET:' ); ?></strong>
                            <?php baobab_e(
                                'Un projet qui se termine, dans les délais, et adopté par vos équipes.',
                                'A project that gets finished, on time, and adopted by your teams.'
                            ); ?>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-[#262936] font-mono-code text-xs text-slate-400">
                        <span class="text-[#b366ff] font-bold block mb-1"><?php baobab_e( 'OUTILS :', 'TOOLS:' ); ?></span>
                        Jira · Trello · Notion · Microsoft Teams · Excel Expert
                    </div>
                </div>

                <!-- Service 3 — Développement Logiciel -->
                <div class="bg-[#12141a] border-2 border-[#6c3483] p-8 space-y-6 flex flex-col justify-between hover:border-[#b366ff] transition-all">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center font-mono-code text-xs">
                            <span class="px-3 py-1 bg-[#6c3483] text-white font-bold">SERVICE_03</span>
                            <span class="text-[#b366ff]"><?php baobab_e( '[DEV_LOGICIEL]', '[SOFTWARE_DEV]' ); ?></span>
                        </div>
                        <h3 class="font-grotesk font-black text-2xl sm:text-3xl text-white uppercase leading-tight">
                            <?php baobab_e( 'JE DÉVELOPPE DES SOLUTIONS MÉTIER SUR MESURE.', 'I BUILD TAILORED BUSINESS SOLUTIONS.' ); ?>
                        </h3>
                        <p class="font-sans text-slate-300 text-sm leading-relaxed">
                            <?php baobab_e(
                                'CRM, ERP, plateformes de gestion, applications mobiles — je conçois et développe des solutions adaptées à vos besoins réels, pas à un template générique.',
                                'CRM, ERP, management platforms, mobile apps — I design and build solutions suited to your real needs, not a generic template.'
                            ); ?>
                        </p>
                        <div class="bg-[#0b0c10] border border-[#262936] p-4 font-sans text-xs text-[#b366ff]">
                            <strong class="text-white block font-mono-code uppercase mb-1">> <?php baobab_e( 'CE QUE VOUS OBTENEZ :', 'WHAT YOU GET:' ); ?></strong>
                            <?php baobab_e(
                                'Une application qui résout votre problème spécifique, sans complexité inutile.',
                                'An application that solves your specific problem, without unnecessary complexity.'
                            ); ?>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-[#262936] font-mono-code text-xs text-slate-400">
                        <span class="text-[#b366ff] font-bold block mb-1"><?php baobab_e( 'STACK TECHNIQUE :', 'TECH STACK:' ); ?></span>
                        Laravel · React JS · Flutter · Django · Python · SQL · REST API
                    </div>
                </div>

                <!-- Service 4 — Data & Business Intelligence -->
                <div class="bg-[#12141a] border-2 border-[#1abc9c] p-8 space-y-6 flex flex-col justify-between hover:border-[#00ffc4] transition-all">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center font-mono-code text-xs">
                            <span class="px-3 py-1 bg-[#1abc9c] text-black font-bold">SERVICE_04</span>
                            <span class="text-[#1abc9c]"><?php baobab_e( '[DATA_&_BI]', '[DATA_&_BI]' ); ?></span>
                        </div>
                        <h3 class="font-grotesk font-black text-2xl sm:text-3xl text-white uppercase leading-tight">
                            <?php baobab_e( 'JE TRANSFORME VOS DONNÉES EN DÉCISIONS.', 'I TURN YOUR DATA INTO DECISIONS.' ); ?>
                        </h3>
                        <p class="font-sans text-slate-300 text-sm leading-relaxed">
                            <?php baobab_e(
                                'Tableaux de bord Power BI, analyses SQL, modèles de prévision — je crée les outils qui vous permettent de piloter votre activité avec des données réelles plutôt qu\'avec des intuitions.',
                                'Power BI dashboards, SQL analysis, forecasting models — I build the tools that let you run your business on real data instead of gut feeling.'
                            ); ?>
                        </p>
                        <div class="bg-[#0b0c10] border border-[#262936] p-4 font-sans text-xs text-[#00ffc4]">
                            <strong class="text-white block font-mono-code uppercase mb-1">> <?php baobab_e( 'CE QUE VOUS OBTENEZ :', 'WHAT YOU GET:' ); ?></strong>
                            <?php baobab_e(
                                'Des indicateurs clairs, un tableau de bord que vous utiliserez vraiment, et des insights actionnables.',
                                'Clear KPIs, a dashboard you will actually use, and actionable insights.'
                            ); ?>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-[#262936] font-mono-code text-xs text-slate-400">
                        <span class="text-[#1abc9c] font-bold block mb-1"><?php baobab_e( 'OUTILS DATA :', 'DATA TOOLS:' ); ?></span>
                        Power BI · SQL · Python · R · Excel Expert · Tableau
                    </div>
                </div>

            </div>
            <?php endif; ?>

        </div>
    </section>

    <?php if ( ! empty( $pillars ) && is_array( $pillars ) ) : ?>
    <!-- ================================================
         3. PILIERS DE L'APPROCHE (ACF group_pillars)
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">

            <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b-4 border-[#1abc9c] pb-4 mb-12 gap-4">
                <div>
                    <h2 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase tracking-tighter">
                        <?php baobab_e( 'LES PILIERS DE MON APPROCHE', 'THE PILLARS OF MY APPROACH' ); ?>
                    </h2>
                    <p class="font-mono-code text-xs text-slate-400 mt-1">
                        <?php baobab_e( 'CE QUI GARANTIT LA QUALITÉ DE CHAQUE LIVRAISON', 'WHAT GUARANTEES THE QUALITY OF EVERY DELIVERY' ); ?>
                    </p>
                </div>
                <span class="font-mono-code text-xs font-bold text-[#1abc9c] tracking-widest bg-[#12141a] px-4 py-2 border border-[#262936]"><?php baobab_e( '[PILIERS]', '[PILLARS]' ); ?></span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ( $pillars as $pl ) :
                    $p_icon = ! empty( $pl['pillar_icon'] )  ? $pl['pillar_icon']  : 'star';
                    $p_title = ! empty( $pl['pillar_title'] ) ? $pl['pillar_title'] : '';
                    $p_desc  = ! empty( $pl['pillar_desc'] )  ? $pl['pillar_desc']  : '';
                    if ( ! $p_title ) { continue; }
                ?>
                <div class="bg-[#12141a] border-2 border-[#262936] p-6 hover:border-[#1abc9c] transition-all">
                    <div class="w-10 h-10 bg-[#1abc9c] text-black flex items-center justify-center mb-4 font-mono-code font-bold">
                        <span class="material-symbols-outlined"><?php echo esc_html( $p_icon ); ?></span>
                    </div>
                    <h3 class="font-grotesk font-black text-lg text-white uppercase mb-2"><?php echo esc_html( $p_title ); ?></h3>
                    <p class="font-sans text-xs text-slate-300 leading-relaxed"><?php echo esc_html( $p_desc ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>

        </div>
    </section>
    <?php endif; ?>

</main>

<?php get_footer(); ?>