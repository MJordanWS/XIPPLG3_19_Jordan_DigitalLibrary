<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $fillable = [
        'title',
        'writer',
        'user_id',
        'category_id',
        'publisher',
        'year',
    ];

    public function user()
    {
        return $this->belongsTo(User2::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function loans()
    {
        return $this->hasMany(loans::class);
    }
}
