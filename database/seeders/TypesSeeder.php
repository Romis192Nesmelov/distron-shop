<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['image' => 'images/types/type1.png', 'name' => 'АКБ'],
            ['image' => 'images/types/type2.png', 'name' => 'Ячейки для АКБ'],
            ['image' => 'images/types/type3.png', 'name' => 'Аксесуары'],
        ];

        foreach ($data as $item) {
            Type::create($item);
        }
    }
}
