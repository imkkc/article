<?php

/**
 * 注册器模式
 * 一般框架引导文件、或者配合工厂模式用的多一些
 */
class Register
{
    protected static $object;

    //注册
    static function set($alias, $object)
    {
        self::$object[$alias] = $object;
    }

    //获取
    static function get($name)
    {
        return self::$object[$name];
    }

    //消除
    static function _unset($alias)
    {
        unset(self::$object[$alias]);
    }
}


/**
 * 工厂模式，最普通常用的设计模式，它通常与单例模式一起用
 * 取代到处new的场景，万一类对象有更改，只更改工厂里的方法即可
 */
class Factory
{
    static function createDatabase()
    {
        $sth = new 业务场景类();
        //单例模式，比如多个数据库支持，只修改这一处即可
        $db = Database::getInstance();
        return $sth;
    }
}

/**
 * 单例模式
 */
class Database
{
    protected static $db;

    //屏蔽外界创建对象的作用
    private function __construct()
    {
    }

    static function getInstance()
    {
        if (self::$db) {
            return self::$db;
        } else {
            self::$db = new self();
            return self::$db;
        }
    }
}

/**
 * 适配器模式，将截然不同的函数接口封装成统一的api
 * 例如不同的数据库，不同的缓存等函数操作接口，统一成一样的调用方式
 * 用到接口Interface 然后各种操作类实现这个接口
 */
interface IDatabase
{
    function connect($host, $user, $password, $dbname);

    function query($sql);

    function close();
}
//然后就是mysql、oricle、mysqli、pdo等各自实现这个接口
class Mysql implements IDatabase {
    function connect($host, $user, $password, $dbname){

    }

    function query($sql){

    }

    function close(){

    }
}

/**
 * 策略模式 ，实现依赖倒置、控制反转
 * 每个场景设置一个策略类，外部调用方法，传入策略对象
 * 这样新增加场景只增加一个策略类即可
 */
interface IUserStage{
    function showAD();
    function showCategory();
}
//男性用户策略 继承接口 实现约定方法
class ManUserStage implements IUserStage{
    function showAD()
    {
        // TODO: Implement showAD() method.
    }

    function showCategory()
    {
        // TODO: Implement showCategory() method.
    }
}
//女性用户策略 继承接口 实现约定方法
class WoMenUserStage implements IUserStage{

    function showAD()
    {
        // TODO: Implement showAD() method.
    }

    function showCategory()
    {
        // TODO: Implement showCategory() method.
    }
}
class Page {
    /**
     * @var IUserStage 写了这个注解 phpstrom能跟踪到方法
     */
    protected $stage;
    function index(){
        //使用策略行为提供的方法，不需要硬编码一堆if、else判断男女or其他条件
        //策略对象是在外面传入的，直接用其方法
        $this->stage->showAD();
        $this->stage->showCategory();
    }

    //方法暴露给外面，用于被调用设置进去一个策略，参数约定接口类型
    function setStage(IUserStage $stage){
        $this->stage = $stage;
    }
}

$page = new Page();
if ('man' == $_GET['man']){
    $stage = new ManUserStage();
}else{
    $stage = new WoMenUserStage();
}
//外部调用方法，根据上下文环境，传入策略对象
//在执行过程中才将两个依赖关系进行绑定，实现Ioc，依赖倒置、控制反转， 看到这个想起laravel
$page->setStage($stage);
$page->index();


/**
 * 观察者模式，当一个对象发生改变，依赖它的对象全部更新改变
 * 观察者（需要执行的业务逻辑）
 * 生产者（触发业务逻辑的场景条件）
 */

//声明一个接口 表示观察者
interface Observer{
    function update($event_info = null);
}
//不同业务的各种观察者
class Observer1 implements Observer{
    function update($event_info = null)
    {
        // TODO: Implement update() method.
        echo '第1个观察者业务逻辑'.PHP_EOL;
    }
}
class Observer2 implements Observer{
    function update($event_info = null)
    {
        // TODO: Implement update() method.
        echo '第2个观察者业务逻辑'.PHP_EOL;
    }
}
//声明一个基类，表示事件️产生者
abstract class EventGenerator{
    //私有，因为观察者Observer对于事件发生者来说是不可见的
    private $observers = [];
    function addObserver(Observer $observer){
        $this->observers[] = $observer;
    }

    //逐个通知所有观察者
    function notify(){
        foreach ($this->observers as $observer){
            $observer->update();
        }
    }
}

//这时候，主体代码实现就简单了
class Event extends EventGenerator {
    //表示触发事件就通知各个业务场景更新
    function trigger(){
        echo 'Event'.PHP_EOL;
        $this->notify();
    }
}
$event = new Event();
$event->addObserver(new Observer1());
$event->addObserver(new Observer2());
$event->trigger();

