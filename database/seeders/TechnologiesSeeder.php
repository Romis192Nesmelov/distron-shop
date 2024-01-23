<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Technology;
use Illuminate\Database\Seeder;

class TechnologiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['Свинцовая АКБ','Гелевая АКБ','AGM'];

        foreach ($data as $item) {
            Technology::create(['name' => $item]);
        }
    }
}
