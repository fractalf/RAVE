<?php
/**
 * Foo
 */
namespace Rave\Modules;
use Rave\Lib\Tpl;
use Rave\Lib\Auth;

class Foo {
    
    // GET /foo/bar
    public static function bar() {
        $accessLevel = Auth::authorize('foo');
        
        $output = [];
        $accessLevels = [
            'lervik' => 1,
            'rogue' => 2,
            'brewdog' => 3
        ];
        
        $data = self::getData();

        foreach ($data as $key => $value) {
            if (isset($accessLevels[$key]) && $accessLevel < $accessLevels[$key]) {
                // No access to data element
                continue;
            }
            $output[$key] = $value;
        }
        Tpl::output($output);
    }
    
    // POST /foo/beer/brew
    public static function beerBrew() {
        Auth::authorize('foo');
        
        $name = filter_input(INPUT_POST, 'title', FILTER_DEFAULT);
        $name = 4;
        
        $response = [ 'success' => false ];
        if ($name) {
            $id = self::saveData($name);
            $response = [ 'success' => true, 'id' => $id ];
        }
        Tpl::output($response);
    }
    
    
    // Simulating getting data
    private static function getData() {
        return [
            'lervik'  => [ 'Betty Brown', 'Lucky Jack', 'Kringly Kris' ],
            'rogue'   => [ 'Shakespeare Stout', 'Hazelnut Brown Nectar' ],
            'brewdog' => [ 'Alpha Dog', 'Punk IPA' ]
        ];
    }
    
    // Simulating save data
    private static function saveData($name) {
        // Input into db or something simular
        return 42;
    }
}
