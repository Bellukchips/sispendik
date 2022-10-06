<?php

use App\School;
use Illuminate\Database\Seeder;
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
            'name' => 'Admin Sispendik',
            'email' => 'sispendikapps@gmail.com',
            'email_verified_at' => now(),
            'id_users'=> 101,
            'password' => bcrypt('sispendikappsadmin'),
            'password' => 'sispendikappsadmin',
            'role' => 0,
            'status' => true,
            'deleted_status'=>0
        ]);
        School::create([
            'name' => 'Sispendik',
            'code' => 101,
            'id' => 1,
            'address' => 'Jl. Setia Budi Dukuh wringin Kab.Tegal Kec.Slawi'
        ]);
    }
}
