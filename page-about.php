<?php
/*
 Template Name: About Page
*/
get_header();
?>

<main class="flex flex-col flex-1">

    <!-- ================================================
         HERO SECTION
         ================================================ -->
    <section class="max-w-[1200px] mx-auto w-full px-6 py-12 md:py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="flex flex-col gap-6">

                <span class="text-primary font-bold tracking-widest text-sm uppercase">
                    <?php echo esc_html( get_field( 'about_label' ) ?: 'Our Story' ); ?>
                </span>

                <h1 class="text-4xl md:text-5xl font-black leading-tight tracking-tight text-slate-900 dark:text-slate-100">
                    <?php echo esc_html( get_field( 'about_title' ) ?: 'Rooted in Africa, Reaching the World' ); ?>
                </h1>

                <?php $text1 = get_field( 'about_text1' ); if ( $text1 ) : ?>
                <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                    <?php echo esc_html( $text1 ); ?>
                </p>
                <?php endif; ?>

                <?php $text2 = get_field( 'about_text2' ); if ( $text2 ) : ?>
                <p class="text-slate-600 dark:text-slate-400">
                    <?php echo esc_html( $text2 ); ?>
                </p>
                <?php endif; ?>

            </div>

            <!-- Image -->
            <div class="relative h-[400px] rounded-2xl overflow-hidden shadow-2xl">
                <div class="absolute inset-0 bg-primary/20 mix-blend-overlay z-10"></div>
                <?php $hero_img = get_field( 'about_hero_image' ); ?>
                <div class="w-full h-full bg-cover bg-center"
                     style="background-image: url('<?php echo esc_url( $hero_img ?: 'https://lh3.googleusercontent.com/aida-public/AB6AXuB_7fJviFAwhpbkNhMO7xWJ3SclNTxxRIQ5QKCtCOK-n6LbHDLiJfL_U2jBaauFD38ezMr2nTSv9e5CKOhMLQfeaU5xo8bO88v3HnrEbvlOoJ8KYA-g_myjo_i9FH-9KjFhLUvk2LmYisAei9PMIYmZv4LVupZUpAqcD4Q1TeIPV7zNVaQZ3y2gSt65QI20Y3AYv-hq6UQMd8f-hh0QbFc0MKUi1t0SHzrGi2eDZJkZgQPO7XJ5g7D_sh6C8odKpQ66cPmVbajSphg' ); ?>')">
                </div>
            </div>
        </div>
    </section>

    <!-- ================================================
         VISION & MISSION
         ================================================ -->
    <section class="bg-primary/5 py-16 bg-slate-50">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-8">

                <!-- Vision -->
                <div class="bg-white p-10 rounded-xl border border-slate-200 shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-primary mb-4">
                        <?php echo esc_html( get_field( 'vision_icon' ) ?: 'visibility' ); ?>
                    </span>
                    <h3 class="text-2xl font-bold mb-4">
                        <?php echo esc_html( get_field( 'vision_title' ) ?: 'Our Vision' ); ?>
                    </h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?php echo esc_html( get_field( 'vision_text' ) ?: '' ); ?>
                    </p>
                </div>

                <!-- Mission -->
                <div class="bg-white p-10 rounded-xl border border-slate-200 shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-primary mb-4">
                        <?php echo esc_html( get_field( 'mission_icon' ) ?: 'rocket_launch' ); ?>
                    </span>
                    <h3 class="text-2xl font-bold mb-4">
                        <?php echo esc_html( get_field( 'mission_title' ) ?: 'Our Mission' ); ?>
                    </h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        <?php echo esc_html( get_field( 'mission_text' ) ?: '' ); ?>
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ================================================
         VALEURS — BAOBAB STANDARDS
         ================================================ -->
    <section class="max-w-[1200px] mx-auto w-full px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">
                <?php echo esc_html( get_field( 'values_title' ) ?: 'The Baobab Standards' ); ?>
            </h2>
            <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">
                <?php echo esc_html( get_field( 'values_subtitle' ) ?: '' ); ?>
            </p>
        </div>

        <?php $values = get_field( 'values' ); ?>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
        <?php if ( $values ) :
            foreach ( $values as $value ) : ?>
            <div class="bg-white border border-slate-100 p-6 rounded-lg text-center flex flex-col items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="bg-primary/10 p-3 rounded-full">
                    <span class="material-symbols-outlined text-primary">
                        <?php echo esc_html( $value['value_icon'] ?: 'verified' ); ?>
                    </span>
                </div>
                <h4 class="font-bold">
                    <?php echo esc_html( $value['value_title'] ); ?>
                </h4>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    <?php echo esc_html( $value['value_desc'] ); ?>
                </p>
            </div>
        <?php endforeach;
        endif; ?>
        </div>
    </section>

    <!-- ================================================
         WHY BAOBAB
         ================================================ -->
    <section class="bg-primary text-white py-20">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">

                <!-- Texte + points -->
                <div class="flex flex-col gap-8">
                    <h2 class="text-3xl font-bold">
                        <?php echo esc_html( get_field( 'why_title' ) ?: 'Why Baobab?' ); ?>
                    </h2>
                    <p class="text-slate-300 leading-relaxed">
                        <?php echo esc_html( get_field( 'why_text' ) ?: '' ); ?>
                    </p>

                    <?php $why_points = get_field( 'why_points' ); ?>
                    <?php if ( $why_points ) : ?>
                    <div class="space-y-6">
                        <?php foreach ( $why_points as $point ) : ?>
                        <div class="flex gap-4">
                            <span class="material-symbols-outlined text-primary bg-slate-100 rounded-full p-2 h-fit">check</span>
                            <div>
                                <h5 class="font-bold text-xl">
                                    <?php echo esc_html( $point['point_title'] ); ?>
                                </h5>
                                <p class="text-white/70">
                                    <?php echo esc_html( $point['point_desc'] ); ?>
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Tableau comparatif -->
                <?php $rows = get_field( 'comparison_rows' ); ?>
                <?php if ( $rows ) : ?>
                <div class="rounded-2xl border border-white/10 overflow-hidden bg-slate-900/40">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-white/10">
                                <th class="py-4 px-5 font-semibold text-white text-sm uppercase tracking-wider">Feature</th>
                                <th class="py-4 px-5 font-bold text-white text-sm uppercase tracking-wider text-center">Baobab</th>
                                <th class="py-4 px-5 font-semibold text-slate-400 text-sm uppercase tracking-wider text-center">Competitors</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ( $rows as $row ) : ?>
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="py-4 px-5 text-slate-300">
                                    <?php echo esc_html( $row['row_feature'] ); ?>
                                </td>
                                <td class="py-4 px-5 text-center font-bold text-emerald-400">
                                    <?php echo esc_html( $row['row_baobab'] ); ?>
                                </td>
                                <td class="py-4 px-5 text-center text-slate-500">
                                    <?php echo esc_html( $row['row_competitors'] ); ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <!-- ================================================
         TIMELINE
         ================================================ -->
    <section class="max-w-[1200px] mx-auto w-full px-6 py-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold">
                <?php echo esc_html( get_field( 'timeline_title' ) ?: 'Our Journey & Roadmap' ); ?>
            </h2>
        </div>

        <?php $timeline_items = get_field( 'timeline_items' ); ?>
        <?php if ( $timeline_items ) : ?>
        <div class="relative">

            <!-- Ligne verticale centrale -->
            <div class="hidden md:block absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-0.5 bg-slate-800/30"></div>

            <div class="space-y-16">
            <?php foreach ( $timeline_items as $index => $item ) :

                // Les étapes paires (0, 2, 4...) sont à gauche
                // Les étapes impaires (1, 3, 5...) sont à droite
                $is_right = ( $index % 2 !== 0 );

                // Étape future = opacité réduite + bordure pointillée
                $is_future = ! empty( $item['timeline_future'] );
            ?>

                <div class="relative flex flex-col <?php echo $is_right ? 'md:flex-row-reverse' : 'md:flex-row'; ?> items-center justify-between">

                    <!-- Texte -->
                    <div class="md:w-5/12 <?php echo $is_right ? 'text-center md:text-left' : 'text-center md:text-right'; ?> <?php echo $is_future ? 'opacity-70' : ''; ?>">
                        <h4 class="text-xl font-bold text-slate-900">
                            <?php echo esc_html( $item['timeline_item_title'] ); ?>
                        </h4>
                        <p class="text-slate-600 dark:text-slate-400 mt-2">
                            <?php echo esc_html( $item['timeline_item_desc'] ); ?>
                        </p>
                    </div>

                    <!-- Icône centrale -->
                    <div class="z-10 <?php echo $is_future ? 'border-2 border-dashed border-primary' : ''; ?> bg-slate-900 w-10 h-10 rounded-full flex items-center justify-center my-4 md:my-0">
                        <span class="material-symbols-outlined text-white text-md">
                            <?php echo esc_html( $item['timeline_icon'] ?: 'home' ); ?>
                        </span>
                    </div>

                    <div class="md:w-5/12"></div>

                </div>

            <?php endforeach; ?>
            </div>

        </div>
        <?php endif; ?>

    </section>

</main>

<?php get_footer(); ?>