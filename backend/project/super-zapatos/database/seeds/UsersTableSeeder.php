<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$users = [];
    	$users[] = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456789'),
        ];
        $users[] = [
            'name' => 'otheradmin',
            'email' => 'otheradmin@gmail.com',
            'password' => bcrypt('987654321'),
        ];

        DB::table('users')->insert();
    }
}
