<?php

namespace Tests\Feature;

use App\Models\CatalogItem;
use App\Models\Inquiry;
use App\Models\Project;
use App\Models\Setting;
use App\Models\User;
use Database\Seeders\KandyIronWorksSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class KandyIronWorksTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(KandyIronWorksSeeder::class);
    }

    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Kandy');
        $response->assertSee('Iron Works');
        $response->assertSee('Cost Estimator');
    }

    public function test_public_pages_load_successfully(): void
    {
        $this->get('/portfolio')->assertStatus(200)->assertSee('Projects');
        $this->get('/catalog')->assertStatus(200)->assertSee('Design Pattern Catalog');
        $this->get('/calculator')->assertStatus(200)->assertSee('Metalwork Price Calculator');
        $this->get('/contact')->assertStatus(200)->assertSee('William Gopallawa Mawatha');
    }

    public function test_customer_can_submit_quote_inquiry(): void
    {
        $payload = [
            'name' => 'Mr. Rohan Gunaratne',
            'phone' => '077 889 1234',
            'email' => 'rohan@gmail.com',
            'location' => 'Katugastota, Kandy',
            'service_type' => 'Automated Sliding Gate',
            'dimensions' => '16ft x 6ft',
            'estimated_budget' => 'LKR 390,000',
            'message' => 'Please visit our site for exact laser measurements.',
            'source' => 'estimator_test',
        ];

        $response = $this->post('/inquire', $payload);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('inquiries', [
            'name' => 'Mr. Rohan Gunaratne',
            'phone' => '077 889 1234',
            'status' => 'pending',
        ]);
    }

    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_admin_can_access_dashboard_and_manage_inquiries(): void
    {
        $admin = User::where('email', 'admin@kandyironworks.com')->first();
        $this->assertNotNull($admin);
        $this->assertTrue($admin->is_admin);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Workshop Control Center');

        $inquiry = Inquiry::first();
        $this->assertNotNull($inquiry);

        // Test updating inquiry
        $updateResponse = $this->actingAs($admin)->put("/admin/inquiries/{$inquiry->id}", [
            'status' => 'site_visit',
            'internal_notes' => 'Appointment scheduled with client for Friday morning.',
            'estimated_budget' => 'LKR 425,000',
        ]);

        $updateResponse->assertSessionHas('success');

        $this->assertDatabaseHas('inquiries', [
            'id' => $inquiry->id,
            'status' => 'site_visit',
        ]);
    }

    public function test_admin_can_create_and_manage_projects(): void
    {
        $admin = User::where('email', 'admin@kandyironworks.com')->first();

        $response = $this->actingAs($admin)->post('/admin/projects', [
            'title' => 'Hilltop Villa Sliding Gate',
            'category' => 'gates',
            'description' => 'Precision engineered sliding gate with Italian automated motor kit.',
            'location' => 'Hantana, Kandy',
            'client_name' => 'Dr. Ranil Senanayake',
            'completed_year' => '2026',
            'image_url' => '/images/showcase/luxury_gate.jpg',
            'is_featured' => 1,
            'sort_order' => 1,
        ]);

        $response->assertRedirect('/admin/projects');

        $this->assertDatabaseHas('projects', [
            'title' => 'Hilltop Villa Sliding Gate',
            'slug' => 'hilltop-villa-sliding-gate',
        ]);
    }

    public function test_admin_can_create_catalog_item(): void
    {
        $admin = User::where('email', 'admin@kandyironworks.com')->first();

        $response = $this->actingAs($admin)->post('/admin/catalog', [
            'code' => 'KIW-GT-999',
            'title' => 'Minimalist Black Pivot Gate',
            'category' => 'gates',
            'material' => 'Galvanized Box Iron',
            'base_price_lkr' => 4500,
            'price_unit' => 'sq. ft',
            'image_url' => '/images/showcase/luxury_gate.jpg',
            'description' => 'Modern architectural pivot gate with concealed heavy hinges.',
            'is_active' => 1,
        ]);

        $response->assertRedirect('/admin/catalog');

        $this->assertDatabaseHas('catalog_items', [
            'code' => 'KIW-GT-999',
            'title' => 'Minimalist Black Pivot Gate',
        ]);
    }

    public function test_admin_can_update_workshop_settings(): void
    {
        $admin = User::where('email', 'admin@kandyironworks.com')->first();

        $response = $this->actingAs($admin)->post('/admin/settings', [
            'workshop_name' => 'Kandy Iron Works & Steel Fabricators',
            'phone_primary' => '+94 81 223 9999',
        ]);

        $response->assertSessionHas('success');

        $this->assertEquals('Kandy Iron Works & Steel Fabricators', Setting::get('workshop_name'));
        $this->assertEquals('+94 81 223 9999', Setting::get('phone_primary'));
    }
}
