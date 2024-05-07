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
                'image' => 'storage/images/items/item1.jpg',
                'name' => 'Восстановление Тяговых АКБ',
                'description' => '<p>Quisque ultrices varius dui, at bibendum eros vulputate nec. Praesent pretium nisl at turpis ornare egestas. Sed non suscipit nunc. Donec condimentum vehicula turpis, vel suscipit diam. Duis posuere at.</p>',
                'price' => rand(5000,10000),
                'capacity' => rand(100,1000),
                'description_file' => 'Цены на услуги по восстановлению АКБ',
                'file' => 'files/prices.docx',
                'type_id' => 4
            ],
            [
                'image' => 'storage/images/items/item2.jpg',
                'name' => 'Восстановление Телеком батарей',
                'capacity' => rand(100,1000),
                'description' => '<p>Pellentesque nec pellentesque dui. In porttitor faucibus urna eget auctor. Fusce id nibh at ligula dapibus mattis in sed magna. Mauris pellentesque mattis bibendum. Etiam ut nibh non dolor aliquet.</p>',
                'price' => rand(5000,10000),
                'type_id' => 4
            ],
        ];

        $dataAccessories = [
            [
                'image' => 'storage/images/items/item3.jpg',
                'name' => 'Перемычка гибкая',
                'section' => 25,
                'length' => 95,
                'price' => 332,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item4.jpg',
                'name' => 'Перемычка гибкая',
                'section' => 25,
                'length' => 110,
                'price' => 356,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item5.jpg',
                'name' => 'Перемычка гибкая',
                'section' => 50,
                'length' => 95,
                'price' => 459,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item6.jpg',
                'name' => 'Перемычка гибкая',
                'section' => 50,
                'length' => 110,
                'price' => 486,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item7.jpg',
                'name' => 'Болт крепления м10',
                'description' => '<p>Для тяговых АКБ</p>',
                'price' => 65,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item8.jpg',
                'name' => 'Переходник',
                'description' => '<p>Используются для подключения АКБ к эл.сети как самой техники, так и к зарядному устройству.</p>',
                'rated_current' => 50,
                'price' => 145,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item9.jpg',
                'name' => 'Переходник',
                'description' => '<p>Используются для подключения АКБ к эл.сети как самой техники, так и к зарядному устройству.</p>',
                'rated_current' => 175,
                'price' => 481,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item10.jpg',
                'name' => 'Переходник',
                'description' => '<p>Используются для подключения АКБ к эл.сети как самой техники, так и к зарядному устройству.</p>',
                'rated_current' => 350,
                'price' => 1214,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item11.jpg',
                'name' => 'Комплект концевых отводов',
                'section' => 25,
                'price' => 2550,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item12.jpg',
                'name' => 'Комплект концевых отводов',
                'section' => 35,
                'price' => 3200,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item13.jpg',
                'name' => 'Комплект концевых отводов',
                'section' => 50,
                'price' => 3850,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item14.jpg',
                'name' => 'Комплект концевых отводов',
                'section' => 70,
                'price' => 4700,
                'type_id' => 3,
            ],
            [
                'image' => 'storage/images/items/item15.jpg',
                'description' => '<p>Аккумуляторная батарея состоит из элементов 2PzS 230. Производитель ВАЗ-Импульс</p>',
                'type_id' => 1,
                'price' => 103500,
                'capacity' => 230,
                'voltage' => 24,
                'length' => 45,
                'width' => 198,
                'height' => 587,
                'technology_id' => 1
            ],
            [
                'image' => 'storage/images/items/item16.jpg',
                'description' => '<p>Аккумуляторная батарея состоит из элементов 3PzS 315</p>',
                'type_id' => 1,
                'price' => 144500,
                'capacity' => 315,
                'voltage' => 24,
                'length' => 65,
                'width' => 198,
                'height' => 534,
                'technology_id' => 1
            ],
        ];

        foreach ($dataServices as $item) {
            Item::create($item);
        }

        foreach ($dataAccessories as $item) {
            Item::create($item);
        }

        for ($i=2;$i<=6;$i++) {
            Item::create([
                'name' => 'Ячейка АКБ',
                'description' => '<p>Pellentesque nec pellentesque dui. In porttitor faucibus urna eget auctor. Fusce id nibh at ligula dapibus mattis.</p>',
                'price' => rand(1000,3000),
                'length' => rand(45,190),
                'width' => rand(100,200),
                'height' => rand(300,750),
                'type_id' => 2,
                'plates' => $i
            ]);
        }
    }
}
