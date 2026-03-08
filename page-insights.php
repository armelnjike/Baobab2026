<?php
/*
 Template Name: Insight Page
*/
get_header();
?>

<!-- Insights & Blog - Light Theme -->
<main class="flex-1 w-full max-w-7xl mx-auto px-6 lg:px-20 py-12">
    <!-- Hero Section -->
    <div class="mb-16">
        <div class="max-w-3xl space-y-4">
            <h1 class="text-5xl md:text-6xl font-black tracking-tighter leading-none">Insights &amp;<br /><span
                    class="text-slate-900">Perspectives</span></h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-xl">
                Strategic analysis on Cybersecurity, Data Intelligence, and the evolving African Tech Ecosystem.
            </p>
        </div>
        <!-- Category Tabs -->
        <div class="mt-12 flex flex-wrap border-b border-slate-200 gap-x-8 gap-y-2 overflow-x-auto pb-px">
            <a class="border-b-2 border-primary pb-4 text-sm font-bold" href="#">All Posts</a>
            <a class="border-b-2 border-transparent pb-4 text-sm font-medium text-slate-500 hover:text-primary transition-colors"
                href="#">Cybersecurity</a>
            <a class="border-b-2 border-transparent pb-4 text-sm font-medium text-slate-500 hover:text-primary transition-colors"
                href="#">Data Science</a>
            <a class="border-b-2 border-transparent pb-4 text-sm font-medium text-slate-500 hover:text-primary transition-colors"
                href="#">African Tech</a>
            <a class="border-b-2 border-transparent pb-4 text-sm font-medium text-slate-500 hover:text-primary transition-colors"
                href="#">Leadership</a>
        </div>
    </div>
    <!-- Featured Post -->
    <div class="group relative grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-32">
        <div class="lg:col-span-7 overflow-hidden rounded-xl bg-slate-200 bg-slate-50">
            <div class="aspect-[16/9] w-full bg-cover bg-center transition-transform duration-700 group-hover:scale-105"
                data-alt="Abstract digital matrix representing cybersecurity network protection"
                style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBV-rQfe13b9cdewy6cnnFzD94sdIIdObShZ7KoHX6T8qZ4Gxk5G-TmMXDTskKbP-_RuBclNI-tFzXAgvGoinHse1MDCj1CRQnpGM-VPG9C5m3Ty2Ss25cMRn3spO-exMsX9DU7Az_egQieEo1YwEsFZpl-PFxN-irdkX8sTWG8DVE4AVsK2uoTtUQmZ4x7vSwp34zYOvh5SEOLzo7LeN8X7BVc6PERopER9xSJG60n7R0uHLyv0k9JQ-Jff7UKc_1YyUFKqwDFY64')">
            </div>
        </div>
        <div class="lg:col-span-5 flex flex-col justify-center space-y-4">
            <div class="flex items-center gap-3 text-xs font-bold uppercase tracking-widest text-primary">
                <span>Featured Article</span>
                <span class="h-px w-8 bg-primary/30"></span>
                <span class="text-slate-500 dark:text-slate-400 uppercase">8 min read</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold leading-tight">The Future of Cybersecurity in Pan-African Fintech
            </h2>
            <p class="text-slate-600 text-lg leading-relaxed text-slate-700">
                Exploring the evolving threat landscape and how emerging zero-trust architectures are securing the
                continent's booming digital economy.
            </p>
            <div class="pt-4">
                <button class="flex items-center gap-2 font-bold text-primary group-hover:gap-4 transition-all">
                    Read Full Analysis
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </div>
        </div>
    </div>
    <!-- Latest Insights Grid -->
    <div>
        <div class="flex items-center justify-between mb-10">
            <h3 class="text-2xl font-bold text-slate-900">Latest Insights</h3>
            <div class="flex gap-2">
                <button
                    class="p-2 rounded-full border border-slate-200 dark:border-primary/30 hover:bg-slate-100 dark:hover:bg-primary/20">
                    <span class="material-symbols-outlined">grid_view</span>
                </button>
                <button
                    class="p-2 rounded-full border border-slate-200 dark:border-primary/30 hover:bg-slate-100 dark:hover:bg-primary/20">
                    <span class="material-symbols-outlined">reorder</span>
                </button>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <!-- Card 1 -->
            <article class="flex flex-col space-y-4 group">
                <div class="aspect-[4/3] overflow-hidden rounded-xl bg-slate-200 dark:bg-primary/10">
                    <div class="h-full w-full bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                        data-alt="A clean dashboard with data visualization charts"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAcD5ni1WbBqE4_JzIeVFGE6ojj1MCLkuPAHLh2JuX04iJxXKbvtxsAunoIexO-eISN13DVh1-6WvK6ejwk_Xa-ChrNYqontztADHeh-u9NodjmSb40en_Xz5ZILxpDvlt9k6Z6P2K5AuHqcDQ_WXsScv8YoMjH8yamwLuVLosy0n7_ud1Tp_LbpLfM6OJ-aS-5T7yS4DsGd3gR9QSOJOHPctWJ1t_S2uCXYHObFTTRxIDWfkPeKM7UrUAi3Glciv-Ia_Qo4jq0hpQ')">
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-primary uppercase">
                        <span>Data Science</span>
                        <span class="text-slate-400">•</span>
                        <span class="text-slate-500">June 12, 2024</span>
                    </div>
                    <h4
                        class="text-xl font-bold leading-snug group-hover:text-primary transition-colors text-slate-900">
                        Leveraging Big Data for Localized Market Expansion</h4>
                    <p class="text-slate-600 text-sm line-clamp-3">How granular data sets are helping startups navigate
                        the fragmented regulatory environments of West Africa.</p>
                </div>
            </article>
            <!-- Card 2 -->
            <article class="flex flex-col space-y-4 group">
                <div class="aspect-[4/3] overflow-hidden rounded-xl bg-slate-200 dark:bg-primary/10">
                    <div class="h-full w-full bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                        data-alt="Connectivity lines and points over a digital globe"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDTde8SkH5UR3Uj0hoQlXSB0bcktFpVjeZ3gSC6CKQZw3Qhs57-x5GbDMJP-ZP4UblYD7a2bzYwves2QN1zTGr7yDpA9l2dAiwzG1FSmLqxc14uweoAu5N8YOAJ4QttQXl1cuPDwLF5ww6q0MYkyKf2wBuDr4Pv8wIecJ8ggrRVIPRS-VD7Ye5AugyqS0KJv5aqjiwzBp1la6dZlI6_zbVpGuxWRbzsYYQBVp7zAtUQAPPWcm16rjJqqeHjIZoVwm_H8zQCi2VwFcc')">
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-primary uppercase">
                        <span>African Tech</span>
                        <span class="text-slate-400">•</span>
                        <span class="text-slate-500">June 08, 2024</span>
                    </div>
                    <h4
                        class="text-xl font-bold leading-snug group-hover:text-primary transition-colors text-slate-900">
                        The Rise of Regional Tech Hubs Beyond Lagos and Nairobi</h4>
                    <p class="text-slate-600 text-sm line-clamp-3">A deep dive into emerging ecosystems in Accra,
                        Kigali, and Dakar and their unique competitive advantages.</p>
                </div>
            </article>
            <!-- Card 3 -->
            <article class="flex flex-col space-y-4 group">
                <div class="aspect-[4/3] overflow-hidden rounded-xl bg-slate-200 dark:bg-primary/10">
                    <div class="h-full w-full bg-cover bg-center transition-transform duration-500 group-hover:scale-110"
                        data-alt="Conceptual image of binary code and padlock for security"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDueF6uhII7LyvvF_3IwhZpp8fRqLHLdxStgvP83ML9rJI8LMFY2d8F5PnQvmjG9TJri61MU-44ojwjf6AiQpbATRkbMx0wz5_c-0QHFYlKaZMY4JgLjlgEmaZOIvEMdZx_XTPbATHL15zqWj47O3dstXuKlzf83LwXjRKJu3G0O453AfsVuTn1_lzQwsxt8G_8z1PVV5avS34W9BQrB_UK0Xump8atv7ABboHBUHLgdze7uYul1X6NvsgbZdw_GCrOR8kUNDimS6U')">
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center gap-2 text-xs font-bold text-primary uppercase">
                        <span>Cybersecurity</span>
                        <span class="text-slate-400">•</span>
                        <span class="text-slate-500">May 30, 2024</span>
                    </div>
                    <h4
                        class="text-xl font-bold leading-snug group-hover:text-primary transition-colors text-slate-900">
                        Why 2024 is the Year of Identity-First Security</h4>
                    <p class="text-slate-600 text-sm line-clamp-3">Managing digital identities in an increasingly
                        mobile-first workforce across the continent.</p>
                </div>
            </article>
        </div>
        <!-- Load More -->
        <div class="mt-16 flex justify-center">
            <button
                class="px-8 py-3 border-2 border-primary text-primary font-bold rounded-lg hover:bg-primary hover:text-white transition-all">
                Load More Articles
            </button>
        </div>
    </div>
</main>
<!-- Newsletter Footer Section -->
<section class="bg-primary/5 py-20 mt-12">
    <div class="max-w-7xl mx-auto px-6 lg:px-20 text-center">
        <div class="max-w-2xl mx-auto space-y-6">
            <h2 class="text-3xl font-bold">Subscribe to our Newsletter</h2>
            <p class="text-slate-600 dark:text-slate-400">Join 10,000+ technology leaders receiving our monthly briefing
                on African tech and security.</p>
            <form class="flex flex-col sm:flex-row gap-3 mt-8">
                <input
                    class="flex-1 rounded-lg border-slate-300 dark:border-primary/20 dark:bg-background-dark py-3 px-4 focus:ring-primary focus:border-primary bg-slate-50"
                    placeholder="Enter your email address" type="email" />
                <button class="bg-primary text-white font-bold px-8 py-3 rounded-lg hover:opacity-90"
                    type="submit">Subscribe</button>
            </form>
            <p class="text-xs text-slate-500">No spam. Only high-signal insights. Unsubscribe at any time.</p>
        </div>
    </div>
</section>

<?php get_footer(); ?>