<?php
/*
 Template Name: Team Page
*/
get_header();
?>

<main class="flex flex-col items-center py-12 px-6 lg:px-40">
<div class="max-w-5xl w-full">

    <!-- ================================================
         HERO
         ================================================ -->
    <section class="mb-16">
        <span class="text-primary font-bold tracking-widest uppercase text-xs">
            <?php echo esc_html( get_field( 'team_label' ) ?: 'Our Leadership' ); ?>
        </span>
        <h2 class="text-slate-900 text-5xl font-extrabold leading-tight tracking-tight mt-2 mb-4">
            <?php echo esc_html( get_field( 'team_title' ) ?: 'Executive Vision' ); ?>
        </h2>
        <p class="text-slate-500 text-lg max-w-2xl font-normal leading-relaxed">
            <?php echo esc_html( get_field( 'team_subtitle' ) ?: '' ); ?>
        </p>
    </section>

    <!-- ================================================
         MEMBRES — tiré du CPT team_member
         ================================================ -->
    <?php
    $members = new WP_Query( array(
        'post_type'      => 'team_member',
        'posts_per_page' => -1,
        'orderby'        => 'meta_value_num',
        'meta_key'       => 'member_order',
        'order'          => 'ASC',
    ) );
    ?>

    <div class="flex flex-col gap-12">

    <?php if ( $members->have_posts() ) :
        while ( $members->have_posts() ) : $members->the_post();

            $photo        = get_field( 'member_photo' );
            $role         = get_field( 'member_role' );
            $quote        = get_field( 'member_quote' );
            $link         = get_field( 'member_link' );
            $link_icon    = get_field( 'member_link_icon' ) ?: 'link';
            $expertise    = get_field( 'member_expertise' );
            $achievements = get_field( 'member_achievements' );
            $bio          = get_field( 'member_bio' );

            // Alternance gauche/droite
            static $member_index = 0;
            $is_reverse = ( $member_index % 2 !== 0 );
            $member_index++;
    ?>

        <div class="p-8 rounded-xl flex flex-col <?php echo $is_reverse ? 'lg:flex-row-reverse' : 'lg:flex-row'; ?> gap-10 items-start">

            <!-- Photo -->
            <div class="w-full lg:w-1/3 aspect-[4/5] rounded-lg overflow-hidden bg-slate-200 dark:bg-slate-800 relative group">
                <?php if ( $photo ) : ?>
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                     style="background-image: url('<?php echo esc_url( $photo ); ?>');">
                </div>
                <?php else : ?>
                <div class="absolute inset-0 bg-primary/10 flex items-center justify-center">
                    <span class="material-symbols-outlined text-6xl text-primary/30">person</span>
                </div>
                <?php endif; ?>

                <?php if ( $link ) : ?>
                <div class="absolute bottom-4 right-4 flex gap-2">
                    <a href="<?php echo esc_url( $link ); ?>" target="_blank"
                       class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center text-white hover:bg-primary transition-colors">
                        <span class="material-symbols-outlined text-sm"><?php echo esc_html( $link_icon ); ?></span>
                    </a>
                </div>
                <?php endif; ?>
            </div>

            <!-- Contenu -->
            <div class="flex-1 space-y-6">

                <!-- Nom + Poste -->
                <div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-3xl font-bold text-slate-900">
                                <?php the_title(); ?>
                            </h3>
                            <p class="text-primary dark:text-slate-600 font-semibold text-lg">
                                <?php echo esc_html( $role ?: '' ); ?>
                            </p>
                        </div>
                    </div>

                    <?php if ( $quote ) : ?>
                    <p class="mt-4 text-slate-600 dark:text-slate-400 leading-relaxed italic">
                        "<?php echo esc_html( $quote ); ?>"
                    </p>
                    <?php endif; ?>
                </div>

                <!-- Badges expertise -->
                <?php if ( $expertise ) : ?>
                <div class="flex flex-wrap gap-2">
                    <?php foreach ( $expertise as $exp ) : ?>
                    <span class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-500 uppercase">
                        <?php echo esc_html( $exp['expertise_item'] ); ?>
                    </span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Réalisations -->
                <?php if ( $achievements ) : ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ( $achievements as $achievement ) : ?>
                    <div class="p-4 rounded-lg bg-background-light dark:bg-primary/20 border border-primary/10">
                        <p class="text-xs text-primary font-bold uppercase mb-1">
                            <?php echo esc_html( $achievement['achievement_label'] ); ?>
                        </p>
                        <p class="text-sm font-medium">
                            <?php echo esc_html( $achievement['achievement_text'] ); ?>
                        </p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Bio dépliable -->
                <?php if ( $bio ) : ?>
                <details class="group">
                    <summary class="flex items-center gap-2 cursor-pointer text-primary dark:text-slate-500 font-bold text-sm uppercase tracking-wider list-none select-none">
                        <span class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                        View Full Portfolio
                    </summary>
                    <div class="mt-4 p-6 rounded-lg bg-white/5 border border-primary/5 text-sm leading-relaxed text-slate-600 dark:text-slate-400">
                        <?php echo esc_html( $bio ); ?>
                    </div>
                </details>
                <?php endif; ?>

            </div>
        </div>

    <?php endwhile;
    wp_reset_postdata();

    // Fallback si pas encore de membres dans le CPT
    else : ?>
        <p class="text-slate-400 text-center py-12">Aucun membre trouvé. Ajoutez des membres via <strong>Équipe → Ajouter</strong> dans l'admin.</p>
    <?php endif; ?>

    </div>

    <!-- ================================================
         OPEN POSITIONS
         ================================================ -->
    <?php $positions = get_field( 'open_positions' ); ?>
    <?php if ( $positions ) : ?>

    <section class="mt-24 mb-16">

        <div class="text-center mb-12">
            <span class="text-primary font-bold tracking-widest uppercase text-xs">Careers</span>
            <h2 class="text-3xl font-bold mt-2 mb-3">
                <?php echo esc_html( get_field( 'jobs_title' ) ?: 'Join the Baobab Team' ); ?>
            </h2>
            <p class="text-slate-500 max-w-xl mx-auto">
                <?php echo esc_html( get_field( 'jobs_text' ) ?: '' ); ?>
            </p>
        </div>

        <div class="flex flex-col gap-6">
        <?php foreach ( $positions as $job ) : ?>

            <div class="group relative bg-white dark:bg-white/5 rounded-2xl border border-slate-200 dark:border-white/10 hover:border-primary/50 hover:shadow-xl transition-all duration-300 overflow-hidden">

                <!-- Barre accent gauche -->
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                <div class="p-8">

                    <!-- En-tête : titre + badges + bouton -->
                    <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4 mb-5">
                        <div class="flex flex-col gap-2">
                            <h4 class="text-xl font-bold text-slate-900 dark:text-white group-hover:text-primary transition-colors">
                                <?php echo esc_html( $job['job_title'] ); ?>
                            </h4>
                            <div class="flex flex-wrap items-center gap-3">
                                <?php if ( $job['job_location'] ) : ?>
                                <span class="flex items-center gap-1 text-xs text-slate-500 dark:text-slate-400">
                                    <span class="material-symbols-outlined" style="font-size:14px">location_on</span>
                                    <?php echo esc_html( $job['job_location'] ); ?>
                                </span>
                                <?php endif; ?>
                                <?php if ( $job['job_type'] ) : ?>
                                <span class="px-3 py-1 rounded-full bg-primary/10 border border-primary/20 text-xs font-semibold text-primary uppercase tracking-wide">
                                    <?php echo esc_html( $job['job_type'] ); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <?php if ( $job['job_link'] ) : ?>
                        <a href="<?php echo esc_url( $job['job_link'] ); ?>" target="_blank"
                           class="shrink-0 flex items-center gap-2 px-6 py-2.5 rounded-xl bg-primary text-white text-sm font-semibold hover:bg-primary/85 transition-colors self-start">
                            Apply Now
                            <span class="material-symbols-outlined" style="font-size:16px">arrow_forward</span>
                        </a>
                        <?php endif; ?>
                    </div>

                    <!-- Description WYSIWYG -->
                    <?php if ( $job['job_desc'] ) : ?>
                    <div class="prose prose-sm max-w-none text-slate-600 dark:text-slate-400 prose-li:marker:text-primary prose-a:text-primary border-t border-slate-100 dark:border-white/10 pt-5">
                        <?php echo wp_kses_post( $job['job_desc'] ); ?>
                    </div>
                    <?php endif; ?>

                </div>
            </div>

        <?php endforeach; ?>
        </div>

    </section>

    <?php endif; ?>

</div>
</main>

<?php get_footer(); ?>