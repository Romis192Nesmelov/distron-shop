<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
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
        $this->call(SeoSeeder::class);
        $this->call(GalleriesSeeder::class);
        $this->call(ContentsSeeder::class);
        $this->call(QuestionsSeeder::class);
        $this->call(ContactsSeeder::class);
        $this->call(TypesSeeder::class);
        $this->call(TechnologiesSeeder::class);
        $this->call(ItemsSeeder::class);
        $this->call(ArticlesSeeder::class);
//        Article::factory(10)->create();
//        $this->call(MetricsSeeder::class);
    }
}
