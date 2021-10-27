<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatans';
    protected $fillable = [
        'nama',
        'gaji'
    ];


    public function pegawai(){
        return $this->hasMany(Pegawai::class, 'jabatan_id');
    }
}
