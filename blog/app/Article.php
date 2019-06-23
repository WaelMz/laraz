<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
