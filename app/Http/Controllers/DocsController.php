<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * 接口文档控制器
 * Class DocsController
 * @Auth: kingofzihua
 * @package App\Http\Controllers
 */
class DocsController extends Controller
{
    /**
     * 接口文档 入口文件
     * @Auth:kingofzihua
     * @Desc首先定义 你的接口所在的 目录,`swagger-php` 会扫描你定义的目录，自动合并所有定义。
     */
    public function docs()
    {
        $swagger = \Swagger\scan(app_path());

        return response()->json($swagger, 200);
    }
}
