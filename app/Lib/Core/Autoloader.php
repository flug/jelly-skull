<?php
class Autoloader {

    public static $loader;

    public static function init()
    {
        if (self::$loader == NULL)
            self::$loader = new self();
//        var_dump($loader); 
        return self::$loader;
    }

    public function __construct()
    {
      
        spl_autoload_register(array($this,'helper'));        
       
        spl_autoload_register(array($this,'library'));
    }

    public function library($class)
    {
        set_include_path(get_include_path().PATH_SEPARATOR.ROOT.DS.APP_DIR.DS.'lib'.DS);
        spl_autoload_extensions('.php');
        spl_autoload($class);
    }


    public function helper($class)
    {
        $class = preg_replace('/_helper$/ui','',$class);

        set_include_path(get_include_path().PATH_SEPARATOR.ROOT.DS.APP_DIR.DS.'Helpers'.DS);
        
        spl_autoload_extensions('Helper.php');
        spl_autoload($class);
        
    }

}
Autoloader::init();
