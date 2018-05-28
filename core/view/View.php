<?php
namespace core\view;
class View{
    //当实例化这个类并且找不到的时候回自动触发这个方法
    public function __call($name, $arguments)
    {
        return self::parseAction($name, $arguments);
    }
    ///当静态调用方法的时候找不到的时候就自动触发这个方法
    public static function __callStatic($name, $arguments)
    {
        return self::parseAction($name, $arguments);
    }


    public static function parseAction($name, $arguments)
    {
        //试用回调函数帮助用户找到模板并且返回第一个变量为对象，第二个不传递则为空
        return call_user_func_array([new Base(),$name],$arguments);

    }
}





?>