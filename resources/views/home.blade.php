@extends('layouts.public')

@section('title', 'Kandy Iron Works | Master Metal Craftsmanship, Automated Gates & Steel Canopies')

@section('content')

<!-- =========================================================================
     HERO SECTION
========================================================================= -->
@php
    $heroVideoSrc = $settings['hero_video_url'] ?? null;
    if (!$heroVideoSrc) {
        if (file_exists(public_path('videos/hero_forge.mp4')) || file_exists(base_path('videos/hero_forge.mp4'))) {
            $heroVideoSrc = asset('videos/hero_forge.mp4');
        } elseif (file_exists(public_path('videos/hero.mp4')) || file_exists(base_path('videos/hero.mp4'))) {
            $heroVideoSrc = asset('videos/hero.mp4');
        } else {
            $heroVideoSrc = asset('videos/hero_forge.webm');
        }
    }
@endphp

<section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-[#070b11]">
    <!-- Background Video & Gradient Overlay Layer -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <video id="heroBgVideo" autoplay muted loop playsinline preload="auto" src="{{ $heroVideoSrc }}" poster="{{ asset('images/showcase/hero_forge.jpg') }}" class="w-full h-full object-cover object-center filter brightness-[0.55] contrast-115 scale-105 transition-opacity duration-1000">
            <source src="{{ $heroVideoSrc }}" type="{{ str_ends_with($heroVideoSrc, '.webm') ? 'video/webm' : 'video/mp4' }}">
            <!-- Fallback Image for browsers without HTML5 video support -->
            <img src="{{ asset('images/showcase/hero_forge.jpg') }}" alt="Kandy Iron Works Workshop" class="w-full h-full object-cover object-center filter brightness-[0.38] contrast-125">
        </video>
        
        <!-- Multi-layered Atmospheric Gradient Overlays -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#070b11] via-[#070b11]/50 to-[#070b11]/20"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-[#070b11] via-[#070b11]/65 to-transparent"></div>
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-amber-500/15 via-transparent to-transparent"></div>
        
        <!-- Subtle Industrial Forge Grid Texture -->
        <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#f59e0b_1px,transparent_1px)] [background-size:24px_24px]"></div>
    </div>

    <!-- Floating Interactive Video Controller Badge with Multi-Clip Switcher -->
    <div class="absolute bottom-5 right-5 z-20 hidden md:flex flex-col items-end gap-2 pointer-events-auto">
        <div class="inline-flex items-center gap-2.5 px-3.5 py-1.5 rounded-full bg-black/75 border border-white/10 backdrop-blur-md text-xs text-slate-300 shadow-2xl">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse" id="videoLiveDot"></span>
            
            <div class="flex flex-col text-left">
                <span class="text-[9px] text-amber-400 uppercase tracking-widest font-bold leading-none" id="videoClipCounter">Clip 1 of 3</span>
                <span class="font-bold text-white text-xs tracking-wide leading-tight truncate max-w-[140px]" id="videoStatusText">Steel Forging</span>
            </div>
            
            <span class="text-white/20 h-4 w-[1px] bg-white/20"></span>
            
            <button type="button" id="heroVideoPrev" class="text-slate-400 hover:text-amber-400 transition-colors p-1" title="Previous Clip" aria-label="Previous Clip">
                <i class="fa-solid fa-backward-step text-xs"></i>
            </button>
            <button type="button" id="heroVideoToggle" class="text-slate-400 hover:text-amber-400 transition-colors p-1" title="Play / Pause Video" aria-label="Toggle Video Playback">
                <i class="fa-solid fa-pause text-xs" id="videoToggleIcon"></i>
            </button>
            <button type="button" id="heroVideoNext" class="text-slate-400 hover:text-amber-400 transition-colors p-1" title="Next Clip" aria-label="Next Clip">
                <i class="fa-solid fa-forward-step text-xs"></i>
            </button>
            
            <span class="text-white/20 h-4 w-[1px] bg-white/20"></span>
            
            <button type="button" id="heroAudioToggle" class="text-slate-400 hover:text-amber-400 transition-colors p-1" title="Mute / Unmute Sound" aria-label="Toggle Video Sound">
                <i class="fa-solid fa-volume-xmark text-xs" id="audioToggleIcon"></i>
            </button>
        </div>

        <!-- Clip Selector Dots -->
        <div class="flex items-center gap-1.5 mr-3">
            <button type="button" class="clip-dot h-1.5 rounded-full transition-all duration-300 w-6 bg-amber-400" data-clip="0" title="Clip 1: Steel Forging"></button>
            <button type="button" class="clip-dot h-1.5 rounded-full transition-all duration-300 w-2 bg-white/30 hover:bg-white/60" data-clip="1" title="Clip 2: MIG Welding"></button>
            <button type="button" class="clip-dot h-1.5 rounded-full transition-all duration-300 w-2 bg-white/30 hover:bg-white/60" data-clip="2" title="Clip 3: Metal Fabrication"></button>
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="max-w-3xl space-y-6">
            <!-- Eyebrow Pill -->
            <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-400 text-xs font-semibold uppercase tracking-wider backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-ping"></span>
                <span>Premier Architectural Metalwork &bull; Central Province</span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight leading-[1.1] uppercase">
                Forging <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 via-amber-300 to-amber-500">Strength</span> &amp; Architectural <span class="underline decoration-amber-500/50 underline-offset-8">Elegance</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg text-slate-300 leading-relaxed font-normal max-w-2xl">
                Custom handcrafted wrought iron gates, remote automated sliding systems, architectural spiral staircases, and heavy-gauge steel canopies engineered with our signature <span class="text-amber-400 font-semibold">10-Year Rust Guarantee</span>.
            </p>

            <!-- CTA Button Group -->
            <div class="pt-4 flex flex-wrap items-center gap-4">
                <a href="#estimator" class="px-7 py-3.5 rounded-xl font-bold text-sm uppercase tracking-wider bg-gradient-to-r from-amber-500 to-amber-600 text-black hover:from-amber-400 hover:to-amber-500 shadow-glow transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2.5">
                    <i class="fa-solid fa-calculator text-base"></i>
                    <span>Calculate Instant Estimate</span>
                </a>

                <a href="{{ route('portfolio') }}" class="px-6 py-3.5 rounded-xl font-semibold text-sm uppercase tracking-wider text-white bg-white/10 hover:bg-white/15 border border-white/20 hover:border-amber-400/50 backdrop-blur-md transition-all duration-300 flex items-center gap-2">
                    <i class="fa-solid fa-images text-amber-400"></i>
                    <span>View Projects</span>
                </a>

                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '94771234567') }}?text=Hello%20{{ urlencode($settings['workshop_name'] ?? 'Kandy Iron Works') }},%20I%20would%20like%20to%20request%20a%20site%20inspection." target="_blank" class="px-5 py-3.5 rounded-xl font-semibold text-sm text-emerald-400 bg-emerald-500/10 hover:bg-emerald-500/20 border border-emerald-500/30 transition-all flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    <span>WhatsApp Master</span>
                </a>
            </div>

            <!-- Trust Highlights Grid -->
            <div class="pt-8 border-t border-white/10 grid grid-cols-2 sm:grid-cols-4 gap-4 text-left">
                <div class="space-y-0.5">
                    <div class="text-2xl sm:text-3xl font-extrabold text-amber-400">{{ $settings['experience_years'] ?? '16+' }}</div>
                    <div class="text-xs text-slate-400 font-medium">Years Experience</div>
                </div>
                <div class="space-y-0.5">
                    <div class="text-2xl sm:text-3xl font-extrabold text-white">{{ $settings['projects_completed'] ?? '1,450+' }}</div>
                    <div class="text-xs text-slate-400 font-medium">Projects Built</div>
                </div>
                <div class="space-y-0.5">
                    <div class="text-2xl sm:text-3xl font-extrabold text-amber-400">{{ $settings['warranty_years'] ?? '10-Year Rust Guarantee' }}</div>
                    <div class="text-xs text-slate-400 font-medium">Rust Guarantee</div>
                </div>
                <div class="space-y-0.5">
                    <div class="text-2xl sm:text-3xl font-extrabold text-white">FREE</div>
                    <div class="text-xs text-slate-400 font-medium">Site Visit in Kandy</div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     SERVICES & FABRICATION CAPABILITIES
========================================================================= -->
<section id="services" class="py-24 bg-[#0a0f18] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <span class="text-amber-500 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Our Craftsmanship</span>
            <h2 class="text-3xl sm:text-4xl font-black text-white uppercase tracking-tight">Precision Metalwork &amp; Structural Solutions</h2>
            <p class="text-slate-400 text-sm sm:text-base leading-relaxed">
                From high-security decorative residential entrance gates to heavy commercial factory trusses, our certified fabricators deliver engineering excellence across Sri Lanka.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1: Automated & Wrought Iron Gates -->
            <div class="glass-panel p-8 rounded-2xl border border-white/5 hover:border-amber-500/40 transition-all duration-300 group hover:-translate-y-1.5 shadow-xl">
                <div class="w-14 h-14 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-2xl mb-6 group-hover:bg-amber-500 group-hover:text-black transition-all duration-300">
                    <i class="fa-solid fa-door-closed"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-amber-400 transition-colors">Automated Driveway Gates</h3>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">
                    Hand-forged royal wrought iron gates, modern minimalist box steel gates, and cantilever sliding gates with Italian remote motor automation kits.
                </p>
                <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                    <span class="text-slate-400">Starting from <strong class="text-amber-400 font-bold">LKR 3,850/sq.ft</strong></span>
                    <a href="#estimator" class="text-amber-400 hover:text-white font-semibold flex items-center gap-1">Estimate <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
            </div>

            <!-- Service 2: Staircases & Balustrades -->
            <div class="glass-panel p-8 rounded-2xl border border-white/5 hover:border-amber-500/40 transition-all duration-300 group hover:-translate-y-1.5 shadow-xl">
                <div class="w-14 h-14 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-2xl mb-6 group-hover:bg-amber-500 group-hover:text-black transition-all duration-300">
                    <i class="fa-solid fa-stairs"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-amber-400 transition-colors">Spiral &amp; Floating Staircases</h3>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">
                    Architectural center-spine steel stairs, graceful spiral stairways, and balcony railings combined with solid teak steps and SS-304 stainless steel.
                </p>
                <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                    <span class="text-slate-400">Custom Built <strong class="text-amber-400 font-bold">from LKR 180,000</strong></span>
                    <a href="#estimator" class="text-amber-400 hover:text-white font-semibold flex items-center gap-1">Estimate <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
            </div>

            <!-- Service 3: Steel Roofs & Canopies -->
            <div class="glass-panel p-8 rounded-2xl border border-white/5 hover:border-amber-500/40 transition-all duration-300 group hover:-translate-y-1.5 shadow-xl">
                <div class="w-14 h-14 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-2xl mb-6 group-hover:bg-amber-500 group-hover:text-black transition-all duration-300">
                    <i class="fa-solid fa-warehouse"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-amber-400 transition-colors">Cantilever Canopies &amp; Roofs</h3>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">
                    Universal I-beam car porch canopies without front pillar obstructions, high-durability polycarbonate sheets, and Amano zinc-alum roof structures.
                </p>
                <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                    <span class="text-slate-400">Starting from <strong class="text-amber-400 font-bold">LKR 1,750/sq.ft</strong></span>
                    <a href="#estimator" class="text-amber-400 hover:text-white font-semibold flex items-center gap-1">Estimate <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
            </div>

            <!-- Service 4: CNC Laser Cut Screens -->
            <div class="glass-panel p-8 rounded-2xl border border-white/5 hover:border-amber-500/40 transition-all duration-300 group hover:-translate-y-1.5 shadow-xl">
                <div class="w-14 h-14 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-2xl mb-6 group-hover:bg-amber-500 group-hover:text-black transition-all duration-300">
                    <i class="fa-solid fa-border-all"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-amber-400 transition-colors">CNC Laser-Cut Panels &amp; Screens</h3>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">
                    Bespoke parametric and floral architectural screens for privacy boundaries, facade claddings, illuminated garden gates, and feature interior dividers.
                </p>
                <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                    <span class="text-slate-400">Precision Cut <strong class="text-amber-400 font-bold">from LKR 3,200/sq.ft</strong></span>
                    <a href="{{ route('catalog') }}" class="text-amber-400 hover:text-white font-semibold flex items-center gap-1">Catalog <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
            </div>

            <!-- Service 5: Window Grills & Security Enclosures -->
            <div class="glass-panel p-8 rounded-2xl border border-white/5 hover:border-amber-500/40 transition-all duration-300 group hover:-translate-y-1.5 shadow-xl">
                <div class="w-14 h-14 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-2xl mb-6 group-hover:bg-amber-500 group-hover:text-black transition-all duration-300">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-amber-400 transition-colors">Window Grills &amp; Safety Doors</h3>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">
                    Tamper-proof solid 14mm/16mm forged steel window grills, decorative diamond patterns, and reinforced double security mesh screen doors.
                </p>
                <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                    <span class="text-slate-400">Starting from <strong class="text-amber-400 font-bold">LKR 1,450/sq.ft</strong></span>
                    <a href="#estimator" class="text-amber-400 hover:text-white font-semibold flex items-center gap-1">Estimate <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
            </div>

            <!-- Service 6: Custom Steel Furniture & Industrial Works -->
            <div class="glass-panel p-8 rounded-2xl border border-white/5 hover:border-amber-500/40 transition-all duration-300 group hover:-translate-y-1.5 shadow-xl">
                <div class="w-14 h-14 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-2xl mb-6 group-hover:bg-amber-500 group-hover:text-black transition-all duration-300">
                    <i class="fa-solid fa-hammer"></i>
                </div>
                <h3 class="text-xl font-bold text-white mb-2 group-hover:text-amber-400 transition-colors">Industrial Steel &amp; Furniture</h3>
                <p class="text-slate-400 text-xs leading-relaxed mb-6">
                    Commercial warehouse mezzanine floors, heavy equipment racks, and designer industrial raw steel dining and cafe table framework.
                </p>
                <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                    <span class="text-slate-400">Custom Engineering</span>
                    <a href="{{ route('contact') }}" class="text-amber-400 hover:text-white font-semibold flex items-center gap-1">Inquire <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     LIVE METALWORK COST ESTIMATOR (ALPINE.JS INTERACTIVE CALCULATOR)
========================================================================= -->
<section id="estimator" class="py-24 bg-[#080c13] relative overflow-hidden"
         x-data="{
             projectType: 'gate',
             style: 'luxury_wrought',
             material: 'galvanized',
             length: 14,
             height: 6,
             automation: false,
             powderCoat: true,
             glassInserts: false,

             get sqft() {
                 return Math.max(1, this.length * this.height);
             },

             get baseRate() {
                 let rate = 3500;
                 if (this.projectType === 'gate') {
                     if (this.style === 'minimalist') rate = 3800;
                     else if (this.style === 'luxury_wrought') rate = 4500;
                     else if (this.style === 'laser_cut') rate = 4200;
                     else rate = 3600;
                 } else if (this.projectType === 'railing') {
                     if (this.style === 'minimalist') rate = 2800;
                     else if (this.style === 'luxury_wrought') rate = 3600;
                     else if (this.style === 'laser_cut') rate = 3400;
                     else rate = 2500;
                 } else if (this.projectType === 'canopy') {
                     if (this.style === 'minimalist') rate = 1800;
                     else if (this.style === 'luxury_wrought') rate = 2500;
                     else rate = 2200;
                 } else if (this.projectType === 'grill') {
                     rate = 1450;
                 }

                 // Material multiplier
                 if (this.material === 'stainless') rate *= 1.35;
                 else if (this.material === 'galvanized') rate *= 1.15;

                 return Math.round(rate);
             },

             get totalEstimatedCost() {
                 let total = this.sqft * this.baseRate;
                 if (this.automation && this.projectType === 'gate') total += 125000;
                 if (this.powderCoat) total += (this.sqft * 250);
                 if (this.glassInserts) total += (this.sqft * 450);
                 return Math.round(total);
             },

             get minCost() {
                 return Math.round(this.totalEstimatedCost * 0.92);
             },

             get maxCost() {
                 return Math.round(this.totalEstimatedCost * 1.08);
             },

             bookWithEstimate() {
                 // Prepopulate contact form below
                 document.getElementById('service_type_input').value = this.getServiceName();
                 document.getElementById('dimensions_input').value = this.length + 'ft x ' + this.height + 'ft (' + this.sqft + ' sq.ft)';
                 document.getElementById('estimated_budget_input').value = 'LKR ' + this.totalEstimatedCost.toLocaleString();
                 document.getElementById('contact_section').scrollIntoView({ behavior: 'smooth' });
             },

             getServiceName() {
                 let name = '';
                 if (this.projectType === 'gate') name = 'Driveway Gate';
                 else if (this.projectType === 'railing') name = 'Staircase / Balcony Railing';
                 else if (this.projectType === 'canopy') name = 'Steel Roof Canopy / Car Porch';
                 else name = 'Security Window Grills';

                 return name + ' (' + this.style.replace('_', ' ') + ')';
             }
         }">

    <!-- Ambient Spark Effect -->
    <div class="absolute -top-32 right-10 w-96 h-96 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 left-10 w-96 h-96 bg-red-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-12">
            <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3.5 py-1.5 rounded-full border border-amber-500/30">Instant Price Estimator</span>
            <h2 class="text-3xl sm:text-4xl font-black text-white uppercase tracking-tight">Calculate Your Metalwork Cost in Seconds</h2>
            <p class="text-slate-400 text-sm">
                Get an accurate real-time Sri Lankan Rupee (LKR) estimate based on custom dimensions, grade of steel, and decorative specifications.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left: Calculator Inputs -->
            <div class="lg:col-span-7 glass-panel p-6 sm:p-8 rounded-3xl border border-white/10 space-y-6 shadow-2xl">
                <!-- 1. Project Category -->
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2.5">1. Select Project Type</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                        <button type="button" @click="projectType = 'gate'" :class="projectType === 'gate' ? 'bg-amber-500 text-black border-amber-400 font-bold shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 border-white/10 hover:bg-white/10'" class="p-3 rounded-xl border text-xs text-center transition-all flex flex-col items-center gap-1.5">
                            <i class="fa-solid fa-door-closed text-base"></i>
                            <span>Entrance Gate</span>
                        </button>
                        <button type="button" @click="projectType = 'railing'" :class="projectType === 'railing' ? 'bg-amber-500 text-black border-amber-400 font-bold shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 border-white/10 hover:bg-white/10'" class="p-3 rounded-xl border text-xs text-center transition-all flex flex-col items-center gap-1.5">
                            <i class="fa-solid fa-stairs text-base"></i>
                            <span>Railings & Stairs</span>
                        </button>
                        <button type="button" @click="projectType = 'canopy'" :class="projectType === 'canopy' ? 'bg-amber-500 text-black border-amber-400 font-bold shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 border-white/10 hover:bg-white/10'" class="p-3 rounded-xl border text-xs text-center transition-all flex flex-col items-center gap-1.5">
                            <i class="fa-solid fa-warehouse text-base"></i>
                            <span>Roof Canopy</span>
                        </button>
                        <button type="button" @click="projectType = 'grill'" :class="projectType === 'grill' ? 'bg-amber-500 text-black border-amber-400 font-bold shadow-lg shadow-amber-500/20' : 'bg-white/5 text-slate-300 border-white/10 hover:bg-white/10'" class="p-3 rounded-xl border text-xs text-center transition-all flex flex-col items-center gap-1.5">
                            <i class="fa-solid fa-shield-halved text-base"></i>
                            <span>Window Grills</span>
                        </button>
                    </div>
                </div>

                <!-- 2. Style / Complexity -->
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2.5">2. Fabrication Style</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 text-xs">
                        <button type="button" @click="style = 'luxury_wrought'" :class="style === 'luxury_wrought' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400 hover:bg-white/10'" class="p-3 rounded-xl border text-left transition-all">
                            <div class="font-bold text-white mb-0.5">Wrought Iron Floral</div>
                            <div class="text-[11px] text-slate-400">Traditional scrolls &amp; spearheads</div>
                        </button>
                        <button type="button" @click="style = 'minimalist'" :class="style === 'minimalist' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400 hover:bg-white/10'" class="p-3 rounded-xl border text-left transition-all">
                            <div class="font-bold text-white mb-0.5">Modern Minimalist</div>
                            <div class="text-[11px] text-slate-400">Clean geometric square lines</div>
                        </button>
                        <button type="button" @click="style = 'laser_cut'" :class="style === 'laser_cut' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400 hover:bg-white/10'" class="p-3 rounded-xl border text-left transition-all">
                            <div class="font-bold text-white mb-0.5">CNC Laser-Cut</div>
                            <div class="text-[11px] text-slate-400">Bespoke 3mm pattern plate</div>
                        </button>
                    </div>
                </div>

                <!-- 3. Material Grade -->
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2.5">3. Material Grade</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 text-xs">
                        <button type="button" @click="material = 'galvanized'" :class="material === 'galvanized' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400 hover:bg-white/10'" class="p-3 rounded-xl border text-left transition-all">
                            <div class="font-bold text-white mb-0.5 flex items-center justify-between">
                                <span>Hot-Dip Galvanized</span>
                                <i class="fa-solid fa-circle-check text-amber-400" x-show="material === 'galvanized'"></i>
                            </div>
                            <div class="text-[11px] text-slate-400">Recommended for Kandy rains</div>
                        </button>
                        <button type="button" @click="material = 'mild_steel'" :class="material === 'mild_steel' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400 hover:bg-white/10'" class="p-3 rounded-xl border text-left transition-all">
                            <div class="font-bold text-white mb-0.5 flex items-center justify-between">
                                <span>High-Tensile MS</span>
                                <i class="fa-solid fa-circle-check text-amber-400" x-show="material === 'mild_steel'"></i>
                            </div>
                            <div class="text-[11px] text-slate-400">Standard economical choice</div>
                        </button>
                        <button type="button" @click="material = 'stainless'" :class="material === 'stainless' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400 hover:bg-white/10'" class="p-3 rounded-xl border text-left transition-all">
                            <div class="font-bold text-white mb-0.5 flex items-center justify-between">
                                <span>SS-304 Stainless</span>
                                <i class="fa-solid fa-circle-check text-amber-400" x-show="material === 'stainless'"></i>
                            </div>
                            <div class="text-[11px] text-slate-400">Rustless marine grade</div>
                        </button>
                    </div>
                </div>

                <!-- 4. Dimensions Sliders -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-black/30 p-5 rounded-2xl border border-white/5">
                    <div>
                        <div class="flex justify-between items-center text-xs font-bold text-slate-300 mb-2">
                            <span>Length / Width</span>
                            <span class="text-amber-400 text-sm font-extrabold" x-text="length + ' Feet'">14 Feet</span>
                        </div>
                        <input type="range" min="3" max="30" step="1" x-model.number="length" class="w-full accent-amber-500 cursor-pointer h-2 bg-slate-700 rounded-lg">
                        <div class="flex justify-between text-[10px] text-slate-400 mt-1">
                            <span>3 ft</span>
                            <span>30 ft</span>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center text-xs font-bold text-slate-300 mb-2">
                            <span>Height / Rise</span>
                            <span class="text-amber-400 text-sm font-extrabold" x-text="height + ' Feet'">6 Feet</span>
                        </div>
                        <input type="range" min="2" max="15" step="0.5" x-model.number="height" class="w-full accent-amber-500 cursor-pointer h-2 bg-slate-700 rounded-lg">
                        <div class="flex justify-between text-[10px] text-slate-400 mt-1">
                            <span>2 ft</span>
                            <span>15 ft</span>
                        </div>
                    </div>
                </div>

                <!-- 5. Optional Add-ons -->
                <div class="space-y-2.5">
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider">5. Optional Add-ons</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-white/5 border border-white/10 hover:border-amber-400/30 cursor-pointer transition-colors text-xs" :class="{'opacity-50 cursor-not-allowed': projectType !== 'gate'}">
                            <input type="checkbox" x-model="automation" :disabled="projectType !== 'gate'" class="rounded border-slate-700 text-amber-500 focus:ring-amber-500">
                            <div>
                                <div class="font-bold text-white">Italian Motor Kit</div>
                                <div class="text-[10px] text-slate-400">+ LKR 125,000</div>
                            </div>
                        </label>

                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-white/5 border border-white/10 hover:border-amber-400/30 cursor-pointer transition-colors text-xs">
                            <input type="checkbox" x-model="powderCoat" class="rounded border-slate-700 text-amber-500 focus:ring-amber-500">
                            <div>
                                <div class="font-bold text-white">Powder Coating</div>
                                <div class="text-[10px] text-slate-400">+ LKR 250 / sq.ft</div>
                            </div>
                        </label>

                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-white/5 border border-white/10 hover:border-amber-400/30 cursor-pointer transition-colors text-xs">
                            <input type="checkbox" x-model="glassInserts" class="rounded border-slate-700 text-amber-500 focus:ring-amber-500">
                            <div>
                                <div class="font-bold text-white">Tempered Glass</div>
                                <div class="text-[10px] text-slate-400">+ LKR 450 / sq.ft</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right: Dynamic Real-time Breakdown & Lock Button -->
            <div class="lg:col-span-5 glass-panel-amber p-6 sm:p-8 rounded-3xl border border-amber-500/30 space-y-6 shadow-2xl sticky top-28">
                <div class="flex items-center justify-between pb-4 border-b border-amber-500/20">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-300">Estimated Cost Breakdown</span>
                    <span class="px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-300 text-[11px] font-bold">100% Free Site Verification</span>
                </div>

                <!-- Main Price Display -->
                <div class="bg-black/50 p-6 rounded-2xl border border-amber-500/30 text-center space-y-1">
                    <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Estimated Price Range</span>
                    <div class="text-3xl sm:text-4xl font-black text-amber-400 tracking-tight" x-text="'LKR ' + minCost.toLocaleString() + ' - ' + maxCost.toLocaleString()">
                        LKR 340,000 - 390,000
                    </div>
                    <p class="text-[11px] text-slate-400">Includes materials, precision welding, primer &amp; on-site installation in Kandy.</p>
                </div>

                <!-- Quick Specs Table -->
                <div class="space-y-2 text-xs divide-y divide-white/5">
                    <div class="flex justify-between py-1.5 text-slate-300">
                        <span class="text-slate-400">Total Surface Area:</span>
                        <strong class="font-bold text-white" x-text="sqft + ' sq. ft (' + length + ' x ' + height + ' ft)'">84 sq. ft</strong>
                    </div>
                    <div class="flex justify-between py-1.5 text-slate-300">
                        <span class="text-slate-400">Base Rate per sq.ft:</span>
                        <strong class="font-bold text-amber-400" x-text="'LKR ' + baseRate.toLocaleString() + ' / sq.ft'">LKR 4,500 / sq.ft</strong>
                    </div>
                    <div class="flex justify-between py-1.5 text-slate-300">
                        <span class="text-slate-400">Anti-Corrosion Primer:</span>
                        <span class="text-emerald-400 font-bold"><i class="fa-solid fa-check mr-1"></i> Included (Zinc Rich)</span>
                    </div>
                    <div class="flex justify-between py-1.5 text-slate-300">
                        <span class="text-slate-400">Warranty Coverage:</span>
                        <span class="text-amber-400 font-bold">10-Year Rust Guarantee</span>
                    </div>
                    <div class="flex justify-between py-1.5 text-slate-300">
                        <span class="text-slate-400">Turnaround Time:</span>
                        <strong class="text-white font-semibold">7 – 14 Business Days</strong>
                    </div>
                </div>

                <!-- Lock & Book CTA -->
                <button type="button" @click="bookWithEstimate()" class="w-full py-4 rounded-xl font-extrabold text-sm uppercase tracking-wider bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-black shadow-glow transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-calendar-check text-lg"></i>
                    <span>Lock Estimate &amp; Book Free Site Visit</span>
                </button>

                <p class="text-center text-[11px] text-slate-400 leading-normal">
                    * Final quotation may vary depending on on-site foundation conditions, motor brands, and custom architectural ornamentation.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     FEATURED PORTFOLIO SHOWCASE
========================================================================= -->
<section id="portfolio" class="py-24 bg-[#0a0f18] relative" x-data="{ activeFilter: 'all', selectedImage: null }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-2">
                <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Masterpieces Across Sri Lanka</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white uppercase tracking-tight">Recent Featured Projects</h2>
                <p class="text-slate-400 text-sm max-w-xl">
                    Inspect the precision and finish of our custom gates, staircases, and steel canopies built for luxury villas and estates in Kandy, Digana, and beyond.
                </p>
            </div>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap items-center gap-2 text-xs font-bold">
                <button @click="activeFilter = 'all'" :class="activeFilter === 'all' ? 'bg-amber-500 text-black' : 'bg-white/5 text-slate-300 hover:bg-white/10'" class="px-4 py-2 rounded-xl transition-all">All Work</button>
                <button @click="activeFilter = 'gates'" :class="activeFilter === 'gates' ? 'bg-amber-500 text-black' : 'bg-white/5 text-slate-300 hover:bg-white/10'" class="px-4 py-2 rounded-xl transition-all">Driveway Gates</button>
                <button @click="activeFilter = 'railings'" :class="activeFilter === 'railings' ? 'bg-amber-500 text-black' : 'bg-white/5 text-slate-300 hover:bg-white/10'" class="px-4 py-2 rounded-xl transition-all">Stairs &amp; Railings</button>
                <button @click="activeFilter = 'roofing'" :class="activeFilter === 'roofing' ? 'bg-amber-500 text-black' : 'bg-white/5 text-slate-300 hover:bg-white/10'" class="px-4 py-2 rounded-xl transition-all">Roof Canopies</button>
                <button @click="activeFilter = 'laser_cut'" :class="activeFilter === 'laser_cut' ? 'bg-amber-500 text-black' : 'bg-white/5 text-slate-300 hover:bg-white/10'" class="px-4 py-2 rounded-xl transition-all">Laser Cut</button>
            </div>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredProjects as $project)
                <div x-show="activeFilter === 'all' || activeFilter === '{{ $project->category }}'"
                     x-transition.duration.300ms
                     class="group glass-panel rounded-2xl overflow-hidden border border-white/10 hover:border-amber-500/40 transition-all duration-300 flex flex-col shadow-xl">
                    <!-- Image with Hover Overlay -->
                    <div class="relative h-64 overflow-hidden cursor-pointer" @click="selectedImage = '{{ asset($project->image_url) }}'">
                        <img src="{{ asset($project->image_url) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0a0f18] via-transparent to-transparent opacity-80"></div>
                        <span class="absolute top-4 left-4 px-3 py-1 rounded-lg text-[10px] font-extrabold uppercase tracking-wider bg-black/70 backdrop-blur-md text-amber-400 border border-amber-400/30">
                            {{ $project->category_label }}
                        </span>
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity bg-black/40 backdrop-blur-xs">
                            <span class="w-12 h-12 rounded-full bg-amber-500 text-black flex items-center justify-center shadow-lg"><i class="fa-solid fa-expand text-lg"></i></span>
                        </div>
                    </div>

                    <!-- Project Info -->
                    <div class="p-6 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                            <div class="flex items-center gap-2 text-xs text-amber-400 font-medium mb-1">
                                <i class="fa-solid fa-location-dot text-[11px]"></i>
                                <span>{{ $project->location ?? 'Kandy, Sri Lanka' }}</span>
                                <span class="text-white/20">&bull;</span>
                                <span class="text-slate-400">{{ $project->completed_year }}</span>
                            </div>
                            <h3 class="text-lg font-bold text-white group-hover:text-amber-400 transition-colors leading-snug">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs text-slate-400 leading-relaxed mt-2 line-clamp-2">
                                {{ $project->description }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-white/5 flex items-center justify-between text-xs">
                            <span class="text-slate-400">Client: <strong class="text-slate-200">{{ $project->client_name ?? 'Private Client' }}</strong></span>
                            <a href="#estimator" class="text-amber-400 hover:text-white font-bold flex items-center gap-1">Inquire Similar <i class="fa-solid fa-arrow-right text-[10px]"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12 text-slate-400">No projects added yet.</div>
            @endforelse
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('portfolio') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wider bg-white/5 hover:bg-white/10 text-white border border-white/10 hover:border-amber-400/40 transition-all">
                <span>Browse All Completed Works (1,450+ Photos)</span>
                <i class="fa-solid fa-arrow-right text-amber-400"></i>
            </a>
        </div>

        <!-- Lightbox Modal -->
        <div x-show="selectedImage" x-transition.opacity.duration.200ms
             @click="selectedImage = null"
             class="fixed inset-0 z-50 bg-black/90 backdrop-blur-md flex items-center justify-center p-4">
            <div class="relative max-w-4xl max-h-[90vh]">
                <img :src="selectedImage" class="max-w-full max-h-[85vh] rounded-2xl shadow-2xl object-contain border border-white/20">
                <button @click="selectedImage = null" class="absolute -top-12 right-0 text-white hover:text-amber-400 text-2xl font-bold">
                    <i class="fa-solid fa-xmark"></i> Close
                </button>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     DESIGN PATTERN CATALOG (WITH PRODUCT CODES)
========================================================================= -->
<section id="catalog" class="py-24 bg-[#070b11] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-2">
                <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Ready-To-Fabricate</span>
                <h2 class="text-3xl sm:text-4xl font-black text-white uppercase tracking-tight">Popular Design Patterns</h2>
                <p class="text-slate-400 text-sm max-w-xl">
                    Choose from our proven architectural master patterns. Mention the design code when contacting us for accelerated fabrication and standardized pricing.
                </p>
            </div>

            <a href="{{ route('catalog') }}" class="text-amber-400 hover:text-amber-300 text-xs font-bold uppercase tracking-wider flex items-center gap-1.5">
                <span>View Full Catalog</span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <!-- Catalog Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($catalogItems as $item)
                <div class="glass-panel rounded-2xl overflow-hidden border border-white/5 hover:border-amber-400/40 transition-all duration-300 flex flex-col group shadow-lg">
                    <div class="relative h-44 overflow-hidden bg-black">
                        <img src="{{ asset($item->image_url ?? '/images/showcase/luxury_gate.jpg') }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase tracking-wider bg-black/80 backdrop-blur-md text-amber-400 border border-amber-400/30">
                            {{ $item->code }}
                        </span>
                    </div>

                    <div class="p-5 flex-1 flex flex-col justify-between space-y-3">
                        <div>
                            <div class="text-[10px] text-slate-400 uppercase font-semibold">{{ $item->category_label }} &bull; {{ $item->material }}</div>
                            <h4 class="text-sm font-bold text-white mt-1 group-hover:text-amber-400 transition-colors line-clamp-1">{{ $item->title }}</h4>
                            <p class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $item->description }}</p>
                        </div>

                        <div class="pt-3 border-t border-white/5 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 block">Base Rate</span>
                                <strong class="text-xs font-bold text-amber-400">LKR {{ number_format($item->base_price_lkr) }} / {{ $item->price_unit }}</strong>
                            </div>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '94771234567') }}?text=Hello%20{{ urlencode($settings['workshop_name'] ?? 'Kandy Iron Works') }},%20I%20am%20interested%20in%20design%20code%20{{ $item->code }}%20({{ urlencode($item->title) }})." target="_blank" class="px-2.5 py-1.5 rounded-lg bg-white/5 hover:bg-emerald-600 text-slate-300 hover:text-white text-[11px] font-semibold transition-colors flex items-center gap-1">
                                <i class="fa-brands fa-whatsapp text-xs"></i> Order
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-8 text-slate-400">No catalog items configured.</div>
            @endforelse
        </div>
    </div>
</section>


<!-- =========================================================================
     WHY CHOOSE KANDY IRON WORKS
========================================================================= -->
<section class="py-24 bg-[#0a0f18] relative border-y border-white/5">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto space-y-3 mb-16">
            <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Engineering Superiority</span>
            <h2 class="text-3xl sm:text-4xl font-black text-white uppercase tracking-tight">The Kandy Iron Works Standard</h2>
            <p class="text-slate-400 text-sm">
                Why luxury homeowners, architects, and government contractors across Central Province trust us with their critical steelwork.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="glass-panel p-6 rounded-2xl border border-white/5 hover:border-amber-500/30 transition-all space-y-3">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-xl font-bold">
                    <i class="fa-solid fa-cube"></i>
                </div>
                <h4 class="text-base font-bold text-white">3D CAD Modeling</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Review photo-realistic 3D design renders and exact laser measurements before any steel is cut or welded at our workshop.
                </p>
            </div>

            <div class="glass-panel p-6 rounded-2xl border border-white/5 hover:border-amber-500/30 transition-all space-y-3">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-xl font-bold">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h4 class="text-base font-bold text-white">10-Year Rust Guarantee</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    Hot-dip galvanizing followed by dual-coat zinc phosphate epoxy primer withstands Kandy's misty hill-country climate without corrosion.
                </p>
            </div>

            <div class="glass-panel p-6 rounded-2xl border border-white/5 hover:border-amber-500/30 transition-all space-y-3">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-xl font-bold">
                    <i class="fa-solid fa-certificate"></i>
                </div>
                <h4 class="text-base font-bold text-white">Certified High-Tensile Steel</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    We fabricate strictly using certified heavy-gauge hollow sections, solid square rods, and certified universal I-beams. No cheap recycled metals.
                </p>
            </div>

            <div class="glass-panel p-6 rounded-2xl border border-white/5 hover:border-amber-500/30 transition-all space-y-3">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-xl font-bold">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
                <h4 class="text-base font-bold text-white">Turnkey Site Erection</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    From foundation anchor bolting to quiet Italian automation motor setup and electrical testing, we handle complete on-site installation.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- =========================================================================
     CLIENT TESTIMONIALS
========================================================================= -->
<section class="py-24 bg-[#070b11] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto space-y-3 mb-16">
            <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Verified Feedback</span>
            <h2 class="text-3xl sm:text-4xl font-black text-white uppercase tracking-tight">What Our Clients Say</h2>
            <div class="flex items-center justify-center gap-1 text-amber-400 text-sm">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <span class="text-slate-300 font-bold ml-2 text-xs">4.9 / 5.0 on Google Reviews</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($testimonials as $review)
                <div class="glass-panel p-6 rounded-2xl border border-white/5 flex flex-col justify-between space-y-4 hover:border-amber-400/30 transition-all">
                    <div class="space-y-3">
                        <div class="flex items-center gap-1 text-amber-400 text-xs">
                            @for($i = 0; $i < $review->rating; $i++)
                                <i class="fa-solid fa-star"></i>
                            @endfor
                        </div>
                        <p class="text-xs text-slate-300 leading-relaxed italic">
                            "{{ $review->comment }}"
                        </p>
                    </div>

                    <div class="pt-3 border-t border-white/5">
                        <h5 class="text-xs font-bold text-white">{{ $review->client_name }}</h5>
                        <div class="text-[11px] text-amber-400">{{ $review->client_role ?? 'Client' }} &bull; {{ $review->location }}</div>
                    </div>
                </div>
            @empty
                <div class="col-span-4 text-center py-8 text-slate-400">No testimonials yet.</div>
            @endforelse
        </div>
    </div>
</section>


<!-- =========================================================================
     INTERACTIVE CONTACT & FREE SITE MEASUREMENT BOOKING FORM
========================================================================= -->
<section id="contact_section" class="py-24 bg-[#0a0f18] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left: Workshop Details & Info -->
            <div class="lg:col-span-5 space-y-8">
                <div class="space-y-3">
                    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Get In Touch</span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white uppercase tracking-tight">Book A Free Site Inspection</h2>
                    <p class="text-slate-400 text-sm leading-relaxed">
                        Our master fabricator will visit your location in Kandy, Peradeniya, Katugastota, Kundasale, or anywhere in Central Province to take exact laser measurements and give you a written quotation with no obligation.
                    </p>
                </div>

                <div class="space-y-4 text-xs">
                    <div class="glass-panel p-4 rounded-xl flex items-start gap-3.5 border border-white/5">
                        <div class="w-10 h-10 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0 text-base">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <strong class="text-white block text-sm mb-0.5">Workshop &amp; Fabrication Yard</strong>
                            <span class="text-slate-400">{{ $settings['address'] ?? 'No. 142, William Gopallawa Mawatha, Kandy, Sri Lanka' }}</span>
                        </div>
                    </div>

                    <div class="glass-panel p-4 rounded-xl flex items-start gap-3.5 border border-white/5">
                        <div class="w-10 h-10 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0 text-base">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <strong class="text-white block text-sm mb-0.5">Phone &amp; Hotline</strong>
                            <div class="space-x-3 text-slate-300">
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['phone_primary'] ?? '+94812234567') }}" class="hover:text-amber-400">{{ $settings['phone_primary'] ?? '+94 81 223 4567' }}</a>
                                <span class="text-white/20">|</span>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['phone_mobile'] ?? '+94771234567') }}" class="hover:text-amber-400">{{ $settings['phone_mobile'] ?? '+94 77 123 4567' }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="glass-panel p-4 rounded-xl flex items-start gap-3.5 border border-white/5">
                        <div class="w-10 h-10 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center shrink-0 text-base">
                            <i class="fa-brands fa-whatsapp"></i>
                        </div>
                        <div>
                            <strong class="text-white block text-sm mb-0.5">Direct WhatsApp Support</strong>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings['whatsapp_number'] ?? '94771234567') }}?text=Hi%20{{ urlencode($settings['workshop_name'] ?? 'Kandy Iron Works') }}!%20I%20am%20contacting%20you%20from%20your%20website." target="_blank" class="text-emerald-400 hover:underline">
                                {{ $settings['phone_mobile'] ?? ($settings['whatsapp_number'] ?? '+94 77 123 4567') }} (Instant Replies)
                            </a>
                        </div>
                    </div>

                    <div class="glass-panel p-4 rounded-xl flex items-start gap-3.5 border border-white/5">
                        <div class="w-10 h-10 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0 text-base">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <strong class="text-white block text-sm mb-0.5">Operating Hours</strong>
                            <span class="text-slate-400">{{ $settings['working_hours'] ?? 'Monday – Saturday: 8:00 AM – 6:30 PM (Sunday by appointment)' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Card -->
                <div class="rounded-2xl overflow-hidden border border-white/10 shadow-xl h-48 bg-black/40 relative">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5979507936653!2d80.62772597479768!3d7.286524313837923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae366324a350179%3A0xe54d8ec561110034!2sWilliam%20Gopallawa%20Mawatha%2C%20Kandy!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk" width="100%" height="100%" style="border:0; filter: grayscale(85%) invert(90%) contrast(120%);" allowfullscreen="" loading="lazy"></iframe>
                    <div class="absolute bottom-2 left-2 px-2.5 py-1 rounded bg-black/80 text-[10px] text-amber-400 font-bold border border-white/10">
                        <i class="fa-solid fa-location-dot mr-1"></i> William Gopallawa Mw, Kandy
                    </div>
                </div>
            </div>

            <!-- Right: Interactive Booking Form -->
            <div class="lg:col-span-7 glass-panel p-8 sm:p-10 rounded-3xl border border-white/10 shadow-2xl">
                <h3 class="text-2xl font-black text-white uppercase tracking-tight mb-2">Request Quote / Book Visit</h3>
                <p class="text-xs text-slate-400 mb-8">Fill out the details below. We typically contact you within 2 hours to confirm your appointment.</p>

                <form action="{{ route('inquire.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="source" value="website_home">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Your Name <span class="text-amber-400">*</span></label>
                            <input type="text" name="name" required placeholder="e.g. Mr. Bandara" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Phone / WhatsApp <span class="text-amber-400">*</span></label>
                            <input type="text" name="phone" required placeholder="e.g. 077 123 4567" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Email Address (Optional)</label>
                            <input type="email" name="email" placeholder="e.g. name@gmail.com" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Site Location / City</label>
                            <input type="text" name="location" placeholder="e.g. Peradeniya, Kandy" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Service Needed <span class="text-amber-400">*</span></label>
                            <input type="text" id="service_type_input" name="service_type" required placeholder="e.g. Sliding Gate" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Dimensions (Approx.)</label>
                            <input type="text" id="dimensions_input" name="dimensions" placeholder="e.g. 14ft x 6ft" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Estimated Budget</label>
                            <input type="text" id="estimated_budget_input" name="estimated_budget" placeholder="e.g. LKR 350,000" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Special Requirements / Notes</label>
                        <textarea name="message" rows="3" placeholder="Tell us about your site, preferences, preferred design code, or timeline..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400 focus:ring-1 focus:ring-amber-400"></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 rounded-xl font-extrabold text-sm uppercase tracking-wider bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-black shadow-glow transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane text-base"></i>
                        <span>Submit Free Quote Request</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('heroBgVideo');
    const videoToggle = document.getElementById('heroVideoToggle');
    const audioToggle = document.getElementById('heroAudioToggle');
    const videoPrev = document.getElementById('heroVideoPrev');
    const videoNext = document.getElementById('heroVideoNext');
    const videoIcon = document.getElementById('videoToggleIcon');
    const audioIcon = document.getElementById('audioToggleIcon');
    const videoDot = document.getElementById('videoLiveDot');
    const statusText = document.getElementById('videoStatusText');
    const clipCounter = document.getElementById('videoClipCounter');
    const clipDots = document.querySelectorAll('.clip-dot');

    const videoClips = [
        {
            title: 'Steel Forging',
            subtitle: 'Master Forge & Anvil Hammering',
            src: '{{ asset("videos/hero_forge.webm") }}'
        },
        {
            title: 'MIG Welding',
            subtitle: 'Precision Electric Arc & Sparks',
            src: '{{ asset("videos/hero_mig_welding.webm") }}'
        },
        {
            title: 'Metal Fabrication',
            subtitle: 'Workshop Assembly & Craftsmanship',
            src: '{{ asset("videos/hero_fabrication.webm") }}'
        }
    ];

    let currentClipIndex = 0;
    let autoRotateInterval = null;

    if (video) {
        video.muted = true;
        video.defaultMuted = true;
        video.playsInline = true;

        const updateUI = function(index) {
            const clip = videoClips[index];
            if (statusText) statusText.textContent = clip.title;
            if (clipCounter) clipCounter.textContent = `Clip ${index + 1} of ${videoClips.length}`;

            clipDots.forEach((dot, idx) => {
                if (idx === index) {
                    dot.className = 'clip-dot h-1.5 rounded-full transition-all duration-300 w-6 bg-amber-400';
                } else {
                    dot.className = 'clip-dot h-1.5 rounded-full transition-all duration-300 w-2 bg-white/30 hover:bg-white/60';
                }
            });
        };

        const loadClip = function(index, userAction = false) {
            if (index < 0) index = videoClips.length - 1;
            if (index >= videoClips.length) index = 0;
            currentClipIndex = index;

            const clip = videoClips[currentClipIndex];
            video.style.opacity = '0.35';

            setTimeout(function() {
                video.src = clip.src;
                video.load();
                video.play().then(function() {
                    video.style.opacity = '1';
                    if (videoIcon) videoIcon.className = 'fa-solid fa-pause text-xs';
                    if (videoDot) {
                        videoDot.classList.remove('bg-slate-500');
                        videoDot.classList.add('bg-amber-400', 'animate-pulse');
                    }
                }).catch(function(err) {
                    console.log('Playback error/block:', err);
                    video.style.opacity = '1';
                });
                updateUI(currentClipIndex);
            }, 200);

            if (userAction) {
                resetAutoRotate();
            }
        };

        const attemptAutoplay = function() {
            video.muted = true;
            const playPromise = video.play();
            if (playPromise !== undefined) {
                playPromise.then(function() {
                    if (videoIcon) videoIcon.className = 'fa-solid fa-pause text-xs';
                    if (videoDot) {
                        videoDot.classList.remove('bg-slate-500');
                        videoDot.classList.add('bg-amber-400', 'animate-pulse');
                    }
                }).catch(function() {
                    if (videoIcon) videoIcon.className = 'fa-solid fa-play text-xs';
                    if (videoDot) {
                        videoDot.classList.remove('bg-amber-400', 'animate-pulse');
                        videoDot.classList.add('bg-slate-500');
                    }
                });
            }
        };

        const resetAutoRotate = function() {
            if (autoRotateInterval) clearInterval(autoRotateInterval);
            autoRotateInterval = setInterval(function() {
                if (!video.paused) {
                    loadClip(currentClipIndex + 1);
                }
            }, 18000);
        };

        // Initialize first clip
        updateUI(0);
        attemptAutoplay();
        resetAutoRotate();

        // Autoplay on first click anywhere if initial autoplay was blocked by browser
        document.addEventListener('click', function onFirstClick() {
            if (video.paused) {
                video.muted = true;
                attemptAutoplay();
            }
            document.removeEventListener('click', onFirstClick);
        }, { once: true });

        // When a video finishes naturally, seamlessly advance to next clip!
        video.addEventListener('ended', function() {
            loadClip(currentClipIndex + 1);
        });

        // Next Clip Button
        if (videoNext) {
            videoNext.addEventListener('click', function(e) {
                e.stopPropagation();
                loadClip(currentClipIndex + 1, true);
            });
        }

        // Previous Clip Button
        if (videoPrev) {
            videoPrev.addEventListener('click', function(e) {
                e.stopPropagation();
                loadClip(currentClipIndex - 1, true);
            });
        }

        // Clip Dot Selectors
        clipDots.forEach((dot) => {
            dot.addEventListener('click', function(e) {
                e.stopPropagation();
                const targetIndex = parseInt(this.getAttribute('data-clip'), 10);
                if (!isNaN(targetIndex) && targetIndex !== currentClipIndex) {
                    loadClip(targetIndex, true);
                }
            });
        });

        // Play / Pause Toggle
        if (videoToggle) {
            videoToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                if (video.paused) {
                    video.play();
                    if (videoIcon) videoIcon.className = 'fa-solid fa-pause text-xs';
                    if (videoDot) {
                        videoDot.classList.remove('bg-slate-500');
                        videoDot.classList.add('bg-amber-400', 'animate-pulse');
                    }
                } else {
                    video.pause();
                    if (videoIcon) videoIcon.className = 'fa-solid fa-play text-xs';
                    if (videoDot) {
                        videoDot.classList.remove('bg-amber-400', 'animate-pulse');
                        videoDot.classList.add('bg-slate-500');
                    }
                }
            });
        }

        // Audio Mute / Unmute Toggle
        if (audioToggle) {
            audioToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                if (video.muted) {
                    video.muted = false;
                    if (audioIcon) audioIcon.className = 'fa-solid fa-volume-high text-xs text-amber-400';
                    audioToggle.title = 'Mute Sound';
                } else {
                    video.muted = true;
                    if (audioIcon) audioIcon.className = 'fa-solid fa-volume-xmark text-xs';
                    audioToggle.title = 'Unmute Sound';
                }
            });
        }
    }
});
</script>
@endpush
