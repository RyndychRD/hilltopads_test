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
        echo 'Advertiser seeder complete';
        $this->call(PublisherSeeder::class);
        echo 'Publisher seeder complete';
        $this->call(SiteSeeder::class);
        echo 'Site seeder complete';
        $this->call(BlackListTableSeeder::class);
        echo 'BlackList seeder complete';
    }
}
