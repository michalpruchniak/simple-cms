<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::create([
            'title'         => 'Test article',
            'description'   => '<p>Hello World</p>',
            'category_id'   => 1
        ]);
    }
}
