<?php
 namespace App;
 class SendCode{
     public static function SendCode($phone){
         $code =rand(100000,999999);
         $nexmo =app('Nexmo\Client');
         $nexmo->message()->send([
             'to' => '+84'.(int)$phone,
             'from' =>'Insta',
             'text' =>'Mã xác minh của bạn là: '+(string)$code
         ]);
         return $code;
     }
 }