<?php
require('vendor/autoload.php');

use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot;

//先ほど取得したチャネルシークレットとチャネルアクセストークンを以下の変数にセット
$channel_access_token = 'bWr+I3z3v7XgAmogwyntjVYIHAQUI2ggOeeZXK4/IAgtcvDGgE9BIP8fAdq70t6/G2Fqnh9tS8owfYysWmBINLDJ6CUpiwX/1b5WGJhUcAsx2s6KEuAd6NKsYtN4r2+BTGtckGGJT5FHnbGM2F1k2wdB04t89/1O/w1cDnyilFU=';
$channel_secret = '8b8f8c31b5d2525a7e4eaae0ae7b3471';

$http_client = new CurlHTTPClient($channel_access_token);
$bot = new LINEBot($http_client, ['channelSecret' => $channel_secret]);
$signature = $_SERVER['HTTP_' . HTTPHeader::LINE_SIGNATURE];
$http_request_body = file_get_contents('php://input');
$events = $bot->parseEventRequest($http_request_body, $signature);
$event = $events[0];

$reply_token = $event->getReplyToken();
$reply_text = $event->getText();
$bot->replyText($reply_token, $reply_text);