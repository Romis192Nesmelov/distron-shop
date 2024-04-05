<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Seo;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['title' => 'Distron-shop'],
            ['title' => 'Distron-shop. О компании'],
            ['title' => 'Distron-shop. Требования к АКБ'],
            ['title' => 'Distron-shop. Партнерам'],
            ['title' => 'Distron-shop. Товары'],
            ['title' => 'Distron-shop. Услуги'],
            ['title' => 'Distron-shop. Акции'],
            ['title' => 'Distron-shop. Статьи'],
            ['title' => 'Distron-shop. Контакты'],
        ];

        foreach ($data as $item) {
            Seo::create($item);
        }
    }
}
