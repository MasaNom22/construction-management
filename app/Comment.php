<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'name', 'comment',
    ];

    protected $guarded = [
        'create_at', 'update_at',
    ];
}
