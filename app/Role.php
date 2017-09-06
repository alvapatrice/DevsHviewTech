<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model {

	protected $table = 'roles';

    protected $fillable = ['name'];

    /**
     * Roles can be asociated with many users
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        $this->belongsToMany('App\User');
    }

}
