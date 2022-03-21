<?php

namespace App\Youtube\UseCase;

use App\Http\Controllers\Controller;
use App\Youtube\UseCase\GetYoutubeApi;
use Google_Service_YouTube;

class GetYoutubeVideoList
{
    public function getVideoList(String $id, Google_Service_YouTube $manager)
    {
        // クライアントインスタンスがNULLの場合、処理を終了
        if (empty($manager)) {
            return;
        }

        $result = $manager->videos->listVideos('statistics,snippet', [
            'id' => $id
        ]);

        return $result->items;
    }
}
