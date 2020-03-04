<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Film extends Model
{	
	use Sluggable;
  protected $table = 'films';
  protected $fillable = [
      'name', 'other_name', 'type_id', 'slug', 'description', 'ep', 'image', 'background', 'view', 'all_episode', 'year_release'
  ];
  public function sluggable () {
      return [
          'slug' => [
              'source' => 'name'
          ]
      ];
  }
  public function categories()
  {
      return $this->belongsToMany(Category::class);
  }

  public function episodes() {
      return $this->hasMany(Episode::class);
  }

  public function latest_episode () {
    return $this->hasOne(Episode::class)->orderBy('ep','desc')->where('status', 'uploaded')->latest();
  }
}
