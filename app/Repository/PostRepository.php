<?php
namespace App\Repository;

use App\Models\Post;

/**
 * Class PostRepository
 * @Auth: kingofzihua
 * @package App\Repository
 */
class PostRepository extends Repository
{

    /**
     * 添加文章
     * @Auth: kingofzihua
     * @param $data
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    protected function created($data)
    {
        return Post::create($data);
    }

    /**
     * 通过编号获取文章
     * @Auth: kingofzihua
     * @param $post_id
     * @return mixed|static
     */
    protected function get_post_data_by_id($post_id)
    {
        return Post::find($post_id);
    }

    /**
     * 获取所有的文章信息
     * @Auth: kingofzihua
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function get_all_post_data()
    {
        return Post::all();
    }

    /**
     * 获取分页数据
     * @Auth: kingofzihua
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function get_post_data_list()
    {
        return Post::paginate($this->page);
    }

    /**
     * 根据编号删除文章数据
     * @Auth: kingofzihua
     * @param $post_id
     * @return bool
     */
    protected function delete_post_data_by_id($post_id)
    {
        $post = $this->get_post_data_by_id($post_id);

        if (count($post)) {
            return $post->delete();
        }

        return true;
    }

}