<?php
namespace core\model;
class Model{
    //定义连接数据库配置属性
    protected static $config;

    public function __call($name, $arguments)
    {
       return self::parseAction($name, $arguments);
    }
    public static function __callStatic($name, $arguments)
    {
        return self::parseAction($name, $arguments);
    }
    public static function parseAction($name, $arguments){
        //使用一个方法来调用类的名称
        $info = get_called_class();
//        因为$info是一个数组，需要把他切割出来，下标为2的就是类的名称，类的名称就是表明
        $table = explode('\\',$info)[2];
//        由于类的名称第一个字母是大写，但表明不一定是大写，所以要转大小写
        $table = strtolower($table);
//        回调函数
        return call_user_func_array([new Base(self::$config,$table),$name],$arguments);

    }
    public static function getConfig($config){
        //将$config变成一个当前对象的属性
        self::$config = $config;
    }


}






?>