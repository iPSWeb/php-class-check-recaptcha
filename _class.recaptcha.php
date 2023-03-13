<?php
class recaptcha
{
    var $secret = '';
    var $_url = 'https://www.google.com/recaptcha/api/siteverify';
    var $response = '';
    function __construct($response, $secret)
    {
        $this->secret = $secret; //секретный ключ
        $this->response = $response; //ответ из $_POST['g-recaptcha-response']
    }

    public function checkRecaptcha()
    {
        $response = $this->sendRequest($this->getData());
        return $response['success'];
    }

    private function getData()
    {
        return http_build_query([
            'secret' => $this->secret,
            'response' => $this->response
        ]);
    }
    
    private function sendRequest($content) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_URL, $this->_url . '?' . $content);
        curl_setopt($ch, CURLOPT_TIMEOUT, 80);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
}
