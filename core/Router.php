<?php
/**
 * Created by PhpStorm.
 * User: A.Alami
 * Date: 09/03/14
 * Time: 17:44
 */
class Router {

    //parse an URL
    //@param url to parse
    //@return table with all parameters
    static function parse($url, $request){
        $url = trim($url,'/');
        $params = explode('/',$url);
        $request->controller = $params[0];
        $request->action = isset($params[1]) ? $params[1] : 'index';

        $request->params = array_slice ($params,2);
        return true;
    }

}