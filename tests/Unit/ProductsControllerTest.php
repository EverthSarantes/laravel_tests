<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Brand;
use App\Models\Product;

class ProductsControllerTest extends TestCase
{
    public function test_store_product_store_in_database(): void
    {
        $brand = Brand::factory()->create();

        $data = [
            'name' => 'Product Name',
            'brand_id' => $brand->id
        ];
    
        $response = $this->post(route('products.store'), $data);
    
        $this->assertDatabaseHas('products', $data);

        $response->assertRedirect('/');
    }

    public function test_delete_product_deletes_from_database(): void
    {
        $brand = Brand::factory()->create();

        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $response = $this->delete(route('products.delete', ['product' => $product]));

        $this->assertDatabaseMissing('products', $product->toArray());
    }
}
