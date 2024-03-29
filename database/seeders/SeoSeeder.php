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
            ['title' => 'Distron-shop. Статьи'],
        ];

        foreach ($data as $item) {
            Seo::create($item);
        }
    }
}
