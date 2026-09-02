<?php
/*
 Template Name: Case Studies Page (Soulful Brutalism Portfolio BA)
*/
get_header();

$cs_title = get_field( 'cs_hero_title' ) ?: baobab_t( 'RÉALISATIONS MÉTIER &<br/>', 'BUSINESS ACCOMPLISHMENTS &<br/>' );
$cs_desc  = get_field( 'cs_hero_desc' )  ?: baobab_t(
    'Découvrez une sélection de projets majeurs illustrant mon approche de Business Analyst, Ingénieur Logiciel et Architecte Système.',
    'Discover a selection of major projects illustrating my approach as a Business Analyst, Software Engineer and System Architect.'
);

$cases = get_posts( array(
    'post_type'      => 'case_studies',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'meta_key'       => 'case_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'lang'           => function_exists('pll_current_language') ? pll_current_language() : '',
) );

$featured_id = 0;
foreach ( $cases as $c ) {
    if ( get_field( 'case_featured', $c->ID ) ) { $featured_id = $c->ID; break; }
}
if ( ! $featured_id && ! empty( $cases ) ) { $featured_id = $cases[0]->ID; }

$cards = array_filter( $cases, function ( $c ) use ( $featured_id ) {
    return $c->ID !== $featured_id;
} );
?>

<main class="flex-1 w-full bg-[#0b0c10] text-slate-100 overflow-x-hidden">

    <!-- ================================================
         1. HERO SECTION : CASE STUDIES / PORTFOLIO
         ================================================ -->
    <section class="w-full py-16 md:py-24 border-b-2 border-[#262936] bg-[#0b0c10] nsibidi-bg">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">

            <div class="max-w-3xl space-y-4">
                <div class="font-mono-code text-xs text-[#1abc9c] font-bold tracking-widest uppercase">
                    [PORTFOLIO // CASE_STUDIES // CERTIFICATIONS]
                </div>

                <h1 class="font-grotesk font-black text-4xl sm:text-6xl lg:text-7xl text-white uppercase tracking-tight leading-none">
                    <?php echo wp_kses_post( $cs_title ); ?>
                    <span class="text-[#1abc9c]"><?php baobab_e( 'ÉTUDES DE CAS.', 'CASE STUDIES.' ); ?></span>
                </h1>

                <p class="font-sans text-slate-300 text-lg leading-relaxed pt-4">
                    <?php echo esc_html( $cs_desc ); ?>
                </p>
            </div>

        </div>
    </section>

    <!-- ================================================
         2. CASE STUDIES INDEX (DYNAMIQUE — CPT)
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6 space-y-16">

            <div class="flex items-center justify-between font-mono-code text-xs">
                <span class="text-[#1abc9c] font-bold uppercase">[INDEX_CASE_STUDIES]</span>
                <span class="text-slate-400"><?php baobab_e( 'TOTAL_ENTRÉES:', 'TOTAL_ENTRIES:' ); ?> <?php echo count( $cases ); ?></span>
            </div>

            <?php if ( $featured_id ) :

                $ctx     = get_field( 'case_context', $featured_id );
                $imp     = get_field( 'case_impact',  $featured_id );
                $meta    = get_field( 'case_meta',    $featured_id );
                $client  = get_field( 'case_client',  $featured_id );
                $stack   = get_field( 'case_stack',   $featured_id );
                $results = get_field( 'case_results', $featured_id );
                $approach = get_field( 'case_approach', $featured_id );
                $findings = get_field( 'case_findings', $featured_id );
            ?>

            <!-- FEATURED CASE STUDY -->
            <div class="bg-[#12141a] border-2 border-[#6c3483] p-8 sm:p-12 space-y-8 relative overflow-hidden">
                <div class="flex flex-wrap items-center justify-between gap-4 font-mono-code text-xs">
                    <span class="px-3 py-1 bg-[#6c3483] text-white font-bold">[FEATURED_CASE_STUDY]</span>
                    <span class="text-[#00ffc4]"><?php echo esc_html( $meta ?: $client ); ?></span>
                </div>

                <div class="space-y-4">
                    <h2 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase leading-tight break-words">
                        <?php echo esc_html( get_the_title( $featured_id ) ); ?>
                    </h2>
                    <?php if ( $ctx ) : ?>
                    <p class="font-sans text-slate-300 text-base leading-relaxed max-w-4xl break-words">
                        <strong><?php baobab_e( 'Contexte :', 'Context:' ); ?></strong> <?php echo esc_html( wp_strip_all_tags( $ctx ) ); ?>
                    </p>
                    <?php endif; ?>
                </div>

                <?php if ( ! empty( $approach ) ) : ?>
                <div class="bg-[#0b0c10] border border-[#262936] p-6 space-y-3 font-mono-code text-xs">
                    <span class="text-[#1abc9c] font-bold block uppercase">> <?php baobab_e(
                        'MA DÉMARCHE D\'INVESTIGATION STRUCTURÉE :',
                        'MY STRUCTURED INVESTIGATION APPROACH:'
                    ); ?></span>
                    <ul class="grid grid-cols-1 sm:grid-cols-2 gap-2 text-slate-300">
                        <?php foreach ( $approach as $step ) : ?>
                        <li><?php echo esc_html( $step['approach_step'] ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <?php if ( ! empty( $findings ) ) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 font-mono-code text-xs">
                    <?php foreach ( $findings as $k => $f ) : $alt = ( $k % 2 === 1 ); ?>
                    <div class="bg-[#0b0c10] border border-[#262936] p-5 space-y-2">
                        <span class="text-<?php echo $alt ? '#6c3483' : '#1abc9c'; ?> font-bold block">
                            <?php echo esc_html( $f['finding_label'] ); ?>
                        </span>
                        <p class="font-sans text-slate-300 text-xs">
                            <?php echo esc_html( $f['finding_text'] ); ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div class="border-t border-[#262936] pt-6 font-mono-code text-xs space-y-2">
                    <?php if ( $imp ) : ?>
                    <span class="text-[#00ffc4] font-bold block uppercase">> <?php baobab_e( 'L\'IMPACT & LA SOLUTION :', 'THE IMPACT & THE SOLUTION:' ); ?></span>
                    <p class="font-sans text-slate-300 text-sm"><?php echo esc_html( wp_strip_all_tags( $imp ) ); ?></p>
                    <?php endif; ?>
                    <div class="flex flex-wrap items-center justify-between gap-4 pt-2">
                        <span class="text-slate-400">
                            <?php
                            $chips = array();
                            if ( $stack )   { $chips[] = 'STACK: ' . $stack; }
                            if ( $results ) { $chips[] = baobab_t( 'RÉSULTAT:', 'RESULT:' ) . ' ' . $results; }
                            echo esc_html( implode( ' // ', $chips ) );
                            ?>
                        </span>
                        <a href="<?php echo esc_url( get_permalink( $featured_id ) ); ?>"
                           class="px-6 py-3 bg-[#6c3483] text-white font-bold uppercase hover:bg-[#1abc9c] hover:text-black transition-all">
                            <?php baobab_e( 'LIRE LA FICHE COMPLÈTE →', 'READ THE FULL CASE →' ); ?>
                        </a>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- OTHER CASES GRID -->
            <?php if ( ! empty( $cards ) ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 min-w-0">
                <?php foreach ( $cards as $c ) :

                    $prob    = get_field( 'case_problem', $c->ID );
                    $sol     = get_field( 'case_solution', $c->ID );
                    $stack   = get_field( 'case_stack', $c->ID );
                    $results = get_field( 'case_results', $c->ID );
                    $img     = get_field( 'case_image', $c->ID ) ?: get_the_post_thumbnail_url( $c->ID, 'large' );
                    $client  = get_field( 'case_client', $c->ID );

                    $card_cats   = get_the_terms( $c->ID, 'case_category' );
                    $card_cat    = ( $card_cats && ! is_wp_error( $card_cats ) ) ? $card_cats[0]->name : '';
                ?>
                <div class="bg-[#12141a] border-2 border-[#1abc9c] p-6 space-y-4 hover:border-[#00ffc4] transition-all flex flex-col justify-between min-w-0 overflow-hidden">
                    <div class="space-y-3 min-w-0">
                        <div class="flex justify-between items-center gap-2 font-mono-code text-[11px] min-w-0">
                            <span class="px-2 py-0.5 bg-[#1abc9c] text-black font-bold shrink-0 uppercase truncate">
                                <?php echo esc_html( $card_cat ?: baobab_t( 'CASE_STUDY', 'CASE STUDY' ) ); ?>
                            </span>
                            <span class="text-[#00ffc4] text-right flex-1 min-w-0 truncate">
                                <?php echo esc_html( $client ?: $results ); ?>
                            </span>
                        </div>

                        <h3 class="font-grotesk font-black text-2xl text-white uppercase break-words leading-tight">
                            <?php echo esc_html( get_the_title( $c->ID ) ); ?>
                        </h3>

                        <?php if ( $img ) : ?>
                        <div class="aspect-video overflow-hidden border border-[#262936] my-2">
                            <?php $img_alt = get_field( 'case_image_alt', $c->ID ) ?: get_the_title( $c->ID ); ?>
                            <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="w-full h-full object-cover" />
                        </div>
                        <?php endif; ?>

                        <?php if ( $prob ) : ?>
                        <p class="font-sans text-xs text-slate-300 leading-relaxed break-words">
                            <strong><?php baobab_e( 'Problème / Contexte :', 'Problem / Context:' ); ?></strong> <?php echo esc_html( wp_strip_all_tags( $prob ) ); ?>
                        </p>
                        <?php endif; ?>

                        <?php if ( $sol ) : ?>
                        <p class="font-sans text-xs text-slate-300 leading-relaxed border-t border-[#262936] pt-2 break-words">
                            <strong><?php baobab_e( 'Solution :', 'Solution:' ); ?></strong> <?php echo esc_html( wp_strip_all_tags( $sol ) ); ?>
                        </p>
                        <?php endif; ?>
                    </div>

                    <div class="pt-3 border-t border-[#262936] font-mono-code text-xs flex justify-between items-center">
                        <a href="<?php echo esc_url( get_permalink( $c->ID ) ); ?>" class="text-[#1abc9c] font-bold hover:underline">
                            <?php baobab_e( 'LIRE LA FICHE COMPLÈTE →', 'READ THE FULL CASE →' ); ?>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else : ?>
            <p class="text-slate-400 text-center font-mono-code text-sm py-12 border border-[#262936]">
                <?php baobab_e(
                    'AUCUN CASE STUDY PUBLIÉ. AJOUTEZ-EN VIA',
                    'NO CASE STUDY PUBLISHED. ADD ONE VIA'
                ); ?> <strong>ADMIN → CASE STUDIES</strong>.
            </p>
            <?php endif; ?>

        </div>
    </section>

    <!-- ================================================
         3. SECTION CERTIFICATIONS
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#12141a] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6 space-y-8">

            <div class="border-b-2 border-[#262936] pb-4">
                <h2 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase">
                    <?php baobab_e( 'CERTIFIÉ. VÉRIFIÉ. À JOUR.', 'CERTIFIED. VERIFIED. UP TO DATE.' ); ?>
                </h2>
                <p class="font-sans text-slate-400 text-sm mt-2">
                    <?php baobab_e(
                        'La formation continue n\'est pas une case à cocher — c\'est une façon de rester pertinent dans un secteur qui change vite.',
                        'Continuous learning is not a checkbox — it is how you stay relevant in an industry that moves fast.'
                    ); ?>
                </p>
            </div>

            <!-- List of Certifications -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 font-mono-code text-xs">

                <div class="bg-[#0b0c10] border border-[#1abc9c] p-4 space-y-2">
                    <span class="px-2 py-0.5 bg-[#1abc9c] text-black font-bold text-[10px]">VERIFIED</span>
                    <h4 class="font-bold text-white text-sm">CBAP® — IIBA®</h4>
                    <p class="text-slate-400 text-[11px]"><?php baobab_e( 'Certified Business Analysis Professional (2025)', 'Certified Business Analysis Professional (2025)' ); ?></p>
                </div>

                <div class="bg-[#0b0c10] border border-[#262936] p-4 space-y-2">
                    <span class="px-2 py-0.5 bg-[#6c3483] text-white font-bold text-[10px]">VERIFIED</span>
                    <h4 class="font-bold text-white text-sm">POWER BI DATA ANALYST</h4>
                    <p class="text-slate-400 text-[11px]">DAX, Modeling & Dashboards</p>
                </div>

                <div class="bg-[#0b0c10] border border-[#262936] p-4 space-y-2">
                    <span class="px-2 py-0.5 bg-[#6c3483] text-white font-bold text-[10px]">VERIFIED</span>
                    <h4 class="font-bold text-white text-sm">PAYMENT TECHNOLOGIES</h4>
                    <p class="text-slate-400 text-[11px]">University of Michigan — Payments Systems</p>
                </div>

                <div class="bg-[#0b0c10] border border-[#262936] p-4 space-y-2">
                    <span class="px-2 py-0.5 bg-[#6c3483] text-white font-bold text-[10px]">VERIFIED</span>
                    <h4 class="font-bold text-white text-sm">RISK ASSESSMENT</h4>
                    <p class="text-slate-400 text-[11px]">Cybersecurity Risk Management</p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================================================
         4. SECTION CTA
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            <?php
            $cs_cta_badge  = get_field( 'cs_cta_badge' );
            $cs_cta_title1 = get_field( 'cs_cta_title1' );
            $cs_cta_title2 = get_field( 'cs_cta_title2' );
            $cs_cta_text   = get_field( 'cs_cta_text' );
            $cs_cta_btn1   = get_field( 'cs_cta_btn1' );
            $cs_cta_btn2   = get_field( 'cs_cta_btn2' );
            if ( $cs_cta_badge || $cs_cta_title1 ) :
            ?>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
                <div class="lg:col-span-7 space-y-4">
                    <?php if ( $cs_cta_badge ) : ?>
                    <span class="inline-block px-3 py-1 bg-[#1abc9c]/10 border border-[#1abc9c] text-[#1abc9c] font-mono-code text-[10px] uppercase tracking-widest"><?php echo esc_html( $cs_cta_badge ); ?></span>
                    <?php endif; ?>
                    <h2 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase leading-none">
                        <?php echo esc_html( $cs_cta_title1 ); ?><?php if ( $cs_cta_title2 ) : ?><br/><span class="text-[#1abc9c]"><?php echo esc_html( $cs_cta_title2 ); ?></span><?php endif; ?>
                    </h2>
                    <?php if ( $cs_cta_text ) : ?>
                    <p class="font-sans text-slate-300 text-base leading-relaxed max-w-xl"><?php echo esc_html( $cs_cta_text ); ?></p>
                    <?php endif; ?>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <?php if ( $cs_cta_btn1 ) : ?>
                        <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" class="px-6 py-3 bg-[#6c3483] text-white font-mono-code font-bold text-xs uppercase tracking-wider hover:bg-[#1abc9c] hover:text-black transition-all">
                            <?php echo esc_html( $cs_cta_btn1 ); ?>
                        </a>
                        <?php endif; ?>
                        <?php if ( $cs_cta_btn2 ) : ?>
                        <a href="<?php echo esc_url( baobab_get_page_url( 'services' ) ); ?>" class="px-6 py-3 border-2 border-[#6c3483] text-white font-mono-code font-bold text-xs uppercase tracking-wider hover:bg-[#6c3483] transition-all">
                            <?php echo esc_html( $cs_cta_btn2 ); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php else : ?>
            <div class="text-center space-y-4">
                <h2 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase">
                    <?php baobab_e( 'TRAVAILLONS ENSEMBLE', "LET'S WORK TOGETHER" ); ?>
                </h2>
                <p class="font-sans text-slate-300 text-lg max-w-xl mx-auto">
                    <?php baobab_e(
                        'Vous avez un projet à analyser ? Je suis disponible pour des missions en présentiel ou en remote.',
                        'Have a project to analyze? I am available for on-site or remote missions.'
                    ); ?>
                </p>
                <div class="flex flex-wrap justify-center gap-4 pt-2">
                    <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" class="px-6 py-3 bg-[#6c3483] text-white font-mono-code font-bold text-xs uppercase tracking-wider hover:bg-[#1abc9c] hover:text-black transition-all">
                        <?php baobab_e( 'ME CONTACTER', 'CONTACT ME' ); ?>
                    </a>
                    <a href="<?php echo esc_url( baobab_get_page_url( 'services' ) ); ?>" class="px-6 py-3 border-2 border-[#6c3483] text-white font-mono-code font-bold text-xs uppercase tracking-wider hover:bg-[#6c3483] transition-all">
                        <?php baobab_e( 'VOIR MES SERVICES', 'VIEW MY SERVICES' ); ?>
                    </a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php get_footer(); ?>