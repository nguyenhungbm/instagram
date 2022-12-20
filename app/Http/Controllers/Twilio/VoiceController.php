<?php

namespace App\Http\Controllers\Twilio;

use App\Http\Controllers\Controller;
use Config;
use Illuminate\Http\Request;
use Twilio\Exceptions\RestException;
use Twilio\Rest\Client;

class VoiceController extends Controller
{
    public function __construct()
    {
        // Twilio credentials
        $this->account_sid = Config::get('env.twilio_account_sid');
        $this->auth_token = Config::get('env.twilio_account_token');
        //the twilio number you purchased
        $this->from = Config::get('env.twilio_phone_number');

        // Initialize the Programmable Voice API
        $this->client = new Client($this->account_sid, $this->auth_token);
    }

    public function call()
    {
        return view('twilio.call');
    }

    /**
     * Making an outgoing call
     */
    public function initiateCall(Request $request)
    {
        // Validate form input
        $this->validate($request, [
            'phone_number' => 'required|string',
        ]);

        try {
            //Lookup phone number to make sure it is valid before initiating call
            $phone_number = $this->client->lookups->v1->phoneNumbers($request->phone_number)->fetch();

            // If phone number is valid and exists
            if ($phone_number) {
                // Initiate call and record call
                $call = $this->client->account->calls->create(
                    $request->phone_number, // Destination phone number
                    $this->from, // Valid Twilio phone number
                    array(
                        "record" => true,
                        "url" => "http://demo.twilio.com/docs/voice.xml"
                    )
                );

                if ($call) {
                    echo 'Call initiated successfully';
                } else {
                    echo 'Call failed!';
                }
            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        } catch (RestException $rest) {
            echo 'Error: ' . $rest->getMessage();
        }
    }
}
