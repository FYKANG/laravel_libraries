<?php

namespace App\Http\libraries;

class upload_image {
    public function upload_image(){
        return "upTest";
    }
    public function uniqid_img(){
        $Path = "/public/upload/ActivityImg/";
        if (!empty($_FILES['file'])) {
            //获取扩展名
            $exename = $this->getExeName($_FILES['file']['name']);
            if ($exename != 'png' && $exename != 'jpg' && $exename != 'gif') {
                exit('不允许的扩展名');
            }
            $fileName = base_path().$Path.date('Ym');//文件路径
            $upload_name = '/img_'.date("YmdHis").rand(0, 100).'.'.$exename;//文件名加后缀
            if (!file_exists($fileName)) {
                //进行文件创建
                mkdir($fileName, 0777, true);
            }
            $imageSavePath = $fileName . $upload_name;
            if (move_uploaded_file($_FILES['file']['tmp_name'], $imageSavePath)) {
                return $Path . date('Ym') . $upload_name;
            }
        }
    }
    public function getExeName($fileName){
        $pathinfo = pathinfo($fileName);
        return strtolower($pathinfo['extension']);
    }
}