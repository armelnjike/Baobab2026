<?php
/**
 * Template for displaying all single posts
 */

get_header();

if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        // Récupération des données ACF
        $gallery   = get_field( 'insight_gallery' );
        $read_time = get_field( 'insight_read_time' ) ?: '5 min read';
        $cats      = get_the_category();
        $cat_name  = ! empty( $cats ) ? $cats[0]->name : '';
?>

<main class="w-full max-w-4xl mx-auto px-6 lg:px-20 py-12">

    <!-- En-tête de l'article -->
    <div class="mb-12">

        <!-- Catégorie + Temps de lecture -->
        <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-primary mb-4">
            <span><?php echo esc_html( $cat_name ); ?></span>
            <span class="h-px w-8 bg-primary/30"></span>
            <span class="text-slate-500"><?php echo esc_html( $read_time ); ?></span>
            <span class="h-px w-8 bg-primary/30"></span>
            <span class="text-slate-500"><?php echo get_the_date( 'F j, Y' ); ?></span>
        </div>

        <!-- Titre -->
        <h1 class="text-4xl md:text-5xl font-black tracking-tight leading-tight mb-6">
            <?php the_title(); ?>
        </h1>

        <!-- Auteur -->
        <div class="flex items-center gap-3">
            <?php echo get_avatar( get_the_author_meta( 'ID' ), 40, '', '', array( 'class' => 'rounded-full' ) ); ?>
            <div>
                <p class="text-sm font-bold"><?php the_author(); ?></p>
                <p class="text-xs text-slate-500">Baobab Technology</p>
            </div>
        </div>

    </div>

    <!-- CAROUSEL D'IMAGES -->
    <?php if ( ! empty( $gallery ) ) : ?>
    <div class="mb-12 relative overflow-hidden rounded-2xl" id="carousel">

        <!-- Conteneur des slides -->
        <div class="flex transition-transform duration-500 ease-in-out" id="carousel-track">
            <?php foreach ( $gallery as $index => $img_url ) : ?>
            <div class="min-w-full aspect-video bg-cover bg-center rounded-2xl"
                 style="background-image: url('<?php echo esc_url( $img_url ); ?>')">
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Bouton précédent -->
        <button
            id="carousel-prev"
            class="absolute left-4 top-1/2 -translate-y-1/2 size-10 rounded-full bg-white/80 backdrop-blur flex items-center justify-center shadow hover:bg-white transition-colors"
            <?php if ( count( $gallery ) <= 1 ) echo 'style="display:none"'; ?>
        >
            <span class="material-symbols-outlined">chevron_left</span>
        </button>

        <!-- Bouton suivant -->
        <button
            id="carousel-next"
            class="absolute right-4 top-1/2 -translate-y-1/2 size-10 rounded-full bg-white/80 backdrop-blur flex items-center justify-center shadow hover:bg-white transition-colors"
            <?php if ( count( $gallery ) <= 1 ) echo 'style="display:none"'; ?>
        >
            <span class="material-symbols-outlined">chevron_right</span>
        </button>

        <!-- Indicateurs (points en bas) -->
        <?php if ( count( $gallery ) > 1 ) : ?>
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2" id="carousel-dots">
            <?php foreach ( $gallery as $index => $img ) : ?>
            <button
                class="carousel-dot size-2 rounded-full transition-colors <?php echo $index === 0 ? 'bg-white' : 'bg-white/40'; ?>"
                data-index="<?php echo $index; ?>">
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>
    <?php endif; ?>

    <!-- Contenu de l'article -->
    <style>
        .prose h1 { font-size: 2.25rem; font-weight: 800; margin-top: 2rem; margin-bottom: 1rem; color: #013220; }
        .prose h2 { font-size: 1.875rem; font-weight: 700; margin-top: 1.5rem; margin-bottom: 0.75rem; color: #013220; }
        .prose h3 { font-size: 1.5rem; font-weight: 700; margin-top: 1.25rem; margin-bottom: 0.5rem; color: #013220; }
        .prose p { margin-bottom: 1.25rem; line-height: 1.75; color: #334155; }
        .prose ul { list-style-type: disc; margin-left: 1.5rem; margin-bottom: 1.25rem; }
        .prose li { margin-bottom: 0.5rem; }
    </style>
    <div class="prose prose-lg max-w-none prose-slate dark:prose-invert prose-headings:text-primary prose-a:text-primary">
        <?php the_content(); ?>
    </div>

    <!-- Navigation entre articles -->
    <div class="mt-16 pt-8 border-t border-slate-200 flex justify-between gap-4">
        <?php
        $prev = get_previous_post();
        $next = get_next_post();
        ?>
        <?php if ( $prev ) : ?>
        <a href="<?php echo get_permalink( $prev ); ?>"
           class="flex items-center gap-2 text-sm font-bold text-primary hover:gap-4 transition-all">
            <span class="material-symbols-outlined">arrow_back</span>
            <?php echo esc_html( $prev->post_title ); ?>
        </a>
        <?php endif; ?>
        <?php if ( $next ) : ?>
        <a href="<?php echo get_permalink( $next ); ?>"
           class="flex items-center gap-2 text-sm font-bold text-primary hover:gap-4 transition-all ml-auto">
            <?php echo esc_html( $next->post_title ); ?>
            <span class="material-symbols-outlined">arrow_forward</span>
        </a>
        <?php endif; ?>
    </div>

</main>

<?php
    endwhile;
endif;
?>

<!-- Script carousel -->
<script>
document.addEventListener( 'DOMContentLoaded', function() {

    const track  = document.getElementById( 'carousel-track' );
    const dots   = document.querySelectorAll( '.carousel-dot' );
    const prev   = document.getElementById( 'carousel-prev' );
    const next   = document.getElementById( 'carousel-next' );

    if ( ! track ) return;

    let current = 0;
    const total = track.children.length;

    function goTo( index ) {
        current = index;
        track.style.transform = 'translateX(-' + ( current * 100 ) + '%)';
        dots.forEach( function( dot, i ) {
            dot.classList.toggle( 'bg-white', i === current );
            dot.classList.toggle( 'bg-white/40', i !== current );
        });
    }

    if ( next ) {
        next.addEventListener( 'click', function() {
            goTo( ( current + 1 ) % total );
        });
    }

    if ( prev ) {
        prev.addEventListener( 'click', function() {
            goTo( ( current - 1 + total ) % total );
        });
    }

    dots.forEach( function( dot ) {
        dot.addEventListener( 'click', function() {
            goTo( parseInt( this.getAttribute( 'data-index' ) ) );
        });
    });

});
</script>

<?php get_footer(); ?>