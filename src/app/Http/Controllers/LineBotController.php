<?php

namespace App\Http\Controllers;

use App\Youtube\UseCase\GetYoutubeApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use App\Youtube\UseCase\GetYoutubeVideoList;
use App\Youtube\UseCase\SearchYoutubeVideo;

class LineBotController extends Controller
{
    public function inputAnimeName(Request $request)
    {
        Log::debug('開始');
        // 認証を行う
        $lineAccessToken = config('services.line.access_token');
        $lineChannelSecret = config('services.line.channel_secret');

        // LINE Botのインスタンスを作成
        $httpClient = new CurlHTTPClient($lineAccessToken);
        $lineBot = new LINEBot($httpClient, ['channelSecret' => $lineChannelSecret]);

        $signature = $request->header('x-line-signature');

        if (!$lineBot->validateSignature($request->getContent(), $signature)) {
            //送信元に400エラーを伝える
            abort(400, 'Invalid signature');
        }

        // LINE Botから入力値を取得
        $events = $lineBot->parseEventRequest($request->getContent(), $signature);

        // YouTubeのアクセスするAPIのインスタンスを作成
        $managerFactory = new GetYoutubeApi();
        $manager = $managerFactory->__construct();

        // 動画を検索するクラスのインスタンスを作成
        $searchYoutubeVieo = new SearchYoutubeVideo();
        $getYoutubeVideoList = new GetYoutubeVideoList();

        foreach ($events as $event) {
            if (!($event instanceof TextMessage)) {
                continue;
            }

            // LINE Botから取得したデータからトークンを取得
            $replyToken = $event->getReplyToken();
            // LINE Botから取得したデータのうち、入力値のみを取得
            $replyText = $event->getText();

            // エンコードを行う
            $replyText = mb_convert_encoding($replyText, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');

            // 動画を検索
            $searchList = $searchYoutubeVieo->searchList($replyText, $manager);

            // データのURLを取得
            foreach ($searchList as $data) {
                $videosList = $getYoutubeVideoList->getVideoList($data->id->videoId, $manager);
                $embed = "https://www.youtube.com/embed/" . $videosList[0]['id'];
                $array[] = array($embed, $videosList[0]['snippet'], $videosList[0]['statistics']);
            }

            // LINE Botに戻す値を作成
            $video_link = $array[0][0];
        }

        // LINE Botに返信する
        $lineBot->replyText($replyToken, $video_link);
    }
}
