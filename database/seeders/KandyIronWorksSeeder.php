<?php

namespace Database\Seeders;

use App\Models\CatalogItem;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class KandyIronWorksSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@kandyironworks.com'],
            [
                'name' => 'Eng. Sanjaya Perera',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'phone' => '+94 77 123 4567',
                'email_verified_at' => now(),
            ]
        );

        // 2. Settings
        $settings = [
            'workshop_name' => 'Kandy Iron Works',
            'tagline' => 'Master Steel & Architectural Iron Craftsmanship Since 2008',
            'phone_primary' => '+94 81 223 4567',
            'phone_mobile' => '+94 77 123 4567',
            'whatsapp_number' => '94771234567',
            'email' => 'info@kandyironworks.com',
            'address' => 'No. 142, William Gopallawa Mawatha, Kandy, Sri Lanka',
            'working_hours' => 'Mon – Sat: 8:00 AM – 6:30 PM (Sun: By Appointment)',
            'experience_years' => '16+',
            'projects_completed' => '1,450+',
            'warranty_years' => '10-Year Rust Guarantee',
            'emergency_hotline' => '+94 77 123 4567',
            'about_snippet' => 'For over 16 years, Kandy Iron Works has been the Central Province\'s trusted authority in premium architectural metalwork, automated gates, precision staircases, and heavy structural steel solutions. From royal heritage motifs to ultra-modern laser-cut villas, we forge unmatched durability with timeless elegance.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // 3. Showcase Projects
        $projects = [
            [
                'title' => 'The Amara Villa Automated Wrought Iron Gate',
                'slug' => 'amara-villa-automated-wrought-iron-gate',
                'category' => 'gates',
                'description' => 'Custom twin-swing architectural wrought iron main entrance gate featuring laser-cut geometric leaf motifs and integrated Italian remote automated hydraulic swing arms. Finished with hot-dip zinc galvanizing and dual-coat matte charcoal epoxy.',
                'location' => 'Peradeniya, Kandy',
                'client_name' => 'Amara Tropical Luxury Villa',
                'completed_year' => '2025',
                'image_url' => '/images/showcase/luxury_gate.jpg',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Sculptural Modern Spiral Staircase & Balustrade',
                'slug' => 'sculptural-modern-spiral-staircase-balustrade',
                'category' => 'railings',
                'description' => 'Freestanding architectural spiral staircase fabricated from heavy cold-rolled structural steel with curved continuous safety handrails, custom geometric vertical balustrades, and solid seasoned teak step inlays.',
                'location' => 'Richmond Hill, Kandy',
                'client_name' => 'Private Residence',
                'completed_year' => '2025',
                'image_url' => '/images/showcase/spiral_stairs.jpg',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Cantilever I-Beam Car Porch & Modern Steel Canopy',
                'slug' => 'cantilever-i-beam-car-porch-canopy',
                'category' => 'roofing',
                'description' => 'Engineered structural universal steel I-beam car canopy with 6-meter clear span, hidden internal gutter drainage system, and UV-resistant high-impact clear polycarbonate glazing.',
                'location' => 'Royal Palms Estate, Kundasale',
                'client_name' => 'Dr. Priyantha Dissanayake',
                'completed_year' => '2024',
                'image_url' => '/images/showcase/steel_canopy.jpg',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Hand-Forged Traditional Kandyan Heritage Gate',
                'slug' => 'hand-forged-traditional-kandyan-heritage-gate',
                'category' => 'gates',
                'description' => 'Authentic hand-forged wrought iron driveway gate incorporating sacred traditional Kandyan floral scrolls and solid iron spearheads, specially crafted for a colonial manor estate.',
                'location' => 'Digana Golf Club Enclave',
                'client_name' => 'Heritage Manor Resort',
                'completed_year' => '2024',
                'image_url' => '/images/showcase/hero_forge.jpg',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'CNC Laser-Cut Privacy Boundary Screens',
                'slug' => 'cnc-laser-cut-privacy-boundary-screens',
                'category' => 'laser_cut',
                'description' => '3.2mm precision CNC plasma cut architectural boundary wall inserts with bespoke parametric pattern, powder-coated in architectural bronze with integrated warm LED backlighting.',
                'location' => 'Lake View Villas, Kandy Lake',
                'client_name' => 'Arc Studio Ceylon',
                'completed_year' => '2024',
                'image_url' => '/images/showcase/luxury_gate.jpg',
                'is_featured' => false,
                'sort_order' => 5,
            ],
            [
                'title' => 'High-Clearance Commercial Warehouse Steel Trusses',
                'slug' => 'commercial-warehouse-steel-trusses',
                'category' => 'structural',
                'description' => 'Complete fabrication and crane-assisted erection of heavy steel roof trusses and mezzanine flooring for an industrial warehousing facility spanning 8,500 sq. ft.',
                'location' => 'Pallekele Industrial Park',
                'client_name' => 'Central Logistics Hub',
                'completed_year' => '2023',
                'image_url' => '/images/showcase/steel_canopy.jpg',
                'is_featured' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($projects as $proj) {
            Project::updateOrCreate(['slug' => $proj['slug']], $proj);
        }

        // 4. Design Catalog Items
        $catalog = [
            [
                'code' => 'KIW-GT-101',
                'title' => 'Royal Heritage Ornate Wrought Iron Gate',
                'category' => 'gates',
                'material' => 'Forged Wrought Iron & Solid 16mm Square Bar',
                'base_price_lkr' => 4500.00,
                'price_unit' => 'sq. ft',
                'image_url' => '/images/showcase/luxury_gate.jpg',
                'description' => 'Hand-hammered traditional scrolls with cast iron finials, zinc anti-rust primer, and heavy duty roller bearings. Automation ready.',
                'is_active' => true,
            ],
            [
                'code' => 'KIW-GT-102',
                'title' => 'Modern Minimalist Laser-Cut Box Gate',
                'category' => 'gates',
                'material' => '3mm CNC Steel Plate & Heavy Box Section',
                'base_price_lkr' => 3850.00,
                'price_unit' => 'sq. ft',
                'image_url' => '/images/showcase/luxury_gate.jpg',
                'description' => 'Clean geometric lines with privacy backing panels. Available in sliding or twin-swing configuration with powder-coated finish.',
                'is_active' => true,
            ],
            [
                'code' => 'KIW-RL-201',
                'title' => 'Architectural Floating Spiral Staircase',
                'category' => 'railings',
                'material' => 'Heavy Hollow Section Steel + Teak Mounts',
                'base_price_lkr' => 185000.00,
                'price_unit' => 'unit flight',
                'image_url' => '/images/showcase/spiral_stairs.jpg',
                'description' => 'Custom engineered central steel spine with precision laser-cut step brackets, curved handrails, and sound-dampened tread brackets.',
                'is_active' => true,
            ],
            [
                'code' => 'KIW-RL-202',
                'title' => 'Tempered Glass & Stainless Steel Balustrade',
                'category' => 'railings',
                'material' => 'SS-304 Grade Stainless Steel & 12mm Glass',
                'base_price_lkr' => 3200.00,
                'price_unit' => 'linear ft',
                'image_url' => '/images/showcase/spiral_stairs.jpg',
                'description' => 'Sleek brushed stainless steel spigots with continuous top grab rail. Ideal for luxury balconies and internal voids.',
                'is_active' => true,
            ],
            [
                'code' => 'KIW-CN-301',
                'title' => 'Heavy I-Beam Cantilever Car Porch',
                'category' => 'roofing',
                'material' => 'Universal Beam 150x75 + Solid Polycarbonate',
                'base_price_lkr' => 2400.00,
                'price_unit' => 'sq. ft',
                'image_url' => '/images/showcase/steel_canopy.jpg',
                'description' => 'No intrusive front pillars for effortless vehicle parking. Includes integrated storm water channels and anti-condensation seals.',
                'is_active' => true,
            ],
            [
                'code' => 'KIW-CN-302',
                'title' => 'Amano Zinc-Alum Commercial Roof Truss',
                'category' => 'roofing',
                'material' => 'Galvanized Structural Box Tubes & C-Channels',
                'base_price_lkr' => 1750.00,
                'price_unit' => 'sq. ft',
                'image_url' => '/images/showcase/steel_canopy.jpg',
                'description' => 'Engineered structural truss layout for residential upper floors, commercial shops, and warehouse buildings.',
                'is_active' => true,
            ],
            [
                'code' => 'KIW-GR-401',
                'title' => 'Security Diamond-Bar Window Grills',
                'category' => 'grills',
                'material' => 'Solid 14mm Square Mild Steel Bar',
                'base_price_lkr' => 1450.00,
                'price_unit' => 'sq. ft',
                'image_url' => '/images/showcase/hero_forge.jpg',
                'description' => 'High tensile tamper-proof security grills with decorative center twists and corrosion-resistant zinc undercoat.',
                'is_active' => true,
            ],
            [
                'code' => 'KIW-FN-501',
                'title' => 'Industrial Trapezoid Dining Table Steel Base',
                'category' => 'furniture',
                'material' => '75x25mm Heavy Duty Box Steel',
                'base_price_lkr' => 45000.00,
                'price_unit' => 'piece',
                'image_url' => '/images/showcase/hero_forge.jpg',
                'description' => 'Architectural geometric table legs engineered to support heavy live-edge Mara and Teak timber table tops.',
                'is_active' => true,
            ],
        ];

        foreach ($catalog as $item) {
            CatalogItem::updateOrCreate(['code' => $item['code']], $item);
        }

        // 5. Testimonials
        $testimonials = [
            [
                'client_name' => 'Arch. Chaminda Senaratne',
                'client_role' => 'Senior Architect',
                'location' => 'Peradeniya, Kandy',
                'rating' => 5,
                'comment' => 'Kandy Iron Works delivered the entire wrought iron facade, automated gates, and spiral stairs for our boutique villa project. Their weld precision, hot-dip galvanizing quality, and punctuality are simply unmatched in the Central Province.',
                'is_featured' => true,
            ],
            [
                'client_name' => 'Dr. Priyantha Dissanayake',
                'client_role' => 'Homeowner',
                'location' => 'Kundasale',
                'rating' => 5,
                'comment' => 'I ordered a 16-foot sliding gate and cantilever car porch. The instant cost estimator on their website was extremely accurate, and Eng. Sanjaya visited our site next day for exact laser measurements. Super silent motor and beautiful finish.',
                'is_featured' => true,
            ],
            [
                'client_name' => 'Niroshan Wijesinghe',
                'client_role' => 'Managing Director, Hill Country Resorts',
                'location' => 'Katugastota',
                'rating' => 5,
                'comment' => 'They constructed our 3-storey steel mezzanine and decorative balcony railings. Two years through Kandy’s heavy monsoon rains and there is zero rust thanks to their high-grade zinc epoxy primer. Genuine masters of their craft.',
                'is_featured' => true,
            ],
            [
                'client_name' => 'Kavindi Jayawardena',
                'client_role' => 'Interior Designer',
                'location' => 'Digana',
                'rating' => 5,
                'comment' => 'Their CNC laser cut privacy screens transformed our client’s open-concept living area. Impeccable attention to detail, clean site installation, and polite workshop staff.',
                'is_featured' => true,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['client_name' => $t['client_name']],
                $t
            );
        }

        // 6. Realistic Inquiries
        $inquiries = [
            [
                'name' => 'Sunil Wickramasinghe',
                'phone' => '077 345 8892',
                'email' => 'sunil.w@gmail.com',
                'location' => 'Aniwatta, Kandy',
                'service_type' => 'Wrought Iron Sliding Gate',
                'dimensions' => '16ft x 6.5ft',
                'material_preference' => 'Heavy Galvanized + Timber Insert',
                'estimated_budget' => 'LKR 380,000',
                'message' => 'Need an automated sliding gate with Italian motor kit for our new two-story house. Please schedule an on-site inspection.',
                'status' => 'site_visit',
                'internal_notes' => 'Site visit scheduled for Thursday 2 PM. Client requested sample powder coat swatches.',
                'source' => 'estimator',
            ],
            [
                'name' => 'Mahesh Bandara',
                'phone' => '071 890 2234',
                'email' => 'mahesh.bandara@yahoo.com',
                'location' => 'Katugastota',
                'service_type' => 'Curved Balcony Railings',
                'dimensions' => '42 linear feet',
                'material_preference' => 'SS-304 Stainless Steel & Tempered Glass',
                'estimated_budget' => 'LKR 210,000',
                'message' => 'Want quotes for second-floor front balcony balustrades. Looking for corrosion resistant finish.',
                'status' => 'pending',
                'internal_notes' => 'New lead from website estimator. Need to call back to confirm drawings.',
                'source' => 'estimator',
            ],
            [
                'name' => 'Arch. Dilshan Fernando',
                'phone' => '077 789 4433',
                'email' => 'dilshan@studioarch.lk',
                'location' => 'Digana',
                'service_type' => 'Cantilever Car Porch Roof',
                'dimensions' => '22ft x 18ft',
                'material_preference' => 'Universal I-Beam Steel + Polycarbonate',
                'estimated_budget' => 'LKR 750,000',
                'message' => 'Working on a villa project in Victoria Golf Club vicinity. Need structural steel fabrication and erection within 3 weeks.',
                'status' => 'quoted',
                'internal_notes' => 'Official quotation KIW-QT-2026-088 sent via email and WhatsApp. Awaiting client advance.',
                'source' => 'website',
            ],
            [
                'name' => 'Nadeeka Ratnayake',
                'phone' => '076 223 9911',
                'email' => 'nadeeka.r@outlook.com',
                'location' => 'Peradeniya',
                'service_type' => 'Security Window Grills & Screen Door',
                'dimensions' => '8 windows + 1 double grill door',
                'material_preference' => 'Solid 16mm Square Iron',
                'estimated_budget' => 'LKR 165,000',
                'message' => 'Renovating our home in Peradeniya. Need modern minimalist square bar grills with rust-proof coating.',
                'status' => 'contacted',
                'internal_notes' => 'Spoke over phone. Sent design catalog KIW-GR-401 via WhatsApp.',
                'source' => 'website',
            ],
            [
                'name' => 'Gamini Alahakoon',
                'phone' => '071 556 7788',
                'email' => 'gamini.alahakoon@gmail.com',
                'location' => 'Ampitiya, Kandy',
                'service_type' => 'Automated Swing Gate',
                'dimensions' => '14ft x 6ft',
                'material_preference' => 'Wrought Iron Ornate',
                'estimated_budget' => 'LKR 320,000',
                'message' => 'Completed installation of royal pattern gate. Excellent work.',
                'status' => 'completed',
                'internal_notes' => 'Fully installed and handed over on 15th Sep. 100% payment settled.',
                'source' => 'website',
            ],
        ];

        foreach ($inquiries as $inq) {
            Inquiry::updateOrCreate(
                ['phone' => $inq['phone'], 'service_type' => $inq['service_type']],
                $inq
            );
        }
    }
}
