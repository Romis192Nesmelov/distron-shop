<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['contact' => '125167, г.Москва,<br>4-я улица 8 Марта, 6А', 'type' => 1],
            ['contact' => '+7(926)333-22-11', 'type' => 2],
            ['contact' => 'info@distron.ru', 'type' => 3],
            ['contact' => '<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A2e46a7c4af371d2653e709cb2dd429e6e9044779994ccf20fd13224e3919e106&amp;source=constructor" width="100%" height="450" frameborder="0"></iframe>', 'type' => 4],
            ['contact' => '141960, Московская область, Талдомский городской округ, рабочий посёлок Запрудня, улица Ленина, 1, помещение 100', 'type' => 5],
        ];

        foreach ($data as $item) {
            Contact::create($item);
        }
    }
}
