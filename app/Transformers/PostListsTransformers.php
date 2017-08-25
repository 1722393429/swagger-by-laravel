<?php
namespace App\Transformers;

use App\Models\Post;

/**
 * Class PostListsTransformers
 * @Auth: kingofzihua
 * @package App\Transformers
 */
class PostListsTransformers extends Transformer
{
    /**
     * List of resources possible to include
     * @Auth: kingofzihua
     * @var array
     */
    protected $availableIncludes = [
        'author', //作者
        'comments', //评论
    ];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'author',
        'comments',
    ];


    /**
     * @Auth: kingofzihua
     * @param $model
     * @return array
     */
    public function transFormData($model)
    {
        return [
            'title' => $model->title, //标题
            'desc' => $model->desc, //简介
            'body' => $model->body, //内容
        ];
    }

    /**
     * Include Author
     * @Auth: kingofzihua
     * @return \League\Fractal\ItemResource
     */
    public function includeAuthor(Post $post)
    {
        $author = $post->author;
        if (!count($author))

            return;

        return $this->item($author, new AuthorTransformer);
    }

    /**
     * @Auth: kingofzihua
     * @param Post $post
     * @return \League\Fractal\Resource\Collection
     */
    public function includeComments(Post $post)
    {
        $comments = $post->comments;

        return $this->collection($comments, new CommentsTransformer)->setMeta(['author']);

    }

}