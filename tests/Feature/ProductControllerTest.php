<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_add_product_successfully()
    {
        Storage::fake('public');

        // Create a user to authenticate
        $user = User::factory()->create();

        // Fake an image
        $file = UploadedFile::fake()->image('product.jpg');

        $data = [
            'name' => 'Test Product',
            'description' => 'This is a test description.',
            'price' => 500,
            'product_image' => $file,
        ];

        // Act as the authenticated user
        $response = $this->actingAs($user)->postJson('/api/products', $data);

        // Assert the response status
        $response->assertStatus(201);

        // Assert the product was created in the database
        $this->assertDatabaseHas('products', [
            'name' => 'Test Product',
            'description' => 'This is a test description.',
            'price' => 500,
            'user_id' => $user->id,
        ]);

        // Assert the file was stored
        Storage::disk('public')->assertExists('images/products/' . $file->hashName());
    }

    public function test_edit_product_successfully()
    {
        Storage::fake('public');

        // Create user and product
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        // Fake new image
        $file = UploadedFile::fake()->image('new_product.jpg');

        $data = [
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 700,
            'product_image' => $file,
        ];

        // Act as the user and send PUT request
        $response = $this->actingAs($user)->putJson('/api/products/' . $product->id, $data);

        // Assert status
        $response->assertStatus(200);

        // Assert database was updated
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product',
            'description' => 'Updated description',
            'price' => 700,
        ]);

        // Assert the file was stored
        Storage::disk('public')->assertExists('images/products/' . $file->hashName());
    }

    public function test_get_product_successfully()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/api/products/' . $product->id);

        $response->assertStatus(200)
         ->assertJson([
             'product' => [
                 'id' => $product->id,
                 'name' => $product->name,
                 'description' => $product->description,
             ]
         ]);

    }

    public function test_delete_product_successfully()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['user_id' => $user->id]);

        // Send delete request
        $response = $this->actingAs($user)->deleteJson('/api/products/' . $product->id);

        // Assert the product was deleted
        $response->assertStatus(200);

        // Assert product doesn't exist in the database anymore
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
