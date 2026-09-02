<?php
/*
 Template Name: About Page (Soulful Brutalism BA)
*/
get_header();
$theme_uri = get_stylesheet_directory_uri();
?>

<main class="flex-1 w-full bg-[#0b0c10] text-slate-100 overflow-x-hidden">

    <!-- ================================================
         1. HERO SECTION : ABOUT ME
         ================================================ -->
    <section class="w-full py-12 md:py-20 border-b-2 border-[#262936] bg-[#0b0c10]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                <!-- Left Column: Portrait Frame -->
                <div class="lg:col-span-5">
                    <div class="bg-[#12141a] border-4 border-white p-3 shadow-2xl relative">
                        <div class="bg-[#0b0c10] border border-[#262936] p-2 mb-3 font-mono-code text-[11px] text-[#1abc9c] flex justify-between">
                            <span><?php baobab_e( '// PORTRAIT_OFFICIEL', '// OFFICIAL_PORTRAIT' ); ?></span>
                            <span>CBAP® CERTIFIED</span>
                        </div>
                        <div class="aspect-[4/5] overflow-hidden border border-[#262936]">
                            <?php
                            $portrait = get_field( 'about_hero_image' );
                            if ( empty( $portrait ) ) {
                                $portrait = $theme_uri . '/images/armel_portrait.jpg';
                            }
                            ?>
                            <img src="<?php echo esc_url( $portrait ); ?>" 
                                 alt="NYA NJIKE ARMEL Portrait" 
                                 class="w-full h-full object-cover grayscale contrast-125 hover:grayscale-0 transition-all duration-500" />
                        </div>
                    </div>
                </div>

                <!-- Right Column: Content -->
                <div class="lg:col-span-7 space-y-6">
                    
                    <div class="font-mono-code text-xs text-[#1abc9c] font-bold tracking-widest uppercase">
                        <?php baobab_e( '/À_PROPOS', '/ABOUT_ME' ); ?>
                    </div>

                    <h1 class="font-grotesk font-black text-3xl sm:text-5xl lg:text-6xl text-white uppercase tracking-tight leading-tight">
                        <?php baobab_e( 'L\'ANALYSTE QUI COMPREND LE', 'THE ANALYST WHO UNDERSTANDS THE' ); ?>
                        <span class="text-[#6c3483]">CLIENT</span>,
                        <?php baobab_e( 'LE', 'THE' ); ?>
                        <span class="text-[#1abc9c]">CODE</span>
                        <?php baobab_e( 'ET', 'AND' ); ?>
                        <span class="bg-[#1abc9c] text-black px-3 py-0.5 inline-block"><?php baobab_e( 'L\'ARCHITECTURE.', 'THE ARCHITECTURE.' ); ?></span>
                    </h1>

                    <div class="font-grotesk font-bold text-xl text-[#00ffc4] uppercase tracking-wide border-l-4 border-[#6c3483] pl-4 py-1">
                        <?php baobab_e(
                            'NYA NJIKE ARMEL — BUSINESS ANALYST, INGÉNIEUR LOGICIEL & ARCHITECTE SYSTÈME',
                            'NYA NJIKE ARMEL — BUSINESS ANALYST, SOFTWARE ENGINEER & SYSTEM ARCHITECT'
                        ); ?>
                    </div>

                    <div class="font-sans text-slate-300 text-base leading-relaxed space-y-4">
                        <p>
                            <?php baobab_e(
                                'Je m\'appelle Armel Nya Njike. Je suis Business Analyst et Ingénieur Logiciel basé à Yaoundé, Cameroun.',
                                'My name is Armel Nya Njike. I am a Business Analyst and Software Engineer based in Yaoundé, Cameroon.'
                            ); ?>
                        </p>
                        <p>
                            <?php baobab_e(
                                'Mon parcours est atypique : j\'ai commencé par co-fonder une startup tech à 22 ans, vendu des solutions IT terrain, travaillé deux ans à l\'intérieur de l\'écosystème MoMo de MTN Cameroun, avant de devenir Lead Project Manager sur un projet de digitalisation d\'une société de gestion d\'assets financiers.',
                                'My path is unconventional: I co-founded a tech startup at 22, sold IT solutions in the field, spent two years inside MTN Cameroon\'s MoMo ecosystem, before becoming Lead Project Manager on the digitalization of a financial asset management company.'
                            ); ?>
                        </p>
                        <p class="italic text-white border-l-2 border-[#1abc9c] pl-4 py-1 bg-[#12141a]">
                            <?php baobab_e(
                                'Ce que ça m\'a appris : les projets échouent rarement à cause de la technologie. Ils échouent parce que personne n\'a vraiment compris ce que le client voulait — ou parce que personne n\'a su le traduire correctement pour l\'équipe technique. C\'est exactement ce que je fais. Je suis le pont entre le métier et la tech.',
                                'What that taught me: projects rarely fail because of technology. They fail because nobody truly understood what the client wanted — or because nobody could translate it properly for the technical team. That is exactly what I do. I am the bridge between business and tech.'
                            ); ?>
                        </p>
                    </div>

                    <div class="flex flex-wrap gap-4 pt-4 font-mono-code text-xs">
                        <a href="<?php echo esc_url( baobab_get_page_url( 'case-studies' ) ); ?>" class="px-6 py-3.5 bg-[#6c3483] text-white font-bold uppercase tracking-wider hover:bg-[#1abc9c] hover:text-black transition-all">
                            <?php baobab_e( 'VOIR MON PORTFOLIO', 'VIEW MY PORTFOLIO' ); ?>
                        </a>
                        <a href="<?php echo esc_url( baobab_get_page_url( 'contact' ) ); ?>" class="px-6 py-3.5 border-2 border-white text-white font-bold uppercase tracking-wider hover:bg-white hover:text-black transition-all">
                            <?php baobab_e( 'PRENDRE CONTACT', 'GET IN TOUCH' ); ?>
                        </a>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <!-- ================================================
         2. CE QUI ME DIFFÉRENCIE
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#12141a] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            
            <div class="border-b-2 border-[#262936] pb-4 mb-12">
                <h2 class="font-grotesk font-black text-3xl sm:text-4xl text-white uppercase">
                    <?php baobab_e( 'CE QUI ME', 'WHAT SETS ME' ); ?>
                    <span class="text-[#1abc9c]"><?php baobab_e( 'DIFFÉRENCIE', 'APART' ); ?></span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Differentiator 1 -->
                <div class="bg-[#0b0c10] border-2 border-[#1abc9c] p-6 space-y-3">
                    <div class="font-mono-code text-xs text-[#1abc9c] font-bold">[CERTIFICATION_EXCELLENCE]</div>
                    <h3 class="font-grotesk font-black text-2xl text-white uppercase"><?php baobab_e( 'CBAP® CERTIFIÉ', 'CBAP® CERTIFIED' ); ?></h3>
                    <p class="font-sans text-sm text-slate-300 leading-relaxed">
                        <?php baobab_e(
                            'Une des rares certifications BA reconnues internationalement (IIBA®), obtenue en 2025. Garantie de méthodologie et de rigueur théorique appliquée.',
                            'One of the few internationally recognized BA certifications (IIBA®), earned in 2025. A guarantee of methodology and applied theoretical rigor.'
                        ); ?>
                    </p>
                </div>

                <!-- Differentiator 2 -->
                <div class="bg-[#0b0c10] border-2 border-[#6c3483] p-6 space-y-3">
                    <div class="font-mono-code text-xs text-[#b366ff] font-bold"><?php baobab_e( '[EXPÉRIENCE_TERRAIN]', '[FIELD_EXPERIENCE]' ); ?></div>
                    <h3 class="font-grotesk font-black text-2xl text-white uppercase">INSIDER MOMO</h3>
                    <p class="font-sans text-sm text-slate-300 leading-relaxed">
                        <?php baobab_e(
                            'Deux ans chez MTN Cameroun m\'ont donné une connaissance opérationnelle des systèmes de mobile money qu\'aucun consultant externe ne peut avoir.',
                            'Two years at MTN Cameroon gave me operational knowledge of mobile money systems that no external consultant can have.'
                        ); ?>
                    </p>
                </div>

                <!-- Differentiator 3 -->
                <div class="bg-[#0b0c10] border-2 border-[#6c3483] p-6 space-y-3">
                    <div class="font-mono-code text-xs text-[#b366ff] font-bold"><?php baobab_e( '[POSITIONNEMENT_HYBRIDE]', '[HYBRID_PROFILE]' ); ?></div>
                    <h3 class="font-grotesk font-black text-2xl text-white uppercase"><?php baobab_e( 'PROFIL HYBRIDE', 'HYBRID PROFILE' ); ?></h3>
                    <p class="font-sans text-sm text-slate-300 leading-relaxed">
                        <?php baobab_e(
                            'Je lis du code et je parle aux directeurs financiers. Je comprends une spec technique et je sais rédiger un cahier des charges pour un non-technicien.',
                            'I read code and I talk to CFOs. I understand a technical spec and I can write a specification document for a non-technical audience.'
                        ); ?>
                    </p>
                </div>

                <!-- Differentiator 4 -->
                <div class="bg-[#0b0c10] border-2 border-[#1abc9c] p-6 space-y-3">
                    <div class="font-mono-code text-xs text-[#1abc9c] font-bold"><?php baobab_e( '[COMPÉTENCE_LINGUISTIQUE]', '[LANGUAGE_SKILL]' ); ?></div>
                    <h3 class="font-grotesk font-black text-2xl text-white uppercase"><?php baobab_e( 'BILINGUE FR/EN C2', 'BILINGUAL FR/EN C2' ); ?></h3>
                    <p class="font-sans text-sm text-slate-300 leading-relaxed">
                        <?php baobab_e(
                            'Je travaille aussi naturellement en français qu\'en anglais, avec des clients camerounais comme avec des équipes internationales.',
                            'I work as naturally in French as in English, with Cameroonian clients as well as international teams.'
                        ); ?>
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ================================================
         3. MON PARCOURS PROFESSIONNEL (ACF timeline)
         ================================================ -->
    <?php
    $tl_items = get_field( 'timeline_items' );
    if ( ! empty( $tl_items ) && is_array( $tl_items ) ) :
        $tl_title = get_field( 'timeline_title' ) ?: baobab_t( 'MON PARCOURS.', 'MY JOURNEY.' );
    ?>
    <section class="w-full py-16 md:py-24 bg-[#0b0c10] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            <div class="flex flex-wrap items-end justify-between gap-4 border-b-4 border-[#1abc9c] pb-4 mb-12">
                <div>
                    <div class="font-mono-code text-xs text-[#1abc9c] font-bold tracking-widest uppercase mb-2"><?php baobab_e( '[MON_PARCOURS_PROFESSIONNEL]', '[MY_PROFESSIONAL_JOURNEY]' ); ?></div>
                    <h2 class="font-grotesk font-black text-3xl sm:text-5xl text-white uppercase tracking-tighter"><?php echo esc_html( $tl_title ); ?></h2>
                </div>
                <span class="font-mono-code text-xs font-bold text-[#1abc9c] tracking-widest bg-[#12141a] px-4 py-2 border border-[#262936]">[TIMELINE]</span>
            </div>

            <div class="relative">
                <div class="absolute left-[27px] sm:left-[31px] top-2 bottom-2 w-0.5 bg-[#262936]"></div>
                <?php foreach ( $tl_items as $ti ) :
                    $ic      = ! empty( $ti['timeline_icon'] )       ? $ti['timeline_icon']       : 'star';
                    $it      = ! empty( $ti['timeline_item_title'] ) ? $ti['timeline_item_title'] : '';
                    $id      = ! empty( $ti['timeline_item_desc'] )  ? $ti['timeline_item_desc']  : '';
                    $future  = ! empty( $ti['timeline_future'] );
                    if ( ! $it ) { continue; }
                ?>
                <div class="relative pl-16 sm:pl-20 pb-10 last:pb-0">
                    <div class="absolute left-0 top-0 w-[54px] sm:w-[62px] h-[54px] sm:h-[62px] <?php echo $future ? 'border-2 border-dashed border-[#b366ff] text-[#b366ff]' : 'bg-[#1abc9c] text-black'; ?> flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl"><?php echo esc_html( $ic ); ?></span>
                    </div>
                    <div class="bg-[#12141a] border-2 <?php echo $future ? 'border-dashed border-[#6c3483]' : 'border-[#262936] hover:border-[#1abc9c]'; ?> p-5 space-y-2">
                        <div class="flex flex-wrap items-center justify-between gap-2">
                            <h3 class="font-grotesk font-black text-xl sm:text-2xl text-white uppercase"><?php echo esc_html( $it ); ?></h3>
                            <?php if ( $future ) : ?>
                            <span class="px-2 py-0.5 bg-[#6c3483] text-white font-mono-code text-[11px] font-bold uppercase"><?php baobab_e( '[À_VENIR]', '[UPCOMING]' ); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ( $id ) : ?>
                        <p class="font-sans text-sm text-slate-300 leading-relaxed"><?php echo esc_html( $id ); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ================================================
         4. MES VALEURS
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            
            <div class="text-center max-w-3xl mx-auto mb-16 space-y-2">
                <h2 class="font-grotesk font-black text-4xl sm:text-5xl text-white uppercase">
                    <?php baobab_e( 'MES', 'MY' ); ?> <span class="italic text-[#1abc9c]"><?php baobab_e( 'VALEURS', 'VALUES' ); ?></span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-[#12141a] border-2 border-[#262936] p-8 space-y-4 hover:border-[#1abc9c] transition-all">
                    <div class="font-mono-code text-2xl font-bold text-[#1abc9c]">01. <?php baobab_e( 'HONNÊTETÉ', 'HONESTY' ); ?></div>
                    <p class="font-sans text-slate-300 text-sm leading-relaxed">
                        <?php baobab_e(
                            'Je dis quand quelque chose ne marchera pas, avant que ça coûte cher.',
                            'I say when something will not work, before it gets expensive.'
                        ); ?>
                    </p>
                </div>

                <div class="bg-[#12141a] border-2 border-[#262936] p-8 space-y-4 hover:border-[#6c3483] transition-all">
                    <div class="font-mono-code text-2xl font-bold text-[#b366ff]">02. <?php baobab_e( 'RIGUEUR', 'RIGOR' ); ?></div>
                    <p class="font-sans text-slate-300 text-sm leading-relaxed">
                        <?php baobab_e(
                            'Une exigence mal définie au départ, c\'est un bug garanti à la fin.',
                            'A poorly defined requirement at the start means a guaranteed bug at the end.'
                        ); ?>
                    </p>
                </div>

                <div class="bg-[#12141a] border-2 border-[#262936] p-8 space-y-4 hover:border-[#1abc9c] transition-all">
                    <div class="font-mono-code text-2xl font-bold text-[#1abc9c]">03. IMPACT</div>
                    <p class="font-sans text-slate-300 text-sm leading-relaxed">
                        <?php baobab_e(
                            'Ce qui compte, c\'est ce que l\'utilisateur final peut faire de mieux après que j\'ai travaillé sur un projet.',
                            'What matters is what the end user can do better after I have worked on a project.'
                        ); ?>
                    </p>
                </div>

            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>