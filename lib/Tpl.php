<?php
namespace Rave\Lib;

class Tpl {
    
    private static $data = [];
    
    public static function render($template, $args = []) {
        $data = self::$data; // used in template
        require __DIR__ . '/../templates/' . $template;
    }
    
    public static function set($var, $value) {
        self::$data[$var] = $value;
    }
    
    public static function output($result) {
        if (!empty($_GET['callback'])) {
            if (preg_match('/^[A-Za-z0-9_.]+$/', $_GET['callback'])) {
                header('Content-Type: application/javascript; charset=utf-8');
                header('Access-Control-Allow-Origin: *');
                echo $_GET['callback'] . '(' . json_encode($result) . ')';
            } else {
                echo "ERROR: Callback function needs to please /^[A-Za-z0-9_.]+$/";
                exit;
            }
        } else {
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($result);
        }
    }
    
}
