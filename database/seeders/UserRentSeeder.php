<?php

namespace Database\Seeders;

use App\Models\Rent;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(30)->create();
        Rent::factory()->count(100)->create();
    }
}
