<?php
namespace mf\router;

use mf\router\AbstractRouter;

class Router extends AbstractRouter
{

    public function construct()
    {
        parent::construct();
    }

    public function addRoute($name, $url, $ctrl, $mth)
    {

        self::$routes[$url] = array($ctrl, $mth);

        self::$aliases[$name] = "$url";
    }

    public function setDefaultRoute($url)
    {
        self::$aliases['default'] = $url;
    }

    public function urlFor($route_name, $param_list = [])
    {
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

    public function run()
    {
        $url = $this->http_req->path_info;

        if (!isset(self::$routes[$url])) {
            $url = self::$aliases['default'];
        }

        $ctrl_name = self::$routes[$url][0];
        $mth_name = self::$routes[$url][1];

        $ctrl = new $ctrl_name;
        $ctrl->$mth_name();

    }

    public static function executeRoute($alias)
    {
      if(!isset(self::$routes[$alias])) {
            $url = self::$aliases['default'];
        }
        $controller = self::$routes[$alias] [0];
        $methode = self::$routes[$alias] [1];
        $c = new $controller();                                // au lieu de mettre return $html on viens recupérer direct grace à cette instanciation
        $c->$methode();
    }
}