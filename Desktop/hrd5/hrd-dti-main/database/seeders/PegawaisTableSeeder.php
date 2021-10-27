<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pegawai::create([
            'nip'   => '0833112bbg',
            'nama' => 'hrd',
            'tempat_lahir'  => 'bandung',
            'tanggal_lahir' => '2000-09-06',
            'jenis_kelamin' => 'laki-laki',
            'alamat'    => 'bandung',
            'status'    => 'belum kawin',
            'tlp'   => '082215778220',
            'bidang_id' => 1,
            'jabatan_id' => 1,
            'shift_id'  => 1,
        ]);

        Pegawai::create([
            'nip'   => '0833112bbgo',
            'nama' => 'pon',
            'tempat_lahir'  => 'bandung',
            'tanggal_lahir' => '2000-09-06',
            'jenis_kelamin' => 'laki-laki',
            'alamat'    => 'bandung',
            'status'    => 'belum kawin',
            'tlp'   => '082215778220',
            'bidang_id' => 1,
            'jabatan_id' => 1,
            'shift_id'  => 1,
        ]);
    }
}
