<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Snippet extends Model {

	protected $fillable = ['tag', 'body', 'lang'];

}
