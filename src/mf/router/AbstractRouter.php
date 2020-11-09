<?php

namespace mf\router;

abstract class AbstractRouter {
 /*   Une instance de HttpRequest */

    protected $http_req = null;

    static public $routes = array ();

    static public $aliases = array ();

    public function __construct(){
        $this->http_req = new \mf\utils\HttpRequest();
    }

    abstract public function run();

    abstract public function urlFor($route_name, $param_list=[]);

    abstract public function setDefaultRoute($url);

    abstract public function addRoute($name, $url, $ctrl, $mth);

}