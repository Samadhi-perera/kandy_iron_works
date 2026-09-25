@extends('layouts.public')

@section('title', 'Contact Workshop & Location | Kandy Iron Works')
@section('meta_description', 'Visit our metal fabrication workshop on William Gopallawa Mawatha, Kandy or contact us for free site measurement in Central Province.')

@section('content')
<div class="py-16 bg-[#070b11]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-4 mb-12">
            <span class="text-amber-400 text-xs font-bold uppercase tracking-widest bg-amber-500/10 px-3 py-1 rounded-full border border-amber-500/20">Kandy Fabrication Yard</span>
            <h1 class="text-4xl sm:text-5xl font-black text-white uppercase tracking-tight">Contact &amp; Visit Us</h1>
            <p class="text-slate-400 text-sm leading-relaxed">
                Have a new residence under construction or commercial steel project? Visit our fabrication yard in Kandy or book a free on-site consultation.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Left Info Cards -->
            <div class="lg:col-span-5 space-y-6">
                <div class="glass-panel p-6 rounded-2xl border border-white/5 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-xl font-bold">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-white">Workshop Address</h4>
                            <p class="text-xs text-slate-400">Centrally located on William Gopallawa Mawatha</p>
                        </div>
                    </div>
                    <p class="text-sm text-slate-200 pl-1">
                        No. 142, William Gopallawa Mawatha, Kandy, Sri Lanka
                    </p>
                    <div class="pt-2 flex items-center gap-3">
                        <a href="https://maps.google.com/?q=William+Gopallawa+Mawatha+Kandy" target="_blank" class="px-4 py-2 rounded-xl bg-white/5 hover:bg-white/10 text-amber-400 text-xs font-bold transition-all flex items-center gap-1.5 border border-white/10">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i> Open in Google Maps
                        </a>
                    </div>
                </div>

                <div class="glass-panel p-6 rounded-2xl border border-white/5 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-xl font-bold">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-white">Direct Phone Hotlines</h4>
                            <p class="text-xs text-slate-400">Speak directly with our chief fabricator</p>
                        </div>
                    </div>
                    <div class="space-y-2 text-sm text-slate-200">
                        <div class="flex justify-between items-center py-1 border-b border-white/5">
                            <span class="text-slate-400 text-xs">Workshop Landline:</span>
                            <a href="tel:+94812234567" class="font-bold text-amber-400 hover:underline">+94 81 223 4567</a>
                        </div>
                        <div class="flex justify-between items-center py-1 border-b border-white/5">
                            <span class="text-slate-400 text-xs">Engineer Direct Mobile:</span>
                            <a href="tel:+94771234567" class="font-bold text-amber-400 hover:underline">+94 77 123 4567</a>
                        </div>
                        <div class="flex justify-between items-center py-1">
                            <span class="text-slate-400 text-xs">WhatsApp Business:</span>
                            <a href="https://wa.me/94771234567" target="_blank" class="font-bold text-emerald-400 hover:underline">+94 77 123 4567</a>
                        </div>
                    </div>
                </div>

                <div class="glass-panel p-6 rounded-2xl border border-white/5 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center text-amber-400 text-xl font-bold">
                            <i class="fa-solid fa-clock"></i>
                        </div>
                        <div>
                            <h4 class="text-base font-bold text-white">Working Hours</h4>
                            <p class="text-xs text-slate-400">Visiting times</p>
                        </div>
                    </div>
                    <div class="space-y-1.5 text-xs text-slate-300">
                        <div class="flex justify-between py-1 border-b border-white/5">
                            <span>Monday – Friday:</span>
                            <strong class="text-white">8:00 AM – 6:30 PM</strong>
                        </div>
                        <div class="flex justify-between py-1 border-b border-white/5">
                            <span>Saturday:</span>
                            <strong class="text-white">8:00 AM – 5:00 PM</strong>
                        </div>
                        <div class="flex justify-between py-1 text-amber-400">
                            <span>Sunday:</span>
                            <span>On-Site Consultations by Appointment</span>
                        </div>
                    </div>
                </div>

                <!-- Google Map Embed -->
                <div class="rounded-2xl overflow-hidden border border-white/10 shadow-xl h-64 bg-black/40">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5979507936653!2d80.62772597479768!3d7.286524313837923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae366324a350179%3A0xe54d8ec561110034!2sWilliam%20Gopallawa%20Mawatha%2C%20Kandy!5e0!3m2!1sen!2slk!4v1700000000000!5m2!1sen!2slk" width="100%" height="100%" style="border:0; filter: grayscale(85%) invert(90%) contrast(120%);" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>

            <!-- Right Interactive Form -->
            <div class="lg:col-span-7 glass-panel p-8 sm:p-10 rounded-3xl border border-white/10 shadow-2xl">
                <h3 class="text-2xl font-black text-white uppercase tracking-tight mb-2">Send Message / Request Quote</h3>
                <p class="text-xs text-slate-400 mb-8">We respond promptly to all project inquiries within Central Province.</p>

                <form action="{{ route('inquire.submit') }}" method="POST" class="space-y-5">
                    @csrf
                    <input type="hidden" name="source" value="contact_page">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Full Name <span class="text-amber-400">*</span></label>
                            <input type="text" name="name" required placeholder="Your name" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Phone / Mobile <span class="text-amber-400">*</span></label>
                            <input type="text" name="phone" required placeholder="077 123 4567" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Email Address</label>
                            <input type="email" name="email" placeholder="email@example.com" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Site Location</label>
                            <input type="text" name="location" placeholder="e.g. Kandy Lake Round / Peradeniya" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Service Type <span class="text-amber-400">*</span></label>
                            <select name="service_type" required class="w-full bg-[#121926] border border-white/10 rounded-xl px-4 py-3 text-sm text-white focus:outline-none focus:border-amber-400">
                                <option value="Automated Driveway Gate">Automated Driveway Gate</option>
                                <option value="Wrought Iron Swing Gate">Wrought Iron Swing Gate</option>
                                <option value="Spiral / Floating Staircase">Spiral / Floating Staircase</option>
                                <option value="Balcony Safety Railings">Balcony Safety Railings</option>
                                <option value="Steel Car Porch Canopy">Steel Car Porch Canopy</option>
                                <option value="Commercial Roof Truss">Commercial Roof Truss</option>
                                <option value="CNC Laser-Cut Screen">CNC Laser-Cut Screen</option>
                                <option value="Window Security Grills">Window Security Grills</option>
                                <option value="Custom Industrial Fabrication">Custom Industrial Fabrication</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Approx Dimensions / Quantity</label>
                            <input type="text" name="dimensions" placeholder="e.g. 15ft width x 6ft height" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-wider mb-2">Message or Design Preferences</label>
                        <textarea name="message" rows="4" placeholder="Mention any specific design motifs, motor automation needs, or site access details..." class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-sm text-white placeholder-slate-500 focus:outline-none focus:border-amber-400"></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 rounded-xl font-extrabold text-sm uppercase tracking-wider bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 text-black shadow-glow transition-all flex items-center justify-center gap-2">
                        <i class="fa-solid fa-paper-plane text-base"></i>
                        <span>Send Inquiry</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
