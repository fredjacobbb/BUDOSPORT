<?php 

use GuzzleHttp\Client;

class Recaptcha {

    public static function checkCaptcha() {
        $secretKey = '';
        $client = new Client();
        if (!empty($_POST['g-recaptcha-response'])) {
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret' => $secretKey,
                    'response' => $_POST['g-recaptcha-response'],
                ]
            ]);
            $responseData = json_decode($response->getBody(), true);
            if ($responseData['success'] && $responseData['score'] >= 0.5) {
                return true;
            }else{
                return false;
            }
        }
    }
}