<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];
    //Taskと多対多の関係
    public function tasks()
    {
        return $this->belongsToMany('App\Task', 'tasks_tags');
    }
}
