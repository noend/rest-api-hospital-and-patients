<?php
namespace app\App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * @method static where(string $string, string $string1, int $int)
 */
class User extends Model
{
    public $timestamps = false;

    protected $table = 'user';

    protected $fillable = ['email', 'first_name', 'last_name', 'type', 'workplace_id'];

    public function hospital(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hospital::class, 'workplace_id', 'id');
    }
}
