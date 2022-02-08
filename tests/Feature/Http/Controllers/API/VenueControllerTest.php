<?php

namespace Tests\Feature\Http\Controllers\API;

use App\Models\Venue;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VenueControllerTest extends TestCase
{
    use WithFaker;
    use LazilyRefreshDatabase;

    public function testGuestCanUpdateVenue()
    {
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

        $response = $this->patchJson(route('venue.update', $venue->id), [
            'name'          => 'Test name after update',
            'alias'         => 'Test alias after update',
            'description'   => 'Test description after update',
            'user_id'       => 1,
            'department_id' => 1,
            'location_id'   => 1,
            'status'        => 2,
        ]);

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