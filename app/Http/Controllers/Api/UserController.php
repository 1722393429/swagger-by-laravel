<?php
namespace App\Http\Controllers\Api;

/**
 * 用户
 * Class UserController
 * @Auth: kingofzihua
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    protected $user;

    /**
     * @Auth: kingofzihua
     * UserController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

}