<?php
    namespace mf\router;
    use mf\auth\Authentification as Auth;

    class Router extends AbstractRouter {

        public function __construct() {
            parent::__construct();
        }

        public function addRoute($name, $url, $ctrl, $mth, $access_level) {
            self::$routes[$url] = [$ctrl, $mth, $access_level];
            self::$aliases[$name] = $url;
        }

        public function setDefaultRoute($url) {
            self::$aliases['default'] = $url;
        }

        public function run() {
            $path = $this->http_req->path_info;
            $auth = new Auth;
            // $ctrl = array_key_exists($path, self::$routes) ? self::$routes[$path][0] : self::$routes[self::$aliases['default']][0];
            // $mth =  array_key_exists($path, self::$routes) ? self::$routes[$path][1] : self::$routes[self::$aliases['default']][1];

            if (array_key_exists($path, self::$routes) && $auth->checkAccessRight(self::$routes[$path][2])) {
                $ctrl = self::$routes[$path][0];
                $mth = self::$routes[$path][1];
            } else {
                $ctrl = self::$routes[self::$aliases['default']][0];
                $mth = self::$routes[self::$aliases['default']][1];
            }

            $instance = new $ctrl();
            $instance->$mth();
        }

        public function urlFor($route_name, $param_list=[]) {
            $url = $this->http_req->script_name . self::$aliases[$route_name];
            if (!empty($param_list)) {
                $url .= '?';
                foreach($param_list as $key => $param) {
                    $multiparam = $param == end($param_list) ? '' : '&';
                    $url .= $key . '=' . $param . $multiparam;
                }
            }
            return $url;
        }

        public static function executeRoute($alias) {
            $ctrl = self::$routes[self::$aliases[$alias]][0];
            $mth = self::$routes[self::$aliases[$alias]][1];

            $instance = new $ctrl();
            $instance->$mth();
        }

        public function iconesPath() {
            return $this->http_req->root . '/html/images/';
        }
    }
?>