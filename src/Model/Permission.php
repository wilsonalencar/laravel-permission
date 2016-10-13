<?php
/**
 * Created by: leandro
 * Datetime: 11/10/16 14:34
 */

namespace Leandreaci\LaravelPermission\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Permission extends Model
{
    /**
     * The attributes that are fillable via mass assignment.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}