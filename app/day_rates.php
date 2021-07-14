<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class day_rates extends Model
{
    protected $fillable = [
        'user_id', 'day', 'attributes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
