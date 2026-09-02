<?php
/*
 Template Name: Contact Page (Soulful Brutalism BA Terminal)
*/
get_header();
?>

<main class="flex-1 w-full bg-[#0b0c10] text-slate-100 overflow-x-hidden">

    <!-- ================================================
         1. HERO SECTION : CONTACT
         ================================================ -->
    <section class="w-full py-16 md:py-24 border-b-2 border-[#262936] bg-[#0b0c10] nsibidi-bg">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            
            <div class="max-w-3xl space-y-4">
                <div class="font-mono-code text-xs text-[#1abc9c] font-bold tracking-widest uppercase">
                    <?php baobab_e( '[PRISE_DE_CONTACT // DISPONIBILITÉ_PROJET]', '[GET_IN_TOUCH // PROJECT_AVAILABILITY]' ); ?>
                </div>

                <h1 class="font-grotesk font-black text-4xl sm:text-7xl text-white uppercase tracking-tight leading-none">
                    <?php baobab_e( 'TRAVAILLONS', "LET'S WORK" ); ?><br/>
                    <span class="text-[#6c3483]"><?php baobab_e( 'ENSEMBLE.', 'TOGETHER.' ); ?></span>
                </h1>

                <p class="font-sans text-slate-300 text-lg leading-relaxed pt-4">
                    <?php baobab_e(
                        'Vous avez un projet à analyser, un produit à spécifier, ou une équipe à coordonner ? Je suis disponible pour des missions en présentiel à Yaoundé/Douala ou en remote.',
                        'Have a project to analyze, a product to specify, or a team to coordinate? I am available for on-site missions in Yaoundé/Douala or remote.'
                    ); ?>
                </p>
            </div>

        </div>
    </section>

    <!-- ================================================
         2. SERVICES CHECKLIST & CONTACT TERMINAL
         ================================================ -->
    <section class="w-full py-16 md:py-24 bg-[#0b0c10] border-b-2 border-[#262936]">
        <div class="max-w-[1300px] mx-auto px-4 sm:px-6">
            
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Terminal Contact Form -->
                <div class="lg:col-span-7 bg-[#12141a] border-2 border-[#1abc9c] p-6 sm:p-10 space-y-6">
                    
                    <div class="flex items-center justify-between border-b border-[#262936] pb-4 font-mono-code text-xs">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 bg-[#6c3483] inline-block"></span>
                            <span class="w-3 h-3 bg-[#1abc9c] inline-block"></span>
                            <span class="w-3 h-3 bg-white inline-block"></span>
                            <span class="text-slate-300 font-bold ml-2">BA_COMMUNICATION_TERMINAL</span>
                        </div>
                        <span class="text-[#00ffc4]">STATUS: READY</span>
                    </div>

                    <form action="" method="POST" class="space-y-6 font-mono-code text-xs sm:text-sm">

                        <?php if ( isset( $_GET['contact'] ) && 'success' === $_GET['contact'] ) : ?>
                        <div class="bg-[#0b0c10] border-2 border-[#1abc9c] text-[#00ffc4] font-mono-code text-xs font-bold px-6 py-4">
                            ✓ <?php baobab_e( 'MESSAGE ENVOYÉ. MERCI, JE REVIENDRAI VERS VOUS RAPIDEMENT !', 'MESSAGE SENT. THANK YOU, I WILL GET BACK TO YOU SOON!' ); ?>
                        </div>
                        <?php elseif ( isset( $_GET['contact'] ) && 'error' === $_GET['contact'] ) : ?>
                        <div class="bg-[#0b0c10] border-2 border-[#6c3483] text-slate-200 font-mono-code text-xs font-bold px-6 py-4">
                            ✗ <?php baobab_e( "ERREUR LORS DE L'ENVOI. RÉESSAYEZ.", 'SEND ERROR. PLEASE TRY AGAIN.' ); ?>
                        </div>
                        <?php endif; ?>

                        <div class="space-y-2">
                            <label for="contact_name" class="block text-[#1abc9c] font-bold uppercase flex items-center gap-1">
                                <span>></span> <?php baobab_e( 'SAISIR_VOTRE_NOM :', 'ENTER_YOUR_NAME:' ); ?>
                            </label>
                            <input type="text" id="contact_name" name="contact_name" placeholder="<?php echo esc_attr( baobab_t( 'Entrez votre nom et prénom...', 'Enter your full name...' ) ); ?>" required
                                   class="w-full bg-[#0b0c10] border-2 border-[#262936] p-3 text-white focus:border-[#1abc9c] focus:outline-none transition-colors" />
                        </div>

                        <div class="space-y-2">
                            <label for="contact_email_input" class="block text-[#1abc9c] font-bold uppercase flex items-center gap-1">
                                <span>></span> <?php baobab_e( 'SAISIR_VOTRE_EMAIL :', 'ENTER_YOUR_EMAIL:' ); ?>
                            </label>
                            <input type="email" id="contact_email_input" name="contact_email_input" placeholder="<?php echo esc_attr( baobab_t( 'votre.email@entreprise.com...', 'your.email@company.com...' ) ); ?>" required
                                   class="w-full bg-[#0b0c10] border-2 border-[#262936] p-3 text-white focus:border-[#1abc9c] focus:outline-none transition-colors" />
                        </div>

                        <div class="space-y-2">
                            <label for="contact_company" class="block text-[#1abc9c] font-bold uppercase flex items-center gap-1">
                                <span>></span> <?php baobab_e( 'NOM_DE_L_ENTREPRISE :', 'COMPANY_NAME:' ); ?>
                            </label>
                            <input type="text" id="contact_company" name="contact_company" placeholder="<?php echo esc_attr( baobab_t( 'Votre entreprise (optionnel)...', 'Your company (optional)...' ) ); ?>"
                                   class="w-full bg-[#0b0c10] border-2 border-[#262936] p-3 text-white focus:border-[#1abc9c] focus:outline-none transition-colors" />
                        </div>

                        <div class="space-y-2">
                            <label for="contact_mission" class="block text-[#1abc9c] font-bold uppercase flex items-center gap-1">
                                <span>></span> <?php baobab_e( 'SÉLECTIONNER_LE_TYPE_DE_MISSION :', 'SELECT_MISSION_TYPE:' ); ?>
                            </label>
                            <select id="contact_mission" name="contact_mission" class="w-full bg-[#0b0c10] border-2 border-[#262936] p-3 text-white focus:border-[#1abc9c] focus:outline-none transition-colors">
                                <option value="<?php echo esc_attr( baobab_t( 'Analyse des besoins & Cahier des charges', 'Requirements Analysis & Specifications' ) ); ?>"><?php baobab_e( 'ANALYSE_DES_BESOINS_&_CAHIER_DES_CHARGES', 'REQUIREMENTS_ANALYSIS_&_SPECIFICATIONS' ); ?></option>
                                <option value="<?php echo esc_attr( baobab_t( 'Coordination de projet digital', 'Digital Project Coordination' ) ); ?>"><?php baobab_e( 'COORDINATION_DE_PROJET_DIGITAL', 'DIGITAL_PROJECT_COORDINATION' ); ?></option>
                                <option value="<?php echo esc_attr( baobab_t( 'Développement de solution sur mesure', 'Custom Solution Development' ) ); ?>"><?php baobab_e( 'DÉVELOPPEMENT_DE_SOLUTION_SUR_MESURE', 'CUSTOM_SOLUTION_DEVELOPMENT' ); ?></option>
                                <option value="<?php echo esc_attr( baobab_t( 'Tableaux de bord & Business Intelligence', 'Dashboards & Business Intelligence' ) ); ?>"><?php baobab_e( 'TABLEAUX_DE_BORD_&_BUSINESS_INTELLIGENCE', 'DASHBOARDS_&_BUSINESS_INTELLIGENCE' ); ?></option>
                                <option value="<?php echo esc_attr( baobab_t( 'Formation & Accompagnement d\'équipe', 'Team Training & Support' ) ); ?>"><?php baobab_e( 'FORMATION_&_ACCOMPAGNEMENT_D_ÉQUIPE', 'TEAM_TRAINING_&_SUPPORT' ); ?></option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label for="contact_message" class="block text-[#1abc9c] font-bold uppercase flex items-center gap-1">
                                <span>></span> <?php baobab_e( 'DESCRIPTION_DU_BESOIN :', 'DESCRIPTION_OF_NEED:' ); ?>
                            </label>
                            <textarea id="contact_message" name="contact_message" rows="5" placeholder="<?php echo esc_attr( baobab_t(
                                'Décrivez votre projet, vos contraintes et vos délais...',
                                'Describe your project, constraints and deadlines...'
                            ) ); ?>" required
                                      class="w-full bg-[#0b0c10] border-2 border-[#262936] p-3 text-white focus:border-[#1abc9c] focus:outline-none transition-colors"></textarea>
                        </div>

                        <?php wp_nonce_field( 'baobab_contact_submit', 'baobab_contact_nonce' ); ?>

                        <button type="submit" 
                                class="w-full py-4 bg-[#1abc9c] text-black font-bold uppercase tracking-wider hover:bg-[#00ffc4] transition-all text-sm">
                            <?php baobab_e( 'ENVOYER LE MESSAGE →', 'SEND MESSAGE →' ); ?>
                        </button>

                    </form>

                </div>

                <!-- Right Scope Checklist & Coordinates -->
                <div class="lg:col-span-5 space-y-6">
                    
                    <!-- Checklist -->
                    <div class="bg-[#12141a] border-2 border-[#6c3483] p-6 space-y-4">
                        <h3 class="font-grotesk font-black text-xl text-white uppercase border-b border-[#262936] pb-3">
                            <?php baobab_e( 'CE QUE JE PEUX FAIRE POUR VOUS', 'WHAT I CAN DO FOR YOU' ); ?>
                        </h3>
                        <ul class="font-sans text-sm text-slate-300 space-y-3">
                            <li class="flex items-start gap-2">
                                <span class="text-[#00ffc4] font-bold font-mono-code">✓</span>
                                <span><?php baobab_e(
                                    'Analyse des besoins et rédaction des spécifications (BRD, FRD)',
                                    'Requirements analysis and specification writing (BRD, FRD)'
                                ); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-[#00ffc4] font-bold font-mono-code">✓</span>
                                <span><?php baobab_e(
                                    'Coordination de projets digitaux et recette (UAT)',
                                    'Digital project coordination and UAT'
                                ); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-[#00ffc4] font-bold font-mono-code">✓</span>
                                <span><?php baobab_e(
                                    'Développement de solutions logiciels sur mesure (Laravel, React, Mobile)',
                                    'Custom software development (Laravel, React, Mobile)'
                                ); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-[#00ffc4] font-bold font-mono-code">✓</span>
                                <span><?php baobab_e(
                                    'Tableaux de bord et analyse de données (Power BI, SQL)',
                                    'Dashboards and data analysis (Power BI, SQL)'
                                ); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-[#00ffc4] font-bold font-mono-code">✓</span>
                                <span><?php baobab_e(
                                    'Formation et accompagnement des équipes métier',
                                    'Training and support for business teams'
                                ); ?></span>
                            </li>
                        </ul>
                    </div>

                    <!-- Direct Info Box -->
                    <div class="bg-[#12141a] border-2 border-[#262936] p-6 space-y-4 font-mono-code text-xs">
                        <div class="text-[#1abc9c] font-bold uppercase border-b border-[#262936] pb-3">
                            <?php baobab_e( '[INFORMATIONS_DE_CONTACT]', '[CONTACT_INFORMATION]' ); ?>
                        </div>

                        <?php
                        $contact_phone   = get_field( 'contact_phone' ) ?: '+237 676 398 049';
                        $contact_email_a = get_field( 'contact_email' ) ?: 'armel.njike@yahoo.com';
                        $contact_addr    = get_field( 'contact_address' ) ?: baobab_t( 'Yaoundé (Dispo Douala)', 'Yaoundé (Available Douala)' );
                        ?>
                        <div class="space-y-3 text-slate-200">
                            <p class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><span class="material-symbols-outlined text-[#1abc9c] text-sm">call</span> <?php baobab_e( 'TÉLÉPHONE :', 'PHONE:' ); ?></span>
                                <a href="tel:<?php echo esc_attr( preg_replace('/[^0-9+]/', '', $contact_phone ) ); ?>" class="font-bold text-[#1abc9c] hover:underline"><?php echo esc_html( $contact_phone ); ?></a>
                            </p>
                            <p class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><span class="material-symbols-outlined text-[#1abc9c] text-sm">mail</span> EMAIL :</span>
                                <a href="mailto:<?php echo esc_attr( $contact_email_a ); ?>" class="font-bold text-[#1abc9c] hover:underline"><?php echo esc_html( $contact_email_a ); ?></a>
                            </p>
                            <p class="flex items-center justify-between">
                                <span class="flex items-center gap-2"><span class="material-symbols-outlined text-[#1abc9c] text-sm">location_on</span> <?php baobab_e( 'LOCALISATION :', 'LOCATION:' ); ?></span>
                                <span class="text-white font-bold"><?php echo esc_html( $contact_addr ); ?></span>
                            </p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>