<?php
namespace App\Models;

/**
 * Class Post 文章
 * @Auth: kingofzihua
 * @package App\Models
 */
class Post extends Model
{

    /**
     * @Auth: kingofzihua
     * @var array
     */
    protected $fillable = [
        'title', 'desc', 'body', 'user_id',
    ];

    /**
     * 作者
     * @Auth: kingofzihua
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');//所要关联的表  外键   外键表的主键
    }

    /**
     * 评论
     * @Auth: kingofzihua
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }

}
