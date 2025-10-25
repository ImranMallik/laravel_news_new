<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

  protected $guarded = [];


   public function news()
{
    return $this->belongsToMany(News::class, 'news_tags', 'tag_id', 'news_id');
}

}
