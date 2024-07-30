<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';

    public $fillable = [
        'commenter_name',
        'content',
        'post_id'
    ];

    protected $casts = [
        'commenter_name' => 'string',
        'content' => 'string'
    ];

    public static array $rules = [
        'commenter_name' => 'required|string|max:100',
        'content' => 'required|string',
        'post_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function post(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Post::class, 'post_id');
    }

    public function post1s(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Post::class, 'post_comment');
    }
}
