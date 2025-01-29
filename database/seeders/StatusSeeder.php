<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Status::query()->insert([
            [
                'name' => 'new',
            ],
            [
                'name' => 'approved',
            ]
        ]);
    }
}
