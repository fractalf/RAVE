<?php
/**
 * Unit tests for API
 * Check that each resource works
 */
class ApiTest extends PHPUnit_Framework_TestCase {

    private $ch;
    private $apiKey = '83e2c73c-3385-43cd-82e2-276922a6875a';
    
    protected function setUp() {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
    }
    
    protected function tearDown() {
        curl_close($this->ch);
    }
    
    public function testFoo() {
        $content = $this->get('/foo/bar?key=' . $this->apiKey);
        $data = json_decode($content, true);
        $this->assertTrue(isset($data['lervik']), 'Missing "lervik" property!');
    }
    
    public function testFooBeerBrew() {
        $data = [
            'name' => 'Banana Ale'
        ];
        
        $content = $this->post('/foo/beer/brew?key=' . $this->apiKey, $data);
        $result = json_decode($content, true);
        $this->assertTrue($result['success'], 'foo/beer/brew failed!');
    }

    private function get($url) {
        return $this->request($url);
    }
    
    private function post($url, $data) {
        return $this->request($url, $data);
    }

    private function request($url, $data = null) {
        curl_setopt($this->ch, CURLOPT_URL, API_URL . $url);
        
        if ($data) { // POST
            curl_setopt($this->ch, CURLOPT_POST, true);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        } // else GET
        
        $result = curl_exec($this->ch);
        $info = curl_getinfo($this->ch);
        $this->assertEquals($info['http_code'], 200, 'Connection problems!');
        $this->assertEquals($info['content_type'], 'application/json; charset=utf-8', 'Format problems!');
        return $result;
    }
}
