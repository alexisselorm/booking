<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Venue;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class VenueControllerTest extends TestCase
{
    use WithFaker;
    use LazilyRefreshDatabase;

    public function testGuestCanUpdateVenue()
    {
        Storage::fake('public');

        $venue = Venue::create([
            'name'        => 'Test name',
            'alias'       => 'Test alias',
            'description' => 'Test description',
            'status'      => 1,
            'image'       => $this->faker->image,
        ]);

        $this->assertDatabaseCount('venues', 1);

        $this->assertGuest();

        $this->assertModelExists($venue);

        Storage::disk('public')->assertMissing('image.jpg');

        $response = $this->patchJson(route('venue.update', $venue->id), [
            'name'          => 'Test name after update',
            'alias'         => 'Test alias after update',
            'description'   => 'Test description after update',
            'user_id'       => 1,
            'department_id' => 1,
            'location_id'   => 1,
            'status'        => 2,
            'image'         => UploadedFile::fake()->image('image.jpg')
        ]);

        $venue->refresh();

        Storage::disk('public')->assertExists($venue->image);

        $response->assertNoContent();

        $this->assertDatabaseHas('venues', [
            'id'          => $venue->id,
            'name'        => 'Test name after update',
            'alias'       => 'Test alias after update',
            'description' => 'Test description after update',
            'status'      => 2,
        ])->assertDatabaseCount('venues', 1);
    }
}