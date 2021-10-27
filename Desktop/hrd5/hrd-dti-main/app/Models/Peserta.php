<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    use HasFactory;
    
    protected $connection = 'mysql_2';
    protected $table = 'peserta_pons';
    protected $fillable = [
        'kode_peserta',
        'name',
        'destinasi',
        'kontingen',
        'tgl_pcr',
        'tgl_keberangkatan',
        'cabor',
        'jam_keberangkatan',
        'tipe_kendaraan',
        'status'
    ];
}
