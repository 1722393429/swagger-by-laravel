<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Validation\PostValidation;
use App\Repository\PostRepository;
use App\Transformers\PostListsTransformers;

/**
 * Class PostController
 * @Auth: kingofzihua
 * @package App\Http\Controllers\Api
 */
class PostController extends Controller
{
    /**
     * @Auth: kingofzihua
     * @var PostRepository
     */
    protected $post;

    /**
     * @Auth: kingofzihua
     * PostController constructor.
     * @param $post
     */
    public function __construct(PostRepository $post)
    {
        $this->post = $post;
    }

    /**
     * @Auth: kingofzihua
     * @return \Dingo\Api\Http\Response
     */
    public function lists()
    {
        $list = $this->post->get_post_data_list();

        return $this->response->paginator($list, new PostListsTransformers())->setMeta([
            'author', 'comments',
        ]);
    }

    /**
     * @Auth: kingofzihua
     * @return \Dingo\Api\Http\Response
     */
    public function store(Request $request, PostValidation $validation)
    {
        $validator = $validation->created($request->all());

        if ($validator->fails()) {
            return $this->error(100, $validator->errors()->first());
        }

        $post = $this->post->created(array_merge($request->all(), ['user_id' => \Auth::user()->id]));

        if ($post) {
            return $this->response()->item($post, new PostListsTransformers())->setMeta([
                'author', 'comments',
            ]);
        }

        return $this->error(100, '添加失败');
    }

    /**
     * @Auth: kingofzihua
     * @param $post_id
     * @param Request $request
     * @param PostValidation $validation
     * @return \Dingo\Api\Http\Response
     */
    public function update($post_id, Request $request, PostValidation $validation)
    {
        $validator = $validation->created($request->all());


        if ($validator->fails()) {
            return $this->error(100, $validator->errors()->first());
        }

        //应该加权限的吧

        $post = $this->post->get_post_data_by_id($post_id);

        $update = $post->update($request->all());

        if ($update) {
            return $this->response()->item($post, new PostListsTransformers())->setMeta([
                'author', 'comments',
            ]);
        }

        return $this->error(100, '修改失败');
    }

    /**
     * @Auth: kingofzihua
     * @param $post_id
     * @param Request $request
     * @param PostValidation $validation
     * @return \Dingo\Api\Http\Response
     */
    public function destroy($post_id)
    {
        //应该加权限的吧

        $delete = $this->post->delete_post_data_by_id($post_id);

        if ($delete) {
            return $this->success('删除成功');
        }

        return $this->error(100, '删除失败');
    }

}