<?php
 	session_start();
    require_once 'vendor/autoload.php';
    require_once 'src/mf/utils/ClassLoader.php';
    new mf\utils\ClassLoader('src');
    use mediaphoto\control\TweeterController as Tweeter;
    use mf\router\Router as Router;
    use tweeterapp\auth\TweeterAuthentification as Auth;

    mf\view\AbstractView::addStyleSheet('html/css/main.css');   

    $config = parse_ini_file('conf/conf.ini');
    $db = new Illuminate\Database\Capsule\Manager();
    $db->addConnection($config); 
    $db->setAsGlobal();
    $db->bootEloquent();