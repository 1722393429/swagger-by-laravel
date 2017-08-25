<?php
namespace App\Transformers;

use App\Models\User;

/**
 * 用户
 * Class AuthorTransformer
 * @Auth: kingofzihua
 * @package App\Transformers
 */
class AuthorTransformer extends Transformer
{

    /**
     * Turn this item object into a generic array
     * @Auth: kingofzihua
     * @param $model
     * @return array
     */
    public function transFormData($model)
    {
        return [
            'name' => $model->name,
            'email' => $model->email,
        ];
    }

}