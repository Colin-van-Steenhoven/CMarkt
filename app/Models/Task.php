<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'task_tag');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }
}
