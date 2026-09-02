<?php
/**
 * Single Case Study — Fiche complète (Soulful Brutalism BA)
 */
get_header();
?>

<main class="w-full bg-[#0b0c10] text-slate-100 py-12 md:py-20">
    <?php
    if ( have_posts() ) : while ( have_posts() ) : the_post();

        $img      = get_field( 'case_image' ) ?: get_the_post_thumbnail_url( get_the_ID(), 'large' );
        $meta     = get_field( 'case_meta' );
        $client   = get_field( 'case_client' );
        $prob     = get_field( 'case_problem' ) ?: get_the_excerpt();
        $sol      = get_field( 'case_solution' );
        $ctx      = get_field( 'case_context' );
        $imp      = get_field( 'case_impact' );
        $stack    = get_field( 'case_stack' );
        $results  = get_field( 'case_results' );
        $approach = get_field( 'case_approach' );
        $findings = get_field( 'case_findings' );
    ?>
    <article class="max-w-[1000px] mx-auto px-4 sm:px-6 space-y-10">

        <!-- Header -->
        <div class="border-b-2 border-[#262936] pb-8 space-y-4">
            <div class="flex items-center gap-3 font-mono-code text-xs text-[#1abc9c]">
                <span class="px-3 py-1 bg-[#1abc9c] text-black font-bold uppercase">[CASE_STUDY]</span>
                <span><?php echo esc_html( $meta ?: $client ); ?></span>
            </div>

            <h1 class="font-grotesk font-black text-3xl sm:text-6xl text-white uppercase tracking-tight leading-tight">
                <?php the_title(); ?>
            </h1>

            <?php if ( $prob ) : ?>
            <p class="font-sans text-slate-300 text-base leading-relaxed max-w-3xl">
                <strong class="text-[#00ffc4]"><?php baobab_e( 'Problème / Contexte :', 'Problem / Context:' ); ?></strong> <?php echo esc_html( wp_strip_all_tags( $prob ) ); ?>
            </p>
            <?php endif; ?>
        </div>

        <!-- Image -->
        <?php if ( $img ) : ?>
        <div class="border-2 border-[#1abc9c] bg-[#12141a] p-2">
            <?php $img_alt = get_field( 'case_image_alt' ) ?: get_the_title(); ?>
            <img src="<?php echo esc_url( $img ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" class="w-full h-auto max-h-[500px] object-cover" />
        </div>
        <?php endif; ?>

        <!-- Contexte détaillé -->
        <?php if ( $ctx ) : ?>
        <div class="bg-[#12141a] border-2 border-[#262936] p-8 space-y-3">
            <span class="font-mono-code text-xs text-[#1abc9c] font-bold uppercase">> <?php baobab_e( 'CONTEXTE DÉTAILLÉ', 'DETAILED CONTEXT' ); ?></span>
            <p class="font-sans text-slate-300 text-sm leading-relaxed"><?php echo esc_html( wp_strip_all_tags( $ctx ) ); ?></p>
        </div>
        <?php endif; ?>

        <!-- Démarche -->
        <?php if ( ! empty( $approach ) ) : ?>
        <div class="bg-[#12141a] border-2 border-[#262936] p-8 space-y-4">
            <span class="font-mono-code text-xs text-[#1abc9c] font-bold uppercase">> <?php baobab_e( 'MA DÉMARCHE', 'MY APPROACH' ); ?></span>
            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3 font-mono-code text-xs text-slate-300">
                <?php foreach ( $approach as $i => $step ) : ?>
                <li class="flex items-start gap-2 bg-[#0b0c10] border border-[#262936] p-4">
                    <span class="text-[#00ffc4] font-bold"><?php echo sprintf( '%02d', $i + 1 ); ?>.</span>
                    <?php echo esc_html( $step['approach_step'] ); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>

        <!-- Findings -->
        <?php if ( ! empty( $findings ) ) : ?>
        <div class="space-y-4">
            <span class="font-mono-code text-xs text-[#6c3483] font-bold uppercase block">> <?php baobab_e( 'POINTS CLÉS / VULNÉRABILITÉS', 'KEY POINTS / FINDINGS' ); ?></span>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ( $findings as $f ) : ?>
                <div class="bg-[#0b0c10] border border-[#262936] p-5 space-y-2">
                    <span class="font-mono-code text-xs text-[#1abc9c] font-bold block"><?php echo esc_html( $f['finding_label'] ); ?></span>
                    <p class="font-sans text-slate-300 text-sm"><?php echo esc_html( $f['finding_text'] ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Solution + Impact -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php if ( $sol ) : ?>
            <div class="bg-[#12141a] border-2 border-[#1abc9c] p-6 space-y-2">
                <span class="font-mono-code text-xs text-[#1abc9c] font-bold uppercase">> SOLUTION</span>
                <p class="font-sans text-slate-300 text-sm leading-relaxed"><?php echo esc_html( wp_strip_all_tags( $sol ) ); ?></p>
            </div>
            <?php endif; ?>
            <?php if ( $imp ) : ?>
            <div class="bg-[#12141a] border-2 border-[#6c3483] p-6 space-y-2">
                <span class="font-mono-code text-xs text-[#6c3483] font-bold uppercase">> IMPACT</span>
                <p class="font-sans text-slate-300 text-sm leading-relaxed"><?php echo esc_html( wp_strip_all_tags( $imp ) ); ?></p>
            </div>
            <?php endif; ?>
        </div>

        <!-- Content / body -->
        <?php $content = trim( get_the_content() ); ?>
        <?php if ( $content ) : ?>
        <div class="prose prose-invert max-w-none font-sans text-slate-200 text-base leading-relaxed border-t-2 border-[#262936] pt-8">
            <?php echo wp_kses_post( apply_filters( 'the_content', $content ) ); ?>
        </div>
        <?php endif; ?>

        <!-- Meta footer -->
        <div class="border-t-2 border-[#262936] pt-6 font-mono-code text-xs flex flex-wrap items-center justify-between gap-4">
            <span class="text-slate-400">
                <?php
                $chips = array();
                if ( $stack )   { $chips[] = 'STACK: ' . $stack; }
                if ( $results ) { $chips[] = baobab_t( 'RÉSULTAT:', 'RESULT:' ) . ' ' . $results; }
                echo esc_html( implode( ' // ', $chips ) );
                ?>
            </span>
            <a href="<?php echo esc_url( baobab_get_page_url( 'case-studies' ) ); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-[#6c3483] text-white font-bold uppercase hover:bg-[#1abc9c] hover:text-black transition-all">
                <?php baobab_e( '← RETOUR_À_L_INDEX_PORTFOLIO', '← BACK_TO_PORTFOLIO_INDEX' ); ?>
            </a>
        </div>

    </article>
    <?php
    endwhile; endif;
    ?>
</main>

<?php get_footer(); ?>