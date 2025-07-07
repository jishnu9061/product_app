<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Toyota', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Honda', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Ford', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'BMW', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Tesla', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('brands')->insert($brands);
    }
}
