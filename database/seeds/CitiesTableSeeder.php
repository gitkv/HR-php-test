<?php

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::create([
            'name' => 'Брянск',
            'lat'  => '53.25209',
            'lon'  => '34.37167',
        ]);
    }
}
