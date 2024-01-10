<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Icon;

class IconsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => 'Значительное продление жизненного цикла АКБ'],
            ['title' => 'Защита окружающей среды, «зеленые» технологии'],
            ['title' => 'Экономическая выгода, экономия средств'],
            ['title' => 'Гарантия до 3 лет на восстановленные элементы']
        ];

        foreach ($data as $k => $item) {
            $item['image'] = 'images/icons/icon'.($k + 1).'.svg';
            $item['active'] = 1;
            Icon::create($item);
        }
    }
}
