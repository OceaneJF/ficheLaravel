<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_all_products()
    {
        Product::factory()->count(3)->create();

        $response = $this->get(route('product.index'));

        $response->assertStatus(200);
        $response->assertViewHas('products');
    }

    public function test_authenticated_user_can_see_their_products()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('product.myProduct'));

        $response->assertStatus(200);
        $response->assertSee($product->name);
    }

    public function test_guest_cannot_create_product()
    {
        $response = $this->post(route('product.store'), []);

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_create_product()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Test Product',
            'price' => 1000,
            'qty' => 10,
            'description' => 'Test description',
        ];

        $response = $this->actingAs($user)->post(route('product.store'), $data);

        $this->assertDatabaseHas('products', ['name' => 'Test Product']);
        $response->assertRedirect(route('product.index'));
    }

    public function test_user_can_edit_their_own_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('product.edit', $product));

        $response->assertStatus(200);
        $response->assertViewHas('product');
    }

    public function test_user_cannot_edit_product_they_do_not_own()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($otherUser)->get(route('product.edit', $product));

        $response->assertRedirect(); // Redirigé back
    }

    public function test_user_can_update_their_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $data = [
            'name' => 'Updated Name',
            'price' => 1500,
            'qty' => 10,
            'description' => 'Updated description',
        ];

        $response = $this->actingAs($user)->put(route('product.update', $product), $data);

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', ['id' => $product->id, 'name' => 'Updated Name']);
    }

    public function test_user_can_delete_their_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('product.destroy', $product));

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_user_cannot_delete_product_they_do_not_own()
    {
        $owner = User::factory()->create();
        $otherUser = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($otherUser)->delete(route('product.destroy', $product));

        $response->assertRedirect(); // Redirigé back
        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_admin_can_access_backoffice()
    {
        $adminRole = \App\Models\Role::factory()->create(['name' => 'admin']);
        $admin = \App\Models\User::factory()->create(['role_id' => $adminRole->id]);

        $response = $this->actingAs($admin)->get(route('backoffice'));

        $response->assertStatus(200); // Page accessible
    }

    public function test_non_admin_user_cannot_access_backoffice()
    {
        $userRole = \App\Models\Role::factory()->create(['name' => 'user']);
        $user = \App\Models\User::factory()->create(['role_id' => $userRole->id]);

        $response = $this->actingAs($user)->get(route('backoffice'));

        $response->assertStatus(403); // Refusé par le middleware
    }

    public function test_store_product_validation_fails_when_name_is_missing()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $data = [
            'price' => 1000,
            'qty' => 10,
            'description' => 'Test desc',
            // 'name' est manquant
        ];

        $response = $this->post(route('product.store'), $data);

        $response->assertSessionHasErrors('name');
    }

    public function test_store_product_succeeds_with_valid_data()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $data = [
            'name' => 'New Product',
            'price' => 1999,
            'qty' => 10,
            'description' => 'Cool product!',
        ];

        $response = $this->post(route('product.store'), $data);

        $response->assertRedirect(route('product.index'));
        $this->assertDatabaseHas('products', ['name' => 'New Product']);
    }


}
