<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => 'app_name',
                'value' => 'AS2E'
            ],
            [
                'key' => 'date_format',
                'value' => 'MM/DD/YYYY'
            ],
            [
                'key' => 'pagination_limit',
                'value' => 10
            ],
            [
                'key' => 'logo',
                'value' => 'as2e.png',
            ]
        ]);
    }
}
