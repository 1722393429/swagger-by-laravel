<?php
namespace App\Validation;

use Validator;

/**
 * Class PostValidation
 * @Auth: kingofzihua
 * @package App\Validation
 */
class PostValidation extends Validation
{
    /**
     * 添加 文章
     * @Auth: kingofzihua
     * @param $data
     * @return mixed
     */
    public function created($data)
    {
        return Validator::make($data, [
            'title' => 'required|unique:posts|max:30',
            'desc' => 'required',
            'body' => 'required',
        ], [
            'title.required' => '标题不许为空',
            'title.unique' => '文章已存在',
            'title.max' => '标题长度不许超过30个字符',
            'desc.required' => '简介不许为空',
            'body.required' => '内容不许为空',
        ]);
    }

    /**
     * 修改文章
     * @Auth: kingofzihua
     * @param $data
     * @return mixed
     */
    public function updated($data)
    {
        return $this->created($data);
    }

}