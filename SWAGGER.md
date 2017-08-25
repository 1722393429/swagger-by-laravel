``` php
    /**
     * @SWG\Swagger(
     *      schemes={"http"},
     *      host="swagger.dev",
     *      basePath="/api/",
     *      produces={"application/x.swagger.v1+json"},
     *      consumes={"application/json"},
     * )
     */
```
#####Swagger说明:
- schemes:定义你的协议方式
- host:定义你的域名
- basePath:定义你的访问的根路径
- produces:指定返回的内容类型
- consumes:指定处理请求的提交内容类型（Content-Type）

```php
    /**
     * @SWG\Info(
     *      version="1.0.0",
     *      title="API 接口文档",
     * ),
     */
```
#####Info说明:
一般来说 Info 在Swagger 里面
- version:版本
- title:标题啦

```php
    /**
     * @SWG\Contact(
     *     name="Swagger API Team",
     *     url="http://www.example.com/support"
     *     email="support@example.com",
     * ),
     */
```
#####Contact(联名)说明:
一般来说 Contact 在 Info 里面
- name:名称啦
- url:地址
- email: 邮箱

```php
    /**
     * @SWG\License(# 许可证
     *     name="MIT",
     *     url="http://www.example.com/support",
     * )
     */
```
#####License(许可证)说明:
一般来说 License 在 Info 里面
- name:名称啦
- url:地址