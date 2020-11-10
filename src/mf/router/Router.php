<?php

namespace mf\router;

class Router extends AbstractRouter {

    public function __construct() {
        parent::__construct();
    }

    public function setDefaultRoute($url) {
        self::$aliases['default'] = $url;
    }

    public function addRoute($name, $url, $ctrl, $mth) {
        self::$routes[$url] = array($ctrl, $mth);
        self::$aliases[$name] = $url;
    }

    public function run() {
        if (array_key_exists($this->http_req->path_info, self::$routes)) {
            $controller = self::$routes[$this->http_req->path_info][0];
            $method = self::$routes[$this->http_req->path_info][1];

            $c = new $controller();
            $c->$method();
        }

        else {
            $default = self::$aliases['default'];

            $controller = self::$routes[$default][0];
            $method = self::$routes[$default][1];

            $c = new $controller();
            $c->$method();
        }
    }

    static function executeRoute($alias) {
        if (array_key_exists($alias, self::$aliases)) {
            $route = self::$aliases[$alias];
            $controller = self::$routes[$alias][0];
            $method = self::$routes[$alias][1];

            $c = new $controller();
            $c->$method();
        }
    }

    public function urlFor($route_name, $param_list=[]) {
        if(isset(self::$aliases[$route_name])) {
            $url_aliases = self::$aliases[$route_name];
            //var_dump($url_aliases);
            //$url_aliases = implode($url_aliases);
            //var_dump($url_aliases);
            $url = $this->http_req->script_name . $url_aliases;

            // * Note faire condition si plusieurs paramètres dans $param_list, faire avec l'éperluette 
            if(count($param_list) > 0) {
                $url = $url . "?";
                foreach($param_list as $param){
                    $url = $url . $param[0] . "=" . $param[1];
                }
            }
            return $url;
        }
    }
}