<?php
namespace App\Repository;

use App\Models\User;

/**
 * Class UserRepository
 * @Auth: kingofzihua
 * @package App\Repository
 */
class UserRepository extends Repository
{
    /**
     * 获取所有的用户信息
     * @Auth: kingofzihua
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    protected function get_user_all_data()
    {
        return User::all();
    }

    /**
     * 获取用户分页数据
     * @Auth: kingofzihua
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function get_user_data_list()
    {
        return User::paginate($this->page);
    }
}