<?php
/*
 Template Name: Contact Page
*/
get_header();
?>

<!-- Contact - Light Theme -->
<!-- Hero Section -->
<section class="relative w-full overflow-hidden px-6 lg:px-20 py-16 md:py-24">
    <div
        class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-primary/10 via-transparent to-transparent">
    </div>
    <div class="mx-auto max-w-7xl">
        <div class="flex flex-col gap-4">
            <span class="text-primary font-bold tracking-widest uppercase text-xs">Reach Out</span>
            <h1 class="text-4xl md:text-6xl font-black leading-tight tracking-tight text-slate-900">
                Connect with our <br /><span class="text-primary">Global Infrastructure Experts</span>
            </h1>
            <p class="max-w-2xl text-lg text-slate-500">
                Whether you're scaling a startup or optimizing an enterprise data center, our team is ready to design
                your path forward.
            </p>
        </div>
    </div>
</section>
<!-- Contact Split Layout -->
<main class="mx-auto max-w-7xl w-full px-6 lg:px-20 pb-24">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        <!-- Contact Form -->
        <div class="rounded-2xl border border-slate-200 bg-white p-8 lg:p-12 shadow-sm">
            <h3 class="text-2xl font-bold mb-8">Send us a Message</h3>
            <form class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold">Full Name</label>
                        <input
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-slate-400"
                            placeholder="John Doe" type="text" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-semibold">Email Address</label>
                        <input
                            class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-slate-400"
                            placeholder="john@company.com" type="email" />
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold">Company Name</label>
                    <input
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-slate-400"
                        placeholder="Baobab Tech Ltd." type="text" />
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-semibold">How can we help?</label>
                    <textarea
                        class="w-full rounded-lg border border-slate-300 bg-white px-4 py-3 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-all placeholder-slate-400"
                        placeholder="Tell us about your project infrastructure needs..." rows="4"></textarea>
                </div>
                <button
                    class="w-full flex items-center justify-center gap-2 rounded-lg bg-primary py-4 text-white font-bold hover:opacity-95 transition-all"
                    type="submit">
                    <span>Send Proposal Request</span>
                    <span class="material-symbols-outlined text-sm">send</span>
                </button>
            </form>
        </div>
        <!-- Details & Map -->
        <div class="flex flex-col gap-12">
            <!-- Office Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex flex-col gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <h4 class="font-bold text-lg text-slate-900">Headquarters</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        42 Innovation Way, Tech Park<br />
                        Nairobi, Kenya
                    </p>
                </div>
                <div class="flex flex-col gap-3">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-primary/10 text-primary">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <h4 class="font-bold text-lg text-slate-900">Contact Info</h4>
                    <p class="text-slate-500 text-sm leading-relaxed">
                        solutions@baobab.tech<br />
                        +254 (0) 20 555 0123
                    </p>
                </div>
            </div>
            <!-- Map Placeholder -->
            <div class="rounded-2xl border border-slate-200 bg-white p-8 lg:p-12 shadow-sm">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="flex flex-col items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-4xl">map</span>
                        <span class="text-xs font-bold tracking-widest uppercase opacity-50">Nairobi Tech Hub</span>
                    </div>
                </div>
                <div class="absolute inset-0 bg-cover bg-center mix-blend-overlay opacity-30 group-hover:opacity-50 transition-opacity"
                    data-alt="Stylized map showing Nairobi tech district location" data-location="Nairobi, Kenya"
                    style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBAX4IMgODwsI7TGxpUb3d9fXKdVicIn4gftKe4yLa_xyJD_L79rkUtH4ASTw6pacfFQW7wnsvlKbKHrc6lnXvH1Uiu6Zh1gsa32r46roUM8T38iK5Ds2ZCZE-4YT2-IE0JayKN6DyVdmzZQcIfLgDsY2orCiph0I_4lg_LPkrE-6hRlPOQNzv4C1ZNoYWVMZiGhChM9yXwbsjkYQ4jrx2rg0xA1n6caq3p9U-hgd2pOmyorkORRLpqSQU53o6Sxqnc-wZQ_50nZ5I');">
                </div>
            </div>
            <!-- Extra Social Proof -->
            <div class="pt-6 border-t border-primary/10">
                <p class="text-xs font-bold text-primary uppercase tracking-[0.2em] mb-4">Trusted Worldwide By</p>
                <div class="flex flex-wrap gap-8 opacity-40 grayscale">
                    <div class="flex items-center gap-2 font-black text-xl italic tracking-tighter">GENESIS</div>
                    <div class="flex items-center gap-2 font-black text-xl italic tracking-tighter">VERTEX</div>
                    <div class="flex items-center gap-2 font-black text-xl italic tracking-tighter">APEX</div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Strong CTA Section -->
<section class="w-full bg-primary py-24 px-6 lg:px-20 text-white overflow-hidden relative">
    <div class="absolute right-0 top-0 h-full w-1/3 opacity-10">
        <span class="material-symbols-outlined text-[300px] leading-none select-none">hub</span>
    </div>
    <div class="mx-auto max-w-4xl text-center flex flex-col items-center gap-8 relative z-10">
        <h2 class="text-3xl md:text-5xl font-black tracking-tight leading-tight">
            Let’s Build the Future Together.
        </h2>
        <p class="max-w-2xl text-lg text-slate-500">
            Our architects are ready to help you navigate the complexities of modern digital infrastructure.
        </p>
        <div class="flex flex-wrap justify-center gap-4">
            <button
                class="bg-white text-primary px-8 py-4 rounded-lg font-extrabold text-sm uppercase tracking-widest hover:bg-slate-100 transition-colors">
                Schedule a Strategy Session
            </button>
            <button
                class="bg-primary border border-white/30 text-white px-8 py-4 rounded-lg font-extrabold text-sm uppercase tracking-widest hover:bg-white/10 transition-colors">
                View Ecosystem
            </button>
        </div>
    </div>
</section>
<?php get_footer(); ?>