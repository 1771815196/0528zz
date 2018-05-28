<?php
namespace app\home\controller;
use core\view\View;
use system\model\Article;

class Entry{
//    创建
    public function index(){

//        View::make();
//        return (new View())->make();
//    }
//    public function add(){
//        return View::make();

//        Article::find(2)->toArray();
//            Article::where('id = 1')->get();
//        Article::where('id = 2')->get()->toArray();
//        $post =[
//            'title' => '我是被修改的书据',
//            'conter' => '我是被修改的内容'
//        ];
//        $result = Article::delete(2);
//        echo "<pre>";
//            print_r($result);
//            Article::where('id = 2')->get();
//        $oldData = Article::find(2);
////        $result = Article::find(2)->toArray();
//            echo "<pre>";
//            print_r($result);

        return View::make();

    }
}


?>