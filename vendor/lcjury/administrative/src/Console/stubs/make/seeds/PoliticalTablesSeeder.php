<?php

use Illuminate\Database\Seeder;

use App\Region;
use App\Province;
use App\Commune;

class PoliticalTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = DummyData;

        foreach($data as $region_name => $provinces)
        {
            $region = Region::create(['name' => $region_name]);
            foreach($provinces as $province_name => $communes)
            {
                $province = Province::create(['name' => $province_name, 'region_id' => $region->id]);
                foreach($communes as $commune_name)
                {
                    Commune::create(['name' => $commune_name, 'province_id' => $province->id]);
                }
            }
        }
    }
}
