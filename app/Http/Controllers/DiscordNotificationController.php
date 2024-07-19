<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiscordNotificationController extends Controller
{
    public function sendNotification($message)
    {
        $webhookUrl = 'https://discord.com/api/webhooks/1263408977455091722/6iiQ3SoNO16O2Y3QqblOtuud9uRo7-43ZVc3inJqA8T9fgvyjlx03DEigh2kksmVj7Ae';

        return Http::post($webhookUrl, [
            'content' => $message,
            'embeds' => [
                [
                    'title' => 'New Payment Notification',
                    'description' => $message,
                    'color' => '7506394',
                ],
            ],
        ]);
    }
}

