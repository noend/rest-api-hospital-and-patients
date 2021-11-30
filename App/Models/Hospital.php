<?php
namespace app\App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * @method static where(string $string, string $string1, $id)
 */
class Hospital extends Model {

    public $timestamps = false;

    protected $table = 'hospital';

    protected $fillable = ['name', 'address', 'phone'];

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'workplace_id', 'id');
    }
}
