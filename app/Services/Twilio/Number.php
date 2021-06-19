<?php
 namespace App\Services\Twilio;
 use Twilio\Rest\Client;
 class Number{
    public static $client;
    public static function setClient(){
        self::$client =new Client(config('twilio.sid'),config('twilio.token'));
    }
    public static function create(){
        self::setClient();
        $numbers = self::$client->availablePhoneNumbers('US')->local->read(['areaCode'=>'612']);
        $number  = self::$client->incomingPhoneNumbers->create([
            'phoneNumber'   => $numbers[0]->phoneNumber,
            'SmsUrl'        => route('twilio.sms'),
            'VoiceUrl'      => route('twilio.voice')
        ]);
        return $number->phoneNumber;
    }
 }