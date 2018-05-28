<?php
namespace core\model;
class Base{
    protected $pdo;
//    定义表明属性
    protected $table;
    //定义where属性
    protected static $where;

    protected static $pri;
    public function __construct($config,$table)
    {//获得表明属性赋值给属性
        $this->table=$table;
        //自动连接数据库方法
        $this->connect($config);
    }
//        连接数据库
    public function connect($config){
        //判断当前pdo的值是否为null，如果有代表没有连接，就连接数据库，如果没有的话就代表连接过了，就不在连接了
        if (is_null($this->pdo)){
        $dns = 'mysql:host='.$config['host'].';dbname='.$config['dbname'];

        $username = $config['username'];
        $password = $config['password'];
        try{
            $this->pdo=new \PDO($dns,$username,$password);
            $this->pdo->query('set names utf8');
        }catch (\PDOException $e){
        die($e->getMessage());
        }
        }

    }

    public function find($pri){
//        组合sql语句
//        $sql ="select * from user where id = " .$pri;
        self::$pri=$pri;
        $prikey =$this->getPriKey();
        $sql = "select * from ".$this->table." where ".$prikey." = ".$pri;
        $result = $this->pdo->query($sql);
        $data = $result->fetch(\PDO::FETCH_ASSOC);
        $this->data = $data;
        return $this;
    }


        public function getPriKey(){
        //组合sql
            $sql = 'desc '.$this->table;
            $info = $this->pdo->query($sql);
//            $data = $info->fetchAll(\PDO::FETCH_ASSOC);
            $priKey = '';
            foreach ($info as $k => $v){
                if ($v['Key'] == 'PRI'){
                    $priKey = $v['Field'];
                    break;
                }
            }
            return $priKey;
    }
//public function getPriKey(){
//        $sql = 'desc '
//}
//    public function getPriKey(){
//        //组合sql
//        $sql = 'desc ' . $this->table;
//        //用pdo对象执行query方法来操作sql
//        $info = $this->pdo->query($sql);
//        $data = $info->fetchAll(\PDO::FETCH_ASSOC);
//        //定义一个空字符串用来接收主键名称的值
//        $priKey = '';
//        foreach ($data as $k => $v){
//            //判断如果$v里面的KEY == PRI,就代表当前$v对应的是主键的数据,取出主键的名称
//            if ($v['Key'] == 'PRI'){
//                $priKey = $v['Field'];
//                break;
//            }
//        }
//        //将主键名称返回
//        return $priKey;
//    }



        public function get(){
//        组合sql语句
            $sql = 'select * from '.$this->table . self::$where;
//            用pdo属性调用query方法来获取数据
            $re = $this->pdo->query($sql);
            $data = $re->fetchAll(\PDO::FETCH_ASSOC);
            $this->data = $data;
            return $this;



        }
    public function toArray(){
//        返回去
        return $this->data;

    }

    public function where($where){
//当用户调用了where方法的时候，当前对象就知道用户需要获取的数据和条件
        self::$where = ' where  '. $where;
        //返回当前对象，方便后面的练市操作
        return $this;
    }


    public function add($data){
//        定义一个接受字段的名称
        $KeyStr = '';
        $valuesStr = '';
        foreach ($data as $k => $v){
//                 $keyStr .= $k . ',';
//            $valueStr .= '"'.$v . '",';
            $KeyStr .=$k . ',';
            $valuesStr .= '"'.$v . '",';

        }
        $KeyStr = rtrim($KeyStr,',');
        $valuesStr = rtrim($valuesStr,',');
        $sql = 'insert into '.$this->table.' ('.$KeyStr.') values ('.$valuesStr.')';
        $data = $this->pdo->exec($sql);
        return $data;

    }


    public function edit($data){

        $str = '';
        foreach ($data as $k => $v){
            $str .= $k . ' = "' . $v .'",';

        }
        $str = rtrim($str,',');
//        获得逐渐名称
        $priKey = $this->getPriKey();
//        组合sql语句
        $sql = 'update '.$this->table.' set '.$str.' where '.$priKey.' = ' . self::$pri;
        $data = $this->pdo->exec($sql);
        return $data;


//        $sql = "update ".$this->table." set ".$str.self::$where;
//        $data = $this->pdo->exec($sql);
//        return $data;

    }
    public function delete($pri){
//获得逐渐名
        $priKey = $this->getPriKey();
        //组合语句
        $sql = 'delete from '.$this->table.' where '.$priKey.' = '.$pri;
        $data = $this->pdo->exec($sql);
        return $data;




    }




}
?>