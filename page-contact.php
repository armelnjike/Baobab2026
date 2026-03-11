<?php
/*
 Template Name: Contact Page
*/
get_header();

// Statut de soumission du formulaire
$contact_status = $_GET['contact'] ?? '';
?>

<!-- ================================================
     HERO
     ================================================ -->
<section class="relative w-full overflow-hidden px-6 lg:px-20 py-16 md:py-24">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-primary/10 via-transparent to-transparent"></div>
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col gap-4">

            <span class="text-primary font-bold tracking-widest uppercase text-xs">
                <?php echo esc_html( get_field( 'contact_label' ) ?: 'Reach Out' ); ?>
            </span>

            <h1 class="text-4xl md:text-6xl font-black leading-tight tracking-tight text-slate-900">
                <?php echo esc_html( get_field( 'contact_title' ) ?: 'Connect with our' ); ?>
                <br />
                <span class="text-primary">
                    <?php echo esc_html( get_field( 'contact_title_colored' ) ?: 'Global Infrastructure Experts' ); ?>
                </span>
            </h1>

            <p class="max-w-2xl text-lg text-slate-500">
                <?php echo esc_html( get_field( 'contact_subtitle' ) ?: '' ); ?>
            </p>

        </div>
    </div>
</section>

<!-- ================================================
     FORMULAIRE + INFOS
     ================================================ -->
<main class="mx-auto max-w-7xl w-full px-6 lg:px-20 pb-24">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">

        <!-- FORMULAIRE -->
        <div class="rounded-2xl border border-slate-200 bg-white p-8 lg:p-12 shadow-sm">

            <h3 class="text-2xl font-bold mb-6">
                <?php echo esc_html( get_field( 'contact_form_title' ) ?: 'Send us a Message' ); ?>
            </h3>

            <!-- Message succès / erreur -->
            <?php if ( $contact_status === 'success' ) : ?>
            <div class="mb-6 flex items-center gap-3 p-4 rounded-lg bg-emerald-50 border border-emerald-200 text-emerald-700">
                <span class="material-symbols-outlined">check_circle</span>
                <p class="font-semibold text-sm">Message envoyé ! Nous vous répondrons rapidement.</p>
            </div>
            <?php elseif ( $contact_status === 'error' ) : ?>
            <div class="mb-6 flex items-center gap-3 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700">
                <span class="material-symbols-outlined">error</span>
                <p class="font-semibold text-sm">Une erreur s'est produite. Merci de réessayer ou de nous contacter directement par email.</p>
            </div>
            <?php endif; ?>

            <!-- Formulaire -->
            <form method="POST" action="" class="space-y-6">

                <?php wp_nonce_field( 'baobab_contact_submit', 'baobab_contact_nonce' ); ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold" for="contact_name">Full Name <span class="text-red-400">*</span></label>
                        <input
                            id="contact_name"
                            name="contact_name"
                            type="text"
                            required
                            placeholder="Njike Baobab"
                            value="<?php echo esc_attr( $_POST['contact_name'] ?? '' ); ?>"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-slate-400" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold" for="contact_email_input">Email Address <span class="text-red-400">*</span></label>
                        <input
                            id="contact_email_input"
                            name="contact_email_input"
                            type="email"
                            required
                            placeholder="Baobab@company.com"
                            value="<?php echo esc_attr( $_POST['contact_email_input'] ?? '' ); ?>"
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-slate-400" />
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold" for="contact_company">Company Name</label>
                    <input
                        id="contact_company"
                        name="contact_company"
                        type="text"
                        placeholder="Baobab Tech Ltd."
                        value="<?php echo esc_attr( $_POST['contact_company'] ?? '' ); ?>"
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-slate-400" />
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold" for="contact_message">How can we help? <span class="text-red-400">*</span></label>
                    <textarea
                        id="contact_message"
                        name="contact_message"
                        required
                        rows="4"
                        placeholder="Tell us about your project..."
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-slate-400"><?php echo esc_textarea( $_POST['contact_message'] ?? '' ); ?></textarea>
                </div>

                <button
                    type="submit"
                    class="w-full flex items-center justify-center gap-2 rounded-lg bg-primary py-4 text-white font-bold hover:opacity-90 transition-all">
                    <span>Send Proposal Request</span>
                    <span class="material-symbols-outlined text-sm">send</span>
                </button>

            </form>
        </div>

        <!-- INFOS + CLIENTS -->
        <div class="flex flex-col gap-12">

            <!-- Infos bureau -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                <?php $address = get_field( 'contact_address' ); if ( $address ) : ?>
                <div class="flex flex-col gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <h4 class="font-bold text-lg text-slate-900">Headquarters</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        <?php echo nl2br( esc_html( $address ) ); ?>
                    </p>
                </div>
                <?php endif; ?>

                <?php
                $email = get_field( 'contact_email' );
                $phone = get_field( 'contact_phone' );
                if ( $email || $phone ) :
                ?>
                <div class="flex flex-col gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <h4 class="font-bold text-lg text-slate-900">Contact Info</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        <?php if ( $email ) : ?>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>" class="hover:text-primary transition-colors">
                            <?php echo esc_html( $email ); ?>
                        </a><br />
                        <?php endif; ?>
                        <?php if ( $phone ) : ?>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>" class="hover:text-primary transition-colors">
                            <?php echo esc_html( $phone ); ?>
                        </a>
                        <?php endif; ?>
                    </p>
                </div>
                <?php endif; ?>

            </div>

            <!-- Logos clients -->
            <?php $clients = get_field( 'clients' ); ?>
            <?php if ( $clients ) : ?>
            <div class="pt-6 border-t border-primary/10">
                <p class="text-xs font-bold text-primary uppercase tracking-[0.2em] mb-4">
                    <?php echo esc_html( get_field( 'clients_label' ) ?: 'Trusted Worldwide By' ); ?>
                </p>
                <div class="flex flex-wrap gap-8 opacity-90  grayscale hover:opacity-100 hover:grayscale-0 transition-all duration-500 items-center">
                    <?php foreach ( $clients as $client ) : ?>

                        <?php if ( $client['client_logo'] ) : ?>
                        <img src="<?php echo esc_url( $client['client_logo'] ); ?>"
                             alt="<?php echo esc_attr( $client['client_name'] ); ?>"
                             class="h-12 object-contain" />
                        <?php else : ?>
                        <div class="font-black text-xl italic tracking-tighter">
                            <?php echo esc_html( $client['client_name'] ); ?>
                        </div>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</main>

<!-- ================================================
     CTA FINALE
     ================================================ -->
<section class="w-full bg-primary py-24 px-6 lg:px-20 text-white overflow-hidden relative">
    <div class="absolute right-0 top-0 h-full w-1/3 opacity-10">
        <span class="material-symbols-outlined text-[300px] leading-none select-none">hub</span>
    </div>
    <div class="mx-auto max-w-4xl text-center flex flex-col items-center gap-8 relative z-10">

        <h2 class="text-3xl md:text-5xl font-black tracking-tight leading-tight">
            <?php echo esc_html( get_field( 'cta_title' ) ?: "Let's Build the Future Together." ); ?>
        </h2>

        <p class="max-w-2xl text-lg text-slate-300">
            <?php echo esc_html( get_field( 'cta_text' ) ?: '' ); ?>
        </p>

        <div class="flex flex-wrap justify-center gap-4">

            <?php
            $btn1_text = get_field( 'cta_btn1_text' ) ?: 'Schedule a Strategy Session';
            $btn1_url  = get_field( 'cta_btn1_url' )  ?: '#';
            ?>
            <a href="<?php echo esc_url( $btn1_url ); ?>"
               class="bg-white border-black/30 text-slate-500 px-8 py-4 rounded-lg font-extrabold text-sm uppercase tracking-widest hover:bg-slate-100 transition-colors">
                <?php echo esc_html( $btn1_text ); ?>
            </a>

            <?php
            $btn2_text = get_field( 'cta_btn2_text' ) ?: 'View Ecosystem';
            $btn2_url  = get_field( 'cta_btn2_url' )  ?: '#';
            ?>
            <a href="<?php echo esc_url( $btn2_url ); ?>"
               class="border border-black/30 text-slate-500 px-8 py-4 rounded-lg font-extrabold text-sm uppercase tracking-widest hover:bg-white/10 transition-colors">
                <?php echo esc_html( $btn2_text ); ?>
            </a>

        </div>
    </div>
</section>

<?php get_footer(); ?>