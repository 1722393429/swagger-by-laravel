<?php
namespace App\Repository;

/**
 * 仓库模式基类
 * Class Repository
 * @Auth: kingofzihua
 * @package App\Repository
 */
abstract class Repository
{
    /**
     * 分页条数
     * @Auth: kingofzihua
     * @var
     */
    protected $page = 20;

    /**
     * @Auth: kingofzihua
     * @param $method function name
     * @param $parameters parameter
     * @return mixed
     */
    public static function __callStatic($method, $parameters)
    {
        return (new static())->$method(...$parameters);
    }

    /**
     * @Auth: kingofzihua
     * @param $method function name
     * @param $parameters parameter
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return (new static())->$method(...$parameters);
    }
}