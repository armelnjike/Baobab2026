<?php
/*
 Template Name: Case-Study Page
*/
get_header();
?>

<!-- Case Studies - Light Theme -->

<main class="flex-1 max-w-7xl mx-auto w-full px-6 md:px-20 py-12">
    <!-- Hero Header -->
    <div class="mb-12">
        <h1 class="text-5xl font-black tracking-tight mb-4 text-primary">Case Studies</h1>
        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">
            A deep dive into how we solve complex engineering challenges and deliver measurable business impact through
            innovative digital solutions.
        </p>
    </div>
    <!-- Filters -->
    <div class="flex flex-wrap items-center gap-3 mb-10 pb-6 border-b border-primary/10"><button
            class="px-6 py-2 rounded-full bg-primary text-white text-sm font-bold shadow-sm">All Work</button>
        <button
            class="px-6 py-2 rounded-full bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-all">Web</button>
        <button
            class="px-6 py-2 rounded-full bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-all">Mobile</button>
        <button
            class="px-6 py-2 rounded-full bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-all">AI</button>
        <button
            class="px-6 py-2 rounded-full bg-slate-100 text-slate-600 text-sm font-semibold hover:bg-primary/10 hover:text-primary transition-all">Cybersecurity</button>
    </div>
    <!-- Case Study Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Case Study 1 -->
        <div class="flex flex-col gap-6 group">
            <div
                class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 border border-slate-200 relative shadow-sm">
                <img alt="Fintech AI Dashboard"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    data-alt="Modern dark fintech dashboard with data visualizations"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCsMOeM51I17Mx_FHeBCADleC3YHeYY2QdQkzmZ2dwgHgppHYstZ6y57W1-VV4DcXUiGvm27DOy5cSpTFc6QJ2IzPyk6fFgbk0BG1RVcR9DQoa5tKXd_L_eAeKH472y-mSOywWXXt6WiaaXLHwh2rboeuAWqFIEFMDois8omvRmgoD-3Rju7DmzFSO0uIhm4QzS-LRwMjYGpoocMgDl3YVFWIP5-IUKr9eQ-F7iZpgwZ2rO5lW1aq8laMfauZoO7L_oD1iqRMFuotM" />
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex gap-2">
                    <span
                        class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded">AI</span>
                    <span
                        class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded">Fintech</span>
                </div>
                <h3 class="text-2xl font-bold tracking-tight text-primary">Transforming Fraud Detection with Neural
                    Networks</h3>
                <div class="space-y-4">
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Client Problem</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">Inefficient manual fraud detection
                            processes leading to high operational costs and 15% missed anomalies.</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Strategic Solution</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">Deployed a real-time automated
                            neural network monitoring system that learns from historical transaction patterns.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Technical Stack</h4>
                            <p class="text-sm font-medium">Python, TensorFlow, AWS SageMaker</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Measurable Results</h4>
                            <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">40% reduction in false
                                positives</p>
                        </div>
                    </div>
                </div>
                <button
                    class="mt-2 flex items-center gap-2 text-sm font-bold text-primary dark:text-emerald-400 group-hover:underline">
                    Read Full Story <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
        </div>
        <!-- Case Study 2 -->
        <div class="flex flex-col gap-6 group">
            <div
                class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 border border-slate-200 relative shadow-sm">
                <img alt="E-commerce architecture"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    data-alt="Minimalist laptop showing a high-end e-commerce interface"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDcCn-rgMDDDjecyTaX0vHx6bZsYiYLh5cPJTMQQAS4ke7NUHIKGxjyrXLF_xZLx0PPpCGr-rMOAUtxdXEvXI3Gh7okKVFqv8dWoQIJk_YDy1CMXcrXq0SwhybWMev6W2W2ycNZ_F7n5vjEKsIYojtGVxg127jfiKale2UsLMLtZBjfKQDAWYt6kvev3WhJE4zqj5HVa-Qz9w-_DxhXv-M4mgw6f8ffcl975cG1fc7yIyvcfOOnJzyBNX_Bo5GpXvbNDKXdiFIV_BQ" />
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex gap-2">
                    <span
                        class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded">Web</span>
                    <span
                        class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded">Architecture</span>
                </div>
                <h3 class="text-2xl font-bold tracking-tight text-primary">Global Scalability for Peak Traffic Events
                </h3>
                <div class="space-y-4">
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Client Problem</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">Legacy monolithic system unable to
                            handle peak traffic spikes during global Black Friday sales events.</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Strategic Solution</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">Migrated to a headless microservices
                            architecture using edge-cached content delivery.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Technical Stack</h4>
                            <p class="text-sm font-medium">React, Node.js, Kubernetes, Redis</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Measurable Results</h4>
                            <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">99.99% Uptime / 3x Speed
                            </p>
                        </div>
                    </div>
                </div>
                <button
                    class="mt-2 flex items-center gap-2 text-sm font-bold text-primary dark:text-emerald-400 group-hover:underline">
                    Read Full Story <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
        </div>
        <!-- Case Study 3 -->
        <div class="flex flex-col gap-6 group">
            <div
                class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 border border-slate-200 relative shadow-sm">
                <img alt="Mobile Security App"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    data-alt="User hand holding a smartphone with a security shield icon"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCDlvMq_3Tqqq25m60qs-YjI2R07nZ7yvhQdpMdTdpANebVkXMUi8QViDoj4kCJ0ikg_0IMYtdPClUNnalJgy2ZezxXiMmceFhvdXeq_5fWYSvh2CusbwM1jDq6bZk09P_25Hm_RM3z7T1iPiIs87BOIpNzOOTgpg1VD53Gy4RkQ2LVQGo2ou6Dht1SEPEm6NBVSjrZxovndfbggILghCD6NMTdOU4FoniS-KVZqvWN9JMoF4dYjBt-RGBKh8HPK6ZnwoQwx3mppbM" />
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex gap-2">
                    <span
                        class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded">Cybersecurity</span>
                    <span
                        class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded">Mobile</span>
                </div>
                <h3 class="text-2xl font-bold tracking-tight text-primary">Military-Grade Encryption for Remote Teams
                </h3>
                <div class="space-y-4">
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Client Problem</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">Data leaks during internal
                            communications for a distributed workforce handling sensitive R&amp;D data.</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Strategic Solution</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">End-to-end encrypted mobile
                            ecosystem with biometric multi-factor authentication and zero-trust protocols.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Technical Stack</h4>
                            <p class="text-sm font-medium">Flutter, Rust, AES-256, Docker</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Measurable Results</h4>
                            <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">Zero Security Breaches
                                YTD</p>
                        </div>
                    </div>
                </div>
                <button
                    class="mt-2 flex items-center gap-2 text-sm font-bold text-primary dark:text-emerald-400 group-hover:underline">
                    Read Full Story <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
        </div>
        <!-- Case Study 4 -->
        <div class="flex flex-col gap-6 group">
            <div
                class="aspect-video w-full overflow-hidden rounded-xl bg-slate-100 border border-slate-200 relative shadow-sm">
                <img alt="Smart Logistics AI"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    data-alt="Digital representation of global logistics and circuit patterns"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCG1_nLczEJLOr17Fmp_jtLFfctSrDfEi_ap_zjWv8YABMGdyLWimc2UPNSMSS9sGX6HMTrF0neLi-DPQyd2gsUQ9jKlf9dji0AoRUh2XwnJZOqvq_2BFisEM-ZYFK-vsaRxV0HGL8mum90vsZvITpsRiqe5UrMlcfnzEdvDM90O_I4f_uAvshcclcc7wQ116htLelyr6VzfWeyV4-31UpB9MVncEbxLkdhSoD_diWNYal5BxldVdmFrJ1ZDxOf8H50DFWOQ7lFGqA" />
            </div>
            <div class="flex flex-col gap-4">
                <div class="flex gap-2">
                    <span
                        class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded">AI</span>
                    <span
                        class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded">Logistics</span>
                </div>
                <h3 class="text-2xl font-bold tracking-tight text-primary">Predictive Analytics for Supply Chain
                    Resilience</h3>
                <div class="space-y-4">
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Client Problem</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">Unpredictable supply chain delays
                            causing $2M annual losses in idle warehouse time.</p>
                    </div>
                    <div>
                        <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Strategic Solution</h4>
                        <p class="text-slate-500 max-w-2xl text-lg leading-relaxed">Custom ML models predicting demand
                            surges and shipping bottlenecks before they occur.</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Technical Stack</h4>
                            <p class="text-sm font-medium">PyTorch, Google Cloud, BigQuery</p>
                        </div>
                        <div>
                            <h4 class="text-xs font-black uppercase text-primary/40 mb-1">Measurable Results</h4>
                            <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400">22% Efficiency Increase
                            </p>
                        </div>
                    </div>
                </div>
                <button
                    class="mt-2 flex items-center gap-2 text-sm font-bold text-primary dark:text-emerald-400 group-hover:underline">
                    Read Full Story <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </div>
        </div>
    </div>
    <!-- CTA Section -->
    <div
        class="mt-24 p-12 rounded-2xl bg-emerald-50 border border-emerald-100 text-center flex flex-col items-center shadow-sm">
        <h2 class="text-3xl font-bold text-primary mb-4">Ready to build your success story?</h2>
        <p class="text-slate-600 max-w-xl mb-8">
            Let's collaborate on your next technical challenge and achieve measurable results for your business.
        </p>
        <div class="flex gap-4"><button
                class="px-8 py-3 bg-primary text-white rounded-lg font-bold hover:opacity-90 transition-opacity shadow-lg shadow-primary/20">Start
                a Project</button>
            <button
                class="px-8 py-3 bg-white border border-slate-200 text-primary rounded-lg font-bold hover:bg-slate-50 transition-colors">View
                All Services</button></div>
    </div>
</main>

<?php get_footer(); ?>