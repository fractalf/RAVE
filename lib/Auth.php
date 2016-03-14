<?php
namespace Rave\Lib;
/**
 * Access must be given a level for each resource
 * 1 - Normal (standard data set is exposed)
 * 2 - All (expose "all" data)
 * 3 - Übermench (also expose stuff needed for debug)
 */
class Auth {
    public static function authorize($resource) {
        $json = file_get_contents(__DIR__ . '/../auth.json');
        $config = json_decode($json, true);
        $key = filter_input(INPUT_GET, 'key', FILTER_DEFAULT, [ 'options' => [ 'default' => false ] ]);
        if ($key && !empty($config[$key])) {
            $access = isset($config[$key]['access'][$resource]) && $config[$key]['access'][$resource] !== false;
            if ($access) {
                return $config[$key]['access'][$resource];
            } else {
                Tpl::set('noResource', true);
                Tpl::render('accessdenied.php');
                exit;
            }
        } else {
            Tpl::set('noKey', true);
            Tpl::render('accessdenied.php');
            exit;
        }
    }
}
