<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::create([
            'name' => 'Scripts',
            'slug' => 'scripts'
        ]);
        \App\Models\Category::create([
            'name' => 'Apps/Mobiles',
            'slug' => 'mobile'
        ]);
        \App\Models\Category::create([
            'name' => 'Plusgins/Addons',
            'slug' => 'plugins'
        ]);
        \App\Models\Category::create([
            'name' => 'Nulled CMS',
            'slug' => 'nulled-cms'
        ]);
    }
}
