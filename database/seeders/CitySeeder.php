<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $cities = [
            'Skopje', 'Bitola', 'Ohrid', 'Kumanovo', 'Prilep',
            'Tetovo', 'Gostivar', 'Strumica', 'Veles', 'Štip',
            'Kavadarci', 'Kočani', 'Kičevo', 'Debar', 'Resen',
            'Radoviš', 'Gevgelija', 'Kriva Palanka', 'Delčevo', 'Vinica'
        ];

        foreach ($cities as $city) {
            City::updateOrCreate([
                'name' => $city
            ]);
        }
    }
}
