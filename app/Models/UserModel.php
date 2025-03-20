<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable = ['level_id', 'username', 'nama', 'password', 'created_at', 'updated_at'];

    protected $hidden = ['password'];

    protected $cast = ['password' => 'hashed'];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}

// //One to One
// class UserModel extends Model
// {
//     public function level(): BelongsTo
//     {
//         return $this->belongsTo(LevelModel::class);
//     }
// }

// Mendefinisikan Kebalikan dari Hubungan One-to-one
class LevelModel extends Model
{
    use HasFactory;

    protected $table = 'm_level'; // Pastikan ini sesuai dengan nama tabel di database
    protected $primaryKey = 'level_id'; // Primary key tabel

    protected $fillable = ['level_nama', 'level_kode'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(UserModel::class, 'level_id', 'level_id');
    }
}

//One to Many
class KategoriModel extends Model
{
    public function barang(): HasMany
    {
        return $this->hasMany(BarangModel::class, 'barang_id', 'barang_id');
    }
}

// One to Many (Inverse) / Belongs To
class BarangModel extends Model
{
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriModel::class, 'kategori_id', 'kategori_id');
    }
}
