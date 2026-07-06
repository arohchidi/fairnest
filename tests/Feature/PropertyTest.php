<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Property;

class PropertyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    public function test_home_page():void
    {

    $this->withoutExceptionHandling();
        $response = $this->get('about');
        $response->assertStatus(200);
    }

    public function test_property_exist():void
    {
        $property = Property::factory()->create();

    $this->assertDatabaseHas('properties', [
        'id' => $property->id,
    ]);
    }


    public function test_create_property(): void
    {

    /** @var \App\Models\User $user */
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->post('/properties', [
                'title' => 'Villa',
                'price' => 500000,
            ]);

        $response->assertRedirect();
    }
}
