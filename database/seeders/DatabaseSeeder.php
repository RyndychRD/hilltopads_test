<?php

namespace Database\Seeders;

use App\Models\Publisher;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdvertiserSeeder::class);
        $this->call(PublisherSeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(BlackListTableSeeder::class);
    }
}
