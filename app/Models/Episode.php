<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Episode extends Model
{	
	use Sluggable;
  protected $table = 'episodes';
	protected $fillable = [ 'name', 'ep', 'label', 'drive' ];
  public function sluggable () {
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }
}
