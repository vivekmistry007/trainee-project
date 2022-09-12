<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
               'name'=>'Vivek mistry',
               'email'=>'vm@gmail.com',
                'is_admin'=>'1',
                'action'=>'1',
               'password'=> bcrypt('123456'),
               'mobile'=>'8141667083',
               'img' => 'undraw_profile.svg'
            ]];
            foreach ($userData as $key => $val) {
                User::create($val);
            }
    }
}
