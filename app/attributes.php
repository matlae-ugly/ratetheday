<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class attributes extends Model
{
    protected $fillable = [
        'attribute_name', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
