<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        'name' => 'Gerardo Cuzco',
        'email' => 'gcuzco@gmail.com',
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        ]);

        Role::create([
        	'name'		=> 'Admin',
        	'slug'  	=> 'slug',
        	'special' 	=> 'all-access'
        ]);

        DB::table('role_user')->insert(
        ['role_id' => '1', 'user_id' => '1']
        );
    }
}
