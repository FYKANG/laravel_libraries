# laravel_libraries

## 目录

* [tb_resfult(用于对reafult风格的api进行`删改查`)](#tb_resfult)

## 使用实例

* tb_resfult

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
