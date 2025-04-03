<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class StoreContactTest extends TestCase
{

    use RefreshDatabase;

    public function test_store_contact_successfully(){

        $user = User::factory()->create();

        $this->actingAs($user);

        $contactData = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'contact' => '123456789'
        ];

        $response = $this->post(route('contact.store'), $contactData);

        $this->assertDatabaseHas('contacts', [
            'user_id' => $user->id,
            'email' => 'johndoe@example.com',
            'contact' => '123456789'
        ]);

        $response->assertRedirect()
                 ->assertSessionHas('success', 'Email contact: johndoe@example.com successfully registered');
    }
}
