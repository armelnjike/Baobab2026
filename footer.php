<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<!-- Footer -->
<footer class="bg-sky-950 text-slate-300 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-20">
            <div class="col-span-1 md:col-span-2">
                <div class="flex items-center gap-3 text-white mb-8">
                    <div class="size-8">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold">Baobab Technology</span>
                </div>
                <p class="max-w-sm text-slate-400 mb-8">
                    The partner of choice for digital transformation and technological excellence across the continent and beyond.
                </p>
                <div class="flex gap-4">
                    <a class="size-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all" href="#">
                        <span class="material-symbols-outlined">public</span>
                    </a>
                    <a class="size-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-emerald-500 hover:text-white transition-all" href="#">
                        <span class="material-symbols-outlined">alternate_email</span>
                    </a>
                </div>
            </div>
            <div>
                <h5 class="text-white font-bold mb-6">Expertise</h5>
                <ul class="space-y-4 text-sm">
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Digital Strategy</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Software Engineering</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Data Science</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/services/' ) ); ?>">Cybersecurity</a></li>
                </ul>
            </div>
            <div>
                <h5 class="text-white font-bold mb-6">Company</h5>
                <ul class="space-y-4 text-sm">
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/about/' ) ); ?>">Our Story</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/case-studies/' ) ); ?>">Case Studies</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="#">Careers</a></li>
                    <li><a class="hover:text-emerald-400 transition-colors" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-6 text-xs font-medium">
            <p>© <?php echo date( 'Y' ); ?> Baobab Technology. All rights reserved.</p>
            <div class="flex gap-8">
                <a class="hover:text-white" href="#">Privacy Policy</a>
                <a class="hover:text-white" href="#">Terms of Service</a>
                <a class="hover:text-white" href="#">Legal Notice</a>
            </div>
        </div>
    </div>
</footer>

</div><!-- .layout-container -->
</div><!-- .group/design-root -->

<?php wp_footer(); ?>
</body>
</html>
