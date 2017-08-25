<?php
namespace App\Transformers;

use App\Models\Comment;
use App\Models\User;

/**
 * 用户
 * Class AuthorTransformer
 * @Auth: kingofzihua
 * @package App\Transformers

 */
class CommentsTransformer extends Transformer
{
    /**
     * List of resources possible to include
     * @Auth: kingofzihua
     * @var array
     */
    protected $availableIncludes = [
        'author',
    ];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
//        'author'
    ];


    /**
     * Turn this item object into a generic array
     * @Auth: kingofzihua
     * @param $model
     * @return array
     */
    public function transFormData($model)
    {
        return [
            'body' => $model->body, //内容
        ];
    }

    /**
     * Include Author
     * @Auth: kingofzihua
     * @return \League\Fractal\ItemResource
     */
    public function includeAuthor(Comment $comment)
    {
        $author = $comment->author;

        return $this->item($author, new AuthorTransformer);
    }

}