<?php

/**
 * @Auth: kingofzihua
 * @Date: 2017-08-15
 */
namespace App\Transformers;

use App\Models\Model;
use League\Fractal\TransformerAbstract;

/**
 * Transformers 基类
 * Class Transformer
 * @Auth: kingofzihua
 * @package App\Transformers
 */
abstract class Transformer extends TransformerAbstract
{
    /**
     * @todo: transFormData
     * @Auth: kingofzihua
     * @return: mixed
     */
    public function transform($model)
    {
        $data = $this->transformData($model);

        // 转换 null 字段为空字符串
        foreach (array_keys($data) as $key) {
            if (!isset($data[$key])) {
                $data[$key] = '';
                continue;
            }
            if (is_null($data[$key])) {
                $data[$key] = '';
            }
        }

        return $data;
    }

    /**
     * Turn this item object into a generic array
     * @Auth: kingofzihua
     * @param $model
     * @return array
     */
    abstract public function transFormData($model);
}