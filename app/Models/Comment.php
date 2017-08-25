<?php

namespace App\Models;

/**
 * Class Comment 评论
 * @Auth: kingofzihua
 * @package App\Models
 */
class Comment extends Model
{
    /**
     * 作者
     * @Auth: kingofzihua
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');//所要关联的表  外键   外键表的主键
    }
}
