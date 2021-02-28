<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reservation')->insert([
            'email' => Str::random(10).'@gmail.com',
            'date' => today()->addWeeks(rand(1, 52))->format('Y-m-d H:i'),
            'token' => md5(uniqid(true)),
            'confirm' => rand(0,1),
        ]);
    }
}
