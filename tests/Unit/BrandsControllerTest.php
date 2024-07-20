<?php

namespace Tests\Unit\Controllers;

use Tests\TestCase;
use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\Concerns\InteractsWithDatabase;

class BrandsControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker, InteractsWithDatabase;

    public function test_index_method_returns_view_with_brands()
    {
        $brands = Brand::factory()->count(3)->create();

        $response = $this->get(route('brands.index'));

        $response->assertViewIs('brands.index')
            ->assertViewHas('brands', $brands);
    }

    public function test_show_method_returns_view_with_brand()
    {
        $brand = Brand::factory()->create();

        $response = $this->get(route('brands.show', $brand));

        $response->assertViewIs('brands.show')
            ->assertViewHas('brand', $brand);
    }

    public function test_store_method_creates_brand_and_redirects_to_index()
    {
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->post(route('brands.store'), $data);

        $this->assertDatabaseHas('brands', $data);

        $response->assertRedirect(route('brands.index'));
    }

    public function test_update_method_updates_brand_and_redirects_to_show()
    {
        $brand = Brand::factory()->create();
        $data = [
            'name' => $this->faker->name,
        ];

        $response = $this->put(route('brands.update', $brand), $data);

        $brand->refresh();

        $this->assertEquals($data['name'], $brand->name);

        $response->assertRedirect(route('brands.show', $brand));
    }

    public function test_delete_method_deletes_brand_and_redirects_to_index()
    {
        $brand = Brand::factory()->create();

        $response = $this->delete(route('brands.delete', $brand));

        $this->assertDatabaseMissing('brands', $brand->toArray());

        $response->assertRedirect(route('brands.index'));
    }
}