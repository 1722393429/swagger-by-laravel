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
     *
     * @SWG\Get(
     *     path="/post/lists",
     *     summary="获取文章列表",
     *     operationId="lists",
     *     tags={"Post"},
     *     @SWG\Parameter( name="page", in="query", description="页码", required=false, type="integer", format="int32" ),
     *     @SWG\Response(
     *         response=200,
     *         description="获取成功",
     *         @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Post"),
     *         ),
     *     ),
     * )
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
     * @SWG\Post(
     *     path="/post/store",
     *     summary="添加文章",
     *     operationId="store",
     *     tags={"Post"},
     *     consumes={"application/json"},
     *     @SWG\Parameter( name="FormData", in="body", description="所要添加的数据", required=true, @SWG\Schema(ref="#/definitions/Post")),
     *     security={
     *       {"petstore_auth": {"write:pets", "read:pets"}}
     *     },
     *     @SWG\Response(
     *         response=200,
     *         description="添加成功",
     *         @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Post"),
     *         ),
     *     ),
     *     @SWG\Response( response="100", description="添加失败"),
     *     @SWG\Response( response="500", description="Unauthenticated"),
     * )
     *
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
     *
     * @SWG\Put(
     *     path="/post/update/{post_id}",
     *     summary="修改文章",
     *     operationId="update",
     *     tags={"Post"},
     *     consumes={"application/json"},
     *     @SWG\Parameter( name="post_id", in="path", description="所要修改的文章编号", required=true,type="number"),
     *     @SWG\Parameter( name="FormData", in="body", description="所要修改的数据", required=true, @SWG\Schema(ref="#/definitions/Post")),
     *     security={
     *       {"petstore_auth": {"write:pets", "read:pets"}}
     *     },
     *     @SWG\Response(
     *         response=200,
     *         description="修改成功",
     *         @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/Post"),
     *         ),
     *     ),
     *     @SWG\Response( response="100", description="修改失败"),
     *     @SWG\Response( response="500", description="Unauthenticated"),
     * )
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
     *
     * @SWG\delete(
     *     path="/post/destroy/{post_id}",
     *     summary="删除文章",
     *     operationId="delete",
     *     tags={"Post"},
     *     consumes={"application/json"},
     *     @SWG\Parameter( name="post_id", in="path", description="所要删除的文章编号", required=true,type="number"),
     *     security={
     *       {"petstore_auth": {"write:pets", "read:pets"}}
     *     },
     *     @SWG\Response( response="200", description="删除成功"),
     *     @SWG\Response( response="100", description="删除失败"),
     *     @SWG\Response( response="500", description="Unauthenticated"),
     * )
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