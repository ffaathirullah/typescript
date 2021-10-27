<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'email'     => 'hrd@gmail.com',
            'password'  => Hash::make('hrd031100'),
            'pegawai_id' => 1,
            'role'  => 'admin',
            'username' => 'hrd',
            'photo' => 'assets/dokumen/user/ZPYehUaxrr0hwfvezGJtvXCFUUQfBAmo7neykBGN.jpg'
        ]);

        User::create([
            'email'     => 'pon@gmail.com',
            'password'  => Hash::make('pon031100'),
            'pegawai_id' => 1,
            'role'  => 'pon',
            'username' => 'pon',
            'photo' => 'assets/dokumen/user/ZPYehUaxrr0hwfvezGJtvXCFUUQfBAmo7neykBGN.jpg'
        ]);
    }
}
