<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';
    protected $fillable = [
        'nip',
        'nama',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'status',
        'tlp',
        'bidang_id',
        'jabatan_id',
        'shift_id'
    ];

    public function bidang(){
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }

    public function shift(){
        return $this->belongsTo(Shift::class, 'shift_id');
    }

    public function jabatan(){
        return $this->belongsTo(Jabatan::class, 'jabatan_id');
    }

    public function lembur(){
        return $this->hasMany(Lembur::class, 'pegawai_id');
    }

    public function project(){
        return $this->hasMany(Project::class, 'pegawai_id');
    }

    public function cuti(){
        return $this->hasMany(Cuti::class, 'pegawai_id');
    }

    public function absen(){
        return $this->hasMany(Absen::class, 'pegawai_id');
    }

    public function sp(){
        return $this->hasMany(Sp::class, 'pegawai_id');
    }

    public function sppd(){
        return $this->hasMany(Sppd::class, 'pegawai_id');
    }

    public function penilaiankerja(){
        return $this->hasMany(PenilaianKerja::class, 'pegawai_id');
    }

    public function bpjs(){
        return $this->hasOne(Bpjs::class, 'pegawai_id');
    }

    public function gaji(){
        return $this->hasMany(Gaji::class, 'pegawai_id');
    }

    public function users(){
        return $this->hasOne(Users::class, 'pegawai_id');
    }

    public function pinjaman(){
        return $this->hasMany(Pinjaman::class, 'pegawai_id');
    }

    public function pegawaiexit(){
        return $this->hasOne(Pegawaiexit::class, 'pegawai_id');
    }

    public function pengumumanhr(){
        return $this->hasMany(Pengumumanhr::class, 'pegawai_id');
    }

    public function kebijakanhr(){
        return $this->hasMany(Kebijakanhr::class, 'created_by');
    }
}
