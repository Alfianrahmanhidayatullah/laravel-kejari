<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $judul
 * @property string $deskripsi
 * @property string $gambar
 * @property string $created_at
 * @property string $updated_atd
 */
class Berita extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'berita';

    /**
     * @var array
     */
    protected $fillable = ['judul', 'deskripsi', 'gambar', 'created_at', 'updated_at'];
}
