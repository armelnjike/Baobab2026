<?php
/*
 Template Name: Process Page (Soulful Brutalism BA)
*/
get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

<main class="flex-1 w-full bg-[#0b0c10] text-slate-100 overflow-x-hidden">

    <!-- ================================================
         1. HERO SECTION : PROCESS
         ================================================ -->
    <section class="w-full py-16 md:py-24 border-b-2 border-[#262936] bg-[#0b0c10] nsibidi-bg">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">

            <div class="max-w-3xl space-y-4">
                <div class="font-mono-code text-xs text-[#1abc9c] font-bold tracking-widest uppercase">
                    <?php
                    $badge = get_field( 'process_hero_badge' );
                    echo esc_html( $badge ?: 'MÉTHODOLOGIE // APPROCHE' );
                    ?>
                </div>

                <h1 class="font-grotesk font-black text-4xl sm:text-6xl lg:text-7xl text-white uppercase tracking-tight leading-none">
                    <?php
                    $t1 = get_field( 'process_hero_title' );
                    $t2 = get_field( 'process_hero_title_colored' );
                    echo esc_html( $t1 ?: 'COMMENT JE' ); ?><br/>
                    <span class="text-[#1abc9c]"><?php echo esc_html( $t2 ?: 'TRAVAILLE.' ); ?></span>
                </h1>

                <p class="font-sans text-slate-300 text-lg leading-relaxed pt-4">
                    <?php
                    $desc = get_field( 'process_hero_text' );
                    echo esc_html( $desc ?: 'Du cadrage initial à la livraison finale, chaque étape est pensée pour réduire les risques, clarifier les attentes et garantir une solution qui répond exactement à votre besoin métier.' );
                    ?>
                </p>
            </div>

        </div>
    </section>

    <!-- ================================================
         2. PROCESS STEPS — DYNAMIQUE ACF
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">

            <?php if ( have_rows( 'process_steps' ) ) :
                $step_idx = 0;
                while ( have_rows( 'process_steps' ) ) : the_row();
                    $step_idx++;
                    $icon   = get_sub_field( 'step_icon' );
                    $title  = get_sub_field( 'step_title' );
                    $desc   = get_sub_field( 'step_desc' );
                    $num    = str_pad( $step_idx, 2, '0', STR_PAD_LEFT );
                    $border = ( $step_idx % 2 === 1 ) ? 'border-[#6c3483]' : 'border-[#1abc9c]';
            ?>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-12 last:mb-0">

                <!-- Step Number + Icon -->
                <div class="lg:col-span-2 flex lg:flex-col items-center lg:items-start gap-4">
                    <span class="font-mono-code text-5xl lg:text-7xl font-black <?php echo $step_idx % 2 === 1 ? 'text-[#6c3483]' : 'text-[#1abc9c]'; ?> leading-none"><?php echo esc_html( $num ); ?></span>
                    <?php if ( $icon ) : ?>
                    <span class="material-symbols-outlined text-3xl lg:text-4xl <?php echo $step_idx % 2 === 1 ? 'text-[#6c3483]' : 'text-[#1abc9c]'; ?>"><?php echo esc_html( $icon ); ?></span>
                    <?php endif; ?>
                </div>

                <!-- Step Content -->
                <div class="lg:col-span-10 bg-[#12141a] border-l-4 <?php echo $border; ?> p-6 sm:p-8">
                    <h2 class="font-grotesk font-black text-2xl sm:text-3xl text-white uppercase mb-4">
                        <?php echo esc_html( $title ?: 'ÉTAPE ' . $num ); ?>
                    </h2>
                    <p class="font-sans text-slate-300 text-base leading-relaxed mb-6">
                        <?php echo esc_html( $desc ); ?>
                    </p>

                    <?php if ( have_rows( 'step_details' ) ) : ?>
                    <ul class="font-mono-code text-xs space-y-2">
                        <?php while ( have_rows( 'step_details' ) ) : the_row(); ?>
                        <li class="flex items-start gap-2 text-slate-300">
                            <span class="text-[#00ffc4] font-bold mt-0.5">✓</span>
                            <span><?php echo esc_html( get_sub_field( 'detail_item' ) ); ?></span>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>

            </div>
            <?php
                endwhile;
            else :
                // Fallback : étapes par défaut
                $fallback_steps = array(
                    array( 'num' => '01', 'icon' => 'search', 'title' => 'CADRAGE & DIAGNOSTIC', 'desc' => 'Je commence par comprendre votre contexte métier, vos objectifs et vos contraintes. Entretiens avec les parties prenantes, audit de l\'existant, identification des gaps.', 'details' => array( 'Entretiens avec les parties prenantes', 'Audit de l\'existant et cartographie des processus', 'Identification des besoins critiques et des quick wins' ) ),
                    array( 'num' => '02', 'icon' => 'description', 'title' => 'SPÉCIFICATION & EXIGENCES', 'desc' => 'Je rédige les livrables clés : cahier des charges, spécifications fonctionnelles, user stories avec critères d\'acceptation. Chaque exigence est traçable et testable.', 'details' => array( 'Cahier des charges / BRD / FRD', 'User stories avec critères d\'acceptation (UAT)', 'Matrice de traçabilité des exigences' ) ),
                    array( 'num' => '03', 'icon' => 'draw', 'title' => 'CONCEPTION & ARCHITECTURE', 'desc' => 'Je conçois la solution : architecture technique, maquettes d\'interface, modélisation des données. Le tout validé avant le premier sprint de développement.', 'details' => array( 'Architecture technique et choix de stack', 'Maquettes et parcours utilisateurs', 'Modélisation des données et APIs' ) ),
                    array( 'num' => '04', 'icon' => 'code', 'title' => 'DÉVELOPPEMENT & COORDINATION', 'desc' => 'Je pilote l\'équipe technique, je priorise le backlog et je suis l\'avancement au quotidien. Sprints courtes, démos régulières, rien n\'est laissé dans l\'ombre.', 'details' => array( 'Pilotage backlog et priorisation', 'Sprints courtes avec démos régulières', 'Reporting clair pour les parties prenantes' ) ),
                    array( 'num' => '05', 'icon' => 'verified', 'title' => 'RECETTE & VALIDATION', 'desc' => 'Tests fonctionnels, recette utilisateur (UAT), validation des critères d\'acceptation. Je ne livre pas tant que chaque exigence n\'est pas vérifiée.', 'details' => array( 'Tests fonctionnels et de non-régression', 'Session UAT avec les utilisateurs finaux', 'Protocole de recette documenté' ) ),
                    array( 'num' => '06', 'icon' => 'rocket_launch', 'title' => 'LIVRAISON & ACCOMPAGNEMENT', 'desc' => 'Mise en production supervisée, documentation technique, formation des équipes. Je reste disponible pour le support post-livraison.', 'details' => array( 'Mise en production supervisée', 'Documentation et formation des équipes', 'Support post-livraison et amélioration continue' ) ),
                );
                foreach ( $fallback_steps as $fs ) :
            ?>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start mb-12 last:mb-0">
                <div class="lg:col-span-2 flex lg:flex-col items-center lg:items-start gap-4">
                    <span class="font-mono-code text-5xl lg:text-7xl font-black <?php echo $fs['num'] % 2 === 1 ? 'text-[#6c3483]' : 'text-[#1abc9c]'; ?> leading-none"><?php echo esc_html( $fs['num'] ); ?></span>
                    <span class="material-symbols-outlined text-3xl lg:text-4xl <?php echo $fs['num'] % 2 === 1 ? 'text-[#6c3483]' : 'text-[#1abc9c]'; ?>"><?php echo esc_html( $fs['icon'] ); ?></span>
                </div>
                <div class="lg:col-span-10 bg-[#12141a] border-l-4 <?php echo $fs['num'] % 2 === 1 ? 'border-[#6c3483]' : 'border-[#1abc9c]'; ?> p-6 sm:p-8">
                    <h2 class="font-grotesk font-black text-2xl sm:text-3xl text-white uppercase mb-4"><?php echo esc_html( $fs['title'] ); ?></h2>
                    <p class="font-sans text-slate-300 text-base leading-relaxed mb-6"><?php echo esc_html( $fs['desc'] ); ?></p>
                    <ul class="font-mono-code text-xs space-y-2">
                        <?php foreach ( $fs['details'] as $d ) : ?>
                        <li class="flex items-start gap-2 text-slate-300">
                            <span class="text-[#00ffc4] font-bold mt-0.5">✓</span>
                            <span><?php echo esc_html( $d ); ?></span>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php
                endforeach;
            endif;
            ?>

        </div>
    </section>

    <!-- ================================================
         3. CTA SECTION
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#12141a] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            <div class="max-w-3xl mx-auto text-center space-y-6">

                <div class="font-mono-code text-xs text-[#6c3483] font-bold uppercase tracking-widest">
                    <?php
                    $cta_badge = get_field( 'process_cta_badge' );
                    echo esc_html( $cta_badge ?: '[PRÊT À DÉMARRER?]' );
                    ?>
                </div>

                <h2 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase">
                    <?php
                    $cta_t1 = get_field( 'process_cta_title1' );
                    $cta_t2 = get_field( 'process_cta_title2' );
                    echo esc_html( $cta_t1 ?: 'UN PROJET EN TÊTE?' ); ?><br/>
                    <span class="text-[#1abc9c]"><?php echo esc_html( $cta_t2 ?: 'PARLONS-EN.' ); ?></span>
                </h2>

                <p class="font-sans text-slate-300 text-lg leading-relaxed">
                    <?php
                    $cta_text = get_field( 'process_cta_text' );
                    echo esc_html( $cta_text ?: 'Chaque projet commence par une conversation. Décrivez votre besoin, je vous propose une approche concrète et adaptée.' );
                    ?>
                </p>

                <div class="flex flex-wrap justify-center gap-4 pt-4">
                    <?php
                    $btn1_text = get_field( 'process_cta_btn1' );
                    $btn2_text = get_field( 'process_cta_btn2' );
                    ?>
                    <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>"
                       class="px-8 py-3 bg-[#1abc9c] text-black font-mono-code text-xs font-bold uppercase hover:bg-[#00ffc4] border-2 border-[#1abc9c] transition-all">
                        <?php echo esc_html( $btn1_text ?: 'PRENDRE CONTACT' ); ?>
                    </a>
                    <a href="<?php echo esc_url( baobab_get_page_url( 'case-studies' ) ); ?>"
                       class="px-8 py-3 border-2 border-[#6c3483] text-white font-mono-code text-xs font-bold uppercase hover:bg-[#6c3483] transition-all">
                        <?php echo esc_html( $btn2_text ?: 'VOIR MES RÉALISATIONS' ); ?>
                    </a>
                </div>

            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
