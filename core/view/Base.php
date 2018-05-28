<?php
namespace core\view;
class Base{
//    定义文件路径
    protected $file;
//define('M',$m);
//define('C',$c);
//define('A',$a);
    public function make(){
        //定义一个需要加载的模板文件路径
//        $this->file = "app/".MODULE."/view/".strtolower(CONTROLLER)."/".ACTION.".php";
        $this->file = "app/" . M . "/view/" . strtolower(C) . "/" . A . ".php";
        //返回当前对象，再利用魔术方法，来实现加载模板
        return $this;
    }


    public function __toString()
    {
        //加载模板
        include $this->file;
        //当前这个魔术方法,一定要返回一个字符串,由于这里除了加载模板之外,没有东西返回输出,所以返回一个空字符串
        return '';
    }
}


?>