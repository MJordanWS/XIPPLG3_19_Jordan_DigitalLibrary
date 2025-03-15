<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    protected $fillable = [
        'user_id',
        'book_id',
        'rating',
        'comment',
        'created_date'
    ];

    public function user()
    {
        return $this->belongsTo(User2::class);
    }

    public function book()
    {
        return $this->belongsTo(Books::class);
    }
}
