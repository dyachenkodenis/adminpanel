<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Widget;
use Illuminate\Database\Seeder;

class WidgetSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $widgets = [
            [
                'title' => 'Первый слайд на главной странице',
                'template' => 'home_one_slide',
                'thumbnail' => '/uploads/files/1/homepage/images.png',
            ],[
                'title' => 'Второй слайд на главной странице',
                'template' => 'home_two_slide',
                'thumbnail' => '/uploads/files/1/homepage/images.png',
            ],[
                'title' => 'Третий слайд на главной странице',
                'template' => 'home_three_slide',
                'thumbnail' => '/uploads/files/1/homepage/images.png',
            ],
        ];

        foreach ($widgets as $widget) {
            Widget::updateOrCreate(['template' => $widget['template']], $widget);
        }

    }
}
