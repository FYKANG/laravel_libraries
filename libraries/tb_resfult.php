<?php
namespace App\Http\libraries;
use Illuminate\Support\Facades\Log;//错误日志

class tb_resfult {

    public function tb_resfult(){
        return 'tb_resfult';
    }
    /**
     * 显示所有信息
     * 
     * @param Illuminate\Database\Eloquent\Model $tb 
     * @return \Illuminate\Http\Response
     */
    public function tb_index($tb){
        try{
            $message=$tb->all();
            return response()->json(['message' => $message],200);
        }catch(\Illuminate\Database\QueryException $e){
            Log::error($e->errorInfo);
            return response()->json(['erro' => '查询异常'],422);
        }
    }

    /**
     * 对表进行查询操作
     *
     * @param  int  $id
     * @param Illuminate\Database\Eloquent\Model $tb
     * @return \Illuminate\Http\Response
     */
    public function tb_show($id,$tb){
        try{
            $message=$tb::find($id);
            if($message==null){
                return response()->json(['message' => '无此id记录'],422);
            }else{
                return response()->json(['message' => $message],200);
            }
        }catch(\Illuminate\Database\QueryException $e){
            Log::error($e->errorInfo[2]);
            return response()->json(['erro' => '查询异常'],422);
        }
    }

    /**
     * 对表进行更新操作
     * 
     * @param Illuminate\Foundation\Http\FormRequest $request
     * @param int $id 
     * @param Illuminate\Database\Eloquent\Model $tb
     * @return \Illuminate\Http\Response
     */
    public function tb_update($request,$id,$tb){
        $message=null;
        $con=$request->all();
        try{
            $Model=$tb::find($id);
            if($Model!=null){
                foreach($con as $key=>$value){
                    $message[$key]=$value;
                    $Model->update([$key=>$value]);
                }
                $message['succ']="更新成功";
                return response()->json(['message' => $message],200);
            }else{
                return response()->json(['erro' => '无此id'],422);
            }
        }catch(\Illuminate\Database\QueryException $e){
            Log::error($e->errorInfo[2]);
            return response()->json(['erro' => '更新异常'],422);
        }
    }

    /**
     * 对表进行删除操作
     * 
     * @param int $id
     * @param Illuminate\Database\Eloquent\Model $tb
     * @return \Illuminate\Http\Response
     */
    public function tb_destroy($id,$tb)
    {
        try{
            $Model=$tb::find($id);
            if($Model!=null){
                $Model->delete();
                return response()->json(['message' => '删除成功'],200);
            }else{
                return response()->json(['erro' => '无此id'],422);
            }
        }catch(\Illuminate\Database\QueryException $e){
            Log::error($e->errorInfo[2]);
            return response()->json(['erro' => '删除异常'],422);
        }
    }
}