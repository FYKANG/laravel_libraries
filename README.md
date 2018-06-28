# laravel_libraries

## 目录

* [tb_resfult(用于对reafult风格的api进行`删改查`)](#tb_resfult)

* [upload_img(用于接收微信小程序的图片上传)](#upload_img)

## 使用实例

### tb_resfult

* 使用示例

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;//request操作
use App\Join;//mode层注入
use App\Http\libraries\tb_resfult;//封装类的使用
use Illuminate\Support\Facades\Log;//错误日志
use App\Http\Requests\JoinRequest;//JoinRequest表单验证
class JoinController extends Controller
{
    /**
     * 显示所有参与表信息
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $join=new Join;
        $tb_resfult=new tb_resfult;//tb操作
        $tb_index=$tb_resfult->tb_index($join);
        return $tb_index;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

    }

    /**
     *创建一个参与表信息
     *
     * @param  App\Http\Requests\JoinRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JoinRequest $request)
    {
        //
    }

    /**
     * 查询指定id参与表信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $join=new Join;
         $tb_resfult=new tb_resfult;//tb操作
        $tb_show=$tb_resfult->tb_show($id,$person);
        return $tb_show;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 更新指定id参与表信息
     *
     * @param  App\Http\Requests\JoinRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JoinRequest $request,$id)
    {
        $join=new Join;
        $tb_resfult=new tb_resfult;//tb操作
        $tb_update=$tb_resfult->tb_update($request,$id,$join);
        return $tb_update;
    }

    /**
     * 删除指定id参与表信息
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $join=new Join;
        $tb_resfult=new tb_resfult;//tb操作
        $tb_update=$tb_resfult->tb_destroy($id,$join);
        return $tb_update;
    }
}

```

### upload_img

* 使用示例

```php
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
            $upload = new upload_image;
            $image_url = 'https://test' . $upload->uniqid_img();
            return $image_url;
        } catch (\Exception $e) {
            #code........
            return response()->json(['erro' => '图片上传异常'], 422);
        }
    }
```

* laravel中自定义异常捕捉
  * 在`app\Exceptions`目录中放入`upload_imgException.php`
  * 异常类编写在upload_imgException.php
  * laravel中引入异常类(向Handler.php修改添加以下内容)

  ```php
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // 如果config配置debug为true ==>debug模式的话让laravel自行处理
        if(config('app.debug')){
            return parent::render($request, $exception);
        }
        return parent::render($request, $exception);
    }

    /**
     * 新添加的handle函数
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Exception $e){ // 只处理自定义的upload_imgException异常
        if($e instanceof upload_imgException) {
            $result = [ "msg" => "", "data" => $e->getMessage(), "status" => 0 ];
            return response()->json($result);
        }
        return parent::render($request, $e);
    }
  ```
