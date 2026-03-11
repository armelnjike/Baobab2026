<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Récupérer les infos de contact depuis la page Contact (ACF)
$footer_contact_page = get_page_by_path( 'contact' );
$footer_email        = $footer_contact_page ? get_field( 'contact_email', $footer_contact_page->ID ) : '';
$footer_phone        = $footer_contact_page ? get_field( 'contact_phone', $footer_contact_page->ID ) : '';
$footer_address      = $footer_contact_page ? get_field( 'contact_address', $footer_contact_page->ID ) : '';

// Liens sociaux (champs ACF optionnels sur la page contact)
$social_linkedin  = $footer_contact_page ? get_field( 'social_linkedin', $footer_contact_page->ID ) : '';
$social_twitter   = $footer_contact_page ? get_field( 'social_twitter',  $footer_contact_page->ID ) : '';
$social_facebook  = $footer_contact_page ? get_field( 'social_facebook',  $footer_contact_page->ID ) : '';
?>

<!-- Footer -->
<footer class="bg-sky-950 text-slate-300 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">

            <!-- Colonne 1 : Marque + contact + socials -->
            <div class="col-span-1 md:col-span-2 lg:col-span-1">
                <div class="flex items-center gap-3 text-white mb-6">
                    <div class="size-8">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-bold">Baobab Technology</span>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">
                    The partner of choice for digital transformation and technological excellence across the continent and beyond.
                </p>

                <!-- Infos de contact -->
                <ul class="space-y-3 text-sm mb-8">
                    <?php if ( $footer_email ) : ?>
                    <li class="flex items-center gap-2 text-slate-400">
                        <span class="material-symbols-outlined text-primary" style="font-size:16px">mail</span>
                        <a href="mailto:<?php echo esc_attr( $footer_email ); ?>" class="hover:text-emerald-400 transition-colors">
                            <?php echo esc_html( $footer_email ); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if ( $footer_phone ) : ?>
                    <li class="flex items-center gap-2 text-slate-400">
                        <span class="material-symbols-outlined text-primary" style="font-size:16px">phone</span>
                        <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $footer_phone ) ); ?>" class="hover:text-emerald-400 transition-colors">
                            <?php echo esc_html( $footer_phone ); ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if ( $footer_address ) : ?>
                    <li class="flex items-start gap-2 text-slate-400">
                        <span class="material-symbols-outlined text-primary mt-0.5" style="font-size:16px">location_on</span>
                        <span><?php echo nl2br( esc_html( $footer_address ) ); ?></span>
                    </li>
                    <?php endif; ?>
                </ul>

                <!-- Réseaux sociaux -->
                <div class="flex gap-3">
                    <?php if ( $social_linkedin ) : ?>
                    <a href="<?php echo esc_url( $social_linkedin ); ?>" target="_blank" rel="noopener"
                       class="size-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all text-slate-400"
                       aria-label="LinkedIn">
                        <svg class="size-4" viewBox="0 0 24 24" fill="currentColor"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_twitter ) : ?>
                    <a href="<?php echo esc_url( $social_twitter ); ?>" target="_blank" rel="noopener"
                       class="size-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all text-slate-400"
                       aria-label="X / Twitter">
                        <svg class="size-4" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    </a>
                    <?php endif; ?>
                    <?php if ( $social_facebook ) : ?>
                    <a href="<?php echo esc_url( $social_facebook ); ?>" target="_blank" rel="noopener"
                       class="size-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all text-slate-400"
                       aria-label="Facebook">
                        <svg class="size-4" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <?php endif; ?>
                    <!-- Icône mail de secours si aucun réseau défini -->
                    <?php if ( ! $social_linkedin && ! $social_twitter && ! $social_facebook ) : ?>
                    <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                       class="size-9 rounded-full bg-white/10 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all text-slate-400"
                       aria-label="Contact">
                        <span class="material-symbols-outlined" style="font-size:18px">mail</span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Colonne 2 : Navigation -->
            <div>
                <h5 class="text-white font-bold mb-6 text-sm uppercase tracking-wider">Navigation</h5>
                <ul class="space-y-3 text-sm">
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Services</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/case-studies/' ) ); ?>">Case Studies</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/insights/' ) ); ?>">Insights</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">About</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/team/' ) ); ?>">Team</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
                </ul>
            </div>

            <!-- Colonne 3 : Expertise -->
            <div>
                <h5 class="text-white font-bold mb-6 text-sm uppercase tracking-wider">Expertise</h5>
                <ul class="space-y-3 text-sm">
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Digital Strategy</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Software Engineering</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Data Science & AI</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Cybersecurity</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Cloud Infrastructure</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Mobile Development</a></li>
                </ul>
            </div>

            <!-- Colonne 4 : CTA + Carousel partenaires -->
            <div>
                <h5 class="text-white font-bold mb-6 text-sm uppercase tracking-wider">Work With Us</h5>
                <p class="text-slate-400 text-sm leading-relaxed mb-6">
                    Ready to transform your business? Let's build something great together.
                </p>
                <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"
                   class="inline-flex items-center gap-2 bg-primary text-white text-sm font-bold px-5 py-3 rounded-xl hover:brightness-110 hover:shadow-lg hover:shadow-primary/30 transition-all mb-8">
                    <span class="material-symbols-outlined" style="font-size:16px">handshake</span>
                    Partner with us
                </a>

                <?php
                $footer_clients      = $footer_contact_page ? get_field( 'clients', $footer_contact_page->ID ) : array();
                if ( ! empty( $footer_clients ) ) :
                    $footer_loop = array_merge( $footer_clients, $footer_clients );
                ?>
                <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500 mb-3">Trusted by</p>
                <div class="relative overflow-hidden rounded-lg"
                     style="mask-image: linear-gradient(to right, transparent 0%, black 20%, black 80%, transparent 100%);
                            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 20%, black 80%, transparent 100%);">
                    <div class="flex gap-6 w-max" style="animation: footer-marquee 20s linear infinite;">
                        <?php foreach ( $footer_loop as $client ) : ?>
                        <div class="flex-shrink-0 flex items-center justify-center h-8">
                            <?php if ( ! empty( $client['client_logo'] ) ) : ?>
                            <img src="<?php echo esc_url( $client['client_logo'] ); ?>"
                                 alt="<?php echo esc_attr( $client['client_name'] ); ?>"
                                 class="h-5 object-contain grayscale invert opacity-40 hover:opacity-70 transition-opacity" />
                            <?php else : ?>
                            <span class="text-xs font-black italic tracking-tight text-slate-500 hover:text-slate-300 transition-colors whitespace-nowrap">
                                <?php echo esc_html( $client['client_name'] ); ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <style>
                @keyframes footer-marquee {
                    0%   { transform: translateX(0); }
                    100% { transform: translateX(-50%); }
                }
                </style>
                <?php endif; ?>
            </div>

        </div>

        <!-- Bas du footer -->
        <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-slate-500">
            <p>© <?php echo date( 'Y' ); ?> Baobab Technology. All rights reserved.</p>
            <div class="flex flex-wrap justify-center gap-6">
                <?php
                $privacy = get_page_by_path( 'privacy-policy' );
                $terms   = get_page_by_path( 'terms-of-service' );
                $legal   = get_page_by_path( 'legal-notice' );
                ?>
                <a class="hover:text-white transition-colors" href="<?php echo $privacy ? esc_url( get_permalink( $privacy ) ) : '#'; ?>">Privacy Policy</a>
                <a class="hover:text-white transition-colors" href="<?php echo $terms   ? esc_url( get_permalink( $terms ) )   : '#'; ?>">Terms of Service</a>
                <a class="hover:text-white transition-colors" href="<?php echo $legal   ? esc_url( get_permalink( $legal ) )   : '#'; ?>">Legal Notice</a>
            </div>
        </div>
    </div>
</footer>

</div><!-- .layout-container -->
</div><!-- .group/design-root -->

<?php wp_footer(); ?>
</body>
</html>
