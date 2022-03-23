<?php

namespace App\Youtube\UseCase;

use App\Http\Controllers\Controller;
use App\Youtube\UseCase\GetYoutubeApi;
use Google_Service_YouTube;
use Illuminate\Support\Facades\Log;

class SearchYoutubeVideo
{
    /**
     * チャネル名からビデオリストを取得
     * @param String $channel_name LINEから取得したチャネル名
     * @return $result 取得したリストを返却
     */
    public function searchList(String $channel_name, Google_Service_YouTube $manager)
    {
        // クライアントインスタンスがNULLの場合、処理を終了
        if (empty($manager)) {
            return;
        }

        // ビデオリストを取得
        $result = $manager->search->listSearch('id', [
            'q' => $channel_name, // 検索文字を指定
            'maxResults' => 1, // 取得件数を指定
        ]);

        return $result->items;
    }
}
