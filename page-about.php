<?php
/*
 Template Name: About Page
*/
get_header();
?>

<main class="flex flex-col flex-1">
    <!-- Hero Section / Company Story -->
    <section class="max-w-[1200px] mx-auto w-full px-6 py-12 md:py-20">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="flex flex-col gap-6">
                <span class="text-primary font-bold tracking-widest text-sm uppercase">Our Story</span>
                <h1
                    class="text-4xl md:text-5xl font-black leading-tight tracking-tight text-slate-900 dark:text-slate-100">
                    Rooted in Africa, Reaching the World
                </h1>
                <p class="text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                    Baobab Technology was born from a vision to harness the resilience and strength of the African
                    spirit through world-class digital engineering. Founded with a deep commitment to our heritage, we
                    bridge the gap between local challenges and global technological excellence.
                </p>
                <p class="text-slate-600 dark:text-slate-400">
                    Our journey began with a simple observation: the continent's potential is limitless, but its digital
                    infrastructure needs local mastery. We build the architecture that empowers the next generation of
                    innovators.
                </p>
            </div>
            <div class="relative h-[400px] rounded-2xl overflow-hidden shadow-2xl">
                <div class="absolute inset-0 bg-primary/20 mix-blend-overlay z-10"></div>
                <div class="w-full h-full bg-cover bg-center"
                    data-alt="Majestic Baobab tree at sunset in African savanna"
                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB_7fJviFAwhpbkNhMO7xWJ3SclNTxxRIQ5QKCtCOK-n6LbHDLiJfL_U2jBaauFD38ezMr2nTSv9e5CKOhMLQfeaU5xo8bO88v3HnrEbvlOoJ8KYA-g_myjo_i9FH-9KjFhLUvk2LmYisAei9PMIYmZv4LVupZUpAqcD4Q1TeIPV7zNVaQZ3y2gSt65QI20Y3AYv-hq6UQMd8f-hh0QbFc0MKUi1t0SHzrGi2eDZJkZgQPO7XJ5g7D_sh6C8odKpQ66cPmVbajSphg");'>
                </div>
            </div>
        </div>
    </section>
    <!-- Vision & Mission Blocks -->
    <section class="bg-primary/5 py-16 bg-slate-50">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white p-10 rounded-xl border border-slate-200 shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-primary mb-4">visibility</span>
                    <h3 class="text-2xl font-bold mb-4">Our Vision</h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        To be the global reference for African-led technological excellence, creating a future where
                        digital sovereignty is the cornerstone of the continent's prosperity.
                    </p>
                </div>
                <div class="bg-white p-10 rounded-xl border border-slate-200 shadow-sm">
                    <span class="material-symbols-outlined text-4xl text-primary mb-4">rocket_launch</span>
                    <h3 class="text-2xl font-bold mb-4">Our Mission</h3>
                    <p class="text-slate-600 dark:text-slate-300 leading-relaxed">
                        To engineer robust, secure, and innovative digital solutions that solve real-world problems
                        while fostering local talent and technical independence.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Our Values -->
    <section class="max-w-[1200px] mx-auto w-full px-6 py-20">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4">The Baobab Standards</h2>
            <p class="text-slate-600 dark:text-slate-400 max-w-2xl mx-auto">Our core values guide every line of code we
                write and every strategic decision we make.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            <!-- Value 1 -->
            <div
                class="bg-white border border-slate-100 p-6 rounded-lg text-center flex flex-col items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="bg-primary/10 p-3 rounded-full">
                    <span class="material-symbols-outlined text-primary">verified</span>
                </div>
                <h4 class="font-bold">Rigor</h4>
                <p class="text-sm text-slate-500 dark:text-slate-400">Precision in every detail of our engineering
                    process.</p>
            </div>
            <!-- Value 2 -->
            <div
                class="bg-white border border-slate-100 p-6 rounded-lg text-center flex flex-col items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="bg-primary/10 p-3 rounded-full">
                    <span class="material-symbols-outlined text-primary">workspace_premium</span>
                </div>
                <h4 class="font-bold">Quality</h4>
                <p class="text-sm text-slate-500 dark:text-slate-400">Uncompromising standards for performance and
                    design.</p>
            </div>
            <!-- Value 3 -->
            <div
                class="bg-white border border-slate-100 p-6 rounded-lg text-center flex flex-col items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="bg-primary/10 p-3 rounded-full">
                    <span class="material-symbols-outlined text-primary">security</span>
                </div>
                <h4 class="font-bold">Security</h4>
                <p class="text-sm text-slate-500 dark:text-slate-400">Protecting digital assets with industrial-grade
                    protocols.</p>
            </div>
            <!-- Value 4 -->
            <div
                class="bg-white border border-slate-100 p-6 rounded-lg text-center flex flex-col items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="bg-primary/10 p-3 rounded-full">
                    <span class="material-symbols-outlined text-primary">lightbulb</span>
                </div>
                <h4 class="font-bold">Innovation</h4>
                <p class="text-sm text-slate-500 dark:text-slate-400">Constant evolution through creative
                    problem-solving.</p>
            </div>
            <!-- Value 5 -->
            <div
                class="bg-white border border-slate-100 p-6 rounded-lg text-center flex flex-col items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="bg-primary/10 p-3 rounded-full">
                    <span class="material-symbols-outlined text-primary">public</span>
                </div>
                <h4 class="font-bold">African Commitment</h4>
                <p class="text-sm text-slate-500 dark:text-slate-400">Investing in the continent's digital sovereignty.
                </p>
            </div>
        </div>
    </section>
    <!-- Strategic Positioning -->
    <section class="bg-primary text-white py-20">
        <div class="max-w-[1200px] mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div class="flex flex-col gap-8">
                    <h2 class="text-3xl font-bold">Why Baobab?</h2>
                    <p class="text-slate-300 leading-relaxed">
                        Unlike global conglomerates that apply generic solutions, we combine deep local context with
                        elite technical standards. We don't just export services; we build localized excellence.
                    </p>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <span
                                class="material-symbols-outlined text-primary bg-slate-100 rounded-full p-2 h-fit">check</span>
                            <div>
                                <h5 class="font-bold text-xl">Cultural Intelligence</h5>
                                <p class="text-slate-400">Deep understanding of African market dynamics and consumer
                                    behavior.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span
                                class="material-symbols-outlined text-primary bg-slate-100 rounded-full p-2 h-fit">check</span>
                            <div>
                                <h5 class="font-bold text-xl">High-End Engineering</h5>
                                <p class="text-slate-400">Tech stacks built for scalability, resilience, and
                                    offline-first capabilities.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <span
                                class="material-symbols-outlined text-primary bg-slate-100 rounded-full p-2 h-fit">check</span>
                            <div>
                                <h5 class="font-bold text-xl">Economic Impact</h5>
                                <p class="text-slate-400">Direct investment in the local tech ecosystem through
                                    knowledge transfer.</p>
                            </div>
                        </div>
                    </div>
                </div>
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
                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="py-4 px-5 text-slate-300">Local Integration</td>
                                <td class="py-4 px-5 text-center font-bold text-emerald-400">Deep</td>
                                <td class="py-4 px-5 text-center text-slate-500">Surface</td>
                            </tr>

                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="py-4 px-5 text-slate-300">Security Standards</td>
                                <td class="py-4 px-5 text-center font-bold text-emerald-400">Global Elite</td>
                                <td class="py-4 px-5 text-center text-slate-500">Standard</td>
                            </tr>

                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="py-4 px-5 text-slate-300">Custom Architecture</td>
                                <td class="py-4 px-5 text-center font-bold text-emerald-400">Native</td>
                                <td class="py-4 px-5 text-center text-slate-500">Adapted</td>
                            </tr>

                            <tr class="hover:bg-white/5 transition-colors">
                                <td class="py-4 px-5 text-slate-300">Sovereignty</td>
                                <td class="py-4 px-5 text-center font-bold text-emerald-400">Priority</td>
                                <td class="py-4 px-5 text-center text-slate-500">Secondary</td>
                            </tr>
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </section>
    <!-- Timeline -->
    <section class="max-w-[1200px] mx-auto w-full px-6 py-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold">Our Journey &amp; Roadmap</h2>
        </div>
        <div class="relative">
            <!-- Vertical Line -->
            <div class="hidden md:block absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-0.5 bg-slate-800/30 "></div>
            <div class="space-y-16">
                <!-- Timeline Item 1 -->
                <div class="relative flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-5/12 text-center md:text-right">
                        <h4 class="text-xl font-bold text-slate-900">2020: The Foundation</h4>
                        <p class="text-slate-600 dark:text-slate-400 mt-2">Established in Lagos with a core team of
                            senior engineers returning from global tech hubs.</p>
                    </div>
                    <div class="z-10 bg-slate-900 w-10 h-10 rounded-full flex items-center justify-center my-4 md:my-0">
                        <span class="material-symbols-outlined text-white text-md   ">home</span>
                    </div>
                    <div class="md:w-5/12"></div>
                </div>
                <!-- Timeline Item 2 -->
                <div class="relative flex flex-col md:flex-row-reverse items-center justify-between">
                    <div class="md:w-5/12 text-center md:text-left">
                        <h4 class="text-xl font-bold text-slate-900">2022: Pan-African Expansion</h4>
                        <p class="text-slate-600 dark:text-slate-400 mt-2">Launched regional offices in Nairobi and
                            Dakar, scaling our enterprise infrastructure solutions.</p>
                    </div>
                    <div class="z-10 bg-slate-900 w-10 h-10 rounded-full flex items-center justify-center my-4 md:my-0">
                        <span class="material-symbols-outlined text-white text-md">trending_up</span>
                    </div>
                    <div class="md:w-5/12"></div>
                </div>
                <!-- Timeline Item 3 -->
                <div class="relative flex flex-col md:flex-row items-center justify-between">
                    <div class="md:w-5/12 text-center md:text-right">
                        <h4 class="text-xl font-bold text-slate-900">2024: Global Node</h4>
                        <p class="text-slate-600 dark:text-slate-400 mt-2">Opening the Baobab Innovation Lab, bridging
                            African tech with European and Asian markets.</p>
                    </div>
                    <div class="z-10 bg-slate-900 w-10 h-10 rounded-full flex items-center justify-center my-4 md:my-0">
                        <span class="material-symbols-outlined text-white text-md">language</span>
                    </div>
                    <div class="md:w-5/12"></div>
                </div>
                <!-- Timeline Item 4 -->
                <div class="relative flex flex-col md:flex-row-reverse items-center justify-between">
                    <div class="md:w-5/12 text-center md:text-left opacity-70">
                        <h4 class="text-xl font-bold text-slate-900">2026+: Future Vision</h4>
                        <p class="text-slate-600 dark:text-slate-400 mt-2">Developing sovereign African cloud
                            infrastructure and AI-driven development frameworks.</p>
                    </div>
                    <div
                        class="z-10 bg-slate-900 w-10 h-10 rounded-full flex items-center justify-center my-4 md:my-0 border-2 border-dashed border-primary">
                        <span class="material-symbols-outlined text-white text-sm">auto_awesome</span>
                    </div>
                    <div class="md:w-5/12"></div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>