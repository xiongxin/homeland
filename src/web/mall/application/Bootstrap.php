<?php
/**
* @name Bootstrap
* @author xuebingwang
* @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
* @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
* 这些方法, 都接受一个参数:Yaf\Dispatcher $dispatcher
* 调用的次序, 和申明的次序相同
print_r(Yaf\Application::app());
//require yaf_classes.php
*/
class Bootstrap extends Yaf\Bootstrap_Abstract{

    private $_config;
    
    public function _initConfig() {
        //把配置保存起来
        $this->_config = Yaf\Application::app()->getConfig();
        Yaf\Registry::set('config', $this->_config);
    }
    
    public function _initHelper() {
        Yaf\Loader::import(APP_PATH.'helper'.DS.'functions.php');
    }
    
    public function _initPlugin(Yaf\Dispatcher $dispatcher){
        if(php_sapi_name() != 'cli'){
            
            //布局钩子
            $layout = new LayoutPlugin('layout.php');
            Yaf\Registry::set('layout', $layout);
            $dispatcher->registerPlugin($layout);
            
            //自定义url后辍钩子
            $sys_plugin = new SystemPlugin();
            $dispatcher->registerPlugin($sys_plugin);
        }
    }
    
    public function _initView(Yaf\Dispatcher $dispatcher){
        //在这里注册自己的view控制器，例如smarty,firekylin
        Yaf\Registry::set('dispatcher', $dispatcher);
    }
    
    public function _initSession(Yaf\Dispatcher $dispatcher){
        //session_start();
        //不使用这个了，因为要使用 Yaf\Session::getInstance()->start();
        Yaf\Session::getInstance()->start();
    }

    /**
     * [路由设置]
     */
    public function _initRoutes(Yaf\Dispatcher $dispatcher) {
        $router = $dispatcher->getRouter();
        Yaf\Loader::import(CONF_PATH . 'route.php');
        $router->addConfig($routeConfigs);
    }

//    public function _initDB() {
//        //把配置保存起来
//        $config     = Yaf\Application::app()->getConfig();
//        $db = new medoo($config->database->config->m->toArray());
//
//        if($config->database->config->debug){
//            $db->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
//        }
//
//        Yaf\Registry::set('db', $db);
//    }
}
