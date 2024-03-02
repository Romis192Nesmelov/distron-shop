<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use Illuminate\Database\Seeder;
//use Illuminate\Support\Str;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataServices = [
            [
                'image' => 'images/items/item41.jpg',
                'name' => 'Восстановление Тяговых АКБ',
                'description' => 'Quisque ultrices varius dui, at bibendum eros vulputate nec. Praesent pretium nisl at turpis ornare egestas. Sed non suscipit nunc. Donec condimentum vehicula turpis, vel suscipit diam. Duis posuere at.',
                'price' => rand(5000,10000),
                'capacity' => rand(100,1000),
                'description_file' => 'Цены на услуги по восстановлению АКБ',
                'file' => 'files/prices.docx',
                'type_id' => 4
            ],
            [
                'image' => 'images/placeholder.jpg',
                'name' => 'Восстановление Телеком батарей',
                'capacity' => rand(100,1000),
                'description' => 'Pellentesque nec pellentesque dui. In porttitor faucibus urna eget auctor. Fusce id nibh at ligula dapibus mattis in sed magna. Mauris pellentesque mattis bibendum. Etiam ut nibh non dolor aliquet.',
                'price' => rand(5000,10000),
                'type_id' => 4
            ],
        ];

        $voltage = [24, 48, 80];
        for ($i=0;$i<20;$i++) {
            Item::create([
                'description' => 'Quisque ultrices varius dui, at bibendum eros vulputate nec. Praesent pretium nisl at turpis ornare egestas. Sed non suscipit nunc. Donec condimentum vehicula turpis, vel suscipit diam. Duis posuere at.',
                'type_id' => 1,
                'price' => rand(10000,50000),
                'capacity' => rand(100,1000),
                'voltage' => $voltage[rand(0,2)],
                'technology_id' => rand(1,3),
            ]);
        }

        for ($i=2;$i<=6;$i++) {
            Item::create([
                'name' => 'Ячейка АКБ',
                'description' => 'Pellentesque nec pellentesque dui. In porttitor faucibus urna eget auctor. Fusce id nibh at ligula dapibus mattis.',
                'price' => rand(1000,3000),
                'length' => rand(45,190),
                'width' => rand(100,200),
                'height' => rand(300,750),
                'type_id' => 2,
                'plates' => $i
            ]);
        }

        for ($i=0;$i<5;$i++) {
            Item::create([
                'name' => 'Перемычка',
                'section' => rand(1,10),
                'length' => rand(10,50),
                'description' => 'Quisque ultrices varius dui, at bibendum eros vulputate nec. Praesent pretium nisl at turpis ornare egestas. Sed non suscipit nunc. Donec condimentum vehicula turpis, vel suscipit diam. Duis posuere at.',
                'price' => rand(100,1000),
                'type_id' => 3,
            ]);
        }

        for ($i=0;$i<8;$i++) {
            Item::create([
                'name' => 'Разъем',
                'rated_current' => rand(50,100) * 0.01,
                'description' => 'Quisque ultrices varius dui, at bibendum eros vulputate nec. Praesent pretium nisl at turpis ornare egestas. Sed non suscipit nunc. Donec condimentum vehicula turpis, vel suscipit diam. Duis posuere at.',
                'price' => rand(100,1000),
                'type_id' => 3,
            ]);
        }

        Item::create([
            'name' => 'Система долива',
            'description' => 'Quisque ultrices varius dui, at bibendum eros vulputate nec. Praesent pretium nisl at turpis ornare egestas. Sed non suscipit nunc. Donec condimentum vehicula turpis, vel suscipit diam. Duis posuere at.',
            'price' => rand(100,1000),
            'type_id' => 3,
        ]);

        Item::create([
            'name' => 'Болт',
            'description' => 'Quisque ultrices varius dui, at bibendum eros vulputate nec. Praesent pretium nisl at turpis ornare egestas. Sed non suscipit nunc. Donec condimentum vehicula turpis, vel suscipit diam. Duis posuere at.',
            'price' => rand(100,1000),
            'type_id' => 3,
        ]);

        foreach ($dataServices as $item) {
            Item::create($item);
        }
    }
}
