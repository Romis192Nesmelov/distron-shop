<?php

namespace Database\Seeders;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['email' => 'romis@nesmelov.com', 'password' => bcrypt('fuckingpassword192'), 'active' => 1, 'email_verified_at' => Carbon::now(), 'is_admin' => true],
            ['email' => 'info@distron.ru', 'password' => bcrypt('distron_shop'),  'active' => 1, 'email_verified_at' => Carbon::now(), 'is_admin' => true]
        ];

        foreach ($data as $user) {
            User::create($user);
        }
    }
}
