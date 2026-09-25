@extends('layouts.public')

@section('title', 'Instant Metalwork Cost Estimator | Kandy Iron Works')
@section('meta_description', 'Calculate real-time prices for custom wrought iron gates, spiral stairs, car porch canopies and window grills in Sri Lankan Rupees.')

@section('content')
<div class="py-16 bg-[#070b11]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-4 mb-12">
            <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Interactive Estimator</span>
            <h1 class="text-4xl sm:text-5xl font-black text-white uppercase tracking-tight">Metalwork Price Calculator</h1>
            <p class="text-slate-400 text-sm leading-relaxed">
                Configure your project dimensions, desired material grade, and optional additions. We give you instant realistic Sri Lankan pricing based on our live workshop steel tariffs.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start"
             x-data="{
                 projectType: 'gate',
                 style: 'luxury_wrought',
                 material: 'galvanized',
                 length: 16,
                 height: 6.5,
                 automation: true,
                 powderCoat: true,
                 glassInserts: false,

                 get sqft() {
                     return Math.max(1, Math.round(this.length * this.height));
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

                 populateForm() {
                     document.getElementById('service_type_input').value = this.projectType.toUpperCase() + ' (' + this.style.replace('_', ' ') + ')';
                     document.getElementById('dimensions_input').value = this.length + 'ft x ' + this.height + 'ft (' + this.sqft + ' sq.ft)';
                     document.getElementById('estimated_budget_input').value = 'LKR ' + this.totalEstimatedCost.toLocaleString();
                     document.getElementById('book_form_container').scrollIntoView({ behavior: 'smooth' });
                 }
             }">

            <!-- Left Form Controls -->
            <div class="lg:col-span-7 glass-panel p-8 rounded-3xl border border-white/10 space-y-6 shadow-2xl">
                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2.5">1. Category</label>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5">
                        <button type="button" @click="projectType = 'gate'" :class="projectType === 'gate' ? 'bg-amber-500 text-black border-amber-400 font-bold' : 'bg-white/5 text-slate-300 border-white/10'" class="p-3 rounded-xl border text-xs text-center transition-all flex flex-col items-center gap-1">
                            <i class="fa-solid fa-door-closed text-base"></i>
                            <span>Entrance Gate</span>
                        </button>
                        <button type="button" @click="projectType = 'railing'" :class="projectType === 'railing' ? 'bg-amber-500 text-black border-amber-400 font-bold' : 'bg-white/5 text-slate-300 border-white/10'" class="p-3 rounded-xl border text-xs text-center transition-all flex flex-col items-center gap-1">
                            <i class="fa-solid fa-stairs text-base"></i>
                            <span>Railings & Stairs</span>
                        </button>
                        <button type="button" @click="projectType = 'canopy'" :class="projectType === 'canopy' ? 'bg-amber-500 text-black border-amber-400 font-bold' : 'bg-white/5 text-slate-300 border-white/10'" class="p-3 rounded-xl border text-xs text-center transition-all flex flex-col items-center gap-1">
                            <i class="fa-solid fa-warehouse text-base"></i>
                            <span>Roof Canopy</span>
                        </button>
                        <button type="button" @click="projectType = 'grill'" :class="projectType === 'grill' ? 'bg-amber-500 text-black border-amber-400 font-bold' : 'bg-white/5 text-slate-300 border-white/10'" class="p-3 rounded-xl border text-xs text-center transition-all flex flex-col items-center gap-1">
                            <i class="fa-solid fa-shield-halved text-base"></i>
                            <span>Window Grills</span>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2.5">2. Style &amp; Ornamentation</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 text-xs">
                        <button type="button" @click="style = 'luxury_wrought'" :class="style === 'luxury_wrought' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400'" class="p-3 rounded-xl border text-left">
                            <div class="font-bold text-white mb-0.5">Wrought Iron Floral</div>
                            <div class="text-[11px] text-slate-400">Hand forged scrolls</div>
                        </button>
                        <button type="button" @click="style = 'minimalist'" :class="style === 'minimalist' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400'" class="p-3 rounded-xl border text-left">
                            <div class="font-bold text-white mb-0.5">Minimalist Linear</div>
                            <div class="text-[11px] text-slate-400">Clean modern lines</div>
                        </button>
                        <button type="button" @click="style = 'laser_cut'" :class="style === 'laser_cut' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400'" class="p-3 rounded-xl border text-left">
                            <div class="font-bold text-white mb-0.5">CNC Laser Screen</div>
                            <div class="text-[11px] text-slate-400">3mm parametric plate</div>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2.5">3. Material</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2.5 text-xs">
                        <button type="button" @click="material = 'galvanized'" :class="material === 'galvanized' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400'" class="p-3 rounded-xl border text-left">
                            <div class="font-bold text-white mb-0.5">Hot-Dip Galvanized</div>
                            <div class="text-[11px] text-slate-400">Anti-rust guaranteed</div>
                        </button>
                        <button type="button" @click="material = 'mild_steel'" :class="material === 'mild_steel' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400'" class="p-3 rounded-xl border text-left">
                            <div class="font-bold text-white mb-0.5">High-Tensile MS</div>
                            <div class="text-[11px] text-slate-400">Budget friendly</div>
                        </button>
                        <button type="button" @click="material = 'stainless'" :class="material === 'stainless' ? 'border-amber-400 bg-amber-500/20 text-amber-300 font-semibold' : 'border-white/10 bg-white/5 text-slate-400'" class="p-3 rounded-xl border text-left">
                            <div class="font-bold text-white mb-0.5">SS-304 Stainless</div>
                            <div class="text-[11px] text-slate-400">Premium luxury finish</div>
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-black/30 p-5 rounded-2xl border border-white/5">
                    <div>
                        <div class="flex justify-between items-center text-xs font-bold text-slate-300 mb-2">
                            <span>Length / Width</span>
                            <span class="text-amber-400 text-sm font-extrabold" x-text="length + ' Feet'">16 Feet</span>
                        </div>
                        <input type="range" min="3" max="30" step="1" x-model.number="length" class="w-full accent-amber-500 cursor-pointer h-2 bg-slate-700 rounded-lg">
                    </div>

                    <div>
                        <div class="flex justify-between items-center text-xs font-bold text-slate-300 mb-2">
                            <span>Height / Rise</span>
                            <span class="text-amber-400 text-sm font-extrabold" x-text="height + ' Feet'">6.5 Feet</span>
                        </div>
                        <input type="range" min="2" max="15" step="0.5" x-model.number="height" class="w-full accent-amber-500 cursor-pointer h-2 bg-slate-700 rounded-lg">
                    </div>
                </div>

                <div class="space-y-2.5">
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider">4. Options</label>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-white/5 border border-white/10 cursor-pointer text-xs" :class="{'opacity-50': projectType !== 'gate'}">
                            <input type="checkbox" x-model="automation" :disabled="projectType !== 'gate'" class="rounded border-slate-700 text-amber-500">
                            <div>
                                <div class="font-bold text-white">Italian Motor Kit</div>
                                <div class="text-[10px] text-slate-400">+ LKR 125,000</div>
                            </div>
                        </label>

                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-white/5 border border-white/10 cursor-pointer text-xs">
                            <input type="checkbox" x-model="powderCoat" class="rounded border-slate-700 text-amber-500">
                            <div>
                                <div class="font-bold text-white">Powder Coating</div>
                                <div class="text-[10px] text-slate-400">+ LKR 250 / sq.ft</div>
                            </div>
                        </label>

                        <label class="flex items-center gap-2.5 p-3 rounded-xl bg-white/5 border border-white/10 cursor-pointer text-xs">
                            <input type="checkbox" x-model="glassInserts" class="rounded border-slate-700 text-amber-500">
                            <div>
                                <div class="font-bold text-white">Tempered Glass</div>
                                <div class="text-[10px] text-slate-400">+ LKR 450 / sq.ft</div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Estimate Display -->
            <div class="lg:col-span-5 glass-panel-amber p-8 rounded-3xl border border-amber-500/30 space-y-6 shadow-2xl sticky top-28">
                <div class="bg-black/50 p-6 rounded-2xl border border-amber-500/30 text-center space-y-1">
                    <span class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Live Calculated Range</span>
                    <div class="text-3xl sm:text-4xl font-black text-amber-400 tracking-tight" x-text="'LKR ' + minCost.toLocaleString() + ' - ' + maxCost.toLocaleString()">
                        LKR 380,000 - 440,000
                    </div>
                    <p class="text-[11px] text-slate-400">Total Sq. Footage: <strong class="text-white" x-text="sqft + ' sq. ft'">104 sq. ft</strong></p>
                </div>

                <div class="space-y-2 text-xs divide-y divide-white/5">
                    <div class="flex justify-between py-1.5 text-slate-300">
                        <span class="text-slate-400">Base Fabrication Rate:</span>
                        <strong class="font-bold text-white" x-text="'LKR ' + baseRate.toLocaleString() + ' / sq.ft'"></strong>
                    </div>
                    <div class="flex justify-between py-1.5 text-slate-300">
                        <span class="text-slate-400">Zinc Anti-Rust Primer:</span>
                        <span class="text-emerald-400 font-bold"><i class="fa-solid fa-check mr-1"></i> Included</span>
                    </div>
                    <div class="flex justify-between py-1.5 text-slate-300">
                        <span class="text-slate-400">Kandy On-Site Installation:</span>
                        <span class="text-emerald-400 font-bold"><i class="fa-solid fa-check mr-1"></i> Included</span>
                    </div>
                    <div class="flex justify-between py-1.5 text-slate-300">
                        <span class="text-slate-400">Warranty Coverage:</span>
                        <span class="text-amber-400 font-bold">10-Year Rust Guarantee</span>
                    </div>
                </div>

                <button type="button" @click="populateForm()" class="w-full py-4 rounded-xl font-extrabold text-sm uppercase tracking-wider bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 text-black shadow-glow transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-calendar-check text-lg"></i>
                    <span>Pre-fill &amp; Book Site Visit</span>
                </button>
            </div>
        </div>

        <!-- Booking Form Container -->
        <div id="book_form_container" class="mt-20 glass-panel p-8 sm:p-10 rounded-3xl border border-white/10 shadow-2xl max-w-4xl mx-auto">
            <h3 class="text-2xl font-black text-white uppercase tracking-tight mb-2">Book Your Free Site Inspection</h3>
            <p class="text-xs text-slate-400 mb-8">Confirm your contact information below. Our master welder will contact you to schedule an inspection.</p>

            <form action="{{ route('inquire.submit') }}" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="source" value="cost_estimator_page">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Full Name <span class="text-amber-400">*</span></label>
                        <input type="text" name="name" required placeholder="Mr. Dissanayake" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Phone / WhatsApp Number <span class="text-amber-400">*</span></label>
                        <input type="text" name="phone" required placeholder="077 123 4567" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Email Address (Optional)</label>
                        <input type="email" name="email" placeholder="client@gmail.com" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Site Location / City in Central Province</label>
                        <input type="text" name="location" placeholder="e.g. Kundasale / Kandy" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Configured Service</label>
                        <input type="text" id="service_type_input" name="service_type" required value="Driveway Gate (luxury wrought)" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-400">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Calculated Dimensions</label>
                        <input type="text" id="dimensions_input" name="dimensions" value="16ft x 6.5ft (104 sq.ft)" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-400">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Estimated Budget</label>
                        <input type="text" id="estimated_budget_input" name="estimated_budget" value="LKR 410,000" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-400">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Additional Project Details</label>
                    <textarea name="message" rows="3" placeholder="Tell us if you have architectural drawings, site constraints, or urgent deadlines..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400"></textarea>
                </div>

                <button type="submit" class="w-full py-4 rounded-xl font-extrabold text-sm uppercase tracking-wider bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 text-black shadow-glow transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-paper-plane text-base"></i>
                    <span>Submit &amp; Schedule Inspection</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
