<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Island;

class IslandSeeder extends Seeder
{
    public function run(): void
    {
        $islands = [
            'Malé Atoll' => ['Malé', 'Hulhumalé', 'Villingili', 'Maafushi', 'Gulhi', 'Guraidhoo'],
            'Ari Atoll' => ['Rasdhoo', 'Ukulhas', 'Thoddoo', 'Mathiveri', 'Bodufolhudhoo', 'Himandhoo', 'Maalhos'],
            'Baa Atoll' => ['Eydhafushi', 'Thulhaadhoo', 'Dharavandhoo', 'Goidhoo', 'Fulhadhoo', 'Fehendhoo'],
            'Lhaviyani Atoll' => ['Naifaru', 'Hinnavaru', 'Kurendhoo'],
            'Noonu Atoll' => ['Manadhoo', 'Holhudhoo', 'Velidhoo', 'Kedhikolhudhoo'],
            'Raa Atoll' => ['Ungoofaaru', 'Dhuvaafaru', 'Meedhoo', 'Maduvvari'],
            'Haa Alif Atoll' => ['Dhidhdhoo', 'Filladhoo', 'Kelaa', 'Ihavandhoo', 'Maarandhoo'],
            'Haa Dhaalu Atoll' => ['Kulhudhuffushi', 'Hanimaadhoo', 'Nolhivaran'],
            'Shaviyani Atoll' => ['Funadhoo', 'Milandhoo', 'Komandoo', 'Maroshi'],
            'Laamu Atoll' => ['Fonadhoo', 'Gan', 'Maabaidhoo', 'Mundoo', 'Isdhoo'],
            'Thaa Atoll' => ['Veymandoo', 'Thimarafushi', 'Kinbidhoo', 'Guraidhoo'],
            'Gaafu Alif Atoll' => ['Villingili', 'Maamendhoo', 'Nilandhoo', 'Dhaandhoo'],
            'Gaafu Dhaalu Atoll' => ['Thinadhoo', 'Madaveli', 'Hoadedhdhoo', 'Gaddhoo'],
            'Addu City' => ['Hithadhoo', 'Maradhoo', 'Feydhoo', 'Hulhudhoo', 'Meedhoo'],
            'Fuvahmulah City' => ['Fuvahmulah'],
        ];

        foreach ($islands as $atoll => $islandNames) {
            foreach ($islandNames as $islandName) {
                Island::create([
                    'name' => $islandName,
                    'atoll' => $atoll,
                ]);
            }
        }
    }
}
