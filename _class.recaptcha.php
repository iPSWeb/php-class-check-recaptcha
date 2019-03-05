<?php
class recaptcha{
    var $secret = '';
    var $url = 'https://www.google.com/recaptcha/api/siteverify';
    var $response = '';
    function __construct($response,$secret) {
        $this->secret = $secret;//секретный ключ
        $this->response = $response;//ответ из $_POST['g-recaptcha-response']
    }
    
    public function checkRecaptcha(){
        $context  = stream_context_create($this->getOptions());
        $verify = file_get_contents($this->url,false, $context,-1,40000);
        $response = json_decode($verify);
        return $response->success;
    }
    
    private function getData(){
        return http_build_query([
            'secret' => $this->secret,
            'response' => $this->response
        ]);
    }
    
    private function getOptions(){
        return [
            'http' => [
                'header' => 'Content-Type: application/x-www-form-urlencoded\r\n'.
                            'Content-Length: '.strlen($this->getData()).'\r\n'.
                            'User-Agent:MyAgent/1.0\r\n',
                'method' => 'POST',
                'content' => $this->getData()
            ]
        ];
    }
}
