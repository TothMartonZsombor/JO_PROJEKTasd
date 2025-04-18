<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Theme;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        Theme::insert([
            ['name' => 'Technika', 'image' => 'technika.JPG'],
            ['name' => 'Iskola', 'image' => 'iskola.JPG'],
            ['name' => 'Háztartás', 'image' => 'haztartas.JPG'],
            ['name' => 'Zene', 'image' => 'zene.JPG'],
        ]);
    }
}
