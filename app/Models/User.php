<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $nama_lengkap
 * @property integer $nomor_induk
 * @property string $role
 * @property string $alamat
 * @property string $created_at
 * @property string $updated_at
 * @property Materi[] $materis
 * @property Notifikasi[] $notifikasis
 */
class User extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'user';

    /**
     * @var array
     */
    protected $fillable = ['email', 'password', 'nama_lengkap', 'nomor_peserta', 'pelatihan_id', 'role', 'alamat', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pelatihans()
    {
        return $this->hasMany('App\Models\Pelatihan');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifikasis()
    {
        return $this->hasMany('App\Models\Notifikasi');
    }
}
