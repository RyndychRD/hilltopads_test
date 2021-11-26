<?php

namespace Database\Factories;

use App\Models\Advertiser;
use App\Models\Publisher;
use App\Models\Site;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlacklistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'advertiser_id' =>  rand(1,Advertiser::all()->count() -1),

            'publisher_id' => rand(1,Publisher::all()->count() -1),
            'site_id' => rand(1,Site::all()->count() -1),
        ];
    }
}
