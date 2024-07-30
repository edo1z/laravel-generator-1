<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 use Illuminate\Database\Eloquent\Factories\HasFactory;
/**
 * @OA\Schema(
 *      schema="Comment",
 *      required={"commenter_name","content","post_id"},
 *      @OA\Property(
 *          property="commenter_name",
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
 */class Comment extends Model
{
    use HasFactory;    public $table = 'comments';

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
