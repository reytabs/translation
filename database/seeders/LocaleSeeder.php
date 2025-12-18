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
        foreach (locales() as $key => $locale) {
            Locale::create([
                'code' => $key,
                'name' => $locale,
                'is_active' => 1,
            ]);
        }
    }
}
