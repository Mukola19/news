<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('articles')->insert([
                'title' => $i . 'The title of the article',
                'img' => 'articles/aD8kYY8RgWqzas6087EHsTtz4Wi4KmtkgTIjdfbj.jpg',
                'text' => 'Щоб створити нову таблицю бази даних, використовуйте  на Schemaфасаді. Метод createприймає два аргументи: перший — ім’я таблиці, а другий — замикання, яке отримує Blueprintоб’єкт, який можна використовувати для визначення нової таблиці:' ,
                'active' => true,
            ]);
        }
    }
}
