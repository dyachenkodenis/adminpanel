<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Locale;

class LocaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locales = [
            ['code' => 'ru', 'name' => 'Ru'],
            ['code' => 'uz', 'name' => 'Uz'],
            ['code' => 'en', 'name' => 'En']
        ];
        foreach ($locales as $loc) {
            Locale::updateOrCreate(['code' => $loc['code']], $loc);
        }
    }
}
