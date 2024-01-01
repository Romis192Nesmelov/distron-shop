<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(IconsSeeder::class);
        $this->call(ContentsSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(TypesSeeder::class);
        Item::factory(100)->create();
//        $this->call(MetricsSeeder::class);
    }
}
