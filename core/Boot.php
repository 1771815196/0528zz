<?php
namespace core;
class Boot{
    public function run(){
        //检测是否有get参数，如果有进入写的文件目录，如果没有进入默认的文件
        if (isset($_GET['a'])){
            //由于我们用的是一个值，写的是一个字符串，需要用方法来切割，切割的是get传递的参数
            $info = explode('/',$_GET['a']);
            //模块的默认
            $m = $info[0];
//            默认的控制器变量
            $c = $info[1];
//            默认的方法变量
            $a = $info[2];
        }else{
            $m = 'home';
            $c = 'Entry';
            $a = 'index';
        }
//        定义常亮
        define('M',$m);
        define('C',$c);
        define('A',$a);
//        组合需要调用的类名称
        $class = '\app\\'.$m.'\\controller\\' . $c;
//        试用回调函数来对应控制器的输出
        echo call_user_func_array([new $class,$a],[]);

    }
}
?>