<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $language = new Language();
        $language->lang = 'en';
        $language->name = 'English';
        $language->slug = 'en';
        $language->is_default = 1;
        $language->status = 1;
        $language->save();
    }
}
