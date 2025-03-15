<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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