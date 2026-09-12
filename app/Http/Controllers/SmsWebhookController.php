<?php

namespace App\Http\Controllers;

use App\Models\SmsMessage;
use Illuminate\Http\Request;

class SmsWebhookController extends Controller
{
    public function receive(Request $request)
    {
        $from = $request->input('From');
        $to   = $request->input('To');
        $body = $request->input('Body');
        $sid  = $request->input('MessageSid');

        SmsMessage::create([
            'direction'    => 'inbound',
            'from_number'  => $from,
            'to_number'    => $to,
            'body'         => $body,
            'provider_sid' => $sid,
            'status'       => 'received',
        ]);

        // Respond with empty TwiML so Twilio doesn't auto-reply
        return response('<Response></Response>', 200)
            ->header('Content-Type', 'text/xml');
    }
}
