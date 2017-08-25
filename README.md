# 在Laravel中使用swagger写Api文档
在PHP中使用Swagger，我们需要一个工具去编写和解析Annotation到Swagger的描述（例如JSON形式），Swagger丰富的生态不是吹的，这里我们直接使用前人写好的swagger-php。而编写API我们则使用Laravel框架(5.4)。当然，swagger-php本身和用哪种框架开发是没关系的
laravel 中部署swagger-php 请看这里  [链接地址](http://www.jianshu.com/p/6840514c4c8e)

项目中还需要 [dingo/api](https://github.com/dingo/api) [laravel/passport](http://d.laravel-china.org/docs/5.4/passport) 默认以为你装好了，具体的可以查看文档，这些不是重点

首先 我们要定义一个路由用来访问接口文档的入口

创建一个接口文档的控制器**DocsController**
在下面添加下面代码
``` php
    public function docs()
    {
        $swagger = \Swagger\scan(app_path()); 

        return response()->json($swagger, 200);
    }
```
使用`\Swagger\scan()`定义你的接口所在的 目录,`swagger-php` 会扫描你定义的目录，自动合并所有定义。

然后定义你的接口的主信息 
``` php
    /**
     * @SWG\Swagger(
     *      schemes={"http"},
     *      host="swagger.dev",
     *      basePath="/api/",
     *      produces={"application/x.swagger.v1+json"},
     *      consumes={"application/json"},
     *      @SWG\Info(
     *          version="1.0.0",
     *          title="API 接口文档",
     *      ),
     * )
     */
```
#####Swagger说明:
- schemes:定义你的协议方式
- host:定义你的域名
- basePath:定义你的访问的根路径
- produces:指定返回的内容类型
- consumes:指定处理请求的提交内容类型（Content-Type）
#####Info说明:
- version:版本
- title:标题啦
        
访问一下/swagger/docs，如果我们看到下面的返回就说明搭建成功了：
```json
{
    "swagger": "2.0",
    "info": {
        "title": "API 接口文档",
        "version": "1.0.0"
    },
    "host": "swagger.dev",
    "basePath": "/api/",
    "schemes": [
        "http"
    ],
    "consumes": [
        "application/json"
    ],
    "produces": [
        "application/x.swagger.v1+json"
    ]
}
```