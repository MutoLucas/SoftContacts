<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Contact;

class EditContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_edit_contact_successfully(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $contact = Contact::factory()->create([
            'user_id' => $user->id,
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'contact' => '123456789'
        ]);

        $updatedData = [
            'name' => 'New Name',
            'email' => 'new@example.com',
            'contact' => '987654321'
        ];

        $response = $this->put(route('contact.edit.save', $contact->id), $updatedData);

        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'name' => 'New Name',
            'email' => 'new@example.com',
            'contact' => '987654321'
        ]);

        $response->assertRedirect(route('contact.edit', ['id' => $contact->id]))
                 ->assertSessionHas('success', 'Contact update success');
    }

    public function test_cannot_edit_contact_of_another_user(){
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $this->actingAs($user1);

        $contact = Contact::factory()->create([
            'user_id' => $user2->id,
            'email' => 'secure@example.com',
            'contact' => '999999999'
        ]);

        $response = $this->put(route('contact.edit.save', $contact->id), [
            'name' => 'Hacker Attempt',
            'email' => 'hacker@example.com',
            'contact' => '000000000'
        ]);

        $response->assertRedirect(route('index.index'))
                 ->assertSessionHas('error', 'You do not have permission to edit this contact');

        $this->assertDatabaseMissing('contacts', [
            'id' => $contact->id,
            'name' => 'Hacker Attempt'
        ]);
    }

    public function test_cannot_update_contact_with_duplicate_email(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $contact1 = Contact::factory()->create([
            'user_id' => $user->id,
            'email' => 'existing@example.com'
        ]);

        $contact2 = Contact::factory()->create([
            'user_id' => $user->id,
            'email' => 'unique@example.com'
        ]);

        $response = $this->put(route('contact.edit.save', $contact2->id), [
            'name' => 'New Name',
            'email' => 'existing@example.com',
            'contact' => '111111111'
        ]);

        $response->assertRedirect()
                 ->assertSessionHas('error', 'There is already a contact with this email registered');
    }

    public function test_cannot_update_contact_with_duplicate_contact_number(){
        $user = User::factory()->create();
        $this->actingAs($user);

        $contact1 = Contact::factory()->create([
            'user_id' => $user->id,
            'contact' => '999999999'
        ]);

        $contact2 = Contact::factory()->create([
            'user_id' => $user->id,
            'contact' => '111111111'
        ]);

        $response = $this->put(route('contact.edit.save', $contact2->id), [
            'name' => 'New Name',
            'email' => 'new@example.com',
            'contact' => '999999999'
        ]);

        $response->assertRedirect()
                 ->assertSessionHas('error', 'There is already a contact with this number contact registered');
    }

}
