<?php
/*
 Template Name: Home Page (Soulful Brutalism BA)
*/
get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

<main class="flex-1 w-full bg-[#0b0c10] text-slate-100 overflow-x-hidden">

    <!-- ================================================
         1. HERO SECTION : NYA NJIKE ARMEL
         ================================================ -->
    <section class="relative w-full py-12 md:py-20 border-b-2 border-[#262936] nsibidi-bg">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6 relative z-10">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">

                <!-- Left Column: Asymmetrical Overlapping Card -->
                <div class="lg:col-span-7 z-20">
                    <div class="bg-[#0b0c10]/95 border-2 border-[#6c3483] p-6 sm:p-10 shadow-2xl relative">
                        
                        <!-- Top Accent Tag -->
                        <div class="absolute -top-3 left-6 px-3 py-0.5 bg-[#12141a] border border-[#262936] text-[#00ffc4] font-mono-code text-[11px] font-bold tracking-widest uppercase">
                            <?php baobab_e( 'BUSINESS_ANALYST_CONFIRMÉ // CBAP®', 'CERTIFIED_BUSINESS_ANALYST // CBAP®' ); ?>
                        </div>

                        <!-- WHY : Problem statement -->
                        <div class="bg-[#12141a] border-l-4 border-[#1abc9c] px-4 py-3 mb-6">
                            <p class="font-mono-code text-[11px] text-slate-400 uppercase tracking-widest font-bold mb-1">
                                <?php baobab_e( 'LE_POURQUOI', 'THE_WHY' ); ?>
                            </p>
                            <p class="font-sans text-slate-200 text-sm sm:text-base leading-relaxed">
                                <?php baobab_e(
                                    'Des idées brillantes, des budgets serrés, des délais tenus… mais des projets qui n\'aboutissent pas.',
                                    'Great ideas, tight budgets, tight deadlines… yet projects that never ship.'
                                ); ?>
                            </p>
                        </div>

                        <!-- Main Title -->
                        <h1 class="font-grotesk font-black text-4xl sm:text-6xl lg:text-7xl tracking-tighter uppercase leading-none text-white my-4">
                            NYA NJIKE<br/>
                            <span class="text-[#1abc9c]">ARMEL</span>
                        </h1>

                        <!-- Subtitle -->
                        <div class="font-grotesk font-bold text-lg sm:text-xl text-[#00ffc4] uppercase tracking-wide mb-4">
                            <?php baobab_e( 'BUSINESS ANALYST, INGÉNIEUR LOGICIEL & ARCHITECTE SYSTÈME', 'BUSINESS ANALYST, SOFTWARE ENGINEER & SYSTEM ARCHITECT' ); ?>
                        </div>

                        <!-- SINGLE value proposition (fusion WHY→HOW) -->
                        <div class="bg-[#12141a] border-l-4 border-[#00ffc4] px-4 py-3 mb-6">
                            <p class="font-mono-code text-[11px] text-[#1abc9c] uppercase tracking-widest font-bold mb-1">
                                <?php baobab_e( 'LE_COMMENT', 'THE_HOW' ); ?>
                            </p>
                            <p class="font-sans text-slate-100 text-sm sm:text-base leading-relaxed">
                                <?php baobab_e(
                                    'Du besoin à la mise en production : spécifications claires, budget sécurisé, pilotage jusqu\'au bout. Résultat : un livrable, pas un concept.',
                                    'From requirements to production: clear specs, de-risked budget, driven to delivery. Result: a shippable product, not a concept.'
                                ); ?>
                            </p>
                        </div>

                        <!-- Context badges (remplace l'accroche verbeuse) -->
                        <div class="flex flex-wrap gap-2 mb-6">
                            <span class="px-3 py-1 border border-[#262936] text-slate-300 font-mono-code text-[11px] font-bold uppercase">FINTECH · TELECOM</span>
                            <span class="px-3 py-1 border border-[#1abc9c] text-[#00ffc4] font-mono-code text-[11px] font-bold uppercase">CBAP®</span>
                            <span class="px-3 py-1 border border-[#262936] text-slate-300 font-mono-code text-[11px] font-bold uppercase"><?php baobab_e( 'AFRIQUE CENTRALE', 'CENTRAL AFRICA' ); ?></span>
                            <span class="px-3 py-1 border border-[#262936] text-slate-300 font-mono-code text-[11px] font-bold uppercase">FR / EN</span>
                        </div>

                        <!-- Tagline secondaire -->
                        <div class="space-y-2 font-mono-code text-xs text-slate-300 border-t-2 border-[#262936] pt-4">
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500 font-bold">></span>
                                <span class="text-white">
                                <?php
                                $home_id = get_the_ID();
                                $s1v = get_field( 'stat1_value', $home_id ) ?: '5';
                                $s1s = get_field( 'stat1_suffix', $home_id ) ?: '+';
                                $s1l = get_field( 'stat1_label', $home_id ) ?: baobab_t( 'ANS D\'EXPÉRIENCE', 'YEARS EXPERIENCE' );
                                $s2v = get_field( 'stat2_value', $home_id ) ?: '50';
                                $s2s = get_field( 'stat2_suffix', $home_id ) ?: '+';
                                $s2l = get_field( 'stat2_label', $home_id ) ?: baobab_t( 'PROJETS LIVRÉS', 'PROJECTS DELIVERED' );
                                $s3v = get_field( 'stat3_value', $home_id ) ?: '8';
                                $s3s = get_field( 'stat3_suffix', $home_id ) ?: '';
                                $s3l = get_field( 'stat3_label', $home_id ) ?: baobab_t( 'PAYS COUVERTS', 'COUNTRIES SERVED' );
                                $s4v = get_field( 'stat4_value', $home_id ) ?: '60';
                                $s4s = get_field( 'stat4_suffix', $home_id ) ?: '+';
                                $s4l = get_field( 'stat4_label', $home_id ) ?: baobab_t( 'EXIGENCES SPÉCIFIÉES', 'REQUIREMENTS SPECIFIED' );
                                echo esc_html( $s1v . $s1s . ' ' . $s1l . ' · ' . $s2v . $s2s . ' ' . $s2l . ' · ' . $s3v . $s3s . ' ' . $s3l . ' · ' . $s4v . $s4s . ' ' . $s4l );
                                ?>
                                </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500 font-bold">></span>
                                <span class="text-slate-400"><?php baobab_e(
                                    'BASÉ À YAOUNDÉ, CAMEROUN (DISPONIBLE À DOUALA & REMOTE)',
                                    'BASED IN YAOUNDÉ, CAMEROON (AVAILABLE IN DOUALA & REMOTE)'
                                ); ?></span>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap gap-4 mt-8 pt-4 border-t border-[#262936]">
                            <a href="<?php echo esc_url( baobab_get_page_url( 'case-studies' ) ); ?>" 
                               class="px-6 py-3 bg-[#1abc9c] text-black font-mono-code font-bold text-xs uppercase tracking-wider hover:bg-[#00ffc4] transition-all">
                                <?php baobab_e( 'VOIR MES PROJETS →', 'VIEW MY PROJECTS →' ); ?>
                            </a>
                            <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" 
                               class="px-6 py-3 border-2 border-[#6c3483] text-white font-mono-code font-bold text-xs uppercase tracking-wider hover:bg-[#6c3483] transition-all">
                                <?php baobab_e( 'PRENDRE CONTACT', 'GET IN TOUCH' ); ?>
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Right Column: Portrait Frame -->
                <div class="lg:col-span-5 relative">
                    <div class="bg-[#1abc9c] border-2 border-[#1abc9c] p-3 sm:p-4 shadow-2xl relative group">
                        
                        <div class="flex justify-between items-center bg-[#0b0c10] text-[#1abc9c] font-mono-code text-[11px] px-3 py-1 mb-3 font-bold">
                            <span>REF: ARMEL-NYA-BA</span>
                            <span class="text-[#00ffc4]">CBAP® CERTIFIED</span>
                        </div>

                        <div class="relative overflow-hidden aspect-[4/5] border border-black/20">
                            <?php
                            $portrait = get_field( 'home_portrait' );
                            if ( empty( $portrait ) ) {
                                foreach ( get_pages( array( 'meta_key' => '_wp_page_template', 'meta_value' => 'front-page.php', 'lang' => '' ) ) as $hp ) {
                                    $cand = get_field( 'home_portrait', $hp->ID );
                                    if ( $cand ) { $portrait = $cand; break; }
                                }
                            }
                            if ( empty( $portrait ) ) {
                                $portrait = $theme_uri . '/images/armel_portrait.jpg';
                            }
                            ?>
                            <img src="<?php echo esc_url( $portrait ); ?>" 
                                 alt="NYA NJIKE ARMEL Portrait" 
                                 class="w-full h-full object-cover grayscale contrast-125 hover:grayscale-0 transition-all duration-500" />
                            
                            <div class="absolute bottom-4 left-4 right-4 bg-[#0b0c10]/95 border border-[#1abc9c] p-3 text-left">
                                <p class="font-grotesk font-black text-white text-sm sm:text-base tracking-tight uppercase leading-tight">
                                    <?php baobab_e(
                                        'L\'ANALYSTE QUI COMPREND LE CLIENT, LE CODE ET L\'ARCHITECTURE SYSTÈME',
                                        'THE ANALYST WHO UNDERSTANDS THE CLIENT, THE CODE AND THE SYSTEM ARCHITECTURE'
                                    ); ?>
                                </p>
                                <p class="font-mono-code text-[10px] text-[#1abc9c] mt-1">
                                    BRIDGING BUSINESS NEEDS, CODE & SYSTEM ARCHITECTURE
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ================================================
         2. DOMAINES D'EXPERTISE // SERVICES PREVIEW
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            
            <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b-4 border-[#1abc9c] pb-4 mb-12 gap-4">
                <div>
                    <h2 class="font-grotesk font-black text-4xl sm:text-5xl text-white tracking-tighter uppercase">
                        <?php baobab_e( 'EXPERTISES & VALEUR AJOUTÉE', 'EXPERTISE & ADDED VALUE' ); ?>
                    </h2>
                    <p class="font-mono-code text-xs text-slate-400 mt-1">
                        <?php baobab_e( 'QUATRE FAÇONS DONT JE CRÉE DE LA VALEUR POUR VOS PROJETS', 'FOUR WAYS I CREATE VALUE FOR YOUR PROJECTS' ); ?>
                    </p>
                </div>
                <div class="font-mono-code text-xs font-bold text-[#1abc9c] tracking-widest bg-[#12141a] px-4 py-2 border border-[#262936]">
                    <?php baobab_e( 'COMPÉTENCES_CLÉS', 'CORE_COMPETENCIES' ); ?>
                </div>
            </div>

            <!-- 4 Column Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Pillar 1 -->
                <div class="bg-[#12141a] border-2 border-[#1abc9c] p-6 flex flex-col justify-between hover:border-[#00ffc4] transition-all space-y-4">
                    <div>
                        <div class="w-10 h-10 bg-[#1abc9c] text-black flex items-center justify-center mb-4 font-mono-code font-bold">
                            01
                        </div>
                        <h3 class="font-grotesk font-black text-xl text-white uppercase mb-2">
                            <?php baobab_e( 'ANALYSE MÉTIER', 'BUSINESS ANALYSIS' ); ?>
                        </h3>
                        <p class="font-sans text-xs text-slate-300 leading-relaxed">
                            <?php baobab_e(
                                'Spécifications claires, testables et traçables (BRD, FRD, User Stories, BPMN).',
                                'Clear, testable and traceable specifications (BRD, FRD, User Stories, BPMN).'
                            ); ?>
                        </p>
                    </div>
                    <div class="font-mono-code text-[11px] text-[#1abc9c] pt-3 border-t border-[#262936]">
                        BABOK · CBAP® · MoSCoW
                    </div>
                </div>

                <!-- Pillar 2 -->
                <div class="bg-[#12141a] border-2 border-[#6c3483] p-6 flex flex-col justify-between hover:border-[#b366ff] transition-all space-y-4">
                    <div>
                        <div class="w-10 h-10 bg-[#6c3483] text-white flex items-center justify-center mb-4 font-mono-code font-bold">
                            02
                        </div>
                        <h3 class="font-grotesk font-black text-xl text-white uppercase mb-2">
                            <?php baobab_e( 'COORDINATION PROJET', 'PROJECT COORDINATION' ); ?>
                        </h3>
                        <p class="font-sans text-xs text-slate-300 leading-relaxed">
                            <?php baobab_e(
                                'Pont entre équipes métier et dev. Respect des délais, des coûts et de l\'adoption.',
                                'Bridge between business and dev teams. On time, on budget, adopted.'
                            ); ?>
                        </p>
                    </div>
                    <div class="font-mono-code text-[11px] text-[#b366ff] pt-3 border-t border-[#262936]">
                        Jira · Agile · Change Mgmt
                    </div>
                </div>

                <!-- Pillar 3 -->
                <div class="bg-[#12141a] border-2 border-[#1abc9c] p-6 flex flex-col justify-between hover:border-[#00ffc4] transition-all space-y-4">
                    <div>
                        <div class="w-10 h-10 bg-[#1abc9c] text-black flex items-center justify-center mb-4 font-mono-code font-bold">
                            03
                        </div>
                        <h3 class="font-grotesk font-black text-xl text-white uppercase mb-2">
                            <?php baobab_e( 'DÉVELOPPEMENT TECH', 'TECH DEVELOPMENT' ); ?>
                        </h3>
                        <p class="font-sans text-xs text-slate-300 leading-relaxed">
                            <?php baobab_e(
                                'Solutions métier sur mesure sans complexité inutile (Laravel, React, Django).',
                                'Tailored business solutions without unnecessary complexity (Laravel, React, Django).'
                            ); ?>
                        </p>
                    </div>
                    <div class="font-mono-code text-[11px] text-[#1abc9c] pt-3 border-t border-[#262936]">
                        Python · SQL · REST APIs
                    </div>
                </div>

                <!-- Pillar 4 -->
                <div class="bg-[#12141a] border-2 border-[#6c3483] p-6 flex flex-col justify-between hover:border-[#b366ff] transition-all space-y-4">
                    <div>
                        <div class="w-10 h-10 bg-[#6c3483] text-white flex items-center justify-center mb-4 font-mono-code font-bold">
                            04
                        </div>
                        <h3 class="font-grotesk font-black text-xl text-white uppercase mb-2">
                            <?php baobab_e( 'DATA & BI', 'DATA & BI' ); ?>
                        </h3>
                        <p class="font-sans text-xs text-slate-300 leading-relaxed">
                            <?php baobab_e(
                                'Tableaux de bord opérationnels et modèles décisionnels pour piloter par la donnée.',
                                'Operational dashboards and decision models to run your business on data.'
                            ); ?>
                        </p>
                    </div>
                    <div class="font-mono-code text-[11px] text-[#b366ff] pt-3 border-t border-[#262936]">
                        Power BI · SQL · Tableau
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ================================================
         3. FEATURED CASE STUDY (DYNAMIQUE — CPT)
         ================================================ -->
    <?php
    $featured_cases = get_posts( array(
        'post_type'      => 'case_studies',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_key'       => 'case_order',
        'orderby'        => 'meta_value_num',
        'order'          => 'ASC',
        'lang'           => function_exists('pll_current_language') ? pll_current_language() : '',
    ) );
    $feat = 0;
    foreach ( $featured_cases as $fc ) { if ( get_field( 'case_featured', $fc->ID ) ) { $feat = $fc->ID; break; } }
    if ( ! $feat && $featured_cases ) { $feat = $featured_cases[0]->ID; }

    if ( $feat ) :
        $feat_ctx      = get_field( 'case_context', $feat );
        $feat_meta     = get_field( 'case_meta', $feat );
        $feat_findings = get_field( 'case_findings', $feat );
        $feat_imp      = get_field( 'case_impact', $feat );
        $feat_results  = get_field( 'case_results', $feat );
    ?>
    <section class="w-full py-16 md:py-24 bg-[#0b0c10] border-b-2 border-[#262936] nsibidi-overlay">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">

            <div class="bg-[#12141a] border-2 border-[#6c3483] p-8 sm:p-12 space-y-8 relative overflow-hidden">

                <div class="flex flex-wrap items-center justify-between gap-4 font-mono-code text-xs">
                    <span class="px-3 py-1 bg-[#6c3483] text-white font-bold">[FEATURED_CASE_STUDY]</span>
                    <span class="text-[#00ffc4]"><?php echo esc_html( $feat_meta ); ?></span>
                </div>

                <div class="space-y-4">
                    <h2 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase leading-tight">
                        <?php echo esc_html( get_the_title( $feat ) ); ?>
                    </h2>
                    <?php if ( $feat_ctx ) : ?>
                    <p class="font-sans text-slate-300 text-base leading-relaxed max-w-4xl">
                        <?php echo esc_html( wp_strip_all_tags( $feat_ctx ) ); ?>
                    </p>
                    <?php endif; ?>
                </div>

                <?php if ( ! empty( $feat_findings ) ) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-b border-[#262936] py-6 font-mono-code text-xs">
                    <?php foreach ( $feat_findings as $fk => $ff ) : $alt = ( $fk % 2 === 1 ); ?>
                    <div class="space-y-2">
                        <?php if ( $alt ) : ?>
                        <span class="text-[#6c3483] font-bold block">> <?php echo esc_html( $ff['finding_label'] ); ?></span>
                        <?php else : ?>
                        <span class="text-[#1abc9c] font-bold block">> <?php echo esc_html( $ff['finding_label'] ); ?></span>
                        <?php endif; ?>
                        <p class="text-slate-300 font-sans"><?php echo esc_html( $ff['finding_text'] ); ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="flex flex-wrap items-center justify-between gap-4 font-mono-code text-xs pt-2">
                    <span class="text-slate-400"><?php echo esc_html( $feat_imp ?: $feat_results ); ?></span>
                    <a href="<?php echo esc_url( get_permalink( $feat ) ); ?>"
                       class="px-6 py-3 bg-[#6c3483] text-white font-bold uppercase hover:bg-[#1abc9c] hover:text-black transition-all">
                        <?php baobab_e( 'LIRE L\'ÉTUDE DE CAS COMPLÈTE →', 'READ THE FULL CASE STUDY →' ); ?>
                    </a>
                </div>

            </div>

        </div>
    </section>
    <?php endif; ?>

    <!-- ================================================
         4. CALL TO ACTION : TRAVAILLONS ENSEMBLE
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                
                <div class="lg:col-span-7 space-y-6">
                    <h2 class="font-grotesk font-black text-4xl sm:text-6xl text-white uppercase leading-none">
                        <?php baobab_e( 'TRAVAILLONS', "LET'S WORK" ); ?><br/>
                        <span class="text-[#1abc9c]"><?php baobab_e( 'ENSEMBLE.', 'TOGETHER.' ); ?></span>
                    </h2>

                    <p class="font-sans text-slate-300 text-lg leading-relaxed max-w-xl">
                        <?php baobab_e(
                            'Vous avez un projet à analyser, un produit à spécifier, ou une équipe à coordonner ? Je suis disponible pour des missions en présentiel à Yaoundé/Douala ou en remote.',
                            'Have a project to analyze, a product to specify, or a team to coordinate? I am available for on-site missions in Yaoundé/Douala or remote.'
                        ); ?>
                    </p>

                    <div>
                        <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" 
                           class="inline-flex items-center gap-3 px-8 py-4 bg-[#6c3483] border-2 border-[#6c3483] text-white font-mono-code font-bold text-sm uppercase tracking-wider hover:bg-[#1abc9c] hover:border-[#1abc9c] hover:text-black transition-all">
                            <span><?php baobab_e( 'DISCUTER DE VOTRE PROJET', 'DISCUSS YOUR PROJECT' ); ?></span>
                            <span class="material-symbols-outlined">east</span>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-5 bg-[#12141a] border-2 border-[#262936] p-8 space-y-4 font-mono-code text-xs">
                    <div class="text-[#1abc9c] font-bold uppercase border-b border-[#262936] pb-3">
                        <?php baobab_e( '[CONTACT_RAPIDE]', '[QUICK_CONTACT]' ); ?>
                    </div>
                    <div class="space-y-3 text-slate-200">
                        <p><span class="text-[#1abc9c] font-bold">></span> <?php baobab_e( 'TÉLÉPHONE:', 'PHONE:' ); ?> <a href="tel:+237676398049" class="font-bold text-white hover:text-[#1abc9c]">+237 676 398 049</a></p>
                        <p><span class="text-[#1abc9c] font-bold">></span> EMAIL: <a href="mailto:armel.njike@yahoo.com" class="font-bold text-white hover:text-[#1abc9c]">armel.njike@yahoo.com</a></p>
                        <p><span class="text-[#1abc9c] font-bold">></span> <?php baobab_e( 'LOCALISATION:', 'LOCATION:' ); ?> <?php baobab_e( 'Yaoundé (Disponible Douala & Remote)', 'Yaoundé (Available Douala & Remote)' ); ?></p>
                    </div>
                </div>

            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>