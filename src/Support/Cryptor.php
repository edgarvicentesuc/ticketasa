<?php

namespace Omnipay\Ticketasa\Support;


use Omnipay\Common\Http\Exception;

class Cryptor
{
    const password_shuffled = "";


    public static function encrypt($plaintext)
    {
        //$plaintext = 'My secret message 1234';
        $password = '3sc3RLrpd17';
        $method = 'aes-256-cbc';

        $password = substr(hash('sha256', $password, true), 0, 32);
        ;
        $encrypted = base64_encode(openssl_encrypt($plaintext,
            $method, $password, OPENSSL_RAW_DATA, (new Cryptor)->getIV()));

        return $encrypted;
    }

    public static function desEncrypt($encrypted)
    {
        try{
        $password = '3sc3RLrpd17';
        $method = 'aes-256-cbc';

        $password = substr(hash('sha256', $password, true), 0, 32);

        $decrypted = openssl_decrypt(base64_decode($encrypted), $method,
            $password, OPENSSL_RAW_DATA, (new Cryptor)->getIV());

        }catch (Exception $error){

            print_r($error);
        }
        return $decrypted;
    }


    public function getIV()
    {

        return chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    }
}

