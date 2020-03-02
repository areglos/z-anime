<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Type extends Model
{	
	use Sluggable;
	protected $fillable = ['name'];
  public function sluggable () {
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }

  public function films() {
      return $this->hasMany(Film::class);
  }
}
