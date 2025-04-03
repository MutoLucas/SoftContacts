<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;



class DeleteContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_delete_own_contact(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $contact = Contact::factory()->create(['user_id' => $user->id]);

        $response = $this->delete(route('contact.delete', $contact->id));

        $response->assertRedirect(route('index.index'));
        $this->assertSoftDeleted('contacts', ['id' => $contact->id]);
    }

    public function test_user_cannot_delete_other_users_contact(){
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $this->actingAs($user);

        $contact = Contact::factory()->create(['user_id' => $otherUser->id]);

        $response = $this->delete(route('contact.delete', $contact->id));

        $response->assertRedirect(route('index.index'));
        $response->assertSessionHas('error', 'You do not have permission to delete this contact');
        $this->assertDatabaseHas('contacts', ['id' => $contact->id]);
    }
}
