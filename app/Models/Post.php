<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="Post",
 *      required={"title","author_id","category_id","content"},
 *      @OA\Property(
 *          property="title",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="content",
 *          description="",
 *          readOnly=false,
 *          nullable=false,
 *          type="string",
 *      ),
 *      @OA\Property(
 *          property="created_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      ),
 *      @OA\Property(
 *          property="updated_at",
 *          description="",
 *          readOnly=true,
 *          nullable=true,
 *          type="string",
 *          format="date-time"
 *      )
 * )
 */class Post extends Model
{
    use HasFactory;    public $table = 'posts';

    public $fillable = [
        'title',
        'author_id',
        'category_id',
        'content'
    ];

    protected $casts = [
        'title' => 'string',
        'content' => 'string'
    ];

    public static array $rules = [
        'title' => 'required|string|max:200',
        'author_id' => 'required',
        'category_id' => 'required',
        'content' => 'required|string',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Author::class, 'author_id');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'post_tag');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Comment::class, 'post_id');
    }

    public function comment1s(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Comment::class, 'post_comment');
    }
}
