<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Entry;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');
        $collect = Entry::query()
            ->select('entry.id', 'entry.plate', 'entry.fruit_id', 'fruit.name as fruit_name', 'entry.weight',
                'entry.entry_date', 'entry.province_id', 'provinces.name as province_name',
                'entry.city_id as city_name', 'cities.name',
                'entry.stall_id', 'stalls.name as stall_name', 'entry.hall_id', 'halls.name', 'entry.created_at')
            ->join('fruit', 'entry.fruit_id', '=', 'fruit.id')
            ->join('provinces', 'entry.province_id', '=', 'provinces.id')
            ->join('cities', 'entry.city_id', '=', 'cities.id')
            ->join('halls', 'entry.hall_id', '=', 'halls.id')
            ->join('stalls', 'entry.stall_id', '=', 'stalls.id')
            ->orderByDesc('created_at')->get();

        var_dump($collect);

        $response->assertStatus(200);
    }
}
