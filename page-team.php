<?php
/*
 Template Name: Team Page
*/
get_header();
?>

<main class="flex flex-col items-center py-12 px-6 lg:px-40">
    <div class="max-w-5xl w-full">
        <section class="mb-16">
            <span class="text-primary font-bold tracking-widest uppercase text-xs">Our Leadership</span>
            <h2 class="text-slate-900 text-5xl font-extrabold leading-tight tracking-tight mt-2 mb-4">Executive Vision
            </h2>
            <p class="text-slate-500 text-lg max-w-2xl font-normal leading-relaxed">
                Architecting the future of high-trust technology through strategic innovation, ethical engineering, and
                institutional excellence.
            </p>
        </section>
        <div class="flex flex-col gap-12">
            <div class="p-8 rounded-xl flex flex-col lg:flex-row gap-10 items-start">
                <div
                    class="w-full lg:w-1/3 aspect-[4/5] rounded-lg overflow-hidden bg-slate-200 dark:bg-slate-800 relative group">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                        data-alt="Professional portrait of Elena Vance CEO"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD1xHu8RTJR9ZDO7ny7rwKQWEM4VpnQIp2ebtRS053tI0_Vd5fONjgonoJxOqPe1TYunUTUIJXr3pT6lHSAVdf81E5_54GsLJxgAtqI5OaeDN1wnc1rmReCUEXIObb21BXLWWwpkIVAQ5E9Vu8yZt5dU1oFwjjE-ISD2MA54SDyW9F8AGL_ZSiV74YwjGimtmxSmVjyf98457nr9GV2QMWzIGktPSJerGUD-KspTL7KqSVkhBdiFAWIQIWHh786pL58R7AVpJtsqHI');">
                    </div>
                    <div class="absolute bottom-4 right-4 flex gap-2">
                        <a class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center text-white hover:bg-primary transition-colors"
                            href="#">
                            <span class="material-symbols-outlined text-sm">link</span>
                        </a>
                    </div>
                </div>
                <div class="flex-1 space-y-6">
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-3xl font-bold text-slate-900 dark:text-white">Elena Vance</h3>
                                <p class="text-primary dark:text-slate-300 font-semibold text-lg">Chief Executive
                                    Officer</p>
                            </div>
                            <div class="flex gap-3">
                                <button
                                    class="p-2 rounded-lg bg-primary/10 text-primary dark:text-slate-300 hover:bg-primary hover:text-white transition-all">
                                    <span class="material-symbols-outlined">share</span>
                                </button>
                            </div>
                        </div>
                        <p class="mt-4 text-slate-600 dark:text-slate-400 leading-relaxed italic">
                            "Our goal isn't just to build systems, but to cultivate the foundational trust that enables
                            global digital commerce to thrive without friction."
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span
                            class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-300 uppercase">Global
                            Strategy</span>
                        <span
                            class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-300 uppercase">Enterprise
                            Architecture</span>
                        <span
                            class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-300 uppercase">Venture
                            Capital</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 rounded-lg bg-background-light dark:bg-primary/20 border border-primary/10">
                            <p class="text-xs text-primary font-bold uppercase mb-1">Key Achievement</p>
                            <p class="text-sm font-medium">Led $2.4B digital transformation for Apex Global Banking.</p>
                        </div>
                        <div class="p-4 rounded-lg bg-background-light dark:bg-primary/20 border border-primary/10">
                            <p class="text-xs text-primary font-bold uppercase mb-1">Legacy Project</p>
                            <p class="text-sm font-medium">Founder of the Ethos Trust Framework protocol.</p>
                        </div>
                    </div>
                    <details class="group">
                        <summary
                            class="flex items-center gap-2 cursor-pointer text-primary dark:text-slate-300 font-bold text-sm uppercase tracking-wider list-none select-none">
                            <span
                                class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                            View Full Portfolio
                        </summary>
                        <div
                            class="mt-4 p-6 rounded-lg bg-white/5 border border-primary/5 text-sm leading-relaxed text-slate-600 dark:text-slate-400">
                            Elena leads Baobab's long-term vision, bringing over 20 years of experience in scaling
                            enterprise technology solutions. Previously, she served as Managing Partner at Luminary
                            Ventures where she oversaw a portfolio of 40+ fintech startups. Her research on
                            institutional trust systems has been published in Harvard Business Review and Wired.
                        </div>
                    </details>
                </div>
            </div>
            <div class="p-8 rounded-xl flex flex-col lg:flex-row gap-10 items-start">
                <div
                    class="w-full lg:w-1/3 aspect-[4/5] rounded-lg overflow-hidden bg-slate-200 dark:bg-slate-800 relative group">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                        data-alt="Professional portrait of Marcus Thorne CTO"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAiZbAoEjJdHn1PyhEA01OyvEgLvN3gLf6sUcI_V0CH21nRpuMAPL8qz4U0UwgnDjqjBuPO6zwUL-85Gxx3GUZE4tSMz6gAeu6W6R0Sk93xnjWzikCrlqxnEFssDwJVmozvdUbLsiuCca5WC0h7ANmI9WpIYpWr8ziXXOqEmhcx3LcHq6utgQDnK_9BpciPdBrP1-SoTF5lfUEEzm54I87Qr7eocW6031L-BpqQAVPMWTSMLn3rvGXn0pezMpvT-o1RkhJFAfjNg1s');">
                    </div>
                    <div class="absolute bottom-4 right-4 flex gap-2">
                        <a class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center text-white hover:bg-primary transition-colors"
                            href="#">
                            <span class="material-symbols-outlined text-sm">terminal</span>
                        </a>
                    </div>
                </div>
                <div class="flex-1 space-y-6">
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-3xl font-bold text-slate-900 dark:text-white">Marcus Thorne</h3>
                                <p class="text-primary dark:text-slate-300 font-semibold text-lg">Chief Technology
                                    Officer</p>
                            </div>
                            <div class="flex gap-3">
                                <button
                                    class="p-2 rounded-lg bg-primary/10 text-primary dark:text-slate-300 hover:bg-primary hover:text-white transition-all">
                                    <span class="material-symbols-outlined">share</span>
                                </button>
                            </div>
                        </div>
                        <p class="mt-4 text-slate-600 dark:text-slate-400 leading-relaxed italic">
                            "We don't build features; we build infrastructure that survives centuries. Code is the DNA
                            of the modern institution."
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span
                            class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-300 uppercase">Distributed
                            Systems</span>
                        <span
                            class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-300 uppercase">Cryptography</span>
                        <span
                            class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-300 uppercase">AI
                            Ethics</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 rounded-lg bg-background-light dark:bg-primary/20 border border-primary/10">
                            <p class="text-xs text-primary font-bold uppercase mb-1">Key Achievement</p>
                            <p class="text-sm font-medium">Architected the ultra-secure "Iron-Core" data engine.</p>
                        </div>
                        <div class="p-4 rounded-lg bg-background-light dark:bg-primary/20 border border-primary/10">
                            <p class="text-xs text-primary font-bold uppercase mb-1">Notable Project</p>
                            <p class="text-sm font-medium">Former lead engineer on the Apollo Blockchain Protocol.</p>
                        </div>
                    </div>
                    <details class="group">
                        <summary
                            class="flex items-center gap-2 cursor-pointer text-primary dark:text-slate-300 font-bold text-sm uppercase tracking-wider list-none select-none">
                            <span
                                class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                            View Full Portfolio
                        </summary>
                        <div
                            class="mt-4 p-6 rounded-lg bg-white/5 border border-primary/5 text-sm leading-relaxed text-slate-600 dark:text-slate-400">
                            Marcus holds a PhD in Computer Science from MIT and has patented 14 novel cryptographic
                            methods. Before joining Baobab, he led the core engineering team at Titan Security Systems,
                            where he pioneered zero-trust architecture for government-level assets. He is a frequent
                            speaker at DEF CON and Black Hat.
                        </div>
                    </details>
                </div>
            </div>
            <div class="p-8 rounded-xl flex flex-col lg:flex-row gap-10 items-start opacity-90">
                <div
                    class="w-full lg:w-1/3 aspect-[4/5] rounded-lg overflow-hidden bg-slate-200 dark:bg-slate-800 relative group">
                    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105"
                        data-alt="Professional portrait of Sarah Jenkins COO"
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuCkfUjypFUgHhApOlhs_RApkFPCuyBd0pVTTK8N-24TZYO3qEWu-w25VtaWN-fR81v109-y6dL00nKLroNA01XLwSkJ2dm-aB8qoveLgoE0odkAl1vjn1ftZtDvSrQk5L45__kvNzyMCZawg5GP2NDSPmqnhif5HF65bNpy3ugZjQECCKO3ut9Ghh8dkoI2ucFzA2gPwiH-aCHIxmrRNqN9dTlJ39PQ38f1ZsUeQBTZ-H3-oPsDds6s8BmInInfxhu2RrZcGLdsRSI');">
                    </div>
                    <div class="absolute bottom-4 right-4 flex gap-2">
                        <a class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center text-white hover:bg-primary transition-colors"
                            href="#">
                            <span class="material-symbols-outlined text-sm">business_center</span>
                        </a>
                    </div>
                </div>
                <div class="flex-1 space-y-6">
                    <div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-3xl font-bold text-slate-900 dark:text-white">Sarah Jenkins</h3>
                                <p class="text-primary dark:text-slate-300 font-semibold text-lg">Chief Operating
                                    Officer</p>
                            </div>
                            <div class="flex gap-3">
                                <button
                                    class="p-2 rounded-lg bg-primary/10 text-primary dark:text-slate-300 hover:bg-primary hover:text-white transition-all">
                                    <span class="material-symbols-outlined">share</span>
                                </button>
                            </div>
                        </div>
                        <p class="mt-4 text-slate-600 dark:text-slate-400 leading-relaxed italic">
                            "Innovation is vanity; execution is sanity. We operationalize complex visions into reliable,
                            repeatable excellence."
                        </p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span
                            class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-300 uppercase">Operational
                            Excellence</span>
                        <span
                            class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-300 uppercase">M&amp;A
                            Strategy</span>
                        <span
                            class="px-3 py-1 rounded-full bg-primary/5 border border-primary/20 text-xs font-semibold text-primary dark:text-slate-300 uppercase">Compliance</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 rounded-lg bg-background-light dark:bg-primary/20 border border-primary/10">
                            <p class="text-xs text-primary font-bold uppercase mb-1">Key Achievement</p>
                            <p class="text-sm font-medium">Optimized operational efficiency by 40% across 12 countries.
                            </p>
                        </div>
                        <div class="p-4 rounded-lg bg-background-light dark:bg-primary/20 border border-primary/10">
                            <p class="text-xs text-primary font-bold uppercase mb-1">Current Focus</p>
                            <p class="text-sm font-medium">Scaling Baobab's presence in EMEA and Asia-Pacific.</p>
                        </div>
                    </div>
                    <details class="group">
                        <summary
                            class="flex items-center gap-2 cursor-pointer text-primary dark:text-slate-300 font-bold text-sm uppercase tracking-wider list-none select-none">
                            <span
                                class="material-symbols-outlined transition-transform group-open:rotate-180">expand_more</span>
                            View Full Portfolio
                        </summary>
                        <div
                            class="mt-4 p-6 rounded-lg bg-white/5 border border-primary/5 text-sm leading-relaxed text-slate-600 dark:text-slate-400">
                            Sarah oversees all operational aspects of Baobab. With a background in management consulting
                            at McKinsey, she has spent the last decade helping Series D startups scale into public
                            corporations. She holds an MBA from Stanford and is a board member for the Women in Tech
                            Ethics initiative.
                        </div>
                    </details>
                </div>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>