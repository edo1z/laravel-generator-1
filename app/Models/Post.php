<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $table = 'posts';

    public $fillable = [
        'title',
        'content'
    ];

    protected $casts = [
        'title' => 'string',
        'content' => 'string'
    ];

    public static array $rules = [
        'title' => 'required',
        'content' => 'required'
    ];

    
}
