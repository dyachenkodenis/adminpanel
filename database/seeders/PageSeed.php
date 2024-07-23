<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Page;

class PageSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Главная страница',
                'status' => 'activate',
                'template' => 'front_page',
                'slug' => 'home',
            ],
            [
                'title' => 'О компании',
                'status' => 'activate',
                'template' => 'about_page',
                'slug' => 'about',
            ],
            [
                'title' => 'Контакты',
                'status' => 'activate',
                'template' => 'contact_page',
                'slug' => 'contacts',
            ]
        ];


        foreach ($pages as $page) {
            Page::updateOrCreate(['slug' => $page['slug']], $page);
        }

    }
}
