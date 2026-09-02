<?php
/**
 * Template for displaying single posts (Soulful Brutalism Insights)
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        $gallery   = get_field( 'insight_gallery' );
        $read_time = get_field( 'insight_read_time' ) ?: '5 MIN READ';
        $cats      = get_the_category();
        $cat_name  = ! empty( $cats ) ? $cats[0]->name : 'RESEARCH';
?>

<main class="w-full bg-[#0b0c10] text-slate-100 py-12 md:py-20">
    <article class="max-w-[1000px] mx-auto px-4 sm:px-6 space-y-10">

        <!-- Header -->
        <div class="border-b-2 border-[#262936] pb-8 space-y-4">
            
            <div class="flex items-center gap-3 font-mono-code text-xs text-[#1abc9c]">
                <span class="px-3 py-1 bg-[#1abc9c] text-black font-bold uppercase">[<?php echo esc_html( $cat_name ); ?>]</span>
                <span>// <?php echo esc_html( $read_time ); ?></span>
                <span>// <?php echo get_the_date( 'Y.m.d' ); ?></span>
            </div>

            <h1 class="font-grotesk font-black text-3xl sm:text-6xl text-white uppercase tracking-tight leading-tight">
                <?php the_title(); ?>
            </h1>

            <div class="flex items-center gap-3 font-mono-code text-xs text-slate-400 pt-2">
                <span class="text-[#6c3483] font-bold"><?php baobab_e( 'AUTEUR:', 'AUTHOR:' ); ?></span>
                <span class="text-white font-bold">NYA NJIKE ARMEL</span>
                <span>|</span>
                <span><?php baobab_e( 'BUSINESS ANALYST, INGÉNIEUR LOGICIEL & ARCHITECTE SYSTÈME', 'BUSINESS ANALYST, SOFTWARE ENGINEER & SYSTEM ARCHITECT' ); ?></span>
            </div>

        </div>

        <!-- Gallery / Image -->
        <?php if ( has_post_thumbnail() || ! empty( $gallery ) ) : ?>
        <div class="border-2 border-[#1abc9c] bg-[#12141a] p-2">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto max-h-[500px] object-cover' ) ); ?>
            <?php elseif ( ! empty( $gallery ) ) : ?>
                <img src="<?php echo esc_url( $gallery[0] ); ?>" class="w-full h-auto max-h-[500px] object-cover" />
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <!-- Content -->
        <div class="prose prose-invert max-w-none font-sans text-slate-200 text-base leading-relaxed space-y-6">
            <?php the_content(); ?>
        </div>

        <!-- Back Button -->
        <div class="border-t-2 border-[#262936] pt-8 font-mono-code text-xs">
            <a href="<?php echo esc_url( baobab_get_page_url( 'blog' ) ); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-[#6c3483] text-white font-bold uppercase hover:bg-[#1abc9c] hover:text-black transition-all">
                <?php baobab_e( '← RETOUR_À_L_INDEX_INSIGHTS', '← BACK_TO_INSIGHTS_INDEX' ); ?>
            </a>
        </div>

    </article>
</main>

<?php
    endwhile;
endif;

get_footer();
?>