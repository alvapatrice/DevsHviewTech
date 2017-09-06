<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

	protected $fillable = ['image_name', 'thumb_name', 'image_original_name'];

}
