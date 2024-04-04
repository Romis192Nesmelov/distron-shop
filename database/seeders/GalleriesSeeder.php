<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class GalleriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['batteries.png','battery1.jpg','loader.jpg','two_batteries.jpg'];

        foreach ($data as $image) {
            Image::create(['image' => 'images/gallery/'.$image]);
        }
    }
}
